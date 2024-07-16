<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a href="/" class="nav-link">سایت</a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <!-- Fullscreen Toggle -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i>
                </a>
            </li>
            <!-- User Account Dropdown -->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="<?php echo $_SESSION['user_data']['profile_image'] ?? '/public/adminlte/assets/img/default-profile.png'; ?>" class="user-image rounded-circle shadow" alt="User Image">
                    <span class="d-none d-md-inline"><?php echo $_SESSION['user_data']['name'] . ' ' . $_SESSION['user_data']['surname']; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <li class="user-header text-bg-primary">
                        <img src="<?php echo $_SESSION['user_data']['profile_image'] ?? '/public/adminlte/assets/img/default-profile.png'; ?>" class="rounded-circle shadow" alt="User Image">
                        <p><?php echo $_SESSION['user_data']['name'] . ' ' . $_SESSION['user_data']['surname']; ?></p>
                        <small>Member since <?php echo date('M. Y', strtotime($_SESSION['user_data']['created_at'])); ?></small>
                    </li>
                    <li class="user-footer">
                        <a href="/user/profile" class="btn btn-default btn-flat">پروفایل</a>
                        <a href="/logout" class="btn btn-default btn-flat float-end">خروج</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>