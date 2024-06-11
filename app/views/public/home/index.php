<?php
$pagetitle = "خانه";
$description = "این صفحه اصلی وبلاگ است که آخرین پست ها و اخبار را نمایش می دهد.";
$keywords = "صفحه اصلی, وبلاگ, اخبار, پست ها";
?>


<section class="pady center-sec flex justify-between items-center gap-6 mobile-large:gap-3 mobile-large:flex-col mobile-large:items-start">
    <div>
        <h2 class="h3-bar">بیمه ویژه اقامت 2024</h2>
        <ul class="[&_li_a]:inline-block [&_li_a]:text-vkl-t-sub-header [&_li_a]:pt-5 tablet-medium:[&_li_a]:pt-3 [&_li:first-child_a]:pt-0">
            <li>
                <a href="">مورد ویژه شماره اول همراه با توضیحات کامل مربوطه</a>
            </li>
            <li>
                <a href="">مورد ویژه شماره اول همراه با توضیحات کامل مربوطه</a>
            </li>
            <li>
                <a href="">مورد ویژه شماره اول همراه با توضیحات کامل مربوطه</a>
            </li>
            <li>
                <a href="">مورد ویژه شماره اول همراه با توضیحات کامل مربوطه</a>
            </li>
            <li>
                <a href="">مورد ویژه شماره اول همراه با توضیحات کامل مربوطه</a>
            </li>
        </ul>
    </div>
    <div class="w-1/2 mobile-large:w-full mobile-large:mt-3">
        <h2 class="text-vkl-t-sub-header font-bold text-vkl-c-header mr-auto w-fit mb-5 mobile-large:h3-bar">
            استعلام
        </h2>
        <form class="grid-cols-2 grid gap-6 mobile-large:gap-3 placeholder:text-vkl-c-normal">
            <input class="input placeholder:text-vkl-c-normal" type="date" name="birth" dir="ltr" placeholder="تاریخ تولد*" value="2000-01-01" />
            <input class="input placeholder:text-vkl-c-normal" type="text" placeholder="سن*" name="age" inputmode="numeric" maxlength="3" />
            <div class="input col-span-2 grid-cols-2 grid gap-6 mobile-large:gap-3">
                <label>مدت بیمه پردازی*</label>
                <span class="gap-6 flex mobile-large:gap-3 mobile-small:mr-auto">
                    <span>
                        <input value="1" type="radio" name="length" />
                        <span>یک سال</span>
                    </span>
                    <span>
                        <input value="2" type="radio" name="length" />
                        <span>دوسال</span>
                    </span>
                </span>
            </div>
            <button class="pri-btn col-span-2 mobile-medium:py-2">استعلام قیمت</button>
        </form>
    </div>
</section>

<section class=" center-sec">
    <div class=" mx-auto text-start">
        <div class="flex justify-between w-full">
            <h2 class="h3-bar mb-3">شرکت‌های بیمه</h2>
            <div class="flex gap-2 h-fit">
                <button class="card-scroll-1 swiper-button-prev transition-colors ease-in duration-200 hover:bg-red-700 hover:text-neutral-50 tablet-medium:block rounded-md p-1 pb-[0.0625rem] mobile-medium:p-[0.0625rem] items-center bg-neutral-300">
                    <i class="ph ph-caret-right text-xl"></i>
                </button>
                <button class="card-scroll-2 swiper-button-next hover:bg-red-700 hover:text-neutral-50 transition-colors ease-in duration-200 tablet-medium:block rounded-md p-1 pb-[0.0625rem] mobile-medium:p-[0.0625rem] items-center bg-neutral-300">
                    <i class="ph ph-caret-left text-xl"></i>
                </button>
            </div>
        </div>
        <div class="swiper companies-slider mt-6 tablet-medium:mt-5">

            <ul class="swiper-wrapper flex">
                <li id="sigorta" class="swiper-slide company-card cursor-pointer mb-3 active-company-card ">
                    <img class="  w-full " width="280" height="136" src="/public/assets/ANKARA-Ba1QrTkf.png" alt="ANKARA" />
                </li>
                <li id="nippon" class="swiper-slide company-card cursor-pointer mb-3 ">
                    <img class=" w-full" width="280" height="136" src="/public/assets/NIPPON-CjjsF_BF.png" alt="NIPPON" />
                </li>
                <li id="sompo" class="swiper-slide company-card cursor-pointer mb-3 ">
                    <img class="  w-full " width="280" height="136" src="/public/assets/SOMPO-CeE7o_g6.png" alt="SOMPO" />
                </li>
                <li id="demir" class="swiper-slide company-card cursor-pointer mb-3 ">
                    <img class="   w-full" width="280" height="136" src="/public/assets/DEMIR-DU3OymPX.png" alt="DEMIR" />
                </li>
                <li id="sompo" class="swiper-slide company-card cursor-pointer mb-3 ">
                    <img class="  w-full " width="280" height="136" src="/public/assets/SOMPO-CeE7o_g6.png" alt="SOMPO" />
                </li>
                <li id="nippon" class="swiper-slide company-card cursor-pointer mb-3 ">
                    <img class=" w-full" width="280" height="136" src="/public/assets/NIPPON-CjjsF_BF.png" alt="NIPPON" />
                </li>
            </ul>
        </div>
        <div class="swiper-pagination"></div>
</section>

<section id="company-card-detail" class="p-6 mobile-large:p-3 pady mt-6 tablet-medium:mt-5 overflow-hidden bg-red-200 rounded-3xl tablet-medium:rounded-2xl mobile-large:rounded-xl center-sec grid grid-cols-2 tablet-small:grid-cols-1 gap-6 mobile-large:gap-3 mobile-medium:gap-6 mobile-large:flex-col mobile-large:items-start">
    <div class="flex justify-start items-start tablet-small:items-center flex-col">
        <h1 class="text-vkl-t-h2 font-bold text-red-950">
            شرکت ANKARA SIGORTA
        </h1>
        <p class="mt-6 mobile-medium:mt-3 text-justify  tablet-small:pb-4">
            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با
            استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در
            ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و
            کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی
            در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می
            طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی
            الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این
            صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و
            شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای
            اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده
            قرار گیرد.
        </p>
        <div class="mt-auto flex justify-start items-center tablet-small:justify-center gap-4 w-full text-vkl-c-header">
            <p>لیست مراکز درمانی طرف قرارداد</p>
            <button class="pri-btn">دانلود لیست</button>
        </div>
    </div>
    <div id="assurance-table" dir="ltr" class="relative overflow-hidden">
        <table class="table-auto w-full text-left" aria-readonly="true">
            <thead class="bg-red-950 text-neutral-50 font-bold">
                <tr>
                    <td class="py-2 border border-red-100 text-center p-4">
                        دوساله
                    </td>
                    <td class="py-2 border border-red-100 text-center p-4">
                        سال دوم
                        <br />
                    </td>
                    <td class="py-2 border border-red-100 text-center p-4">
                        سال اول
                        <br />
                    </td>
                    <td class="py-2 border border-red-100 text-center p-4">
                        <div>
                            رده سنی&nbsp;&nbsp;&nbsp;
                            <br />
                        </div>
                    </td>
                </tr>
            </thead>
            <tbody class="bg-transparent">
                <tr class="">
                    <td class="border border-red-100 text-center py-2">
                        8,265
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        5,175
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        3,450
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        0 تا 15
                        <br />
                    </td>
                </tr>
                <tr class="">
                    <td class="border border-red-100 text-center py-2">
                        3,450
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        3,450
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        3,450
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        16 تا 25
                        <br />
                    </td>
                </tr>
                <tr class="">
                    <td class="border border-red-100 text-center py-2">
                        3,450
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        3,450
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        3,450
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        26 تا 35
                        <br />
                    </td>
                </tr>
                <tr class="">
                    <td class="border border-red-100 text-center py-2">
                        3,450
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        3,450
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        3,450
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        36 تا45
                        <br />
                    </td>
                </tr>
                <tr class="">
                    <td class="border border-red-100 text-center py-2">
                        3,450
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        3,450
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        3,450
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        46 تا 50
                        <br />
                    </td>
                </tr>
                <tr class="">
                    <td class="border border-red-100 text-center py-2">
                        3,450
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        3,450
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        3,450
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        51 تا 55
                        <br />
                    </td>
                </tr>
                <tr class="">
                    <td class="border border-red-100 text-center py-2">
                        3,450
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        3,450
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        3,450
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        56 تا 60
                        <br />
                    </td>
                </tr>
                <tr class="">
                    <td class="border border-red-100 text-center py-2">
                        3,450
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        3,450
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        3,450
                    </td>
                    <td class="border border-red-100 text-center py-2">
                        61 تا 65
                        <br />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<section class="pady center-sec">
    <h3 class="h3-bar mb-6">سوالات متداول</h3>
    <div class="grid grid-cols-2 tablet-small:grid-cols-1 gap-6 tablet-small:gap-0 mobile-medium:gap-0 mobile-large:flex-col mobile-large:items-start">
    <ul id="qa-text">
                <li class="mb-6 tablet-medium:mb-5 mobile-large:mb-4">
                    <button id="qa-button" class="p-4 tablet-medium:p-3 mobile-large:p-2 relative z-30 bg-neutral-200 text-vkl-c-header shadow-button rounded-xl tablet-medium:rounded-lg flex justify-between items-center w-full">
                        <i class="ph ph-caret-down text-xl mobile-large:text-base"></i>
                    </button>
                    <p class="h-0 opacity-0 relative z-10">
                    </p>
                </li>
        </ul>
    <ul id="qa-text">
            <?php foreach ($faqs as $post) : ?>
                <li class="mb-6 tablet-medium:mb-5 mobile-large:mb-4">
                    <button id="qa-button" class="p-4 tablet-medium:p-3 mobile-large:p-2 relative z-30 bg-neutral-200 text-vkl-c-header shadow-button rounded-xl tablet-medium:rounded-lg flex justify-between items-center w-full">
                        <h4 class="font-bold"><?php echo $post['title']; ?></h4>
                        <i class="ph ph-caret-down text-xl mobile-large:text-base"></i>
                    </button>
                    <p class="h-0 opacity-0 relative z-10">
                        <?php echo $post['caption']; ?>
                    </p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<section class="pady center-sec mt-0">
    <h3 class="h3-bar mb-2">هدیه ویژه ارزان بیمه</h3>
    <p class="text-vkl-c-header mb-9 tablet-large:mb-6 mobile-large:mb-8">
        با استفاده از کد اختصاصی خود، دوستانتان را معرفی کنید و هدیه بگیرید.
    </p>
    <div class="flex justify-between items-center tablet-large:flex-col">
        <div class="rounded-lg border border-gray-400 p-2 pb-1 flex justify-between items-center gap-2 overflow-hidden mobile-medium:overflow-scroll max-h-10 mobile-medium:max-w-full">
            <p id="copy-text" dir="ltr">
                https://www.karlancer.com/projects/%D8%AA%D8%A8%D8%AF%DB%8C%D9%84-%D
            </p>
            <button id="copy-btn" class="p-0 mobile-medium:hidden">
                <i class="ph ph-copy text-xl"></i>
            </button>
        </div>
        <span class="text-red-700 tablet-large:my-8 tablet-large:font-bold tablet-large:text-vkl-t-sub-header">یا</span>
        <div class="flex justify-end items-center gap-6 mobile-medium:gap-3">
            <span><i class="ph-duotone ph-at text-3xl mobile-medium:text-xl"></i></span>
            <span class="text-red-700 text-xl">|</span>
            <span><i class="ph-duotone ph-telegram-logo text-3xl mobile-medium:text-xl"></i></span>
            <span class="text-red-700 text-xl">|</span>
            <span><i class="ph-duotone ph-twitter-logo text-3xl mobile-medium:text-xl"></i></span>
            <span class="text-red-700 text-xl">|</span>
            <span><i class="ph-duotone ph-instagram-logo text-3xl mobile-medium:text-xl"></i></span>
            <span class="text-red-700 text-xl">|</span>
            <span><i class="ph-duotone ph-whatsapp-logo text-3xl mobile-medium:text-xl"></i></span>
            <span class="text-red-700 text-xl">|</span>
            <span><i class="ph-duotone ph-chats text-3xl mobile-medium:text-xl"></i></span>
        </div>
    </div>
</section>

<section class="pady center-sec">
    <h3 class="h3-bar mb-6">اطلاعیه های مهم</h3>
    <div class="grid grid-cols-3 tablet-small:grid-cols-1 gap-6 mobile-large:flex-col mobile-large:items-start">
        <img width="380" height="300" alt="مرد کنار زمین" src="/public/assets/a-vector-globe-GME6DF1B.png" />
        <ul id="qa-text" class="col-span-2 tablet-small:col-span-1">
            <li class="mb-6 tablet-medium:mb-5 mobile-large:mb-4">
                <button class="p-4 tablet-medium:p-3 mobile-large:p-2 relative z-30 bg-neutral-200 text-vkl-c-header shadow-button rounded-xl tablet-medium:rounded-lg flex justify-between items-center w-full">
                    <h4 class="font-bold">چگونه مشاوره تلفنی رایگان بگیرم ؟</h4>
                    <i class="ph ph-eye text-xl mobile-large:text-base"></i>
                </button>
                <p class="h-0 opacity-0 relative z-10">
                    برای دریافت مشاوره تلفنی وارد سایت ارزان بیمه شوید و با انتخاب دکمه
                    درخواست مشاوره رایگان و تکمیل فرم درخواست اعم از شماره موبایل، نام
                    نام خانوادگی و ... درخواست شما ثبت خواهد شد.
                </p>
            </li>
            <li class="mb-6 tablet-medium:mb-5 mobile-large:mb-4">
                <button class="p-4 tablet-medium:p-3 mobile-large:p-2 relative z-30 bg-neutral-200 text-vkl-c-header shadow-button rounded-xl tablet-medium:rounded-lg flex justify-between items-center w-full">
                    <h4 class="font-bold">چگونه مشاوره تلفنی رایگان بگیرم ؟</h4>
                    <i class="ph ph-eye text-xl mobile-large:text-base"></i>
                </button>
                <p class="h-0 opacity-0 relative z-10">
                    برای دریافت مشاوره تلفنی وارد سایت ارزان بیمه شوید و با انتخاب دکمه
                    درخواست مشاوره رایگان و تکمیل فرم درخواست اعم از شماره موبایل، نام
                    نام خانوادگی و ... درخواست شما ثبت خواهد شد.
                </p>
            </li>
            <li class="mb-6 tablet-medium:mb-5 mobile-large:mb-4">
                <button class="p-4 tablet-medium:p-3 mobile-large:p-2 relative z-30 bg-neutral-200 text-vkl-c-header shadow-button rounded-xl tablet-medium:rounded-lg flex justify-between items-center w-full">
                    <h4 class="font-bold">چگونه مشاوره تلفنی رایگان بگیرم ؟</h4>
                    <i class="ph ph-eye text-xl mobile-large:text-base"></i>
                </button>
                <p class="h-0 opacity-0 relative z-10">
                    برای دریافت مشاوره تلفنی وارد سایت ارزان بیمه شوید و با انتخاب دکمه
                    درخواست مشاوره رایگان و تکمیل فرم درخواست اعم از شماره موبایل، نام
                    نام خانوادگی و ... درخواست شما ثبت خواهد شد.
                </p>
            </li>
            <li class="mb-6 tablet-medium:mb-5 mobile-large:mb-4">
                <button class="p-4 tablet-medium:p-3 mobile-large:p-2 relative z-30 bg-neutral-200 text-vkl-c-header shadow-button rounded-xl tablet-medium:rounded-lg flex justify-between items-center w-full">
                    <h4 class="font-bold">چگونه مشاوره تلفنی رایگان بگیرم ؟</h4>
                    <i class="ph ph-eye text-xl mobile-large:text-base"></i>
                </button>
                <p class="h-0 opacity-0 relative z-10">
                    برای دریافت مشاوره تلفنی وارد سایت ارزان بیمه شوید و با انتخاب دکمه
                    درخواست مشاوره رایگان و تکمیل فرم درخواست اعم از شماره موبایل، نام
                    نام خانوادگی و ... درخواست شما ثبت خواهد شد.
                </p>
            </li>
        </ul>
    </div>
</section>

<section dir="ltr" class="relative outline-none pady mt-0 mb-0">
    <div id="map" class="h-556 tablet-medium:h-128 mobile-large:h-556 w-full relative z-0"></div>
    <div class="pointer-events-none absolute right-0 top-0 z-10 w-full h-full duration-200 ease-in transition-all map-message-bg">
        <div class="center-sec flex flex-col justify-center tablet-small:justify-start tablet-small:pt-5 mobile-medium:justify-between mobile-medium:py-6 items-start h-full relative">
            <div class="map-message-para tablet-medium:hidden z-10 absolute w-full h-full left-0 top-0 flex justify-center items-center text-neutral-50 text-vkl-t-sub-header">
                <p>
                    برای فعال کردن نقشه، کلید
                    <span class="py-1 mx-2 px-3 text-vkl-t-h3 font-bold border-neutral-50 border-2 border-solid rounded-md">M</span>
                    را نگه دارید و بر روی نقشه کلیک کنید.
                </p>
            </div>

            <div class="flex justify-center items-start mobile-medium:items-center  gap-6 mobile-medium:gap-3 flex-col text-neutral-200 min-w-fit mb-6 mobile-medium:mb-0 w-45% mobile-medium:w-fit mobile-medium:mx-auto">
                <select id="map-btn" class="bg-neutral-950 border-1  hover:bg-red-700 hover:text-neutral-50  border-red-700 py-1 px-3 rounded-lg pointer-events-auto ">
                    <option value="استانبول">Istanbul Offices</option>
                    <option value="تهران">Tehran Offices</option>
                </select>
                <div id="map-buttons" class="gap-3 justify-center items-center flex flex-wrap">
                    <button id="istanbul1" class="active-office-btn office-btn pointer-events-auto pri-btn text-vkl-t-sub font-normal rounded-md bg-neutral-950 border-1  border-red-700  hover:bg-red-700 hover:text-neutral-50">
                        Istanbul 1
                    </button>
                    <button id="istanbul2" class="office-btn pointer-events-auto pri-btn text-vkl-t-sub font-normal rounded-md bg-neutral-950 border-1  border-red-700  hover:bg-red-700 hover:text-neutral-50">
                        Istanbul 2
                    </button>
                    <button id="istanbul3" class="office-btn pointer-events-auto pri-btn text-vkl-t-sub font-normal rounded-md bg-neutral-950 border-1  border-red-700  hover:bg-red-700 hover:text-neutral-50">
                        Istanbul 3
                    </button>
                    <button id="istanbul4" class="office-btn pointer-events-auto pri-btn text-vkl-t-sub font-normal rounded-md bg-neutral-950 border-1  border-red-700  hover:bg-red-700 hover:text-neutral-50">
                        Istanbul 4
                    </button>
                    <button id="istanbul5" class="office-btn pointer-events-auto pri-btn text-vkl-t-sub font-normal rounded-md bg-neutral-950 border-1  border-red-700  hover:bg-red-700 hover:text-neutral-50">
                        Istanbul 5
                    </button>
                </div>
            </div>
            <div id="map-contacts" class="border-red-700 border-2 pointer-events-auto map-message-box text-neutral-900 w-fit mobile-medium:w-full bg-neutral-50 rounded-2xl z-0 p-6 mobile-large:p-5 relative dashed-br-dark after:absolute after:left-0 after:top-0 after:w-full after:h-full after:scale-95 after:z-20 mobile-medium:after:scale-y-90 mobile-medium:after:scale-x-97 mobile-tiny:after:scale-x-94 before:top-0 before:left-0 before:w-full before:h-full before:absolute before:opacity-0 tablet-medium:before:hidden overflow-hidden">
                <h3 class="text-vkl-t-sub-header font-bold text-red-700 mb-2">
                    Istanbul Office
                </h3>

                <ul class="grid gap-2 grid-cols-1 mobile-medium:mt-5">
                    <li class="flex justify-start items-center gap-2">
                        <span><i class="ph text-red-700 ph-map-pin text-xl"></i></span>
                        <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit</span>
                    </li>
                    <li class="flex justify-start items-center gap-2">
                        <span><i class="ph text-red-700 ph-phone text-xl"></i></span>
                        <a href="tel:098123456789">098123456789</a>
                    </li>
                    <li class="flex justify-start items-center gap-2">
                        <span><i class="ph text-red-700 ph-envelope-simple text-xl"></i></span>
                        <a href="tel:098123456789">098123456789</a>
                    </li>
                    <li class="flex justify-start items-center gap-2">
                        <span><i class="ph text-red-700 ph-envelope-simple text-xl"></i></span>
                        <a href="mailto:email@gmail.com">email@gmail.com</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</section>

<section class=" center-sec py-28 tablet-medium:py-24 mobile-large:py-16">
    <div class=" mx-auto text-start">
        <div class="flex justify-between w-full">
            <h2 class="h3-bar mb-3">راهنما</h2>
            <div class="flex gap-2 h-fit">
                <button class="card-scroll-1 swiper-button-prev transition-colors ease-in duration-200 hover:bg-red-700 hover:text-neutral-50 tablet-medium:block rounded-md p-1 pb-[0.0625rem] mobile-medium:p-[0.0625rem] items-center bg-neutral-300">
                    <i class="ph ph-caret-right text-xl"></i>
                </button>
                <button class="card-scroll-2 swiper-button-next hover:bg-red-700 hover:text-neutral-50 transition-colors ease-in duration-200 tablet-medium:block rounded-md p-1 pb-[0.0625rem] mobile-medium:p-[0.0625rem] items-center bg-neutral-300">
                    <i class="ph ph-caret-left text-xl"></i>
                </button>
            </div>
        </div>
        <div class="swiper articles-slider mt-6 tablet-medium:mt-5">
            <ul class="swiper-wrapper">
                <?php foreach ($guides as $post) : ?>
                    <li class="swiper-slide group flex justify-between overflow-hidden items-start flex-col border-2 border-vkl-bg-card border-solid shadow-button  rounded-xl">
                        <div class="w-full h-fit article-item vakil-card grayscale group-hover:grayscale-0 group-hover:after:bg-transparent duration-200 ease-in transition-all after:duration-200 after:ease-in after:transition-all relative after:absolute after:w-full after:h-full after:left-0 after:top-0 after:bg-neutral-900 after:bg-opacity-50">
                            <img width="270" height="200" class=" h-48 tablet-medium:h-40 object-cover w-full border-solid border-b-2 border-vkl-bg-card" src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>">
                        </div>
                        <div class="w-full text-vkl-c-header p-3 relative">
                            <div class="font-bold absolute bottom-0 left-0 w-full text-center h-full z-30">
                                <p class="w-fit h-fit m-auto rounded-full bg-red-700 text-neutral-50 -translate-y-1/2 py-1 px-3 opacity-0 group-hover:opacity-100 duration-200 ease-in transition-all">
                                    بیمه
                                </p>
                            </div>
                            <a href="/post/<?php echo $post['id']; ?>">
                                <h2 class="font-bold">
                                    <?php echo $post['title']; ?>
                                </h2>
                            </a>
                            <p><?php echo $post['caption']; ?></p>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>