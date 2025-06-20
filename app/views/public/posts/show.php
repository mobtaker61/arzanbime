<?php
$pagetitle = $pagetitle;
$description = $post['caption'];
$keywords = $post['caption'];
?>

<section class="flex justify-center items-end h-[22.5rem] tablet-medium:h-96 mobile-large:h-56 bg-bottom bg-hero-back bg-cover bg-no-repeat relative bg-fixed after:content-[''] after:h-full after:w-full after:bg-opacity-50 after:bg-neutral-600 after:absolute after:left-0 after:top-0 after:z-10">
    <?php if (!empty($post['image'])) : ?>
        <img width="900" height="300" src="<?php echo $post['image']; ?>" alt="عکس مقاله" class="grayscale object-cover absolute w-full h-full left-0 top-0 z-10" />
    <?php else : ?>
        <img width="900" height="300" src="/public/assets/default-image.webp" alt="عکس مقاله" class="grayscale object-cover absolute w-full h-full left-0 top-0 z-10" />
    <?php endif; ?>
</section>

<section class="relative grid grid-cols-article gap-x-6 tablet-medium:grid-cols-1 center-sec pt-15 tablet-medium:pt-13 mobile-large:pt-9">
    <div>
        <div class="flex justify-start items-center text-vkl-c-header mobile-tiny:flex-col-reverse mobile-tiny:items-start">
            <h3 class="h3-bar"><?php echo $post['postType']; ?></h3>
        </div>
        <div>
            <h1 class="text-vkl-t-h3 text-vkl-c-header my-6 mt-0 tablet-medium:mb-5 mobile-large:mb-4 font-bold">
                <?= $post['title'] ?>
            </h1>
            <p class="hidden"><?= $post['caption'] ?></p>
            <div class="post-content">
                <?= $post['full_body'] ?>
            </div>
        </div>
    </div>
    <div>
        <?php if (!empty($post['image'])) : ?>
            <img width="auto" src="<?php echo $post['image']; ?>" alt="عکس مقاله" />
        <?php endif; ?>
        <?php include 'app/views/partials/sidebar.php'; ?>
    </div>
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