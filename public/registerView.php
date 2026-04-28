<?php include 'header.php'; ?>
<main class="pt-32 pb-12 px-4 flex justify-center">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl border border-gray-100 shadow-lg">
        <h1 class="text-3xl font-black mb-2">Create Account</h1>
        <p class="text-gray-500 mb-8">Join the community and start writing.</p>
        <?php if (!empty($error)): ?>
            <div class="mb-5 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl">
                <?php foreach ($error as $e): ?>
                    <p class="text-red-700 text-sm font-medium">
                        <?= htmlspecialchars($e, ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="register.php" class="space-y-5" method="POST">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <div>
                <label class="block mb-2 text-sm font-medium">Full Name</label>
                <input type="text" name='name' class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 outline-none" placeholder="example" value="<?php echo htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium">Email Address</label>
                <input type="email" name='email' class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 outline-none" placeholder="example@example.com" value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium">Password</label>
                <input type="password" name='password' class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 outline-none" placeholder="••••••••">
            </div>
            <button type="submit" class="w-full bg-slate-900 text-white font-bold py-3.5 rounded-xl hover:bg-black transition-all">Sign Up</button>
        </form>
        <p class="mt-6 text-center text-sm text-gray-500">Already have an account? <a href="login.php" class="text-blue-600 font-bold">Log in</a></p>
    </div>
</main>
<?php include 'footer.php'; ?>