<?php include 'header.php'; ?>
<main class="pt-32 pb-12 px-4 flex justify-center flex-1 w-full">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl border border-gray-100 shadow-lg">
        <h1 class="text-3xl font-black mb-2">Welcome</h1>
        <p class="text-gray-500 mb-8">Log in to manage your account.</p>

        <?php if (isset($error) && !empty($error)): ?>
            <div style="color: red; margin-bottom: 20px;">
                <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST" class="space-y-5">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <div>
                <label class="block mb-2 text-sm font-medium">Email Address</label>
                <input type="email" name="email" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 outline-none" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium">Password</label>
                <input type="password" name="password" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 outline-none" required>
            </div>
            <button type="submit" class="w-full bg-slate-900 text-white font-bold py-3.5 rounded-xl hover:bg-black transition-all">Log In</button>
        </form>
        <p class="mt-6 text-center text-sm text-gray-500">Don't have an account? <a href="register.php" class="text-blue-600 font-bold">Sign up</a></p>
    </div>
</main>
<?php include 'footer.php'; ?>