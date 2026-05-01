<?php
function renderPostDetail(array $post): void {
    include 'header.php';
?>

    <main class="pt-32 pb-12 max-w-3xl mx-auto px-4">
        <span class="text-blue-600 font-bold text-xs uppercase tracking-widest">
            <?= htmlspecialchars($post['category_name'] ?? 'Uncategorized') ?>
        </span>

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
            <?php if (isset($_SESSION['id']) && ($_SESSION['id'] == $post['user_id'] || ($_SESSION['role'] ?? '') === 'admin')): ?>
                <a href="postEdition.php?id=<?= (int)$post['id'] ?>" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold">Edit this post</a>

                <button onclick="document.getElementById('delete-modal').classList.remove('hidden')"
                    class="bg-red-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-red-700 transition-all">
                    Delete
                </button>

                <div id="delete-modal" class="hidden fixed inset-0 z-50 items-center justify-center">
                    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="document.getElementById('delete-modal').classList.add('hidden')"></div>

                    <div class="relative bg-white rounded-2xl shadow-xl p-8 max-w-sm w-full mx-4 z-10">
                        <h2 class="text-xl font-black text-gray-900 mb-2">Delete this post?</h2>
                        <p class="text-gray-500 text-sm mb-6">This action cannot be undone. The post will be permanently removed.</p>

                        <div class="flex gap-3">
                            <button onclick="document.getElementById('delete-modal').classList.add('hidden')"
                                class="w-1/2 py-3 rounded-xl bg-gray-100 text-gray-700 font-bold hover:bg-gray-200 transition-all">
                                Cancel
                            </button>
                            <form action="postDelete.php" method="POST" class="w-1/2">
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                <input type="hidden" name="id" value="<?= (int)$post['id'] ?>">
                                <button type="submit" class="w-full py-3 rounded-xl bg-red-600 text-white font-bold hover:bg-red-700 transition-all">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <a href="index.php" class="text-sm font-bold text-gray-400 hover:underline self-center">Back to home</a>
        </div>
    </main>

<?php include 'footer.php';
}