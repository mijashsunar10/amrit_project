<section id="brands-section" class="bg-gradient-to-b from-orange-50 to-white py-16 rounded-2xl shadow-xl relative mt-16">
    @auth
        <!-- Add Brand Button -->
        <div class="absolute top-12 right-12">
            <a href="{{ route('brands.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded-full text-md transition-colors">
                + Add Brand
            </a>
        </div>
    @endauth

    <div class="text-center mb-16 px-4">
        <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 inline-block relative pb-3 after:content-[''] after:absolute after:bottom-0 after:left-1/2 after:-translate-x-1/2 after:w-20 after:h-1 after:bg-gradient-to-r after:from-orange-500 after:to-orange-400 after:rounded-full">
            Our Endorsed Brands
        </h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto mt-6">
            We're proud to be associated with these premium brands that share our commitment to quality and excellence.
        </p>
    </div>

    <!-- Brands Container -->
    <div class="brands-container relative overflow-hidden px-4 max-w-[85%] mx-auto">
        <div id="brands-track" class="brands-grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-10 justify-items-center transition-transform duration-500 ease-linear">
            @foreach ($brands as $brand)
                <div class="brand-item w-52 flex flex-col items-center group">
                    <div class="logo-container w-52 h-52 rounded-2xl flex items-center justify-center p-6 bg-transparent transition-all duration-300 group-hover:scale-105 group-hover:shadow-xl">
                        <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" class="max-w-full max-h-full object-contain scale-90 group-hover:scale-100 transition-transform duration-300">
                        
                        @auth
                            <div class="brand-actions absolute top-4 right-4 hidden group-hover:flex space-x-2">
                                <a href="{{ route('brands.edit', $brand->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-full transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this brand?')" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-full transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endauth
                    </div>
                    <h3 class="font-semibold text-gray-800 mt-6 text-center text-lg">{{ $brand->name }}</h3>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize both carousels
    initDynamicCarousel('partners-track');
    initDynamicCarousel('brands-track');

    function initDynamicCarousel(trackId) {
        const track = document.getElementById(trackId);
        if (!track) return;
        
        const container = track.parentElement;
        let animationId = null;
        let carouselSpeed = 1.5;
        let isCarouselActive = false;
        let position = 0;
        let itemWidth = 0;
        let items = [];
        let visibleItems = 6;

        function updateVisibleItems() {
            const width = window.innerWidth;
            if (width >= 1536) visibleItems = 6;
            else if (width >= 1280) visibleItems = 5;
            else if (width >= 1024) visibleItems = 4;
            else if (width >= 768) visibleItems = 3;
            else if (width >= 640) visibleItems = 2;
            else visibleItems = 1;
        }

        function checkLayout() {
            updateVisibleItems();
            items = Array.from(track.children);
            
            const containerWidth = container.offsetWidth;
            const itemsWidth = items.reduce((total, item) => {
                const style = window.getComputedStyle(item);
                return total + item.offsetWidth + 
                       parseFloat(style.marginLeft) + 
                       parseFloat(style.marginRight);
            }, 0);
            
            const shouldCarousel = itemsWidth > containerWidth || items.length > visibleItems;
            
            if (shouldCarousel && !isCarouselActive) {
                activateCarousel();
            } else if (!shouldCarousel && isCarouselActive) {
                deactivateCarousel();
            }
        }

        function activateCarousel() {
            isCarouselActive = true;
            track.classList.remove('grid', 'grid-cols-1', 'sm:grid-cols-2', 'md:grid-cols-3', 'lg:grid-cols-4', 'xl:grid-cols-5', '2xl:grid-cols-6');
            track.classList.add('flex', 'gap-12');
            
            items = Array.from(track.children);
            const itemsToClone = Math.min(items.length, visibleItems * 2);
            for (let i = 0; i < itemsToClone; i++) {
                track.appendChild(items[i].cloneNode(true));
            }
            
            const firstItem = items[0];
            const style = window.getComputedStyle(firstItem);
            itemWidth = firstItem.offsetWidth + 
                      parseFloat(style.marginLeft) + 
                      parseFloat(style.marginRight) +
                      48;
            
            position = 0;
            animateCarousel();
        }

        function animateCarousel() {
            position -= carouselSpeed;
            track.style.transform = `translateX(${position}px)`;
            
            if (Math.abs(position) >= itemWidth * items.length) {
                position = 0;
                track.style.transition = 'none';
                track.style.transform = `translateX(0)`;
                void track.offsetWidth;
                track.style.transition = 'transform 0.5s linear';
            }
            
            animationId = requestAnimationFrame(animateCarousel);
        }

        function deactivateCarousel() {
            isCarouselActive = false;
            cancelAnimationFrame(animationId);
            animationId = null;
            
            const originalCount = track.children.length / 2;
            while (track.children.length > originalCount) {
                track.removeChild(track.lastChild);
            }
            
            track.classList.remove('flex', 'gap-12');
            track.classList.add('grid', 'grid-cols-1', 'sm:grid-cols-2', 'md:grid-cols-3', 'lg:grid-cols-4', 'xl:grid-cols-5', '2xl:grid-cols-6');
            track.style.transform = 'none';
        }

        // Initial setup
        updateVisibleItems();
        checkLayout();
        
        // Resize handler
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                updateVisibleItems();
                checkLayout();
            }, 100);
        });

        // Pause on hover
        container.addEventListener('mouseenter', () => {
            if (isCarouselActive) {
                cancelAnimationFrame(animationId);
                animationId = null;
            }
        });
        
        container.addEventListener('mouseleave', () => {
            if (isCarouselActive) {
                animateCarousel();
            }
        });
    }
});
</script>