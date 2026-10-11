
document.addEventListener('DOMContentLoaded', function () {
    // Preview the selected profile picture before submitting.
    const pictureInput = document.getElementById('profilePicture');
    const imagePreview = document.getElementById('imagePreview');

    if (pictureInput && imagePreview) {
        pictureInput.addEventListener('change', function () {
            const file = this.files && this.files[0];

            imagePreview.replaceChildren();

            if (!file) return;

            if (!file.type.startsWith('image/')) {
                alert('Please select an image file.');
                this.value = '';
                return;
            }

            const image = document.createElement('img');
            image.alt = 'Selected profile picture';
            image.style.width = '90px';
            image.style.height = '90px';
            image.style.objectFit = 'cover';
            image.style.borderRadius = '50%';

            const reader = new FileReader();

            reader.onload = function (event) {
                image.src = event.target.result;
                imagePreview.appendChild(image);
            };

            reader.readAsDataURL(file);
        });
    }

    // Confirm before deleting a portfolio.
    document.querySelectorAll('.saved-card form').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!confirm('Are you sure you want to delete this portfolio?')) {
                event.preventDefault();
            }
        });
    });
});