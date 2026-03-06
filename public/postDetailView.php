<?php include 'header.php'; ?>

<main class="pt-32 pb-12 max-w-3xl mx-auto px-4">
    <span class="text-blue-600 font-bold text-xs uppercase tracking-widest">Story</span>
    
    <h1 class="text-4xl font-black text-gray-900 mt-2 mb-6">
        <?= htmlspecialchars($post['title']) ?>
    </h1>

    <div class="flex items-center gap-2 text-sm text-gray-500 mb-10">
        <span class="font-bold text-gray-900">Author</span>
        <span>•</span>
        <span>February 16, 2026</span>
    </div>

    <img src="<?= htmlspecialchars($post['image']) ?>" class="w-full rounded-2xl mb-10" alt="Featured image">

    <div class="text-gray-700 leading-relaxed text-lg space-y-6">
        <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
    </div>

    <div class="mt-12 pt-6 border-t border-gray-100 flex gap-4">
        <a href="postEdition.php?id=<?= (int)$post['id'] ?>" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold">Edit this post</a>
        <a href="index.php" class="text-sm font-bold text-gray-400 hover:underline">Back to home</a>
    </div>
</main>

<?php include 'footer.php'; ?>