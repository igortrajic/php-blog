<?php
function renderProfile(array $user, array $errors = [], string $section = ''): void
{
    include 'header.php';
?>

    <main class="pt-28 pb-12 max-w-2xl mx-auto px-4 flex-1 w-full">
        <?php display_flash(); ?>

        <h1 class="text-4xl font-black text-gray-900 mb-8">My Profile</h1>
        <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Account Details</h2>

            <?php if (!empty($errors) && $section === 'profile'): ?>
                <div class="mb-5 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl">
                    <?php foreach ($errors as $e): ?>
                        <p class="text-red-700 text-sm font-medium"><?= htmlspecialchars($e) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="profile.php" method="POST" class="space-y-5">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <input type="hidden" name="form" value="profile">
                <div>
                    <label class="block mb-2 text-sm font-medium">Full Name</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium">Email Address</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 outline-none" required>
                </div>
                <button type="submit" class="w-full bg-slate-900 text-white font-bold py-3.5 rounded-xl hover:bg-black transition-all">
                    Save Changes
                </button>
            </form>
        </div>
        <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Change Password</h2>

            <?php if (!empty($errors) && $section === 'password'): ?>
                <div class="mb-5 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl">
                    <?php foreach ($errors as $e): ?>
                        <p class="text-red-700 text-sm font-medium"><?= htmlspecialchars($e) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="profile.php" method="POST" class="space-y-5">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <input type="hidden" name="form" value="password">
                <div>
                    <label class="block mb-2 text-sm font-medium">Current Password</label>
                    <input type="password" name="current_password"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium">New Password</label>
                    <input type="password" name="new_password"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium">Confirm New Password</label>
                    <input type="password" name="confirm_password"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 outline-none" required>
                </div>
                <button type="submit" class="w-full bg-slate-900 text-white font-bold py-3.5 rounded-xl hover:bg-black transition-all">
                    Update Password
                </button>
            </form>
        </div>
    </main>

<?php include 'footer.php';
}
