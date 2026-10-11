<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PortfolioController extends Controller
{
    public function create()
    {
        return view('portfolio.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
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
        ]);

        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request
                ->file('profile_picture')
                ->store('profiles', 'public');
        }

        $data['selected_template'] = 1;

        // Creates a new record; does not replace previous portfolios.
        $portfolio = Portfolio::create($data);

        return redirect()
            ->route('portfolio.templates', $portfolio->id)
            ->with('success', 'Portfolio information saved successfully!');
    }

    public function templates(Portfolio $portfolio)
    {
        return view('portfolio.templates', compact('portfolio'));
    }

    public function selectTemplate(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'template' => [
                'required',
                Rule::in(['1', '2', '3']),
            ],
        ]);

        $portfolio->update([
            'selected_template' => (int) $validated['template'],
        ]);

        return redirect()->route(
            'portfolio.preview',
            [
                'portfolio' => $portfolio->id,
                'template' => $this->templateSlug(
                    (int) $validated['template']
                ),
            ]
        );
    }

    public function preview(Portfolio $portfolio, ?string $template = null)
    {
        $template = $template ?? $this->templateSlug(
            (int) $portfolio->selected_template
        );

        abort_unless(
            in_array($template, ['simple', 'modern', 'creative'], true),
            404
        );

        return view('templates.' . $template, compact('portfolio'));
    }

    public function manage()
    {
        $portfolios = Portfolio::latest()->get();

        return view('portfolio.manage', compact('portfolios'));
    }

    public function edit(Portfolio $portfolio)
    {
        return view('portfolio.create', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
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
        ]);

        if ($request->hasFile('profile_picture')) {
            if ($portfolio->profile_picture) {
                Storage::disk('public')->delete(
                    $portfolio->profile_picture
                );
            }

            $data['profile_picture'] = $request
                ->file('profile_picture')
                ->store('profiles', 'public');
        }

        $portfolio->update($data);

        return redirect()
            ->route('portfolio.preview', [
                'portfolio' => $portfolio->id,
                'template' => $this->templateSlug(
                    (int) $portfolio->selected_template
                ),
            ])
            ->with('success', 'Portfolio updated successfully!');
    }

    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->profile_picture) {
            Storage::disk('public')->delete(
                $portfolio->profile_picture
            );
        }

        $portfolio->delete();

        return redirect()
            ->route('portfolio.manage')
            ->with('success', 'Portfolio deleted successfully!');
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
