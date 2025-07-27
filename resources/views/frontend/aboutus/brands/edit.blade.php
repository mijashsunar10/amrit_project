@extends('template.template')

@section('pagecontent')
<section class="bg-gray-50 py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-lg">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-semibold text-blue-600">Edit Brand</h1>
                <a href="{{ route('aboutus') }}" class="text-3xl text-gray-400 hover:text-gray-600">&times;</a>
            </div>

            <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Brand Name --}}
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-gray-700 font-medium">Brand Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $brand->name) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Current Logo --}}
                <div class="mb-6">
                    <label class="block mb-2 text-gray-700 font-medium">Current Logo</label>
                    @if($brand->logo && file_exists(storage_path('app/public/' . $brand->logo)))
                        <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" class="h-24 rounded shadow" id="currentImagePreview">
                    @else
                        <div class="text-sm text-gray-500 italic">No logo uploaded.</div>
                    @endif
                </div>

                {{-- New Logo Upload --}}
                <div class="mb-6">
                    <label for="logo" class="block mb-2 text-gray-700 font-medium">New Logo (optional)</label>
                    <input type="file" name="logo" id="logo" accept="image/*"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onchange="previewLogo(event)">
                    <div id="logo-preview" class="mt-4 hidden">
                        <p class="text-sm text-gray-500 mb-1">Preview:</p>
                        <img id="preview-image" class="h-24 rounded shadow" />
                    </div>
                    @error('logo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex justify-between items-center mt-8">
                    <a href="{{ route('aboutus') }}" class="text-gray-600 hover:text-gray-800 font-medium transition">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition transform hover:scale-105">
                        Update Brand
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

{{-- Image Preview Script --}}
<script>
    function previewLogo(event) {
        const previewBox = document.getElementById('logo-preview');
        const previewImage = document.getElementById('preview-image');
        const currentImage = document.getElementById('currentImagePreview');
        const file = event.target.files[0];

        if (file) {
            previewImage.src = URL.createObjectURL(file);
            previewBox.classList.remove('hidden');

            if (currentImage) {
                currentImage.classList.add('opacity-50');
            }
        } else {
            previewBox.classList.add('hidden');
        }
    }
</script>
@endsection
