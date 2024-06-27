<!-- app/views/public/auth/register.php -->
<section class="pady center-sec flex justify-between items-center gap-6 mobile-large:gap-3 mobile-large:flex-col mobile-large:items-start">
    <div></div>
    <div class="mobile-large:w-full mobile-large:mt-3">
        <h2 class="text-vkl-t-sub-header font-bold text-vkl-c-header mr-auto w-fit mb-5 mobile-large:h3-bar">ثبت نام</h2>

        <?php use Core\Security; if (!empty($error)) : ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form class="grid gap-3 mobile-large:gap-3 placeholder:text-vkl-c-normal" action="/register" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo Security::generateCSRFToken(); ?>">

            <label>نام کاربری</label>
            <input class="input placeholder:text-vkl-c-normal" type="text" placeholder="Username" name="username" required>

            <label>ایمیل</label>
            <input class="input placeholder:text-vkl-c-normal" type="email" placeholder="Email" name="email" required>

            <label>رمز ورود</label>
            <input class="input placeholder:text-vkl-c-normal" type="password" placeholder="Password" name="password" required>

            <label>نقش</label>
            <select class="input placeholder:text-vkl-c-normal" name="role">
                <option value="user">User</option>
                <option value="agent">Agent</option>
                <option value="admin">Admin</option>
            </select>

            <button class="pri-btn col-span-2 mobile-medium:py-2">ثبت نام</button>
        </form>
    </div>
</section>
