<?php 
    $pageTitle = "Home - EchoLog";
    include 'header.php'; 
?>

<main class="pt-28 pb-12 max-w-screen-xl mx-auto px-4">
    <header class="mb-12">
        <h1 class="text-4xl font-black text-gray-900 tracking-tight">Latest Stories</h1>
        <p class="text-gray-500 mt-2">Fresh insights from our community.</p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <article class="group bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-all">
            <div class="aspect-video overflow-hidden bg-gray-100">
                <img src="" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="PHP Post">
            </div>
            <div class="p-5">
                <span class="text-blue-600 text-xs font-bold uppercase tracking-widest">Tutorial</span>
                <h2 class="text-lg font-bold mt-2 text-gray-900">Modern PHP Development</h2>
                <a href="postDetail.php" class="inline-block mt-4 text-sm font-bold text-gray-900 hover:text-blue-600">Read Article →</a>
            </div>
        </article>
    </div>
</main>

<?php include 'footer.php'; ?>