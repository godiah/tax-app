<!-- Tag Help Guide Modal -->
<div id="helpModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="absolute inset-0 bg-black opacity-50" onclick="closeHelpModal()"></div>
    <div class="bg-white rounded-xl shadow-xl max-w-xl w-full mx-4 z-10 overflow-hidden">
        <div class="px-6 py-4 bg-primary text-white flex justify-between items-center rounded-t-xl">
            <h3 class="text-lg font-semibold font-heading">Tag Management Guide</h3>
            <button onclick="closeHelpModal()" class="text-white hover:text-gray-200 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6 overflow-y-auto max-h-[70vh] font-body bg-blog-paper-accent">
            <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-accent mb-4">
                <h4 class="text-lg font-semibold text-primary mb-3 font-heading flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-accent" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    What are tags?
                </h4>
                <p class="text-dark mb-3">
                    Tags are specific keywords or terms assigned to tax content to help categorize and organize it.
                    Unlike categories which are broad classifications, tags are more specific and can describe multiple
                    aspects of your tax content.
                </p>
                <p class="text-dark">
                    For example, while a post might belong to the "Tax Insights" category, it could have tags like
                    "Corporate Tax," "Tax Credits," and "Small Business."
                </p>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-accent mb-4">
                <h4 class="text-lg font-semibold text-primary mb-3 font-heading flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-accent" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                    Benefits of effective tag management
                </h4>
                <ul class="space-y-2 text-dark">
                    <li class="flex items-start">
                        <span class="text-accent mr-2">•</span>
                        <span><strong class="text-primary">Improved discoverability:</strong> Helps users find specific
                            tax information quickly</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-accent mr-2">•</span>
                        <span><strong class="text-primary">Enhanced navigation:</strong> Creates multiple pathways to
                            explore related tax content</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-accent mr-2">•</span>
                        <span><strong class="text-primary">Better content relationships:</strong> Automatically connects
                            related tax articles</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-accent mr-2">•</span>
                        <span><strong class="text-primary">Topic filtering:</strong> Allows readers to focus on specific
                            tax subjects</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-accent mr-2">•</span>
                        <span><strong class="text-primary">SEO advantages:</strong> Improves search engine rankings for
                            tax-related queries</span>
                    </li>
                </ul>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-accent mb-4">
                <h4 class="text-lg font-semibold text-primary mb-3 font-heading flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-accent" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Best practices for tax content tags
                </h4>
                <ul class="space-y-2 text-dark">
                    <li class="flex items-start">
                        <span class="text-accent mr-2">•</span>
                        <span><strong class="text-primary">Be specific but concise:</strong> Use "Capital Gains Tax"
                            instead of just "Tax" or overly long descriptions</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-accent mr-2">•</span>
                        <span><strong class="text-primary">Maintain consistency:</strong> Use "Self-Employment Tax"
                            consistently rather than alternating with "Freelance Tax"</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-accent mr-2">•</span>
                        <span><strong class="text-primary">Avoid redundancy:</strong> Don't create similar tags like
                            "Tax Deductions" and "Tax Write-offs"</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-accent mr-2">•</span>
                        <span><strong class="text-primary">Use proper formatting:</strong> Follow consistent
                            capitalization (e.g., "Estate Tax" not "estate tax")</span>
                    </li>
                </ul>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-secondary">
                <h4 class="text-lg font-semibold text-primary mb-2 font-heading flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-secondary" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Pro Tips
                </h4>
                <ul class="space-y-2 text-dark font-secondary text-sm">
                    <li class="flex items-start">
                        <span class="text-secondary mr-2">•</span>
                        <span>Regularly audit your tags to consolidate similar ones and maintain a clean system</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-secondary mr-2">•</span>
                        <span>Aim for 3-7 relevant tags per post—not too few, not too many</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-secondary mr-2">•</span>
                        <span>Consider creating a standardized list of recommended tags for content creators</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-secondary mr-2">•</span>
                        <span>Use analytics to identify which tags drive the most traffic and engagement</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="px-6 py-4 bg-light border-t border-default text-right">
            <button onclick="closeHelpModal()"
                class="px-4 py-2 bg-accent text-white rounded-lg hover:bg-opacity-90 transition-colors font-medium shadow-md flex items-center justify-center space-x-2 mx-auto md:ml-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>Got it</span>
            </button>
        </div>
    </div>
</div>

<script>
    // Show the help-guide modal
    function showHelpGuide() {
        const modal = document.getElementById('helpModal');
        modal.classList.remove('hidden');
        // Prevent background scroll
        document.body.classList.add('overflow-hidden');
    }

    // Close the help-guide modal
    function closeHelpModal() {
        const modal = document.getElementById('helpModal');
        modal.classList.add('hidden');
        // Restore background scroll
        document.body.classList.remove('overflow-hidden');
    }

    // Close when Escape key is pressed
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('helpModal');
            if (!modal.classList.contains('hidden')) {
                closeHelpModal();
            }
        }
    });
</script>
