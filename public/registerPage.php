<?php include 'header.php'; ?>
<main class="pt-32 pb-12 px-4 flex justify-center">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl border border-gray-100 shadow-lg">
        <h1 class="text-3xl font-black mb-2">Create Account</h1>
        <p class="text-gray-500 mb-8">Join the community and start writing.</p>
        <form class="space-y-5">
            <div>
                <label class="block mb-2 text-sm font-medium">Full Name</label>
                <input type="text" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 outline-none" placeholder="example">
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium">Email Address</label>
                <input type="email" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 outline-none" placeholder="example@example.com">
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium">Password</label>
                <input type="password" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 outline-none" placeholder="••••••••">
            </div>
            <button type="submit" class="w-full bg-slate-900 text-white font-bold py-3.5 rounded-xl hover:bg-black transition-all">Sign Up</button>
        </form>
        <p class="mt-6 text-center text-sm text-gray-500">Already have an account? <a href="loginForm.php" class="text-blue-600 font-bold">Log in</a></p>
    </div>
</main>
<?php include 'footer.php'; ?>