<?php include 'header.php'; ?> <main class="pt-28 pb-12 max-w-2xl mx-auto px-4">
    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
        
        <?php if (!empty($message)): ?>
            <div class="mb-6 p-4 rounded-xl bg-blue-50 text-blue-700 font-medium border border-blue-100">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <h1 class="text-3xl font-bold mb-8 text-gray-900">Create New Post</h1>
        
        <form action="postCreation.php" method="POST" enctype="multipart/form-data" class="space-y-6">
            
            <div>
                <label class="block mb-2 text-sm font-bold text-gray-700">Post Title</label>
                <input type="text" name="title" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-50/50 focus:border-blue-500 transition-all outline-none" placeholder="Enter a catchy title...">
            </div>

            <div>
                <label class="block mb-2 text-sm font-bold text-gray-700">Featured Image</label>
                <div class="flex items-center justify-center w-full">
                    <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-200 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <p class="text-xs text-gray-500">Click to upload or drag and drop</p>
                        </div>
                        <input type="file" name="fileToUpload" id="fileToUpload" class="hidden"  />
                    </label>
                </div>
            </div>

            <div>
                <label class="block mb-2 text-sm font-bold text-gray-700">Content</label>
                <textarea name="content" rows="8" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-50/50 focus:border-blue-500 outline-none" placeholder="Write your story..."></textarea>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-4 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all">
                Publish Story
            </button>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>