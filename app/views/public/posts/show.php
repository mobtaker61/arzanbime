<?php
// SEO Meta Tags
$pagetitle = $post['title'] . ' - ' . $post['postType'] . ' | ارزان بیمه';
$description = !empty($post['caption']) ? $post['caption'] : substr(strip_tags($post['full_body']), 0, 160);
$keywords = $post['title'] . ', ' . $post['postType'] . ', بیمه, ترکیه, اقامت, ارزان, sigorta';

// Generate keywords from content
$content_words = strip_tags($post['full_body']);
$words = explode(' ', $content_words);
$common_words = ['در', 'به', 'از', 'که', 'این', 'با', 'برای', 'یا', 'و', 'را', 'است', 'شود', 'می', 'های', 'های', 'آن', 'آنها', 'خود', 'خودش', 'خودشان'];
$keywords_array = array_diff($words, $common_words);
$keywords_array = array_slice($keywords_array, 0, 10);
$keywords .= ', ' . implode(', ', $keywords_array);

// Open Graph Meta Tags
$og_title = $post['title'];
$og_description = $description;
$og_image = !empty($post['image']) ? 'https://' . $_SERVER['HTTP_HOST'] . $post['image'] : 'https://' . $_SERVER['HTTP_HOST'] . '/public/assets/default-image.webp';
$og_url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// Twitter Card Meta Tags
$twitter_card = 'summary_large_image';
$twitter_site = '@arzanbime';
$twitter_creator = '@arzanbime';

// Reading time calculation
$word_count = str_word_count(strip_tags($post['full_body']));
$reading_time = ceil($word_count / 200); // Assuming 200 words per minute

// Breadcrumb Data
$breadcrumbs = [
    ["name" => "خانه", "url" => "/"],
    ["name" => $post['postType'], "url" => "/" . strtolower($post['postType'])],
    ["name" => $post['title'], "url" => $_SERVER['REQUEST_URI']]
];
?>

<!-- Schema.org Structured Data -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "<?php echo addslashes($post['title']); ?>",
    "description": "<?php echo addslashes($description); ?>",
    "image": "<?php echo $og_image; ?>",
    "author": {
        "@type": "Organization",
        "name": "ارزان بیمه"
    },
    "publisher": {
        "@type": "Organization",
        "name": "ارزان بیمه",
        "logo": {
            "@type": "ImageObject",
            "url": "https://<?php echo $_SERVER['HTTP_HOST']; ?>/public/assets/ab-icon.png"
        }
    },
    "datePublished": "<?php echo $post['created_at'] ?? date('Y-m-d'); ?>",
    "dateModified": "<?php echo $post['updated_at'] ?? date('Y-m-d'); ?>",
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "<?php echo $og_url; ?>"
    }
}
</script>

<!-- Breadcrumb Schema -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        <?php foreach ($breadcrumbs as $index => $crumb): ?>
        {
            "@type": "ListItem",
            "position": <?php echo $index + 1; ?>,
            "name": "<?php echo addslashes($crumb['name']); ?>",
            "item": "https://<?php echo $_SERVER['HTTP_HOST']; ?><?php echo $crumb['url']; ?>"
        }<?php echo ($index < count($breadcrumbs) - 1) ? ',' : ''; ?>
        <?php endforeach; ?>
    ]
}
</script>

<section class="flex justify-center items-end h-[22.5rem] tablet-medium:h-96 mobile-large:h-56 bg-bottom bg-hero-back bg-cover bg-no-repeat relative bg-fixed after:content-[''] after:h-full after:w-full after:bg-opacity-50 after:bg-neutral-600 after:absolute after:left-0 after:top-0 after:z-10">
    <?php if (!empty($post['image'])) : ?>
        <img width="900" height="300" src="<?php echo $post['image']; ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="grayscale object-cover absolute w-full h-full left-0 top-0 z-10" loading="lazy" />
    <?php else : ?>
        <img width="900" height="300" src="/public/assets/default-image.webp" alt="<?php echo htmlspecialchars($post['title']); ?>" class="grayscale object-cover absolute w-full h-full left-0 top-0 z-10" loading="lazy" />
    <?php endif; ?>
    
    <!-- Breadcrumb Navigation -->
    <div class="absolute top-4 right-4 z-20">
        <nav aria-label="Breadcrumb" class="bg-white bg-opacity-90 rounded-lg px-3 py-2">
            <ol class="flex items-center space-x-2 space-x-reverse text-sm">
                <?php foreach ($breadcrumbs as $index => $crumb): ?>
                    <li class="flex items-center">
                        <?php if ($index > 0): ?>
                            <span class="mx-2 text-gray-400">/</span>
                        <?php endif; ?>
                        <?php if ($index < count($breadcrumbs) - 1): ?>
                            <a href="<?php echo $crumb['url']; ?>" class="text-blue-600 hover:text-blue-800 transition-colors">
                                <?php echo $crumb['name']; ?>
                            </a>
                        <?php else: ?>
                            <span class="text-gray-700 font-medium"><?php echo $crumb['name']; ?></span>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ol>
        </nav>
    </div>
</section>

<section class="relative grid grid-cols-article gap-x-6 tablet-medium:grid-cols-1 center-sec pt-15 tablet-medium:pt-13 mobile-large:pt-9">
    <article class="post-article">
        <!-- Article Header -->
        <header class="mb-8">
            <div class="flex justify-start items-center text-vkl-c-header mobile-tiny:flex-col-reverse mobile-tiny:items-start mb-4">
                <span class="h3-bar bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                    <?php echo $post['postType']; ?>
                </span>
            </div>
            
            <h1 class="text-vkl-t-h3 text-vkl-c-header my-6 mt-0 tablet-medium:mb-5 mobile-large:mb-4 font-bold leading-tight">
                <?= htmlspecialchars($post['title']) ?>
            </h1>
            
            <!-- Article Meta -->
            <div class="flex items-center justify-between text-sm text-gray-600 mb-6">
                <div class="flex items-center space-x-4 space-x-reverse">
                    <span class="flex items-center">
                        <i class="ph ph-clock mr-1"></i>
                        زمان مطالعه: <?php echo $reading_time; ?> دقیقه
                    </span>
                    <span class="flex items-center">
                        <i class="ph ph-calendar mr-1"></i>
                        <?php echo date('j F Y', strtotime($post['created_at'] ?? 'now')); ?>
                    </span>
                </div>
                
                <!-- Social Share Buttons -->
                <div class="flex items-center space-x-2 space-x-reverse">
                    <button onclick="shareOnTelegram()" class="text-blue-500 hover:text-blue-700 transition-colors" title="اشتراک در تلگرام">
                        <i class="ph ph-telegram-logo text-xl"></i>
                    </button>
                    <button onclick="shareOnWhatsApp()" class="text-green-500 hover:text-green-700 transition-colors" title="اشتراک در واتساپ">
                        <i class="ph ph-whatsapp-logo text-xl"></i>
                    </button>
                    <button onclick="shareOnTwitter()" class="text-blue-400 hover:text-blue-600 transition-colors" title="اشتراک در توییتر">
                        <i class="ph ph-twitter-logo text-xl"></i>
                    </button>
                </div>
            </div>
            
            <?php if (!empty($post['caption'])): ?>
                <div class="bg-gray-50 border-r-4 border-blue-500 p-4 mb-6">
                    <p class="text-gray-700 italic leading-relaxed">
                        <?= htmlspecialchars($post['caption']) ?>
                    </p>
                </div>
            <?php endif; ?>
        </header>
        
        <!-- Article Content -->
        <div class="post-content prose prose-lg max-w-none">
            <?= $post['full_body'] ?>
        </div>
        
        <!-- Article Footer -->
        <footer class="mt-8 pt-6 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-600">
                    <span>آخرین به‌روزرسانی: <?php echo date('j F Y', strtotime($post['updated_at'] ?? $post['created_at'] ?? 'now')); ?></span>
                </div>
                <div class="flex items-center space-x-4 space-x-reverse">
                    <button onclick="window.print()" class="text-gray-600 hover:text-gray-800 transition-colors" title="چاپ مقاله">
                        <i class="ph ph-printer text-xl"></i>
                    </button>
                    <button onclick="copyToClipboard()" class="text-gray-600 hover:text-gray-800 transition-colors" title="کپی لینک">
                        <i class="ph ph-link text-xl"></i>
                    </button>
                </div>
            </div>
        </footer>
    </article>
    
    <!-- Sidebar -->
    <aside class="sidebar">
        <?php if (!empty($post['image'])) : ?>
            <div class="mb-6">
                <img width="400" height="300" src="<?php echo $post['image']; ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="w-full h-auto rounded-lg shadow-md" loading="lazy" />
            </div>
        <?php endif; ?>
        <?php include 'app/views/partials/sidebar.php'; ?>
    </aside>
</section>
<!-- برچسب ها و نظرات -->
<section class="center-sec mt-24 mb-28 tablet-medium:mb-24 tablet-medium:mt-16 mobile-large:mt-12 mobile-large:mb-16">
    <div class="flex items-center justify-between pb-3 border-solid border-neutral-400 border-b-2">
        <div class="flex justify-between items-center [&_a:last-child]:ml-0">
            <h2 class="text-vkl-c-header font-bold">برچسب‌ها:</h2>
            <a class="bg-neutral-200 text-vkl-t-sub rounded-full px-2 py-1 mx-6 tablet-medium:mx-3 mobile-tiny:mx-1" href="">بیمه</a>
        </div>
        <div class="flex justify-center items-center">
            <button>
                <i class="ph ph-share-network text-xl mobile-tiny:text-base"></i>
            </button>
            <span class="flex justify-center items-center mr-3 tablet-medium:mr-2 mobile-tiny:mr-1">
                <span> ۵ </span>
                <i class="ph ph-chat-text text-xl mobile-tiny:text-base"></i>
            </span>
        </div>
    </div>

    <div> <!-- نظرات -->
        <h2 class="mt-9 mb-6 h3-bar">نظرات</h2>
        <div>
            <div class="flex items-center justify-between bg-neutral-200 rounded-md">
                <div class="grid grid-cols-2 gap-x-3 mobile-large:gap-x-1 min-h-12">
                    <img width="48" height="48" class="object-cover rounded-md" src="./assets/Picture-of-client-number4-De1Da4Hu.jpg" alt="آواتار کاربر" />
                    <h3 class="flex items-center">فائزه موسوی</h3>
                </div>
                <div>
                    <span class="after:content-[ | ] after:h-5/6 after:border-solid after:border-r-2 mobile-large:after:border-l-2 mobile-large:before:border-l-2 after:border-vkl-c-highlight after:mx-1">
                        24 فروردین 1402
                    </span>
                    <span class="ml-5 tablet-medium:ml-4 mobile-large:ml-3">13:28</span>
                </div>
            </div>
            <p class="text-justify mt-3 mb-9 tablet-medium:mb-6">
                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با
                استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در
                ستون و سطرآنچنان که لازم است،
            </p>
        </div>
        <div>
            <div class="flex items-center justify-between bg-neutral-200 rounded-md">
                <div class="grid grid-cols-2 gap-x-3 mobile-large:gap-x-1 min-h-12">
                    <img width="48" height="48" class="object-cover rounded-md" src="./assets/Picture-of-client-number4-De1Da4Hu.jpg" alt="آواتار کاربر" />
                    <h3 class="flex items-center">فائزه موسوی</h3>
                </div>
                <div>
                    <span class="after:content-[ | ] after:h-5/6 after:border-solid after:border-r-2 mobile-large:after:border-l-2 mobile-large:before:border-l-2 after:border-vkl-c-highlight after:mx-1">
                        24 فروردین 1402
                    </span>
                    <span class="ml-5 tablet-medium:ml-4 mobile-large:ml-3">13:28</span>
                </div>
            </div>
            <p class="text-justify mt-3 mb-9 tablet-medium:mb-6">
                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با
                استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در
                ستون و سطرآنچنان که لازم است،
            </p>
        </div>
        <!-- فرم دیدگاه -->
        <div class="mt-12 mb-28 tablet-medium:mt-10 tablet-medium:mb-24 mobile-large:mt-6 mobile-large:mb-16">
            <h2 class="mt-9 mb-6 h3-bar">دیدگاهتان را بنویسید</h2>
            <form action="">
                <div class="grid grid-cols-3 gap-x-6 gap-y-6 mobile-large:gap-y-3 mobile-large:grid-cols-1">
                    <input type="text" id="name" name="name" placeholder="نام و نام خانوادگی" class="placeholder:text-vkl-t-normal outline-0 py-3 px-4 bg-transparent rounded-lg tablet-medium:rounded-lg border-1 border-solid border-neutral-400" />
                    <input type="tel" id="cell" name="cell" placeholder="شماره همراه" class="placeholder:text-vkl-t-normal placeholder:text-right outline-0 py-3 px-4 bg-transparent rounded-lg tablet-medium:rounded-lg border-1 border-solid border-neutral-400" />
                    <input type="text" id="email" name="email" placeholder="ایمیل" class="placeholder:text-vkl-t-normal outline-0 py-3 px-4 bg-transparent rounded-lg tablet-medium:rounded-lg border-1 border-solid border-neutral-400" />
                    <textarea name="message" id="message" cols="50" rows="10" class="col-span-3 mobile-large:col-span-1 placeholder:text-vkl-t-normal outline-0 py-1 px-4 bg-transparent resize-none rounded-lg tablet-medium:rounded-lg border-1 border-solid border-neutral-400" placeholder="متن پیام شما"></textarea>
                </div>
                <div class="mt-3 flex items-center justify-end mobile-large:flex-col mobile-large:justify-start mobile-large:items-end">
                    <button class="pri-btn bg-red-700 px-13 mobile-large:px-10">
                        ارسال پیام
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Social Sharing JavaScript -->
<script>
function shareOnTelegram() {
    const url = encodeURIComponent(window.location.href);
    const text = encodeURIComponent('<?php echo addslashes($post['title']); ?>');
    window.open(`https://t.me/share/url?url=${url}&text=${text}`, '_blank');
}

function shareOnWhatsApp() {
    const url = encodeURIComponent(window.location.href);
    const text = encodeURIComponent('<?php echo addslashes($post['title']); ?>');
    window.open(`https://wa.me/?text=${text}%20${url}`, '_blank');
}

function shareOnTwitter() {
    const url = encodeURIComponent(window.location.href);
    const text = encodeURIComponent('<?php echo addslashes($post['title']); ?>');
    window.open(`https://twitter.com/intent/tweet?text=${text}&url=${url}`, '_blank');
}

function copyToClipboard() {
    navigator.clipboard.writeText(window.location.href).then(function() {
        // Show success message
        const button = event.target.closest('button');
        const originalHTML = button.innerHTML;
        button.innerHTML = '<i class="ph ph-check text-xl"></i>';
        button.classList.add('text-green-600');
        
        setTimeout(() => {
            button.innerHTML = originalHTML;
            button.classList.remove('text-green-600');
        }, 2000);
    });
}
</script>

<!-- Additional CSS for better content styling -->
<style>
.post-content {
    line-height: 1.8;
    font-size: 1.1rem;
}

.post-content h1, .post-content h2, .post-content h3, .post-content h4, .post-content h5, .post-content h6 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    font-weight: bold;
    color: #1f2937;
}

.post-content h1 { font-size: 2rem; }
.post-content h2 { font-size: 1.75rem; }
.post-content h3 { font-size: 1.5rem; }
.post-content h4 { font-size: 1.25rem; }
.post-content h5 { font-size: 1.1rem; }
.post-content h6 { font-size: 1rem; }

.post-content p {
    margin-bottom: 1.5rem;
    text-align: justify;
}

.post-content ul, .post-content ol {
    margin-bottom: 1.5rem;
    padding-right: 2rem;
}

.post-content li {
    margin-bottom: 0.5rem;
}

.post-content blockquote {
    border-right: 4px solid #3b82f6;
    padding: 1rem;
    margin: 1.5rem 0;
    background-color: #f8fafc;
    font-style: italic;
}

.post-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1.5rem 0;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.post-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 1.5rem 0;
}

.post-content th, .post-content td {
    border: 1px solid #e5e7eb;
    padding: 0.75rem;
    text-align: right;
}

.post-content th {
    background-color: #f9fafb;
    font-weight: bold;
}

.post-content tr:hover {
    background-color: #f3f4f6;
}

.post-content a {
    color: #3b82f6;
    text-decoration: none;
    transition: color 0.2s ease;
}

.post-content a:hover {
    color: #1d4ed8;
    text-decoration: underline;
}

.post-content strong {
    font-weight: 700;
    color: #1f2937;
}

.post-content em {
    font-style: italic;
    color: #4b5563;
}

.post-content u {
    text-decoration: underline;
    text-decoration-color: #3b82f6;
}

@media print {
    .sidebar, .breadcrumb, .social-share, .comments-section {
        display: none !important;
    }
    
    .post-content {
        font-size: 12pt;
        line-height: 1.6;
    }
}
</style>