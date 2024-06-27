<section class="flex justify-center items-end h-[22.5rem] tablet-medium:h-96 mobile-large:h-56 bg-bottom bg-hero-back bg-cover bg-no-repeat relative bg-fixed after:content-[''] after:h-full after:w-full after:bg-opacity-50 after:bg-neutral-600 after:absolute after:left-0 after:top-0 after:z-10">
    <img width="900" height="300" src="/public/assets/Picture-of-article-number1-BArSu-hn.webp" alt="عکس مقاله" class="grayscale object-cover absolute w-full h-full left-0 top-0 z-10" />
</section>

<section class="relative grid grid-cols-article gap-x-6 tablet-medium:grid-cols-1 center-sec pt-15 tablet-medium:pt-13 mobile-medium:grid-cols-1 mobile-large:pt-9">
    <div class="gap-3">
        <div class="col-span-5 flex justify-between items-center">
            <h2 class="h3-bar mb-3"><?php echo $pagetitle; ?></h2>
            <div class="flex space-x-4">
                <a href="?order=DESC" class="text-xl <?php echo $order === 'DESC' ? 'text-red-500' : ''; ?>">
                    <i class="ph ph-arrow-down"></i>
                </a>
                <a href="?order=ASC" class="text-xl <?php echo $order === 'ASC' ? 'text-red-500' : ''; ?>">
                    <i class="ph ph-arrow-up"></i>
                </a>
            </div>
        </div>
        <div class="col-span-5 flex justify-between items-center">
            <ul id="qa-text" class="w-full">
                <?php foreach ($posts as $post) : ?>
                    <li class="mb-6 tablet-medium:mb-5 mobile-large:mb-4">
                        <button id="qa-button" class="p-4 tablet-medium:p-3 mobile-large:p-2 relative z-30 bg-neutral-200 text-vkl-c-header shadow-button rounded-xl tablet-medium:rounded-lg flex justify-between items-center w-full">
                            <h4 class="font-bold"><?php echo $post['title']; ?></h4>
                            <i class="ph ph-caret-down text-xl mobile-large:text-base"></i>
                        </button>
                        <textarea class="hidden h-0 opacity-0 relative z-10 w-full p-4 text-vkl-c-header rounded-xl shadow-button" readonly><?php echo $post['full_body']; ?></textarea>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php include 'app/views/partials/sidebar.php'; ?>
</section>