<?php
use Core\Security;

$pagetitle = "ورود کاربر";
$description = "صفحه ورود به سایت.";
$keywords = "ورود, سایت";
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h2>Set New Password</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="/set_new_password" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo Security::generateCSRFToken(); ?>">
            <div class="form-group">
                <label for="token">Reset Token</label>
                <input type="text" class="form-control" id="token" name="token" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Set New Password</button>
        </form>
    </div>
</div>
