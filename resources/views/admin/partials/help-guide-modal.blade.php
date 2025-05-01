 <!-- Modal Structure -->
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

     #userName {
         color: #e25822;
     }
 </style>
 <div id="quickGuideModal" class="modal-container">
     <div class="modal-content">
         <div class="modal-header">
             <h2 style="margin: 0; font-size: 1.25rem;">TaxGen Dashboard Quick Guide</h2>
             <button class="close-button" onclick="closeQuickGuideModal()">&times;</button>
         </div>
         <div class="modal-body">
             <div class="welcome-message">
                 Welcome, <span id="userName">{{ auth()->user()->name }}</span>! <br> Let's make tax content creation
                 simple.
             </div>

             <p class="mb-2">
                 This dashboard helps you create and manage valuable tax-related content for TaxGen Consultants LLP.
                 We've organized everything to help you efficiently manage your tax insights, tips, and alerts.
             </p>

             <div class="content-card">
                 <div class="section-title">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" width="20" height="20"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                     </svg>
                     Content Management
                 </div>
                 <p>Create engaging tax-related posts, articles and blogs to inform your audience:</p>
                 <ul class="feature-list">
                     <li>Create new posts with rich formatting</li>
                     <li>Assign each post to a specific category</li>
                     <li>Add multiple tags to improve discoverability</li>
                     <li>Edit existing content as tax laws change</li>
                     <li>Delete outdated content when necessary</li>
                 </ul>
                 <div class="tip-box">
                     <strong>Pro Tip:</strong> Regular content updates keep your audience informed of critical tax
                     changes and improve your site's SEO ranking.
                 </div>
             </div>

             <div class="content-card">
                 <div class="section-title">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" width="20" height="20"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                     </svg>
                     Category Management
                 </div>
                 <p>Organize your content with specific categories and tags:</p>
                 <ul class="feature-list">
                     <li>Create categories like "Tax Tips," "Tax Insights," or "Tax Alerts"</li>
                     <li>Add tags to specify topics like "Income Tax," "Corporate Tax," etc.</li>
                     <li>Edit category and tag names as needed</li>
                     <li>View all posts within a specific category</li>
                 </ul>
                 <p>Navigate to <a href="{{ route('categories.index') }}" class="action-link">Categories</a> or <a
                         href="{{ route('tags.index') }}" class="action-link">Tags</a> in the navbar to manage your
                     content organization.</p>
             </div>

             <div class="content-card">
                 <div class="section-title">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" width="20" height="20"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                     </svg>
                     Analytics Dashboard
                 </div>
                 <p>Track the performance of your tax content:</p>
                 <ul class="feature-list">
                     <li>Monitor total posts, categories, and tags</li>
                     <li>Track page views and user engagement</li>
                     <li>View content "likes" to gauge audience interest</li>
                     <li>Review activity logs to monitor administrative actions</li>
                 </ul>
                 <p>The main dashboard provides a quick overview of these metrics, helping you understand what tax
                     content resonates with your audience.</p>
             </div>

             <div class="content-card">
                 <div class="section-title">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" width="20" height="20"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                         <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                         <circle cx="12" cy="7" r="4"></circle>
                     </svg>
                     Profile Management
                 </div>
                 <p>Keep your account secure and up-to-date:</p>
                 <ul class="feature-list">
                     <li>Update your email address</li>
                     <li>Change your password regularly</li>
                 </ul>
                 <p>Access your profile settings through the user menu in the top-right corner of the dashboard.</p>
             </div>
         </div>
     </div>
 </div>

 <!-- JavaScript for Modal Functionality -->
 <script>
     function openQuickGuideModal() {
         document.getElementById('quickGuideModal').style.display = 'block';
         document.body.style.overflow = 'hidden'; // Prevent scrolling behind modal
     }

     function closeQuickGuideModal() {
         document.getElementById('quickGuideModal').style.display = 'none';
         document.body.style.overflow = 'auto'; // Re-enable scrolling
     }

     // Close modal when clicking outside of it
     window.onclick = function(event) {
         const modal = document.getElementById('quickGuideModal');
         if (event.target == modal) {
             closeQuickGuideModal();
         }
     }
 </script>
