<section class="flex justify-center items-end h-[22.5rem] tablet-medium:h-96 mobile-large:h-56 bg-bottom bg-hero-back bg-cover bg-no-repeat relative bg-fixed after:content-[''] after:h-full after:w-full after:bg-opacity-50 after:bg-neutral-600 after:absolute after:left-0 after:top-0 after:z-10">
    <img width="900" height="300" src="/public/assets/Picture-of-article-number1-BArSu-hn.webp" alt="عکس مقاله" class="grayscale object-cover absolute w-full h-full left-0 top-0 z-10" />
</section>

<section class="relative grid grid-cols-article mb-6 gap-x-6 tablet-medium:grid-cols-1 center-sec pt-15 tablet-medium:pt-13 mobile-large:pt-9">
    <div class="grid grid-cols-3 gap-3 mobile-medium:grid-cols-1 ">
        <?php foreach ($posts as $post) : ?>
            <div class="swiper-slide group flex justify-between overflow-hidden items-start flex-col border-2 border-vkl-bg-card border-solid shadow-button  rounded-xl">
                <div class="w-full h-fit article-item vakil-card grayscale group-hover:grayscale-0 group-hover:after:bg-transparent duration-200 ease-in transition-all after:duration-200 after:ease-in after:transition-all relative after:absolute after:w-full after:h-full after:left-0 after:top-0 after:bg-neutral-900 after:bg-opacity-50">
                    <img width="270" height="200" class=" h-48 tablet-medium:h-40 object-cover w-full border-solid border-b-2 border-vkl-bg-card" src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>">
                </div>
            </div>
            <div class="w-full text-vkl-c-header p-3 relative col-span-2">
                <h1 class="text-xl">
                    <a href="/post/<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a>
                </h1>
                <p><?php echo $post['caption']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <?php include 'app/views/partials/sidebar.php'; ?>
</section>