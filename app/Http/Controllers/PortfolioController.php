<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Throwable;

class PortfolioController extends Controller
{
    public function create()
    {
        return view('portfolio.create');
    }

    // Step 1: keep the information as a DRAFT.
    public function store(Request $request)
    {
        $data = $this->validatePortfolio($request);

        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request
                ->file('profile_picture')
                ->store('profiles', 'public');
        }

        $data['user_id'] = Auth::id();
        $data['selected_template'] = 1;
        $data['status'] = Portfolio::STATUS_DRAFT;

        $portfolio = Portfolio::create($data);

        return redirect()
            ->route('portfolio.templates', $portfolio->id)
            ->with('success', 'Your information was kept as a draft. Now choose a template.');
    }

    // Step 2: choose a template.
    public function templates(Portfolio $portfolio)
    {
        $this->authorizeOwner($portfolio);

        return view('portfolio.templates', compact('portfolio'));
    }

    // "Use Selected Template": show the preview.
    // Draft: the chosen template is remembered.
    // Saved: nothing changes until the user clicks "Save Changes".
    public function selectTemplate(Request $request, Portfolio $portfolio)
    {
        $this->authorizeOwner($portfolio);

        $validated = $request->validate([
            'template' => ['required', Rule::in(['1', '2', '3'])],
        ]);

        if ($portfolio->status === Portfolio::STATUS_DRAFT) {
            try {
                $updated = $portfolio->update([
                    'selected_template' => (int) $validated['template'],
                ]);
            } catch (Throwable $e) {
                report($e);
                $updated = false;
            }

            if (! $updated) {
                return back()->with('error', 'Sorry, the template could not be selected. Please try again.');
            }

            $message = 'Template selected. Review your portfolio, then click Save Portfolio.';
        } else {
            $message = 'Template changed. Click Save Changes to keep it.';
        }

        return redirect()
            ->route('portfolio.preview', [
                'portfolio' => $portfolio->id,
                'template' => $this->templateSlug((int) $validated['template']),
            ])
            ->with('success', $message);
    }

     // "Save Portfolio" / "Save Changes" button.
    public function save(Request $request, Portfolio $portfolio)
    {
        $this->authorizeOwner($portfolio);

        $validated = $request->validate([
            'template' => ['nullable', Rule::in(['1', '2', '3'])],
        ]);

        $wasSaved = $portfolio->status === Portfolio::STATUS_SAVED;

        $attributes = ['status' => Portfolio::STATUS_SAVED];

        if (! empty($validated['template'])) {
            $attributes['selected_template'] = (int) $validated['template'];
        }

        try {
            $saved = $portfolio->update($attributes);
        } catch (Throwable $e) {
            report($e);
            $saved = false;
        }

        if (! $saved) {
            return back()->with('error', 'Sorry, the portfolio could not be saved. Please try again.');
        }

        // After saving, go to My Portfolios where the portfolio can be opened.
        return redirect()
            ->route('portfolio.manage')
            ->with('success', $wasSaved ? 'Changes saved successfully!' : 'Portfolio saved successfully!');
    }

    // Step 3: review.
    public function preview(Portfolio $portfolio, ?string $template = null)
    {
        $this->authorizeOwner($portfolio);

        $template = $template ?? $this->templateSlug((int) $portfolio->selected_template);

        $numbers = ['simple' => 1, 'modern' => 2, 'creative' => 3];

        abort_unless(isset($numbers[$template]), 404);

        // The template number being previewed, and whether it differs from the saved one.
        $templateNumber = $numbers[$template];
        $hasPendingChange = $templateNumber !== (int) $portfolio->selected_template;

        return view('templates.' . $template, compact('portfolio', 'templateNumber', 'hasPendingChange'));
    }

    // My Portfolios: only the signed-in user's records.
    public function manage()
    {
        $portfolios = Portfolio::where('user_id', Auth::id())->latest()->get();

        return view('portfolio.manage', compact('portfolios'));
    }

    public function edit(Portfolio $portfolio)
    {
        $this->authorizeOwner($portfolio);

        return view('portfolio.create', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $this->authorizeOwner($portfolio);

        $data = $this->validatePortfolio($request);

        if ($request->hasFile('profile_picture')) {
            if ($portfolio->profile_picture) {
                Storage::disk('public')->delete($portfolio->profile_picture);
            }

            $data['profile_picture'] = $request
                ->file('profile_picture')
                ->store('profiles', 'public');
        }

        try {
            $portfolio->update($data);
        } catch (Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->with('error', 'Sorry, your changes could not be saved. Please try again.');
        }

        // A draft continues to template selection; a saved portfolio goes to review.
        if ($portfolio->status === Portfolio::STATUS_DRAFT) {
            return redirect()
                ->route('portfolio.templates', $portfolio->id)
                ->with('success', 'Draft updated. Choose a template.');
        }

        return redirect()
            ->route('portfolio.preview', [
                'portfolio' => $portfolio->id,
                'template' => $this->templateSlug((int) $portfolio->selected_template),
            ])
            ->with('success', 'Portfolio updated successfully!');
    }

    public function destroy(Portfolio $portfolio)
    {
        $this->authorizeOwner($portfolio);

        $picture = $portfolio->profile_picture;

        try {
            $portfolio->delete();
        } catch (Throwable $e) {
            report($e);

            return redirect()
                ->route('portfolio.manage')
                ->with('error', 'Sorry, the portfolio could not be deleted.');
        }

        if ($picture) {
            Storage::disk('public')->delete($picture);
        }

        return redirect()
            ->route('portfolio.manage')
            ->with('success', 'Portfolio deleted successfully!');
    }

    private function validatePortfolio(Request $request): array
    {
        return $request->validate([
            'full_name' => ['required', 'string', 'max:255', 'regex:/^[\pL\pM ]+$/u'],
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|string|max:30',
            'address' => 'required|string|max:255',
            'about_me' => 'required|string',
            'education' => 'required|string',
            'skills' => 'required|string',
            'projects' => 'nullable|string',
            'work_experience' => 'nullable|string',
            'social_links' => 'nullable|string',
        ], [
            'full_name.regex' => 'Your name may only contain letters and spaces (no numbers or symbols).',
        ]);
    }

    // Returns 404 (not 403) so other people's portfolio IDs are not revealed.
    private function authorizeOwner(Portfolio $portfolio): void
    {
        abort_unless((int) $portfolio->user_id === (int) Auth::id(), 404);
    }

    private function templateSlug(int $template): string
    {
        return match ($template) {
            1 => 'simple',
            2 => 'modern',
            3 => 'creative',
            default => 'simple',
        };
    }
}