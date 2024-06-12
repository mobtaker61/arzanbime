<!DOCTYPE html>
<html class="w-screen overflow-x-hidden" lang="fa-IR" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="assets/a-logo-EmGrkL-A.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $pagetitle . ' - ارزان بیمه'; ?></title>
    <meta name="description" content="<?php echo $description ?? 'خرید بیمه سلامت ویژه اقامت از شرکتهای معتبر ترکیه بصورت مستقیم و با تخفیف استثنایی'; ?>">
    <meta name="keywords" content="<?php echo $keywords ?? 'بیمه, اقامت, بیمه اقامت, sigorta'; ?>">

    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/duotone/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" type="text/css" href="/public/css/front.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

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
</body>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="/public/js/front.js"></script>
</html>