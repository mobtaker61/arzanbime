<?php
use Core\Security;

$pagetitle = "ورود کاربر";
$description = "صفحه ورود به سایت.";
$keywords = "ورود, سایت";
?>

<section class="pady center-sec">
    <h3 class="h3-bar mb-6">ثبت نام کاربر</h3>
    <div class="grid grid-cols-3 tablet-small:grid-cols-1 gap-6 mobile-large:flex-col mobile-large:items-start">
        <div class="col-span-2 tablet-small:col-span-1">
            <img width="380" height="300" alt="مرد کنار زمین" src="/public/assets/a-vector-globe-GME6DF1B.png" />
        </div>
        <div class="mobile-large:w-full mobile-large:mt-3">


            <form class="grid gap-3 mobile-large:gap-3 placeholder:text-vkl-c-normal" action="/register" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo Security::generateCSRFToken(); ?>">
                <label>نام کاربری</label>
                <input class="input placeholder:text-vkl-c-normal" type="text" placeholder="Username" name="username" inputmode="text" />

                <label>ایمیل</label>
                <input class="input placeholder:text-vkl-c-normal" type="Email" placeholder="email" name="email" inputmode="email" />

                <label>رمز ورود</label>
                <input class="input placeholder:text-vkl-c-normal" type="password" placeholder="Password" name="password" />

                <button class="pri-btn col-span-2 mobile-medium:py-2">ثبت نام</button>
                <?php if (isset($error)) : ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>
            </form>
            <p class="text-vkl-c-header mb-9 mt-6 tablet-large:mb-6 mobile-large:mb-8">آیا حساب کاربری دارید؟ <a href="/login">وارد شوید</a></p>
        </div>
</section>