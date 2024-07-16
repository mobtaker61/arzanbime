<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <link rel="icon" type="image/svg+xml" href="/public/assets/ab-icon.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت - <?php echo $pagetitle; ?></title>
    <link rel="stylesheet" href="/public/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/public/adminlte/css/adminlte.rtl.min.css">
    <link rel="stylesheet" href="/public/css/custom.css">
    <!-- Include TinyMCE -->
    <script src="/public/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html-to-image/1.11.11/html-to-image.min.js" integrity="sha512-7tWCgq9tTYS/QkGVyKrtLpqAoMV9XIUxoou+sPUypsaZx56cYR/qio84fPK9EvJJtKvJEwt7vkn6je5UVzGevw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <?php include 'header.php'; ?>
        <?php
        // Check if the user is an admin or agent and include the appropriate sidebar
        if ($_SESSION['user_role'] === 'admin') {
            include 'sidebar.php';
        } elseif ($_SESSION['user_role'] === 'agent') {
            include 'app/views/layouts/agent/sidebar.php';
        }
        ?>
        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0"><?php echo $pagetitle; ?></h3>
                        </div>
                        <div class="col-sm-6">
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <?php include $viewPath; ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php include 'footer.php'; ?>
    </div>
    <script src="/public/adminlte/plugins/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script>
    <script src="/public/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/public/adminlte/js/adminlte.js"></script>
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
        const Default = {
            scrollbarTheme: "os-theme-light",
            scrollbarAutoHide: "leave",
            scrollbarClickScroll: true,
        };
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined") {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });

        function formatDateToDuration(date) {
            const now = new Date();
            const past = new Date(date);
            const diff = now - past;

            const minute = 60 * 1000;
            const hour = 60 * minute;
            const day = 24 * hour;
            const week = 7 * day;
            const month = 30 * day;
            const year = 365 * day;

            if (diff < hour) {
                const minutes = Math.floor((diff % hour) / minute);
                return `${minutes} دقیقه پیش`;
            } else if (diff < day) {
                const hours = Math.floor(diff / hour);
                const minutes = Math.floor((diff % hour) / minute);
                return `${hours} ساعت و ${minutes} دقیقه پیش`;
            } else if (diff < week) {
                const days = Math.floor(diff / day);
                return `${days} روز پیش`;
            } else if (diff < month) {
                const weeks = Math.floor(diff / week);
                return `${weeks} هفته پیش`;
            } else if (diff < year) {
                const months = Math.floor(diff / month);
                return `${months} ماه پیش`;
            } else {
                const years = Math.floor(diff / year);
                return `${years} سال`;
            } 
        }


        function updateDurations() {
            const dateElements = document.querySelectorAll('.dur_date');
            dateElements.forEach(function(el) {
                const date = el.innerText;
                el.innerText = formatDateToDuration(date);
            });
        }

        document.addEventListener('DOMContentLoaded', updateDurations);
    </script>
</body>

</html>