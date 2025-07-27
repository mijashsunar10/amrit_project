@extends('template.template')

@section('pagecontent')
<div class=" mx-auto px-4 py-8 max-w-[80%]">
    <h1 class="text-4xl font-bold mb-8 text-pastry-primary text-center">Edit About Us Page</h1>
    
    <form method="POST" action="{{ route('aboutus.update') }}" enctype="multipart/form-data">
        @csrf

        <!-- Main Content Section -->
        <div class=" p-6 rounded-lg shadow-md mb-8 border border-pastry-secondary">
            <h2 class="text-xl font-semibold mb-4 text-pastry-primary">Main Content</h2>
            
            <div class="mb-4">
                <label class="block mb-2 text-pastry-primary">Main Title</label>
                <input type="text" name="main_title" value="{{ old('main_title', $aboutUs->main_title ?? '') }}" 
                       class="w-full p-2 border border-pastry-secondary rounded focus:ring-pastry-primary focus:border-pastry-primary">
            </div>
            
            <div class="mb-4">
                <label class="block mb-2 text-pastry-primary">Main Description</label>
                <textarea name="main_description" rows="4" 
                          class="w-full p-2 border border-pastry-secondary rounded focus:ring-pastry-primary focus:border-pastry-primary">{{ old('main_description', $aboutUs->main_description ?? '') }}</textarea>
            </div>
        </div>

        <!-- Why Choose Section -->
        <div class=" p-6 rounded-lg shadow-md mb-8 border border-pastry-secondary">
            <h2 class="text-xl font-semibold mb-4 text-pastry-primary">Why Choose Us</h2>
            
            <div class="mb-4">
                <label class="block mb-2 text-pastry-primary">Section Title</label>
                <input type="text" name="why_choose_title" value="{{ old('why_choose_title', $aboutUs->why_choose_title ?? '') }}" 
                       class="w-full p-2 border border-pastry-secondary rounded focus:ring-pastry-primary focus:border-pastry-primary">
            </div>
            
            <div class="mb-4">
                <label class="block mb-2 text-pastry-primary">Section Description</label>
                <textarea name="why_choose_description" rows="4" 
                          class="w-full p-2 border border-pastry-secondary rounded focus:ring-pastry-primary focus:border-pastry-primary">{{ old('why_choose_description', $aboutUs->why_choose_description ?? '') }}</textarea>
            </div>
        </div>

        <!-- Features Section -->
        <div class=" p-6 rounded-lg shadow-md mb-8 border border-pastry-secondary">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-pastry-primary">Features</h2>
                <button type="button" id="add-feature" class="px-4 py-2 bg-pastry-secondary text-white rounded hover:bg-pastry-primary transition-colors">
                    + Add Feature
                </button>
            </div>
            
            <div id="features-container">
                @php
                    $features = old('features', $aboutUs->features ?? [['title' => '', 'description' => '']]);
                @endphp
                
                @foreach($features as $index => $feature)
                <div class="feature-item border border-pastry-secondary p-4 rounded mb-4 bg-white">
                    <div class="flex justify-between mb-2">
                        <h3 class="font-medium text-pastry-primary">Feature {{ $index + 1 }}</h3>
                        @if($index > 0)
                        <button type="button" class="remove-feature text-pastry-accent hover:text-red-700">Remove</button>
                        @endif
                    </div>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-pastry-primary">Title</label>
                            <input type="text" name="features[{{ $index }}][title]" 
                                   value="{{ $feature['title'] }}" 
                                   class="w-full p-2 border border-pastry-secondary rounded focus:ring-pastry-primary focus:border-pastry-primary" required>
                        </div>
                        <div>
                            <label class="text-pastry-primary">Description</label>
                            <textarea name="features[{{ $index }}][description]" 
                                      class="w-full p-2 border border-pastry-secondary rounded focus:ring-pastry-primary focus:border-pastry-primary" 
                                      rows="3" required>{{ $feature['description'] }}</textarea>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Images Section -->
        <div class=" p-6 rounded-lg shadow-md mb-8 border border-pastry-secondary">
            <h2 class="text-xl font-semibold mb-4 text-pastry-primary">Images</h2>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2 text-pastry-primary">Main Image</label>
                    @if($aboutUs->main_image ?? false)
                    <div class="relative mb-4">
                        <img src="{{ Storage::url($aboutUs->main_image) }}" class="w-full h-48 object-cover rounded-lg border border-pastry-secondary">
                        <div class="absolute top-2 right-2 bg-white/80 rounded-full p-1">
                            <button type="button" class="replace-image" data-target="main_image" 
                                    class="text-pastry-accent hover:text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    @endif
                    <div class="image-upload-container" id="main_image_container" @if($aboutUs->main_image ?? false) style="display:none" @endif>
                        <div class="relative">
                            <input type="file" name="main_image" id="main_image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <div class="flex items-center justify-between px-4 py-2 bg-white border border-pastry-secondary rounded-lg">
                                <span id="main_image_label" class="text-pastry-primary truncate">Choose file...</span>
                                <svg class="w-5 h-5 text-pastry-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm text-pastry-secondary mt-2">Recommended size: 800x600px</p>
                        <div id="main_image_preview" class="mt-2 hidden">
                            <img src="" alt="Main Image Preview" class="max-w-full h-auto max-h-40 rounded-lg border border-pastry-secondary">
                        </div>
                    </div>
                </div>
                
                <div>
                    <label class="block mb-2 text-pastry-primary">Secondary Image</label>
                    @if($aboutUs->secondary_image ?? false)
                    <div class="relative mb-4">
                        <img src="{{ Storage::url($aboutUs->secondary_image) }}" class="w-full h-48 object-cover rounded-lg border border-pastry-secondary">
                        <div class="absolute top-2 right-2 bg-white/80 rounded-full p-1">
                            <button type="button" class="replace-image" data-target="secondary_image" 
                                    class="text-pastry-accent hover:text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    @endif
                    <div class="image-upload-container" id="secondary_image_container" @if($aboutUs->secondary_image ?? false) style="display:none" @endif>
                        <div class="relative">
                            <input type="file" name="secondary_image" id="secondary_image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <div class="flex items-center justify-between px-4 py-2 bg-white border border-pastry-secondary rounded-lg">
                                <span id="secondary_image_label" class="text-pastry-primary truncate">Choose file...</span>
                                <svg class="w-5 h-5 text-pastry-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm text-pastry-secondary mt-2">Recommended size: 800x600px</p>
                        <div id="secondary_image_preview" class="mt-2 hidden">
                            <img src="" alt="Secondary Image Preview" class="max-w-full h-auto max-h-40 rounded-lg border border-pastry-secondary">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('aboutus') }}" class="px-6 py-2 border border-pastry-secondary rounded-lg text-pastry-primary hover:bg-pastry-cream transition-colors">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-pastry-primary text-white rounded-lg hover:bg-pastry-accent transition-colors">
                Save Changes
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('features-container');
        
        // Add feature
        document.getElementById('add-feature').addEventListener('click', function() {
            const index = container.children.length;
            const html = `
            <div class="feature-item border border-pastry-secondary p-4 rounded mb-4 bg-white">
                <div class="flex justify-between mb-2">
                    <h3 class="font-medium text-pastry-primary">Feature ${index + 1}</h3>
                    <button type="button" class="remove-feature text-pastry-accent hover:text-red-700">Remove</button>
                </div>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-pastry-primary">Title</label>
                        <input type="text" name="features[${index}][title]" 
                               class="w-full p-2 border border-pastry-secondary rounded focus:ring-pastry-primary focus:border-pastry-primary" required>
                    </div>
                    <div>
                        <label class="text-pastry-primary">Description</label>
                        <textarea name="features[${index}][description]" 
                                  class="w-full p-2 border border-pastry-secondary rounded focus:ring-pastry-primary focus:border-pastry-primary" 
                                  rows="3" required></textarea>
                    </div>
                </div>
            </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        });
        
        // Remove feature
        container.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-feature')) {
                e.target.closest('.feature-item').remove();
                // Re-index features
                document.querySelectorAll('.feature-item').forEach((item, index) => {
                    item.querySelector('h3').textContent = `Feature ${index + 1}`;
                    const inputs = item.querySelectorAll('[name^="features["]');
                    inputs.forEach(input => {
                        input.name = input.name.replace(/\[\d+\]/, `[${index}]`);
                    });
                });
            }
        });

        // Image preview functionality
        function setupImagePreview(inputId, labelId, previewId) {
            const input = document.getElementById(inputId);
            const label = document.getElementById(labelId);
            const preview = document.getElementById(previewId);
            const previewImg = preview.querySelector('img');

            input.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    label.textContent = this.files[0].name;
                    
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        preview.classList.remove('hidden');
                    }
                    reader.readAsDataURL(this.files[0]);
                } else {
                    label.textContent = 'Choose file...';
                    preview.classList.add('hidden');
                }
            });
        }

        setupImagePreview('main_image', 'main_image_label', 'main_image_preview');
        setupImagePreview('secondary_image', 'secondary_image_label', 'secondary_image_preview');

        // Replace image functionality
        document.querySelectorAll('.replace-image').forEach(button => {
            button.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                document.getElementById(`${target}_container`).style.display = 'block';
                this.closest('.relative').style.display = 'none';
            });
        });
    });
</script>
@endsection