<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;

class PublicPortfolioController extends Controller
{
    // Public, read-only page. Only SAVED portfolios can be opened.
    public function show(string $slug)
    {
        $portfolio = Portfolio::where('slug', $slug)
            ->where('status', Portfolio::STATUS_SAVED)
            ->firstOrFail();

        $templates = [1 => 'simple', 2 => 'modern', 3 => 'creative'];
        $templateNumber = (int) $portfolio->selected_template;
        $template = $templates[$templateNumber] ?? 'simple';

        $hasPendingChange = false;
        $isPublic = true; // hides every owner button in the template

        return view('templates.' . $template, compact(
            'portfolio',
            'templateNumber',
            'hasPendingChange',
            'isPublic'
        ));
    }
}