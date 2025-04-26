<!-- Tag Help Guide Modal -->
<div id="helpModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="absolute inset-0 bg-black opacity-50" onclick="closeHelpModal()"></div>
    <div class="bg-white rounded-xl shadow-xl max-w-xl w-full mx-4 z-10 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800 font-heading">Tags Guide</h3>
            <button onclick="closeHelpModal()" class="text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6 overflow-y-auto max-h-[70vh] font-body">
            <h4 class="text-lg font-semibold text-gray-800 mb-3">What are tags?</h4>
            <p class="text-gray-600 mb-4">
                Tags are keywords or terms assigned to content to help categorize and organize it. Unlike categories,
                tags are more specific and can be used to describe multiple aspects of content.
            </p>

            <h4 class="text-lg font-semibold text-gray-800 mb-3">Benefits of using tags</h4>
            <ul class="list-disc pl-5 text-gray-600 mb-4 space-y-2">
                <li>Improved content organization and discoverability</li>
                <li>Enhanced user navigation experience</li>
                <li>Better related content suggestions</li>
                <li>Ability to filter content by specific topics</li>
                <li>SEO benefits for your content</li>
            </ul>

            <h4 class="text-lg font-semibold text-gray-800 mb-3">Best practices</h4>
            <ul class="list-disc pl-5 text-gray-600 mb-4 space-y-2">
                <li>Keep tag names concise and descriptive</li>
                <li>Use consistent naming conventions</li>
                <li>Avoid redundant or overlapping tags</li>
                <li>Regularly review and consolidate similar tags</li>
            </ul>
        </div>
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 text-right">
            <button onclick="closeHelpModal()"
                class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors">
                Got it
            </button>
        </div>
    </div>
</div>

<script>
    // Show the help‐guide modal
    function showHelpGuide() {
        const modal = document.getElementById('helpModal');
        modal.classList.remove('hidden');
        // Prevent background scroll
        document.body.classList.add('overflow-hidden');
    }

    // Close the help‐guide modal
    function closeHelpModal() {
        const modal = document.getElementById('helpModal');
        modal.classList.add('hidden');
        // Restore background scroll
        document.body.classList.remove('overflow-hidden');
    }

    // Optional: close when Escape key is pressed
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('helpModal');
            if (!modal.classList.contains('hidden')) {
                closeHelpModal();
            }
        }
    });
</script>
