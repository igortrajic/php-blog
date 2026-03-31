<?php include 'header.php'; ?>

<main class="pt-28 pb-12 max-w-2xl mx-auto px-4">
    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
        
        <?php if (!empty($message)): ?>
            <div class="mb-6 p-4 rounded-xl bg-blue-50 text-blue-700 font-medium border border-blue-100">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <h1 class="text-3xl font-bold mb-8 text-gray-900">Edit Post</h1>
        
        <form action="postEdition.php?id=<?= (int)$post['id'] ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            
            <input type="hidden" name="id" value="<?= (int)$post['id'] ?>">

            <div>
                <label class="block mb-2 text-sm font-bold text-gray-700">Post Title</label>
                <input type="text" name="title" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-50/50 focus:border-blue-500 outline-none" 
                       value="<?= htmlspecialchars($post['title']) ?>">
            </div>

            <div>
                <label class="block mb-2 text-sm font-bold text-gray-700">Current Image</label>
                <div class="mb-4">
                    <img src="<?= htmlspecialchars($post['image']) ?>" class="w-full h-48 object-cover rounded-xl border border-gray-100" alt="Current featured image">
                </div>
                <label class="block mb-2 text-xs font-bold text-gray-500 uppercase">Replace Image (Optional)</label>
                <input type="file" name="fileToUpload" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all cursor-pointer">
            </div>

            <div>
                <label class="block mb-2 text-sm font-bold text-gray-700">Content</label>
                <textarea name="content" rows="10" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-50/50 focus:border-blue-500 outline-none"><?= htmlspecialchars($post['content']) ?></textarea>
            </div>

            <div class="flex gap-4">
                <a href="allPosts.php" class="w-1/3 text-center bg-gray-50 text-gray-500 font-bold py-4 rounded-xl hover:bg-gray-100 transition-all">
                    Cancel
                </a>
                <button type="submit" class="w-2/3 bg-blue-600 text-white font-bold py-4 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all">
                    Update Post
                </button>
            </div>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>