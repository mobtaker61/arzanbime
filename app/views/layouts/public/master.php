<!DOCTYPE html>
<html class="w-screen overflow-x-hidden" lang="fa-IR" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="assets/a-logo-EmGrkL-A.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $pagetitle .' - ارزان بیمه'; ?></title>
    <meta name="description" content="<?php echo $description ?? 'این وبلاگ به اشتراک گذاری اطلاعات می پردازد'; ?>">
    <meta name="keywords" content="<?php echo $keywords ?? 'وبلاگ, آموزش, اخبار, سوالات متداول'; ?>">

    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/duotone/style.css" />
    <link rel="stylesheet" type="text/css" href="/public/css/front.css" />
</head>

<body class="text-vkl-t-normal font-anjoman bg-neutral-50 text-vkl-c-normal max-w-180 mx-auto overflow-x-hidden">
    <header id="desc-header" class="max-w-180 fixed w-full top-0 text-vkl-t-sub text-neutral-50 z-50">
        <?php include 'app/views/layouts/public/header.php'; ?>
    </header>
    <main class="container">
        <?php echo $content; ?>
    </main>
    <footer>
        <?php include 'app/views/layouts/public/footer.php'; ?>
    </footer>
    <script src="/public/js/front.js"></script>
</body>

</html>