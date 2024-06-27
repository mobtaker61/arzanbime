<?php
$pagetitle = $pagetitle ?? 'User Area';
$description = $description ?? '';
$keywords = $keywords ?? '';
?>
<!DOCTYPE html>
<html class="w-screen overflow-x-hidden" lang="fa-IR" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/public/assets/a-logo-EmGrkL-A.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $pagetitle . ' - ارزان بیمه'; ?></title>
    <meta name="description" content="<?php echo $description ?? 'خرید بیمه سلامت ویژه اقامت از شرکتهای معتبر ترکیه بصورت مستقیم و با تخفیف استثنایی'; ?>">
    <meta name="keywords" content="<?php echo $keywords ?? 'بیمه, اقامت, بیمه اقامت, sigorta'; ?>">

    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/duotone/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" type="text/css" href="/public/css/front.css" />    

</head>

<body class="text-vkl-t-normal font-anjoman bg-neutral-50 text-vkl-c-normal max-w-180 mx-auto overflow-x-hidden">
    <?php include 'app/views/layouts/public/header.php'; ?>
    <main class="pady center-sec flex justify-between items-center gap-6 mobile-large:gap-3 mobile-large:flex-col mobile-large:items-start">
        <div class="grid grid-cols-4 tablet-small:grid-cols-3 gap-6 mobile-large:flex-col mobile-large:items-start">
            <div>
                <?php include 'app/views/layouts/user/sidebar.php'; ?>
            </div>
            <div id="qa-text" class="col-span-3 tablet-small:col-span-2">
            <?php echo $content ?? ''; ?>
            </div>
        </div>
    </main>
    <footer>
        <?php include 'app/views/layouts/public/footer.php'; ?>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="/public/js/front.js"></script>

</html>