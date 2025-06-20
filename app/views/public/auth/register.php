<!-- app/views/public/auth/register.php -->
<section class="pady center-sec flex justify-between items-center gap-6 mobile-large:gap-3 mobile-large:flex-col mobile-large:items-start">
    <div></div>
    <div class="mobile-large:w-full mobile-large:mt-3">
        <h2 class="text-vkl-t-sub-header font-bold text-vkl-c-header mr-auto w-fit mb-5 mobile-large:h3-bar">ثبت نام</h2>

        <form class="grid gap-3 mobile-large:gap-3 placeholder:text-vkl-c-normal" action="/register" method="post">
            <input type="hidden" name="csrf_token" value="<?php use Core\Security; echo Security::generateCSRFToken(); ?>">
            <input type="hidden" name="fcm_token" id="fcm_token" value="">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block">نام</label>
                    <input type="text" name="name" id="name" class="border border-gray-300 p-2 w-full" required>
                </div>
                <div>
                    <label for="surname" class="block">نام خانوادگی</label>
                    <input type="text" name="surname" id="surname" class="border border-gray-300 p-2 w-full" required>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="tel" class="block">موبایل</label>
                    <input type="tel" name="tel" id="tel" class="border border-gray-300 p-2 w-full" required>
                </div>
                <div>
                    <label for="email" class="block">ایمیل</label>
                    <input type="email" name="email" id="email" class="border border-gray-300 p-2 w-full">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="username" class="block">Username</label>
                    <input type="text" name="username" id="username" class="border border-gray-300 p-2 w-full" required>
                    <input type="hidden" name="role" id="role" value="1">
                    <input type="hidden" name="birth_date" id="birth_date" class="border border-gray-300 p-2 w-full" required>
                </div>
                <div>
                    <label for="password" class="block">Password</label>
                    <input type="password" name="password" id="password" class="border border-gray-300 p-2 w-full" required>
                </div>
            </div>
            <button type="submit" class="pri-btn bg-blue-500 text-white px-4 py-2 rounded">ثبت نام</button>
        </form>
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger py-6"><?php echo $error; ?></div>
        <?php endif; ?>
    </div>
</section>

<script>
// Check if Firebase is initialized on the page
document.addEventListener('DOMContentLoaded', function() {
    // Initialize the form
    const form = document.querySelector('form');
    
    // Try to get FCM token if Firebase is available
    if (typeof firebase !== 'undefined' && firebase.messaging) {
        try {
            const messaging = firebase.messaging();
            messaging.getToken().then(function(currentToken) {
                if (currentToken) {
                    // Set the token in the hidden field
                    document.getElementById('fcm_token').value = currentToken;
                    console.log('FCM token set successfully');
                }
            }).catch(function(err) {
                console.log('An error occurred while retrieving token: ', err);
            });
        } catch (e) {
            console.log('Firebase messaging not available: ', e);
        }
    } else {
        console.log('Firebase not available');
    }
});
</script>