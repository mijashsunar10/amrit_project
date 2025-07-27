<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $teamMembers = TeamMember::orderBy('order')->get();
        return view('frontend.aboutus.aboutus', compact('teamMembers'));
    }

public function create()
    {
        return view('frontend.aboutus.teammember.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'instagram' => ['nullable', 'url', 'starts_with:https://www.instagram.com/'],
            'facebook' => ['nullable', 'url', 'starts_with:https://www.facebook.com/'],
        ]);
        
        $imagePath = $request->file('image')->store('team-images', 'public');
        
        TeamMember::create([
            'name' => $validated['name'],
            'position' => $validated['position'],
            'bio' => $validated['bio'],
            'image_path' => $imagePath,
            'social_instagram' => $validated['instagram'] ?? null,
            'social_facebook' => $validated['facebook'] ?? null,
        ]);
        
        return redirect()->route('aboutus')->with('success', 'Team member added successfully')->with('scroll', 'team-section');;
    }

    public function edit(TeamMember $teamMember)
    {
        return view('frontend.aboutus.teammember.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'instagram' => ['nullable', 'url', 'starts_with:https://www.instagram.com/'],
            'facebook' => ['nullable', 'url', 'starts_with:https://www.facebook.com/'],
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            Storage::disk('public')->delete($teamMember->image_path);
            // Store new image
            $imagePath = $request->file('image')->store('team-images', 'public');
            $teamMember->image_path = $imagePath;
        }

        $teamMember->update([
            'name' => $validated['name'],
            'position' => $validated['position'],
            'bio' => $validated['bio'],
            'social_instagram' => $validated['instagram'] ?? null,
            'social_facebook' => $validated['facebook'] ?? null,
        ]);

        return redirect()->route('aboutus')->with('success', 'Team member updated successfully')->with('scroll', 'team-section');;
    }

    public function destroy(TeamMember $teamMember)
    {
        Storage::disk('public')->delete($teamMember->image_path);
        $teamMember->delete();
        return redirect()->route('aboutus')->with('success', 'Team member deleted successfully')->with('scroll', 'team-section');;
    }

    
}
