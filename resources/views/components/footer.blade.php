<footer class="bg-primary text-white py-12 px-4 bg-opacity-90">
    <div class="container mx-auto max-w-5xl text-center justify-center grid md:grid-cols-3 gap-8">
        {{-- Logo and Description Section --}}
        <div class="flex flex-col items-center  md:items-start space-y-4">
            <img src="{{ asset('images/logo-footer.png') }}" alt="Logo"
                class="h-20 w-auto mb-4 transform transition-transform hover:scale-105">
            <p class="text-sm opacity-80 font-secondary text-center md:text-left leading-relaxed">
                Providing expert tax consultation and financial strategies for individuals and businesses.
            </p>
            <div class="flex space-x-3 mt-4">
                {{-- Social Media Icons - You can replace with actual icons --}}
                {{-- <a href="#" class="text-white hover:text-accent transition-colors"> --}}
                    {{-- <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"> --}}
                        {{-- Facebook Icon --}}
                        {{-- <path --}}
                            {{-- d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3 8h-1.35c-.538 0-.65.221-.65.778v1.222h2l-.209 2h-1.791v7h-3v-7h-2v-2h2v-2.308c0-1.769.931-2.692 3.029-2.692h1.971v3z" /> --}}
                    {{-- </svg> --}}
                {{-- </a> --}}
                <a href="https://www.linkedin.com/in/duncan-gateru-33bb02145/" target="_blank" class="text-white hover:text-accent transition-colors">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        {{-- LinkedIn Icon --}}
                        <path
                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16h-2v-6h2v6zm-1-6.891c-.607 0-1.1-.496-1.1-1.109 0-.612.492-1.109 1.1-1.109s1.1.497 1.1 1.109c0 .613-.492 1.109-1.1 1.109zm8 6.891h-1.998v-2.861c0-1.881-2.002-1.722-2.002 0v2.861h-2v-6h2v1.061c.927-1.364 4-1.466 4 1.305v3.634z" />
                    </svg>
                </a>
                {{-- <a href="#" class="text-white hover:text-accent transition-colors"> --}}
                    {{-- <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"> --}}
                        {{-- X (Twitter) Icon --}}
                        {{-- <path --}}
                            {{-- d="M18.901 1.153h3.68l-8.04 9.557L24 22.846h-7.406l-5.8-7.584-6.638 7.584H1.474l8.6-9.824L0 1.154h7.594l5.243 6.932L18.901 1.153zm-1.64 17.733h2.039L7.884 3.278H5.706l11.561 15.608z" /> --}}
                    {{-- </svg> --}}
                {{-- </a> --}}
                {{-- <a href="#" class="text-white hover:text-accent transition-colors"> --}}
                    {{-- <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"> --}}
                        {{-- Instagram Icon --}}
                        {{-- <path --}}
                            {{-- d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.148 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.148-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" /> --}}
                    {{-- </svg> --}}
                {{-- </a> --}}
                <a href="https://wa.me/254723881440" target="_blank" class="text-white hover:text-accent transition-colors">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        {{-- WhatsApp Icon --}}
                        <path
                            d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.149-.173.198-.297.297-.495.099-.198.05-.372-.025-.521-.075-.149-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.041 1.016-1.041 2.479 1.066 2.876 1.215 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                    </svg>
                </a>
            </div>
        </div>

        {{-- Quick Links Section --}}
        <div>
            <h4 class="font-heading text-lg font-semibold mb-4 border-b border-white border-opacity-20 pb-2">Quick Links
            </h4>
            <nav>
                <ul class="space-y-2 text-sm font-secondary">
                    <li>
                        <a href="#home"
                            class="group flex items-center transition-all duration-300 hover:pl-2 hover:text-accent">
                            <span class="mr-2 opacity-0 group-hover:opacity-100 transition-opacity">→</span>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="#services"
                            class="group flex items-center transition-all duration-300 hover:pl-2 hover:text-accent">
                            <span class="mr-2 opacity-0 group-hover:opacity-100 transition-opacity">→</span>
                            Services
                        </a>
                    </li>
                    <li>
                        <a href="#about"
                            class="group flex items-center transition-all duration-300 hover:pl-2 hover:text-accent">
                            <span class="mr-2 opacity-0 group-hover:opacity-100 transition-opacity">→</span>
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="#contact"
                            class="group flex items-center transition-all duration-300 hover:pl-2 hover:text-accent">
                            <span class="mr-2 opacity-0 group-hover:opacity-100 transition-opacity">→</span>
                            Contact
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        {{-- Contact Information Section --}}
        <div>
            <h4 class="font-heading text-lg font-semibold mb-4 border-b border-white border-opacity-20 pb-2">Contact
                Info</h4>
            <ul class="space-y-3 text-sm font-secondary">
                <li class="flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Nairobi, Kenya</span>
                </li>
                <li class="flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <span>(+254) 723-881-440</span>
                </li>
                <li class="flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>taxgen.ke@gmail.com</span>
                </li>
            </ul>
        </div>
    </div>

    {{-- Copyright Section --}}
    <div class="container mx-auto max-w-6xl mt-8 pt-4 border-t border-opacity-20 border-white text-center">
        <p class="text-sm font-secondary">
            © {{ date('Y') }} Taxgen Consultants LLP. All Rights Reserved.
            <span class="block md:inline-block mt-2 md:mt-0 md:ml-4">
                <a href="#" class="hover:text-accent mr-2 transition-colors">Privacy Policy</a> |
                <a href="#" class="hover:text-accent ml-2 transition-colors">Terms of Service</a>
            </span>
        </p>
    </div>
</footer>
