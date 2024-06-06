<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'وبلاگ'; ?></title>
    <meta name="description" content="<?php echo $description ?? 'این وبلاگ به اشتراک گذاری اطلاعات می پردازد'; ?>">
    <meta name="keywords" content="<?php echo $keywords ?? 'وبلاگ, آموزش, اخبار, سوالات متداول'; ?>">
    <!-- Include Bootstrap RTL CSS -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css">
    <style>
        body {
            direction: rtl;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <header>
        <?php include 'app/views/layouts/user/header.php'; ?>
    </header>
    <main class="container">
        <?php include $viewPath; ?>
    </main>
    <footer>
        <?php include 'app/views/layouts/user/footer.php'; ?>
    </footer>
    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>