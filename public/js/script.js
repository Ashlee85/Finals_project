
function getSavedPortfolios() {
    try {
        return JSON.parse(localStorage.getItem('studentFolioPortfolios') || '[]');
    } catch {
        return [];
    }
}

function setSavedPortfolios(items) {
    localStorage.setItem('studentFolioPortfolios', JSON.stringify(items));
}

function escapeHTML(value) {
    return String(value ?? '').replace(/[&<>"']/g, char => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    })[char]);
}

function safeUrl(value) {
    try {
        const url = new URL(value);
        return ['http:', 'https:'].includes(url.protocol) ? url.href : null;
    } catch {
        return null;
    }
}

function getActivePortfolioData() {
    try {
        return JSON.parse(sessionStorage.getItem('studentFolioDraft') || 'null');
    } catch {
        return null;
    }
}

function loadPortfolioPreview(template) {
    const data = getActivePortfolioData();

    if (!data) {
        window.location.href = '/create-portfolio';
        return;
    }

    document.querySelectorAll('[data-field]').forEach(element => {
        const key = element.dataset.field;
        element.textContent = data[key] || 'Not provided';
    });

    const photo = document.getElementById('profileImage');
    if (photo) {
        if (data.profile_picture) {
            photo.src = data.profile_picture;
        } else {
            photo.src = 'https://placehold.co/400x400/e7eee8/174b3b?text=Profile';
        }
        photo.alt = (data.full_name || 'Student') + ' profile picture';
    }

    const contact = [
        data.email,
        data.contact_number,
        data.address
    ].filter(Boolean).join(' • ');

    ['simpleContact', 'modernContact', 'creativeContact'].forEach(id => {
        const element = document.getElementById(id);
        if (element) element.textContent = contact;
    });

    const skills = String(data.skills || '')
        .split(',')
        .map(skill => skill.trim())
        .filter(Boolean);

    const skillList = document.getElementById('skillList');
    if (skillList) {
        skillList.innerHTML = skills.length
            ? skills.map(skill => `<span>${escapeHTML(skill)}</span>`).join('')
            : '<span>No skills added</span>';
    }

    const social = document.getElementById('socialLinks');
    if (social) {
        const links = String(data.social_links || '')
            .split(/\n|,/)
            .map(link => link.trim())
            .filter(Boolean)
            .map(link => ({ text: link, url: safeUrl(link) }))
            .filter(item => item.url);

        social.innerHTML = links.map((item, index) =>
            `<a href="${escapeHTML(item.url)}" target="_blank"
                rel="noopener noreferrer">Link ${index + 1} ↗</a>`
        ).join('');
    }

    sessionStorage.setItem('studentFolioTemplate', template);
}

function saveCurrentPortfolio() {
    const data = getActivePortfolioData();
    const template = sessionStorage.getItem('studentFolioTemplate') || 'simple';

    if (!data || !data.full_name) {
        alert('Please complete the portfolio form first.');
        window.location.href = '/create-portfolio';
        return;
    }

    const portfolios = getSavedPortfolios();

    const portfolio = {
        ...data,
        id: (window.crypto && crypto.randomUUID)
            ? crypto.randomUUID()
            : String(Date.now()),
        template,
        created_at: new Date().toISOString()
    };

    portfolios.push(portfolio);

    try {
        setSavedPortfolios(portfolios);
        sessionStorage.removeItem('studentFolioDraft');
        sessionStorage.removeItem('studentFolioTemplate');
        alert('Portfolio saved successfully!');
        window.location.href = '/manage-portfolio';
    } catch (error) {
        alert('Unable to save. The profile photo may be too large. Try a smaller photo.');
    }
}

function deletePortfolio(id) {
    if (!confirm('Are you sure you want to delete this portfolio?')) return;

    const portfolios = getSavedPortfolios()
        .filter(portfolio => portfolio.id !== id);

    setSavedPortfolios(portfolios);
    renderPortfolioList();
}

function renderPortfolioList() {
    const container = document.getElementById('portfolioList');
    if (!container) return;

    const portfolios = getSavedPortfolios();

    if (portfolios.length === 0) {
        container.innerHTML = `
            <div class="empty-state">
                <h2>No portfolios yet</h2>
                <p>Create your first student portfolio to get started.</p>
                <a class="btn btn-primary" href="/create-portfolio">Create Portfolio</a>
            </div>`;
        return;
    }

    container.innerHTML = portfolios.map(portfolio => {
        const photo = portfolio.profile_picture ||
            'https://placehold.co/100x100/e7eee8/174b3b?text=Photo';

        const date = new Date(portfolio.created_at).toLocaleDateString();

        return `
            <article class="saved-portfolio">
                <img src="${escapeHTML(photo)}" alt="Profile picture">
                <div class="saved-details">
                    <h3>${escapeHTML(portfolio.full_name)}</h3>
                    <p>${escapeHTML(portfolio.email || '')}</p>
                    <small>${escapeHTML(portfolio.template)} · ${date}</small>
                </div>
                <div class="saved-actions">
                    <button class="btn btn-outline" data-view="${escapeHTML(portfolio.id)}">View</button>
                    <button class="btn btn-outline" data-edit="${escapeHTML(portfolio.id)}">Edit</button>
                    <button class="btn btn-danger" data-delete="${escapeHTML(portfolio.id)}">Delete</button>
                </div>
            </article>`;
    }).join('');

    container.querySelectorAll('[data-view]').forEach(button => {
        button.addEventListener('click', () => {
            const portfolio = portfolios.find(item => item.id === button.dataset.view);
            if (!portfolio) return;

            sessionStorage.setItem('studentFolioDraft', JSON.stringify(portfolio));
            sessionStorage.setItem('studentFolioTemplate', portfolio.template);
            window.location.href = '/preview/' + portfolio.template;
        });
    });

    container.querySelectorAll('[data-edit]').forEach(button => {
        button.addEventListener('click', () => {
            const portfolio = portfolios.find(item => item.id === button.dataset.edit);
            if (!portfolio) return;

            sessionStorage.setItem('studentFolioEditId', portfolio.id);
            sessionStorage.setItem('studentFolioDraft', JSON.stringify(portfolio));
            window.location.href = '/create-portfolio';
        });
    });

    container.querySelectorAll('[data-delete]').forEach(button => {
        button.addEventListener('click', () => {
            deletePortfolio(button.dataset.delete);
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    renderPortfolioList();
});
