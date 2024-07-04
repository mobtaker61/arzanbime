<?php

use Core\Security;

$pagetitle = "ورود کاربر";
$description = "صفحه ورود به سایت.";
$keywords = "ورود, سایت";
?>

<section class="pady center-sec flex justify-between items-center gap-6 mobile-large:gap-3 mobile-large:flex-col mobile-large:items-start">
    <div>
    </div>
    <div class="mobile-large:w-full mobile-large:mt-3">
        <h2 class="text-vkl-t-sub-header font-bold text-vkl-c-header mr-auto w-fit mb-5 mobile-large:h3-bar">
            ورود کاربر
        </h2>
        <form class="grid gap-3 mobile-large:gap-3 placeholder:text-vkl-c-normal" action="/login" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo Security::generateCSRFToken(); ?>">
            <label>نام کاربری</label>
            <input class="input placeholder:text-vkl-c-normal" type="text" placeholder="username" name="username" inputmode="text" />

            <label>رمز ورود</label>
            <input class="input placeholder:text-vkl-c-normal" type="password" placeholder="Password" name="password" />

            <button class="pri-btn col-span-2 mobile-medium:py-2">ورود</button>
        </form>
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
    </div>
</section>

<script>
    function saveToken(token) {
        fetch('/save-token', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': 'YOUR_CSRF_TOKEN'
            },
            body: JSON.stringify({ token: token })
        }).then(response => response.json())
        .then(data => {
            console.log('Token saved:', data);
        }).catch(error => {
            console.error('Error saving token:', error);
        });
    }

    messaging.getToken().then((token) => {
        console.log('Token received: ', token);
        saveToken(token);
    }).catch((err) => {
        console.error('Unable to get token.', err);
    });
</script>
