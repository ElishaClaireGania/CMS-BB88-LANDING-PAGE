<?php

namespace App\Http\Controllers;

use App\Models\PageSection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    public function index(): View
    {
        return view('landing');
    }

    public function getSection(Request $request, ?string $section = null): JsonResponse
    {
        $sectionName = $section ?? $request->query('section');

        if (empty($sectionName)) {
            return response()->json(['error' => 'Missing section parameter.'], 400);
        }

        try {
            $pageSection = PageSection::where('section', $sectionName)->first();

            if ($pageSection) {
                return response()->json($pageSection->content);
            }
        } catch (\Throwable $e) {
            // Fallback to local json files if database is not reachable yet
        }

        $filePath = public_path("src/data/{$sectionName}.json");
        if (file_exists($filePath)) {
            $data = json_decode(file_get_contents($filePath), true);
            return response()->json($data);
        }

        return response()->json(['error' => "Section '{$sectionName}' not found."], 404);
    }
}
