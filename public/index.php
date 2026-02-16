<?php 
    $pageTitle = "Home - EchoLog";
    include 'header.php'; 
?>

<main class="pt-24 pb-12 max-w-screen-xl mx-auto p-4">
    <header class="mb-10">
        <h1 class="text-4xl font-extrabold text-heading">Latest Stories</h1>
        <p class="text-body mt-2">Insights, tutorials, and thoughts on web development.</p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <article class="border border-default rounded-base overflow-hidden hover:shadow-lg transition-shadow">
            <div class="p-6">
                <span class="text-xs font-bold uppercase text-fg-brand">Tutorial</span>
                <h2 class="text-xl font-bold mt-2 text-heading">Getting Started with PHP</h2>
                <p class="text-body mt-3 line-clamp-3">This is a short excerpt from the blog post to entice readers...</p>
                <a href="postDetail.php?id=1" class="inline-block mt-4 text-fg-brand font-semibold hover:underline">Read more →</a>
            </div>
        </article>
    </div>
</main>

<?php include 'footer.php'; ?>