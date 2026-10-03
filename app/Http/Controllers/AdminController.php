<?php

namespace App\Http\Controllers;

use App\Models\PageSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $sections = PageSection::orderBy('section')->get();

        return view('admin.index', compact('sections'));
    }

    public function editSection(string $section): View
    {
        $pageSection = PageSection::firstOrCreate(
            ['section' => $section],
            ['content' => []]
        );

        return view('admin.edit', compact('pageSection'));
    }

    public function updateSection(Request $request, string $section): RedirectResponse
    {
        $validated = $request->validate([
            'content' => ['required', 'string'],
        ]);

        $decoded = json_decode($validated['content'], true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return back()->withErrors(['content' => 'Invalid JSON format: ' . json_last_error_msg()])->withInput();
        }

        PageSection::updateOrCreate(
            ['section' => $section],
            [
                'content' => $decoded,
                'updated_at' => now(),
            ]
        );

        return redirect()->route('admin.dashboard')->with('success', "Section '{$section}' updated successfully!");
    }
}
