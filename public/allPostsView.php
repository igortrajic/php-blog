<?php 
    $pageTitle = "All Posts - EchoLog";
    include 'header.php'; 
?>

<main class="pt-28 pb-12 max-w-7xl mx-auto px-4">
    <header class="mb-12">
        <h1 class="text-4xl font-black text-gray-900">Archive</h1>
        <p class="text-gray-500 mt-2">Explore every story we've ever told.</p>
        
        <?php if (isset($errorMessage)): ?>
            <p class="text-red-500 mt-4"><?= htmlspecialchars($errorMessage) ?></p>
        <?php endif; ?>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php if (!empty($allPosts)): ?>
            <?php foreach ($allPosts as $post): ?>
                <article class="group bg-white rounded-xl border border-gray-100 overflow-hidden shadow-sm flex flex-col">
                    <div class="aspect-video overflow-hidden bg-gray-100">
                        <img src="<?= htmlspecialchars($post['image']) ?>" class="w-full h-full object-cover" alt="<?= htmlspecialchars($post['title']) ?>">
                    </div>
                    <div class="p-4 flex flex-col grow">
                        <h2 class="font-bold text-gray-900 text-lg line-clamp-1"><?= htmlspecialchars($post['title']) ?></h2>
                        
                        <?php 
                            $cleanContent = strip_tags($post['content']);
                            $excerpt = strlen($cleanContent) > 100 ? substr($cleanContent, 0, 100) . '...' : $cleanContent;
                        ?>
                        <p class="text-sm text-gray-500 mt-2 grow"><?= htmlspecialchars($excerpt) ?></p>
                        <a href="postDetail.php?id=<?= urlencode($post['id']) ?>" class="inline-block mt-4 text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">Read Post →</a>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full text-center text-gray-500">
                <p>No posts found.</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include 'footer.php'; ?>