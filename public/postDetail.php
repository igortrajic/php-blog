<?php 
    include 'header.php'; 
?>

<main class="pt-32 pb-12 max-w-3xl mx-auto px-4">
    <span class="text-blue-600 font-bold text-xs uppercase tracking-widest">Category Name</span>
    
    <h1 class="text-4xl font-black text-gray-900 mt-2 mb-6">Post Title Goes Here</h1>

    <div class="flex items-center gap-2 text-sm text-gray-500 mb-10">
        <span class="font-bold text-gray-900">Author Name</span>
        <span>•</span>
        <span>February 16, 2026</span>
    </div>

    <div class="text-gray-700 leading-relaxed text-lg space-y-6">
        <p>This is the first paragraph of your blog post. It's clean, readable, and ready for your database content.</p>
        
        <p>By keeping this simple, you can easily see where your PHP logic will loop through paragraphs or display images.</p>
    </div>

    <div class="mt-12 pt-6 border-t border-gray-100 flex gap-4">
        <a href="postEdition.php" class="text-sm font-bold text-blue-600 hover:underline">Edit this post</a>
        <a href="index.php" class="text-sm font-bold text-gray-400 hover:underline">Back to home page</a>
    </div>
</main>

<?php include 'footer.php'; ?>