@extends('template.template')

@section('pagecontent')
<style>
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .fa-spinner { animation: spin 1s linear infinite; }
</style>

<!-- Flash Message Container -->
<div id="flashMessage" class="fixed top-16 xl:top-16 left-0 right-0 bg-pastry-secondary text-white text-center py-3 z-50 hidden animate-fade-in">
    <span id="flashMessageText"></span>
</div>

<!-- Loading Indicator -->
<div id="loadingIndicator" class="fixed top-16 xl:top-16 left-0 right-0 bg-pastry-accent text-white text-center py-3 z-50 hidden animate-fade-in">
    Sending your message... <i class="fas fa-spinner fa-spin"></i>
</div>

<section id="contact" class="bg-gradient-to-br from-[#FFF8E1] to-[#F9F3E9] py-12 px-4 sm:px-6 lg:px-8 overflow-hidden">
    <!-- Decorative elements with animations -->
    <div class="absolute left-[5%] top-[10%] text-[10rem] text-[#FF6B6B]/10 hidden lg:block animate-float" style="animation-delay: 0.2s">
        <i class="fas fa-cookie"></i>
    </div>
    <div class="absolute right-[5%] bottom-[10%] text-[8rem] text-[#D4A76A]/10 rotate-30 hidden lg:block animate-float" style="animation-delay: 0.4s">
        <i class="fas fa-croissant"></i>
    </div>

    <div class="max-w-7xl mx-auto">
        <!-- Section Header with animation -->
        <div class="text-center mb-16 scroll-reveal opacity-0">
            <h2 class="text-4xl md:text-5xl font-bold text-[#8B4513] mb-4 relative inline-block animate-reveal-up">
                Contact Us
                <div class="absolute bottom-0 left-1/2 w-32 h-1.5 bg-[#D4A76A] transform -translate-x-1/2 rounded-full"></div>
            </h2>
            <p class="text-lg text-[#5D4037] max-w-2xl mx-auto leading-relaxed animate-reveal-up" style="animation-delay: 0.2s">
                Have questions about our pastries or custom orders? We're here to help with all your sweet inquiries!
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left Column - Contact Info with staggered animations -->
            <div class="space-y-8">
                <!-- Contact Information Card -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1 scroll-reveal opacity-0 animate-card-drop">
                    <div class="bg-[#8B4513] text-white py-6 px-8 text-center">
                        <h3 class="text-2xl font-semibold">Contact Information</h3>
                    </div>
                    
                    <div class="p-6 space-y-8">
                        <!-- Address -->
                        <div class="flex items-start animate-reveal-left" style="animation-delay: 0.2s">
                            <div class="bg-[#D4A76A] p-3 rounded-full shadow-md flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                            </div>
                            <div class="ml-6">
                                <h4 class="text-xl font-semibold text-[#8B4513] mb-2">Our School & Bakery</h4>
                                <p class="text-[#5D4037]">123 Pastry Lane, Dessert Valley</p>
                                <p class="text-[#5D4037] text-sm mt-1">Open Tuesday-Sunday, 7AM-7PM</p>
                            </div>
                        </div>
                        
                        <!-- Phone -->
                        <div class="flex items-start animate-reveal-left" style="animation-delay: 0.3s">
                            <div class="bg-[#D4A76A] p-3 rounded-full shadow-md flex-shrink-0">
                                <i class="fas fa-phone-alt text-white text-2xl"></i>
                            </div>
                            <div class="ml-6">
                                <h4 class="text-xl font-semibold text-[#8B4513] mb-2">Call Us</h4>
                                <p class="text-[#5D4037]">(123) 456-7890</p>
                                <a href="tel:+11234567890" class="text-[#FF6B6B] hover:text-[#8B4513] text-sm font-medium mt-1 inline-block transition-colors">
                                    Click to call →
                                </a>
                            </div>
                        </div>
                        
                        <!-- Email -->
                        <div class="flex items-start animate-reveal-left" style="animation-delay: 0.4s">
                            <div class="bg-[#D4A76A] p-3 rounded-full shadow-md flex-shrink-0">
                                <i class="fas fa-envelope text-white text-2xl"></i>
                            </div>
                            <div class="ml-6">
                                <h4 class="text-xl font-semibold text-[#8B4513] mb-2">Email Us</h4>
                                <p class="text-[#5D4037]">contact@sweetdelights.com</p>
                                <a href="mailto:contact@sweetdelights.com" class="text-[#FF6B6B] hover:text-[#8B4513] text-sm font-medium mt-1 inline-block transition-colors">
                                    Send email →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Follow Our Journey Card -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1 scroll-reveal opacity-0 animate-card-drop" style="animation-delay: 0.2s">
                    <div class="text-[#8B4513] py-6 px-8 text-center">
                        <h3 class="text-2xl font-semibold">Connect With Us</h3>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex justify-center space-x-4">
                            <a href="#" class="bg-[#D4A76A] text-white w-12 h-12 rounded-full flex items-center justify-center text-xl hover:bg-[#8B4513] transition-colors animate-bounce-in" style="animation-delay: 0.3s">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="bg-[#D4A76A] text-white w-12 h-12 rounded-full flex items-center justify-center text-xl hover:bg-[#8B4513] transition-colors animate-bounce-in" style="animation-delay: 0.4s">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="bg-[#D4A76A] text-white w-12 h-12 rounded-full flex items-center justify-center text-xl hover:bg-[#8B4513] transition-colors animate-bounce-in" style="animation-delay: 0.5s">
                                <i class="fab fa-pinterest"></i>
                            </a>
                            <a href="#" class="bg-[#D4A76A] text-white w-12 h-12 rounded-full flex items-center justify-center text-xl hover:bg-[#8B4513] transition-colors animate-bounce-in" style="animation-delay: 0.6s">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="#" class="bg-[#D4A76A] text-white w-12 h-12 rounded-full flex items-center justify-center text-xl hover:bg-[#8B4513] transition-colors animate-bounce-in" style="animation-delay: 0.7s">
                                <i class="fab fa-tiktok"></i>
                            </a>
                        </div>
                        <p class="text-center text-[#5D4037] mt-6 animate-fade-in" style="animation-delay: 0.8s">
                            Follow us for daily pastry inspiration, special offers, and behind-the-scenes baking magic!
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Contact Form with animation -->
            <div class="bg-white rounded-2xl shadow-xl border-2 border-[#D4A76A] overflow-hidden scroll-reveal opacity-0 animate-reveal-right">
                <div class="bg-gradient-to-r from-[#8B4513] to-[#FF6B6B] text-white py-6 px-8 text-center">
                    <h3 class="text-2xl font-semibold">Send Us a Message</h3>
                </div>
                
                <form id="contactForm" class="p-6 space-y-6">
                    @csrf
                    <div class="animate-reveal-up" style="animation-delay: 0.2s">
                        <label class="block text-lg font-medium text-[#8B4513] mb-2">Full Name</label>
                        <input type="text" name="name" class="w-full px-4 py-3 rounded-lg border-2 border-[#D4A76A] focus:border-[#8B4513] focus:ring-2 focus:ring-[#8B4513]/30 outline-none transition-all bg-[#FFF8E1]" placeholder="Your Name" required>
                    </div>
                    
                    <div class="animate-reveal-up" style="animation-delay: 0.3s">
                        <label class="block text-lg font-medium text-[#8B4513] mb-2">Email Address</label>
                        <input type="email" name="email" class="w-full px-4 py-3 rounded-lg border-2 border-[#D4A76A] focus:border-[#8B4513] focus:ring-2 focus:ring-[#8B4513]/30 outline-none transition-all bg-[#FFF8E1]" placeholder="your@email.com" required>
                    </div>
                    
                    <div class="animate-reveal-up" style="animation-delay: 0.4s">
                        <label class="block text-lg font-medium text-[#8B4513] mb-2">Phone Number</label>
                        <input type="tel" name="whatsapp" class="w-full px-4 py-3 rounded-lg border-2 border-[#D4A76A] focus:border-[#8B4513] focus:ring-2 focus:ring-[#8B4513]/30 outline-none transition-all bg-[#FFF8E1]" placeholder="(123) 456-7890">
                    </div>
                    
                    <div class="animate-reveal-up" style="animation-delay: 0.5s">
                        <label class="block text-lg font-medium text-[#8B4513] mb-2">Your Message</label>
                        <textarea rows="5" name="message" class="w-full px-4 py-3 rounded-lg border-2 border-[#D4A76A] focus:border-[#8B4513] focus:ring-2 focus:ring-[#8B4513]/30 outline-none transition-all bg-[#FFF8E1]" placeholder="Tell us about your pastry needs..."></textarea>
                    </div>
                    
                    <button type="submit" class="w-full bg-gradient-to-r from-[#8B4513] to-[#FF6B6B] text-white py-4 px-6 rounded-lg font-semibold text-lg hover:shadow-lg transition-all duration-300 hover:-translate-y-1 animate-bounce-in" style="animation-delay: 0.6s">
                        <i class="fas fa-paper-plane mr-2"></i> Send Message
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Map Section with animation -->
        <div class="mt-20 text-center scroll-reveal opacity-0">
            <h3 class="font-bold text-4xl text-[#8B4513] mb-4 animate-reveal-up">Our Location</h3>
            <p class="text-lg text-[#5D4037] mb-8 animate-reveal-up" style="animation-delay: 0.2s">Come visit us for a sweet experience!</p>
            
            <div class="h-96 w-full rounded-2xl shadow-lg overflow-hidden border-2 border-[#D4A76A]">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d883.3696810031988!2d85.31735856960282!3d27.67159518622741!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19e7772d9b01%3A0x66f41c4b105765e2!2sSchool%20Of%20Baking%20And%20Pastry%20Technology!5e0!3m2!1sen!2snp!4v1751420178573!5m2!1sen!2snp" 
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = e.target;
        const formData = new FormData(form);
        const flashMessage = document.getElementById('flashMessage');
        const flashMessageText = document.getElementById('flashMessageText');
        const loadingIndicator = document.getElementById('loadingIndicator');

        loadingIndicator.classList.remove('hidden');

        fetch('{{ route('contact.send') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: formData,
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            form.reset();
            flashMessageText.textContent = data.message;
            flashMessage.classList.remove('hidden', 'bg-red-100', 'text-red-700');
            flashMessage.classList.add('bg-green-100', 'text-green-700');
        })
        .catch(error => {
            flashMessageText.textContent = error.message || 'An error occurred. Please try again.';
            flashMessage.classList.remove('hidden', 'bg-green-100', 'text-green-700');
            flashMessage.classList.add('bg-red-100', 'text-red-700');
        })
        .finally(() => {
            loadingIndicator.classList.add('hidden');
            flashMessage.classList.remove('hidden');
            setTimeout(() => {
                flashMessage.classList.add('hidden');
            }, 4000);
        });
    });

    // Scroll reveal animation setup
    document.addEventListener('DOMContentLoaded', () => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add(
                        entry.target.classList.contains('scroll-reveal-left') ? 'animate-reveal-left' :
                        entry.target.classList.contains('scroll-reveal-right') ? 'animate-reveal-right' :
                        'animate-reveal-up'
                    );
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.scroll-reveal').forEach(el => {
            observer.observe(el);
        });
    });
</script>
@endsection