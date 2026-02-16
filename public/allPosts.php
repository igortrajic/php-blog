<?php 
    $pageTitle = "All Posts - EchoLog";
    include 'header.php'; 
?>

<main class="pt-28 pb-12 max-w-screen-xl mx-auto px-4">
    <header class="mb-12">
        <h1 class="text-4xl font-black text-gray-900">Archive</h1>
        <p class="text-gray-500 mt-2">Explore every story we've ever told.</p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <article class="group bg-white rounded-xl border border-gray-100 overflow-hidden shadow-sm">
            <div class="aspect-video overflow-hidden bg-gray-100">
                <img src="" class="w-full h-full object-cover" alt="Card Image">
            </div>
            <div class="p-4">
                <h2 class="font-bold text-gray-900">Static Post Example</h2>
                <a href="postDetail.php" class="inline-block mt-3 text-xs font-bold text-blue-600">Read Post →</a>
            </div>
        </article>
        
    </div>
</main>

<?php include 'footer.php'; ?>