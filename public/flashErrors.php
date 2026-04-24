<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function set_flash($message, $type = 'success') {
    $_SESSION['flash'] = [
        'message' => $message,
        'type' => $type
    ];
}

function display_flash() {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];

        $colors = $flash['type'] === 'success' 
            ? 'bg-green-100 text-green-800 border-green-200' 
            : 'bg-red-100 text-red-800 border-red-200';
        
        echo "
        <div id='flash-message' class='mb-8 transition-opacity duration-500'>
            <div class='{$colors} border p-4 rounded-xl flex justify-between items-center shadow-sm'>
                <span class='font-medium text-sm md:text-base'>" . htmlspecialchars($flash['message']) . "</span>
                <button onclick=\"this.parentElement.parentElement.remove()\" class='text-2xl leading-none px-2'>&times;</button>
            </div>
        </div>";

        unset($_SESSION['flash']);
    }
}