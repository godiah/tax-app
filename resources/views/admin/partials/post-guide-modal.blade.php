<style>
    /* Base Modal Styles */
    .modal-container {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 50;
        font-family: "Inter", ui-sans-serif, system-ui, sans-serif;
        color: #424242;
    }

    .modal-content {
        position: relative;
        background-color: white;
        margin: 2rem auto;
        max-width: 700px;
        max-height: 85vh;
        overflow-y: auto;
        border-radius: 0.5rem;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .modal-header {
        background-color: #1f3b73;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 0.5rem 0.5rem 0 0;
        font-family: "Poppins", sans-serif;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-body {
        padding: 1.5rem;
        background-color: rgba(226, 88, 34, 0.01);
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='4' height='4' viewBox='0 0 4 4'%3E%3Cpath fill='%23e25822' fill-opacity='0.15' d='M1 3h1v1H1V3zm2-2h1v1H3V1z'%3E%3C/path%3E%3C/svg%3E");
    }

    .close-button {
        background: none;
        border: none;
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
        padding: 0;
    }

    /* Content Styles */
    .welcome-message {
        font-family: "Poppins", sans-serif;
        font-size: 1.25rem;
        color: #1f3b73;
        margin-bottom: 1.5rem;
    }

    .section-title {
        font-family: "Poppins", sans-serif;
        color: #1f3b73;
        font-size: 1.125rem;
        font-weight: 600;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
    }

    .section-title svg {
        margin-right: 0.5rem;
    }

    .content-card {
        background-color: white;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1rem;
        border-left: 4px solid #e25822;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    }

    .feature-list {
        list-style-type: none;
        padding-left: 1.5rem;
    }

    .feature-list li {
        margin-bottom: 0.5rem;
        position: relative;
    }

    .feature-list li:before {
        content: "";
        position: absolute;
        left: -1.25rem;
        top: 0.5rem;
        width: 0.5rem;
        height: 0.5rem;
        background-color: #e25822;
        border-radius: 50%;
    }

    .action-link {
        color: #e25822;
        text-decoration: none;
        font-weight: 500;
    }

    .action-link:hover {
        text-decoration: underline;
        color: #456990;
    }

    .tip-box {
        background-color: rgba(46, 125, 50, 0.1);
        border-left: 4px solid #2e7d32;
        padding: 0.75rem;
        margin: 1rem 0;
        border-radius: 0 0.25rem 0.25rem 0;
        font-family: "Plus Jakarta Sans", sans-serif;
        font-size: 0.875rem;
    }

    .field-example {
        font-family: "Plus Jakarta Sans", sans-serif;
        background-color: #f4f4f4;
        padding: 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.875rem;
        margin: 0.5rem 0;
    }

    .markdown-example {
        background-color: rgba(31, 59, 115, 0.05);
        border-radius: 0.25rem;
        padding: 0.5rem;
        font-family: monospace;
        margin: 0.5rem 0;
        font-size: 0.875rem;
    }

    .field-name {
        font-weight: 600;
        color: #1f3b73;
    }

    #userNameForm {
        color: #e25822;
    }
</style>

<!-- Modal Structure -->
<div id="formHelpGuide" class="modal-container">
    <div class="modal-content">
        <div class="modal-header">
            <h2 style="margin: 0; font-size: 1.25rem;">Creating a Tax Content Post</h2>
            <button class="close-button" onclick="closeFormHelpGuide()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="welcome-message">
                Hello, <span id="userNameForm">{{ auth()->user()->name }}</span>! <br> Let's create engaging tax
                content.
            </div>

            <p class="mb-4">
                This guide will help you understand each field in the post creation form, ensuring your tax content is
                well-structured, informative, and discoverable.
            </p>

            <div class="content-card">
                <div class="section-title">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" width="20" height="20"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    Basic Information Fields
                </div>

                <p><span class="field-name">Title:</span> Create a clear, concise title that summarizes your tax
                    content. Effective titles often include keywords that your audience may search for.</p>
                <div class="field-example">Example: "2025 Tax Deduction Changes for Small Business Owners"</div>

                <p><span class="field-name">Excerpt:</span> A brief summary (1-3 sentences) of your post that will
                    appear in previews and search results. Think of this as your "elevator pitch" that entices readers
                    to click and read more.</p>
                <div class="field-example">Example: "New tax deductions are available for small business owners in 2025.
                    Learn which expenses now qualify and how to properly document them to maximize your tax savings."
                </div>

                <div class="tip-box">
                    <strong>Pro Tip:</strong> Write your excerpt after completing your article to ensure it accurately
                    reflects the final content.
                </div>
            </div>

            <div class="content-card">
                <div class="section-title">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" width="20" height="20"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    Content (Markdown Editor)
                </div>

                <p>Our rich markdown editor allows you to create beautifully formatted tax content with ease.</p>

                <p><strong>What is Markdown?</strong> Markdown is a lightweight formatting language that uses simple
                    syntax to create rich text formatting. It lets you add formatting while focusing on writing content
                    rather than complex HTML.</p>

                <p><strong>Available Markdown Features:</strong></p>
                <ul class="feature-list">
                    <li><strong>Headings</strong>: Use # symbols (# for H1, ## for H2, etc.)</li>
                    <li><strong>Text formatting</strong>: Bold (**bold**), italic (*italic*), strikethrough (~~strike~~)
                    </li>
                    <li><strong>Lists</strong>: Ordered (1. 2. 3.) and unordered (* or -)</li>
                    <li><strong>Links</strong>: [Link text](https://example.com)</li>
                    <li><strong>Blockquotes</strong>: > Quote text</li>
                    <li><strong>Code blocks</strong>: ```language code here ```</li>
                    <li><strong>Tables</strong>: | Header | Header | with row separators</li>
                    <li><strong>Horizontal rules</strong>: --- or ***</li>
                </ul>

                <p><strong>Example Markdown:</strong></p>
                <div class="markdown-example">
                    # Tax Deduction Updates<br><br>

                    Here are the **key changes** for 2025:<br><br>

                    * New home office deduction rules<br>
                    * Increased mileage rates<br>
                    * Changes to meal deductions<br><br>

                    > Important: Consult with your tax professional before applying these deductions.
                </div>

                <div class="tip-box">
                    <strong>Pro Tip:</strong> Use headers (# and ##) to break your content into scannable sections,
                    making it easier for busy tax professionals and business owners to find relevant information
                    quickly.
                </div>
            </div>

            <div class="content-card">
                <div class="section-title">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" width="20" height="20"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                        <polyline points="2 17 12 22 22 17"></polyline>
                        <polyline points="2 12 12 17 22 12"></polyline>
                    </svg>
                    Classification Fields
                </div>

                <p><span class="field-name">Category:</span> Select a predefined category that best fits your content.
                    Each post must belong to exactly one category.</p>
                <ul class="feature-list">
                    <li><strong>Tax Tips</strong> - Practical advice for tax compliance and savings</li>
                    <li><strong>Tax Insights</strong> - Analysis and explanations of tax concepts</li>
                    <li><strong>Tax Alerts</strong> - Urgent updates about tax law changes</li>
                    <li><strong>Tax Guides</strong> - Comprehensive information on specific tax topics</li>
                </ul>

                <p><span class="field-name">Tags:</span> Select multiple relevant tags to improve discoverability. Tags
                    are more specific than categories and help readers find related content.</p>
                <div class="field-example">Example tags: Income Tax, Corporate Tax, Tax Credits, Small Business,
                    Self-Employment, Real Estate</div>

                <div class="tip-box">
                    <strong>Pro Tip:</strong> Consistently using the right tags helps build a network of related content
                    that keeps readers engaged longer on your site.
                </div>
            </div>

            <div class="content-card">
                <div class="section-title">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" width="20" height="20"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    Publication Settings
                </div>

                <p><span class="field-name">Status:</span> Determine the visibility of your post.</p>
                <ul class="feature-list">
                    <li><strong>Draft</strong> - Saves your work but keeps it private. Use this while developing content
                        or awaiting review.</li>
                    <li><strong>Published</strong> - Makes your content live and visible to the public.</li>
                    <li><strong>Archived</strong> - Removes content from public view but preserves it for historical
                        reference or potential future use.</li>
                </ul>

                <p><span class="field-name">Featured Image:</span> Upload an image that visually represents your
                    content. This will appear in previews, social shares, and at the top of your post.</p>

                <p><span class="field-name">Meta Description:</span> A concise summary (up to 160 characters) optimized
                    for search engines. This text often appears in search results and should include relevant keywords
                    while enticing readers to click.</p>
                <div class="field-example">Example: "Learn about 7 new tax deductions for small businesses in 2025. Our
                    guide explains qualification requirements and proper documentation."</div>

                <div class="tip-box">
                    <strong>Pro Tip:</strong> Meta descriptions should be different from your excerpt. Focus on SEO
                    keywords in your meta description, while making your excerpt more engaging for human readers.
                </div>
            </div>

            <p style="margin-top: 1.5rem;">
                Remember to save your work by setting the "status" field as <span class="text-accent">Draft</span> if
                you're not ready to publish. Once
                published, your content will be immediately accessible to TaxGen visitors seeking valuable tax
                information.
            </p>
        </div>
    </div>
</div>

<!-- JavaScript for Modal Functionality -->
<script>
    function showFormHelpGuide() {
        document.getElementById('formHelpGuide').style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevent scrolling behind modal
    }

    function closeFormHelpGuide() {
        document.getElementById('formHelpGuide').style.display = 'none';
        document.body.style.overflow = 'auto'; // Re-enable scrolling
    }

    // Close modal when clicking outside of it
    window.onclick = function(event) {
        const modal = document.getElementById('formHelpGuide');
        if (event.target == modal) {
            closeFormHelpGuide();
        }
    }
</script>
