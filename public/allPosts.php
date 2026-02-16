<?php 
    $pageTitle = "All Posts - EchoLog";
    include 'header.php'; 
?>

<main class="pt-28 pb-12 max-w-screen-xl mx-auto px-4">
    <header class="mb-12 border-b border-gray-100 pb-8">
        <h1 class="text-4xl font-black text-gray-900 tracking-tight">All Publications</h1>
        <p class="text-gray-500 mt-2">Browse our complete archive of articles.</p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <article class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <span class="text-blue-600 text-xs font-bold uppercase">Archive</span>
            <h2 class="text-xl font-bold mt-2 mb-3">An Older Story</h2>
            <p class="text-gray-600 text-sm line-clamp-2">This is one of many posts in the archive...</p>
            <a href="postDetail.php" class="inline-block mt-4 text-blue-600 font-bold">Read more →</a>
        </article>
        
        </div>
</main>

<?php include 'footer.php'; ?>