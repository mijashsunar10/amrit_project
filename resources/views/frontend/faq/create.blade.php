@extends('template.template')

@section('pagecontent')
<div class="min-h-screen bg-pastry-cream py-8">
    <div class="container mx-auto max-w-2xl px-4 mt-20">
        <div class="bg-white rounded-lg shadow-lg p-8 relative">
            <a href="{{ route('faqs.index') }}" 
               class="absolute top-2 right-4 text-gray-600 hover:text-pastry-accent transition-colors">
                <button class="bg-red-600 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded shadow">Cancel</button>
            </a>
            <h1 class="text-3xl font-bold text-pastry-primary mb-6 text-center">Add New FAQ</h1>
            
            <form action="{{ route('faqs.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="question" class="block text-sm font-medium text-pastry-primary mb-2">Question</label>
                    <input type="text" name="question" id="question" 
                           class="w-full px-4 py-2 border border-pastry-secondary rounded-md focus:ring-2 focus:ring-pastry-primary focus:border-pastry-primary transition duration-150"
                           placeholder="Enter your question here">
                    @error('question')
                        <p class="text-pastry-accent text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="answer" class="block text-sm font-medium text-pastry-primary mb-2">Answer</label>
                    <textarea name="answer" id="answer" rows="4" 
                              class="w-full px-4 py-2 border border-pastry-secondary rounded-md focus:ring-2 focus:ring-pastry-primary focus:border-pastry-primary transition duration-150"
                              placeholder="Provide the answer here"></textarea>
                    @error('answer')
                        <p class="text-pastry-accent text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-8">
                    <button type="submit" 
                            class="w-full bg-pastry-primary hover:bg-pastry-secondary text-white font-semibold py-3 px-4 rounded-md transition duration-150 transform hover:scale-105">
                        Create FAQ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 