<section class="flex justify-center items-end h-[22.5rem] tablet-medium:h-96 mobile-large:h-56 bg-bottom bg-hero-back bg-cover bg-no-repeat relative bg-fixed after:content-[''] after:h-full after:w-full after:bg-opacity-50 after:bg-neutral-600 after:absolute after:left-0 after:top-0 after:z-10">
    <img width="900" height="300" src="/public/assets/Picture-of-article-number1-BArSu-hn.webp" alt="عکس مقاله" class="grayscale object-cover absolute w-full h-full left-0 top-0 z-10" />
</section>

<section class="relative grid grid-cols-article mb-6 gap-x-6 tablet-medium:grid-cols-1 center-sec pt-15 tablet-medium:pt-13 mobile-medium:grid-cols-1 mobile-large:pt-9">
    <div class="grid grid-cols-6 gap-3">
        <div class="col-span-6 flex justify-between items-center">
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
        <?php foreach ($posts as $post) : ?>
            <div class="bg-white border rounded-lg shadow-lg p-3 text-center date-box" dir="ltr">
                <?php
                $created_at = new DateTime($post['created_at']);
                $day = $created_at->format('d');
                $month = strtoupper($created_at->format('M'));
                $year = $created_at->format('Y');
                ?>                
                <p class="text-xl font-bold day"><?php echo $day . ' ' . $month; ?></p>
                <p class="text-xs year"><?php echo $year; ?></p>
                </div>
            <div class="col-span-5">
                <h1 class="text-xl bg-red-200 p-1">
                    <a href="/post/<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a>
                </h1>
                <p><?php echo $post['caption']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <?php include 'app/views/partials/sidebar.php'; ?>
</section>        