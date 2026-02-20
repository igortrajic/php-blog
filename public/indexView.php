<?php 
    $pageTitle = "Home - IdeGas";
    include 'header.php'; 
?>

<main class="pt-28 pb-12 max-w-7xl mx-auto px-4">
    <header class="mb-12">
        <h1 class="text-4xl font-black text-gray-900 tracking-tight">Latest Stories</h1>
        <p class="text-gray-500 mt-2">Fresh insights from our community.</p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <?php if (!empty($recentPosts)): ?>
            <?php foreach ($recentPosts as $post): ?>
                <article class="group bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-all">
                    <div class="aspect-video overflow-hidden bg-gray-100">
                        <img src="<?= htmlspecialchars($post['image']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="<?= htmlspecialchars($post['title']) ?>">
                    </div>
                    <div class="p-5">
                        <span class="text-blue-600 text-xs font-bold uppercase tracking-widest">Story</span>
                        <h2 class="text-lg font-bold mt-2 text-gray-900"><?= htmlspecialchars($post['title']) ?></h2>
                        <a href="postDetail.php?id=<?= $post['id'] ?>" class="inline-block mt-4 text-sm font-bold text-gray-900 hover:text-blue-600">Read Article →</a>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-500 col-span-3">No stories published yet. Be the first to write one!</p>
        <?php endif; ?>
    </div>
</main>

<?php include 'footer.php'; ?>