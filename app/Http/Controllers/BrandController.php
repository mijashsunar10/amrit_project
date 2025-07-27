<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{ 
     
     public function index()
    {
        $brands = Brand::all();
        return view('frontend.aboutus.aboutus', compact('brands'));
    }

    public function create()
    {
        return view('frontend.aboutus.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,WebP,HEIF,HEIC|max:2048',
        ]);

        $path = $request->file('logo')->store('brand_logos', 'public');

        Brand::create([
            'name' => $request->name,
            'logo' => $path,
        ]);

        return redirect()->route('aboutus')->with('success', 'Brand added successfully')->with('scroll', 'brands-section');;
    }

    public function edit(Brand $brand)
    {
        return view('frontend.aboutus.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,WebP,HEIF,HEIC|max:2048',
        ]);

        $brand->name = $request->name;

        if ($request->hasFile('logo')) {
            Storage::disk('public')->delete($brand->logo);
            $path = $request->file('logo')->store('brand_logos', 'public');
            $brand->logo = $path;
        }

        $brand->save();

        return redirect()->route('aboutus')->with('success', 'Brand edited successfully')->with('scroll', 'brands-section');;
    }

    public function destroy(Brand $brand)
    {
        Storage::disk('public')->delete($brand->logo);
        $brand->delete();
        
        return redirect()->route('aboutus')->with('success', 'Brand deleted successfully')->with('scroll', 'brands-section');;
    }
}