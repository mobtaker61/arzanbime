<?php

use Core\Security;

$pagetitle = "ورود کاربر";
$description = "صفحه ورود به سایت.";
$keywords = "ورود, سایت";

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Generate CSRF token if not exists
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = Security::generateCSRFToken();
}

// Store current token for form
$csrf_token = $_SESSION['csrf_token'] ?? '';
?>

<section class="pady center-sec flex justify-between items-center gap-6 mobile-large:gap-3 mobile-large:flex-col mobile-large:items-start">
    <div>
    </div>
    <div class="mobile-large:w-full mobile-large:mt-3">
        <h2 class="text-vkl-t-sub-header font-bold text-vkl-c-header mr-auto w-fit mb-5 mobile-large:h3-bar">
            ورود کاربر
        </h2>
        <form class="grid gap-3 mobile-large:gap-3 placeholder:text-vkl-c-normal" action="/login" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
            <label>نام کاربری</label>
            <input class="input placeholder:text-vkl-c-normal" type="text" placeholder="username" name="username" inputmode="text" required autofocus />

            <label>رمز ورود</label>
            <input class="input placeholder:text-vkl-c-normal" type="password" placeholder="Password" name="password" required />

            <button class="pri-btn col-span-2 mobile-medium:py-2" type="submit">ورود</button>
        </form>
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger mt-3 p-3 bg-red-100 text-red-700 rounded">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        
        <!-- Debug Information -->
        <?php if (!empty($debugInfo) || defined('DEBUG_MODE')): ?>
            <div class="mt-3 p-3 bg-gray-100 text-gray-700 rounded text-sm">
                <details>
                    <summary>Debug Information (Click to expand)</summary>
                    <div class="pt-2">
                        <p>Session Status: <?php echo session_status(); ?></p>
                        <p>Session ID: <?php echo session_id(); ?></p>
                        <p>User ID: <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'Not set'; ?></p>
                        <p>Username: <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Not set'; ?></p>
                        <p>User Role: <?php echo isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'Not set'; ?></p>
                        <p>CSRF Token: <?php echo isset($_SESSION['csrf_token']) ? htmlspecialchars($_SESSION['csrf_token']) : 'Not set'; ?></p>
                        <p>Form Token: <?php echo htmlspecialchars($csrf_token); ?></p>
                        
                        <?php if (!empty($debugInfo)): ?>
                            <hr class="my-2">
                            <p><strong>Login Debug Info:</strong></p>
                            <ol>
                                <?php foreach ($debugInfo as $info): ?>
                                    <li><?php echo htmlspecialchars($info); ?></li>
                                <?php endforeach; ?>
                            </ol>
                        <?php endif; ?>
                    </div>
                </details>
            </div>
        <?php endif; ?>
    </div>
</section>
