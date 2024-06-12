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

        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form class="grid gap-3 mobile-large:gap-3 placeholder:text-vkl-c-normal" action="/login" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo Security::generateCSRFToken(); ?>">
            <label>نام کاربری</label>
            <input class="input placeholder:text-vkl-c-normal" type="text" placeholder="Username" name="username" inputmode="text" />

            <label>رمز ورود</label>
            <input class="input placeholder:text-vkl-c-normal" type="password" placeholder="Password" name="password" />

            <button class="pri-btn col-span-2 mobile-medium:py-2">ورود</button>
        </form>
    </div>
</section>