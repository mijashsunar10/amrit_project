@extends('template.template')

@section('pagecontent')
<section class="bg-gray-50 py-16">
    <div class="max-w-lg mx-auto bg-white rounded-xl shadow-lg p-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-semibold text-orange-600">Edit Partner</h2>
            <a href="{{ route('aboutus') }}" class="text-3xl text-gray-400 hover:text-gray-600">
                &times;
            </a>
        </div>

        <form action="{{ route('partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Company Name --}}
            <div class="mb-6">
                <label for="name" class="block mb-2 text-gray-700 font-medium">Company Name</label>
                <input type="text" name="name" id="name" value="{{ $partner->name }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
            </div>

            {{-- Current Logo --}}
            <div class="mb-6">
                <label class="block mb-2 text-gray-700 font-medium">Current Logo</label>
                <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="h-24 rounded shadow">
            </div>

            {{-- Upload New Logo --}}
            <div class="mb-6">
                <label for="logo" class="block mb-2 text-gray-700 font-medium">New Logo (optional)</label>
                <input type="file" name="logo" id="logo" accept="image/*"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                    onchange="previewLogo(event)">
                <div id="logo-preview" class="mt-4 hidden">
                    <p class="text-sm text-gray-500 mb-1">Preview:</p>
                    <img id="preview-image" class="h-24 rounded shadow" />
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex justify-end gap-4">
                <a href="{{ route('aboutus') }}"
                    class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100">
                    Cancel
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-orange-500 text-white font-medium rounded-lg hover:bg-orange-600 transition">
                    Update Partner
                </button>
            </div>
        </form>
    </div>
</section>

{{-- Image Preview Script --}}
<script>
    function previewLogo(event) {
        const previewBox = document.getElementById('logo-preview');
        const previewImage = document.getElementById('preview-image');
        const file = event.target.files[0];

        if (file) {
            previewImage.src = URL.createObjectURL(file);
            previewBox.classList.remove('hidden');
        } else {
            previewBox.classList.add('hidden');
        }
    }
</script>
@endsection
