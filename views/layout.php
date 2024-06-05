<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'My Blog Site'; ?></title>
    <meta name="description" content="<?php echo $metaDescription ?? 'Default description for My Blog Site'; ?>">
    <meta name="keywords" content="<?php echo $metaKeywords ?? 'default, keywords, for, site'; ?>">
    <meta property="og:title" content="<?php echo $title ?? 'My Blog Site'; ?>">
    <meta property="og:description" content="<?php echo $metaDescription ?? 'Default description for My Blog Site'; ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:image" content="<?php echo $metaImage ?? 'default-image.jpg'; ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $title ?? 'My Blog Site'; ?>">
    <meta name="twitter:description" content="<?php echo $metaDescription ?? 'Default description for My Blog Site'; ?>">
    <meta name="twitter:image" content="<?php echo $metaImage ?? 'default-image.jpg'; ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
        .slick-slide img {
            width: 100%;
            object-fit: cover;
        }
        .slick-prev, .slick-next {
            z-index: 1;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="?route=home">My Blog Site</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="?route=home">Home</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="container">
        <?php include BASE_PATH . '/views/' . $view; ?>
    </main>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">&copy; 2024 My Blog Site</span>
        </div>
    </footer>
</body>
</html>
