<!DOCTYPE html>
<html class="w-screen overflow-x-hidden" lang="fa-IR" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/public/assets/a-logo-EmGrkL-A.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $pagetitle . ' - ارزان بیمه'; ?></title>
    <meta name="description" content="<?php echo $description ?? 'خرید بیمه سلامت ویژه اقامت از شرکتهای معتبر ترکیه بصورت مستقیم و با تخفیف استثنایی'; ?>">
    <meta name="keywords" content="<?php echo $keywords ?? 'بیمه, اقامت, بیمه اقامت, sigorta'; ?>">

    <!-- Flag Icon CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/duotone/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" type="text/css" href="/public/css/front.css" />
</head>

<body class="text-vkl-t-normal font-anjoman bg-neutral-50 text-vkl-c-normal max-w-180 mx-auto overflow-x-hidden">
    <?php include 'app/views/layouts/public/header.php'; ?>
    <?php echo $content ?? ''; ?>
    <footer>
        <?php include 'app/views/layouts/public/footer.php'; ?>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script src="/public/js/front.js"></script>

</html>