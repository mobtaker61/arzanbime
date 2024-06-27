<?php

use Core\Security;
?>

<section class="pady center-sec grid gap-x-6 mobile-large:gap-x-0 mobile-large:gap-y-6 grid-cols-2 mobile-large:grid-cols-1">
    <div class="flex flex-col justify-center items-start">
        <h2 class="text-vkl-c-header text-vkl-t-h3 font-bold after:h-1 after:w-14 after:bg-vkl-c-highlight relative after:absolute after:right-0 after:-bottom-3 tablet-medium:after:-bottom-2">
            ما کی هستیم؟
        </h2>
        <div class="text-justify mb-4 pb-6 py-9 tablet-medium:pt-6 tablet-medium:pb-5 mobile-large:pt-5">
            <p>وب‌سایت <span class="highlight">ارزان بیمه</span> با آدرس <a href="https://arzanbime.com">arzanbime.com</a> معتبرترین پلتفرم آنلاین برای خرید بیمه سلامت اتباع خارجی در ترکیه است. ما به‌طور ویژه به ارائه بیمه سلامت و بیمه اجازه اقامت برای اتباع خارجی می‌پردازیم و هدف اصلی ما فراهم کردن خدمات باکیفیت و آسان برای این گروه از افراد است.</p>
            <p>در ترکیه، اتباع خارجی قبل از درخواست اجازه اقامت، تحصیل، کار و تجارت ملزم به داشتن بیمه سلامت هستند. در ارزان بیمه، ما این امکان را فراهم کرده‌ایم که بیمه سلامت خود را به‌صورت آنلاین و تنها در سه مرحله ساده و کمتر از سه دقیقه خریداری کنید. بلافاصله پس از تکمیل خرید، بیمه‌نامه به‌صورت آنی به ایمیل شما ارسال می‌شود و امکان تحویل رایگان از طریق باربری نیز فراهم است.</p>
            <p>ما به‌صورت مستقیم با تعداد زیادی از شرکت‌های بیمه و بروکرهای بیمه‌ای قرارداد داریم و بیمه‌ها مستقیماً با مسئولیت بروکرها و از شرکت‌های بیمه‌ای صادر می‌شوند. این همکاری‌ها به ما امکان می‌دهد که بهترین و متنوع‌ترین خدمات بیمه‌ای را با قیمت‌های مناسب به شما ارائه دهیم.</p>
            <p>خدمات ما به شما این امکان را می‌دهد که بدون واسطه و با اطمینان خاطر، بیمه سلامت خود را به‌صورت آنلاین و با کمترین هزینه تهیه کنید. ما در تلاشیم تا فرآیند خرید بیمه را برای شما سریع، آسان و ایمن کنیم.</p>
            <p><strong>توجه:</strong> تمامی اطلاعات موجود در سایت در مورد مراحل دریافت اجازه اقامت تنها برای آگاهی‌بخشی و کمک به کاربران عزیز به اشتراک گذاشته شده است.</p>
        </div>
    </div>
    <div class="rounded-2xl tablet-medium:rounded-xl overflow-hidden h-96 mobile-small:h-52 relative after:absolute after:left-0 after:top-0 after:w-full after:h-full after:scale-95 after:z-20">
        <img width="500" height="380" class="object-cover w-full h-full" src="/public/assets/Picture-of-article-number3-BMe3ieTG.webp" alt="جمعی از وکلا" />
    </div>
</section>

<!-- Company Slider Section -->
<section id="companies" class="center-sec pady">
    <div class="mx-auto text-start">
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
                <?php foreach ($companies as $company) : ?>
                    <li id="<?php echo $company['id']; ?>" class="swiper-slide company-card cursor-pointer mb-3">
                        <img class="w-full" width="280" height="136" src="<?php echo $company['logo']; ?>" alt="<?php echo $company['name']; ?>" />
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>

<section class="pady center-sec grid gap-x-6 mobile-large:gap-x-0 mobile-large:gap-y-6 grid-cols-2 mobile-large:grid-cols-1">
    <div class="flex flex-col justify-center items-start">
        <div class="rounded-2xl tablet-medium:rounded-xl overflow-hidden h-96 relative after:absolute after:left-0 after:top-0 after:w-full after:h-full after:scale-95 after:z-20">
            <img class="object-cover w-full" src="/public/assets/ContactUs.webp" alt="جمعی از وکلا" />
        </div>
    </div>
    <div dir="rtl" class="tablet-medium:rounded-xl relative after:absolute after:left-0 after:top-0 after:w-full after:h-full after:scale-95 after:z-20">
        <h1 class="text-xl font-bold mb-6">تماس با ما</h1>
        <p class="mb-4">لطفا فرم زیر را برای تماس با ما پر کنید:</p>
        <form id="contact-form" class="grid gap-3 mobile-large:gap-3 placeholder:text-vkl-c-normal">
            <input type="hidden" name="csrf_token" value="<?php echo Security::generateCSRFToken(); ?>">
            <label for="name" class="block mb-2">نام</label>
            <input type="text" id="name" name="name" required class="border p-2 rounded mb-4">

            <label for="email" class="block mb-2">ایمیل</label>
            <input type="email" id="email" name="email" required class="border p-2 rounded mb-4">

            <label for="cell" class="block mb-2">موبایل</label>
            <input type="tel" id="cell" name="cell" required class="border p-2 rounded mb-4">

            <label for="message" class="block mb-2">پیام</label>
            <textarea id="message" name="message" rows="4" required class="border p-2 rounded mb-4"></textarea>


            <button type="submit" class="pri-btn col-span-2 mobile-medium:py-2">ارسال</button>
        </form>
        <div id="form-result" class="mt-4"></div>
    </div>
</section>

<section class="text-center py-20 mobile-large:py-10 tablet-medium:mt-24 mobile-large:mt-16 relative after:w-full after:h-full after:absolute after:left-0 after:top-0 after:bg-neutral-950 after:bg-opacity-70 after:z-10">
    <div id="bg-section-back" class="grayscale bg-section-back absolute w-full h-full left-0 top-0 z-10 bg-fixed bg-cover bg-bottom bg-no-repeat"></div>
    <div class="center-sec relative z-20">
        <h2 class="text-vkl-t-h2 font-bold text-neutral-50">
            شما هم میتوانید، نمایندگی
            <span class="relative after:-bottom-2 after:right-0 after:absolute after:w-full after:h-1 after:border-t-2 after:border-solid after:border-red-700 after:z-20">ارزان بیمه</span>
            در هر یک از شهرهای ترکیه باشید!
        </h2>
        <p class="text-neutral-200 pt-7 pb-10 tablet-medium:pb-9 tablet-medium:pt-5 mobile-large:pb-5 mobile-large:pt-4">
            اگر شما صاحب شرکت مشاوره در زمینه امور اقامت هستید، میتوانید با ارسال درخواست خود منتظر تماس کارشناسان ما باشید و به خانواده نمایندگان ارزان بیمه بپیوندید
        </p>
        <div class="grid grid-cols-1 gap-6 w-fit mx-auto">
            <button class="pri-btn px-12 py-2">درخواست نمایندگی</button>
        </div>
    </div>
</section>

<script>
    document.getElementById('contact-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);
        const resultDiv = document.getElementById('form-result');

        fetch('/contact/submit', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    resultDiv.innerHTML = `<p class="text-green-500">${data.message}</p>`;
                } else {
                    resultDiv.innerHTML = `<p class="text-red-500">${data.message}</p>`;
                }
            })
            .catch(error => {
                resultDiv.innerHTML = `<p class="text-red-500">خطا در ارسال فرم</p>`;
            });
    });
</script>