<?php include 'header.php'; ?>
<main class="pt-28 pb-12 max-w-2xl mx-auto px-4">
    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
        <h1 class="text-3xl font-bold mb-8">Create New Post</h1>
        <form action="#" class="space-y-6">
            <div>
                <label class="block mb-2 text-sm font-bold text-gray-700">Post Title</label>
                <input type="text" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-50/50 focus:border-blue-500 transition-all outline-none" placeholder="Enter a catchy title...">
            </div>
            <div>
                <label class="block mb-2 text-sm font-bold text-gray-700">Category</label>
                <select class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-50/50 focus:border-blue-500 outline-none">
                    <option>Technology</option>
                    <option>Tutorial</option>
                    <option>Lifestyle</option>
                </select>
            </div>
            <div>
                <label class="block mb-2 text-sm font-bold text-gray-700">Content</label>
                <textarea rows="10" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-50/50 focus:border-blue-500 outline-none" placeholder="Write your story..."></textarea>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-4 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all">Publish Story</button>
        </form>
    </div>
</main>
<?php include 'footer.php'; ?>