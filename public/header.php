<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>IdeGas</title>
</head>
<body class="bg-gray-50 text-slate-900">
<nav class="bg-white/80 backdrop-blur-md fixed w-full z-20 top-0 start-0 border-b border-gray-200">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="index.php" class="flex items-center space-x-2">
        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
            <span class="text-white font-bold">I</span>
        </div>
        <span class="self-center text-xl font-bold tracking-tight">IdeGas</span>
    </a>
    <div class="flex md:order-2 space-x-3">
        <a href="loginForm.php" class="text-gray-700 hover:text-blue-600 font-medium text-sm px-4 py-2">Login</a>
        <a href="registerPage.php" class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-full text-sm px-5 py-2.5 transition-all">Get Started</a>
    </div>
    <div class="hidden w-full md:block md:w-auto md:order-1">
      <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0">
        <li><a href="index.php" class="block py-2 px-3 text-blue-600 font-bold">Home</a></li>
        <li><a href="allPosts.php" class="block py-2 px-3 text-gray-900 hover:text-blue-600">All Posts</a></li>
        <li><a href="postCreation.php" class="block py-2 px-3 text-gray-900 hover:text-blue-600">Write</a></li>
      </ul>
    </div>
  </div>
</nav>