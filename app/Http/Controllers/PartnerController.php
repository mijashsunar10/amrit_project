<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use Illuminate\Support\Facades\Storage;


class PartnerController extends \App\Http\Controllers\Controller
{    
    public function index()
    {        $partners = Partner::all();
        return view('frontend.aboutus.aboutus', compact('partners'));
    }

     public function create()
    {
        return view('frontend.aboutus.partners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,WebP,HEIF,HEIC|max:2048'
        ]);

        $path = $request->file('logo')->store('partner_logos', 'public');

        Partner::create([
            'name' => $request->name,
            'logo' => $path
        ]);

       return redirect()->route('aboutus')->with('success', 'Partner added successfully')->with('scroll', 'partners-section');
    }
    public function edit(Partner $partner)
    {
        return view('frontend.aboutus.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,WebP,HEIF,HEIC|max:2048'
        ]);

        $partner->name = $request->name;

        if ($request->hasFile('logo')) {
            Storage::disk('public')->delete($partner->logo);
            $path = $request->file('logo')->store('partner_logos', 'public');
            $partner->logo = $path;
        }

        $partner->save();

         return redirect()->route('aboutus')->with('success', 'Partner Updated successfully')->with('scroll', 'partners-section');
    }

    public function destroy(Partner $partner)
    {
        Storage::disk('public')->delete($partner->logo);
        $partner->delete();
        
        return redirect()->route('aboutus')->with('success', 'Partner deleted successfully')->with('scroll', 'partners-section');
    }
}
