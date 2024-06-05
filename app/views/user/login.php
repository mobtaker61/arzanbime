<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h2>ورود</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="/login" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo Security::generateCSRFToken(); ?>">
            <div class="form-group">
                <label for="username">نام کاربری</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">رمز عبور</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">ورود</button>
        </form>
    </div>
</div>
