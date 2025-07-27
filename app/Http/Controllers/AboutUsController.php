<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Partner;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AboutUsController extends Controller
{
    // Show About Us page
    public function index()
    {
         $aboutUs = AboutUs::firstOrNew(); // Gets first record or new empty model
         $teamMembers = \App\Models\TeamMember::orderBy('order')->get();
         $partners = Partner::all();
         $brands = Brand::all();
        return view('frontend.aboutus.aboutus', compact('aboutUs', 'teamMembers', 'partners', 'brands'));
    }

    // Show create form (typically would redirect to edit since we only need one about us page)
    public function create()
    {
        // Check if about us already exists
        if (AboutUs::exists()) {
            return redirect()->route('frontend.aboutus.edit');
        }
        
        return view('frontend.aboutus.create');
    }

    // Handle creation of new about us page
     public function store(Request $request)
    {
        if (AboutUs::exists()) {
            return redirect()->route('frontend.aboutus.edit')
                ->with('error', 'About Us page already exists. Please edit the existing one.');
        }

        $validated = $request->validate([
            'main_title' => 'required|string|max:255',
            'main_description' => 'required|string',
            'why_choose_title' => 'required|string|max:255',
            'why_choose_description' => 'required|string',
            'features' => 'required|array|min:1',
            'features.*.title' => 'required|string|max:255',
            'features.*.description' => 'required|string',
            'main_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'secondary_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Store images in public disk
        $validated['main_image'] = $request->file('main_image')->store('about-us', 'public');
        $validated['secondary_image'] = $request->file('secondary_image')->store('about-us', 'public');

        AboutUs::create($validated);

        return redirect()->route('aboutus')->with('success', 'About Us page created successfully!')->withFragment('team-section');
    }

    // Show edit form
    public function edit()
    {
        $aboutUs = AboutUs::firstOrNew();
        return view('frontend.aboutus.edit', compact('aboutUs'));
    }

    // Handle update
    public function update(Request $request)
    {
        $validated = $request->validate([
            'main_title' => 'required|string|max:255',
            'main_description' => 'required|string',
            'why_choose_title' => 'required|string|max:255',
            'why_choose_description' => 'required|string',
            'features' => 'required|array|min:1',
            'features.*.title' => 'required|string|max:255',
            'features.*.description' => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'secondary_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $aboutUs = AboutUs::firstOrNew();

        // Handle image uploads with public disk
        if ($request->hasFile('main_image')) {
            if ($aboutUs->main_image) Storage::disk('public')->delete($aboutUs->main_image);
            $validated['main_image'] = $request->file('main_image')->store('about-us', 'public');
        }

        if ($request->hasFile('secondary_image')) {
            if ($aboutUs->secondary_image) Storage::disk('public')->delete($aboutUs->secondary_image);
            $validated['secondary_image'] = $request->file('secondary_image')->store('about-us', 'public');
        }

        $aboutUs->fill($validated)->save();

        return redirect()->route('aboutus')->with('success', 'About Us page updated!')->withFragment('team-section');
    }

    // Handle deletion
    public function destroy()
    {
        $aboutUs = AboutUs::first();
        
        if (!$aboutUs) {
            return redirect()->back()->with('error', 'About Us page not found');
        }

        // Delete images from public disk
        if ($aboutUs->main_image) Storage::disk('public')->delete($aboutUs->main_image);
        if ($aboutUs->secondary_image) Storage::disk('public')->delete($aboutUs->secondary_image);

        $aboutUs->delete();

        return redirect()->route('aboutus')->with('success', 'About Us page deleted successfully')->withFragment('team-section');
    }
}