<?php include 'header.php'; ?>
<main class="pt-28 pb-12 max-w-2xl mx-auto px-4">
    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
        <h1 class="text-3xl font-bold mb-8 text-gray-900">Edit Post</h1>
        
        <form action="#" class="space-y-6">
            <div>
                <label class="block mb-2 text-sm font-bold text-gray-700">Post Title</label>
                <input type="text" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none" 
                       value="Getting Started with PHP 8.x">
            </div>

            <div>
                <label class="block mb-2 text-sm font-bold text-gray-700">Category</label>
                <select class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none">
                    <option selected>Technology</option>
                    <option>Tutorial</option>
                    <option>Lifestyle</option>
                </select>
            </div>

            <div>
                <label class="block mb-2 text-sm font-bold text-gray-700">Current Image</label>
                <img src="" class="w-full h-40 object-cover rounded-xl mb-4" alt="Current">
                <input type="file" class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>

            <div>
                <label class="block mb-2 text-sm font-bold text-gray-700">Content</label>
                <textarea rows="8" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none">This is the existing content of the post that the user wants to change...</textarea>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-4 rounded-xl hover:bg-blue-700 transition-all">
                Save Changes
            </button>
        </form>
    </div>
</main>
<?php include 'footer.php'; ?>