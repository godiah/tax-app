<!-- resources/views/components/footer.blade.php -->
<footer class="bg-primary text-white py-12 px-4">
    <div class="container mx-auto max-w-7xl grid md:grid-cols-4 gap-8">
        <div>
            <h4 class="font-heading text-xl font-bold mb-4">Tax Solutions</h4>
            <p class="text-sm opacity-80">
                Providing expert tax consultation and financial strategies for individuals and businesses.
            </p>
        </div>

        <div>
            <h4 class="font-heading text-lg font-semibold mb-4">Quick Links</h4>
            <nav>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-accent transition-colors">Home</a></li>
                    <li><a href="#" class="hover:text-accent transition-colors">Services</a></li>
                    <li><a href="#" class="hover:text-accent transition-colors">About Us</a></li>
                    <li><a href="#" class="hover:text-accent transition-colors">Contact</a></li>
                </ul>
            </nav>
        </div>

        <div>
            <h4 class="font-heading text-lg font-semibold mb-4">Contact Info</h4>
            <ul class="space-y-2 text-sm">
                <li>
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    123 Tax Street, Finance City
                </li>
                <li>
                    <i class="fas fa-phone mr-2"></i>
                    (555) 123-4567
                </li>
                <li>
                    <i class="fas fa-envelope mr-2"></i>
                    info@taxsolutions.com
                </li>
            </ul>
        </div>

        <div>
            <h4 class="font-heading text-lg font-semibold mb-4">Newsletter</h4>
            <form class="flex">
                <input type="email" placeholder="Enter your email" class="w-full px-3 py-2 rounded-l-lg text-white">
                <button type="submit"
                    class="bg-accent text-white px-4 py-2 rounded-r-lg hover:bg-secondary transition-colors">
                    Subscribe
                </button>
            </form>
        </div>
    </div>

    <div class="container mx-auto max-w-6xl mt-8 pt-4 border-t border-opacity-20 border-white text-center">
        <p class="text-sm">
            © {{ date('Y') }} Tax Solutions. All Rights Reserved.
            <span class="block md:inline-block mt-2 md:mt-0 md:ml-4">
                <a href="#" class="hover:text-accent">Privacy Policy</a> |
                <a href="#" class="hover:text-accent">Terms of Service</a>
            </span>
        </p>
    </div>
</footer>
