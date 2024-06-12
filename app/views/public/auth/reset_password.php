<?php
use Core\Security;

$pagetitle = "ورود کاربر";
$description = "صفحه ورود به سایت.";
$keywords = "ورود, سایت";
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h2>Reset Password</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (isset($message)): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="/reset_password" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo Security::generateCSRFToken(); ?>">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Send Reset Token</button>
        </form>
    </div>
</div>
