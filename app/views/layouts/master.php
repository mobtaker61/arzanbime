<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>وبلاگ</title>
    <!-- Include Bootstrap RTL CSS -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css">
    <style>
        body {
            direction: rtl;
        }
    </style>
</head>
<body>
    <?php include 'app/views/layouts/header.php'; ?>
    <div class="container">
        <?php include $viewPath; ?>
    </div>
    <?php include 'app/views/layouts/footer.php'; ?>
    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
