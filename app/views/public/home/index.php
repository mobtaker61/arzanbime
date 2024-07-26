<?php
$pagetitle = $pagetitle ?? 'خانه';
$description = $description ?? 'این صفحه اصلی وبلاگ است که آخرین پست ها و اخبار را نمایش می دهد.';
$keywords = $keywords ?? 'صفحه اصلی, وبلاگ, اخبار, پست ها';
$userLoggedIn = isset($_SESSION['user_id']);
?>

<section class="pady center-sec flex justify-between items-center gap-6 mobile-large:gap-3 mobile-large:flex-col mobile-large:items-start mb-6">
    <div id="features">
        <h2 class="h3-bar">فقط در 10 دقیقه</h2>
        <img src="/public/assets/arzan-bime.webp" alt="خرید بیمه اقامت فقط در 10 دقیقه">
        <div class="slider-container hidden">
            <div class="slider">
                <div class="slide">
                    <img src="/path/to/clipart1.png" alt="Clipart 1">
                </div>
                <div class="slide">
                    <img src="/path/to/clipart2.png" alt="Clipart 2">
                </div>
                <div class="slide">
                    <img src="/path/to/clipart3.png" alt="Clipart 3">
                </div>
            </div>
        </div>

        <ul class="[&_li_a]:inline-block [&_li_a]:text-vkl-t-sub-header [&_li_a]:pt-5 tablet-medium:[&_li_a]:pt-3 [&_li:first-child_a]:pt-0 hidden">
            <li>
                تاریخ تولد یا سن ات رو تو فرم بنویس!
            </li>
            <li>
                طبق نرخ تخفیفی ویژه خودت، پرداخت رو انجام بده
            </li>
            <li>
                منتظر دریافت فایل بیمه نامه زیر 10 دقیقه باش
            </li>
        </ul>
    </div>
    <div id="quota-form" class="w-1/2 mobile-large:w-full mobile-large:mt-3">
        <h2 class="text-vkl-t-sub-header font-bold text-vkl-c-header mr-auto w-fit mb-5 mobile-large:h3-bar">
            استعلام
        </h2>
        <form id="quota-form-element" class="grid-cols-2 grid gap-6 mobile-large:gap-3 placeholder:text-vkl-c-normal">
            <input id="birth" class="input placeholder:text-vkl-c-normal" type="date" name="birth" dir="ltr" placeholder="تاریخ تولد*" value="2000-01-01" />
            <input id="age" class="input placeholder:text-vkl-c-normal" type="text" placeholder="سن*" name="age" inputmode="numeric" maxlength="3" readonly />
            <div class="input col-span-2 grid-cols-2 grid gap-6 mobile-large:gap-3">
                <label>مدت درخواست *</label>
                <span class="gap-6 flex mobile-large:gap-3 mobile-small:mr-auto">
                    <span>
                        <input id="duration-1" value="1" type="radio" name="duration" />
                        <span>یک سال</span>
                    </span>
                    <span>
                        <input id="duration-2" value="2" type="radio" name="duration" />
                        <span>دوسال</span>
                    </span>
                </span>
            </div>
            <?php if (!$userLoggedIn) : ?>
                <div class="col-span-2 grid-cols-3 grid gap-6 mobile-large:gap-3">
                    <input id="tel" class="input placeholder:text-vkl-c-normal col-span-2 " type="tel" name="tel" placeholder="شماره تلفن*" required />
                    <select id="country-code" class="input placeholder:text-vkl-c-normal" title="تلفن">
                        <option value="+90" data-flag="tr">🇹🇷 +90</option>
                        <option value="+98" data-flag="ir">🇮🇷 +98</option>
                    </select>
                </div>
                <p class="col-span-2 text-center">لطفا شماره موبایل صحیح وارد کنید، جهت نمایش نرخهای ویژه میبایست کد تایید ارسالی به شماره موبایل را وارد کنید<br />
                    احراز هویت برای هر شماره موبایل فقط یکبار انجام میشود و در دفعات بعدی کدی ارسال نمیشود</p>
            <?php endif; ?>
            <button type="submit" class="pri-btn col-span-2 mobile-medium:py-2">استعلام قیمت</button>
        </form>
    </div>
</section>
<!-- Add this section to show the response -->
<section id="quota-response" class="pady center-sec" style="display: none;">
    <div id="response-message" class="text-vkl-c-header"></div>
</section>

<!-- **** COMPANY ***** -->
<section id="companies" class="py-6 center-sec">
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
                <?php if (isset($companies) && is_array($companies)) : ?>
                    <?php foreach ($companies as $index => $company) : ?>
                        <li class="swiper-slide company-card cursor-pointer mb-0" data-id="<?php echo $company['id']; ?>" data-color="<?php echo $company['color']; ?>">
                            <img class="w-full" width="auto" height="96" src="<?php echo $company['logo']; ?>" alt="<?php echo $company['name']; ?>" />
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No companies found.</p>
                <?php endif; ?>
            </ul>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <div id="company-card-detail" class="p-6 mobile-large:p-3 mt-0 overflow-hidden bg-red-200 rounded-3xl tablet-medium:rounded-2xl mobile-large:rounded-xl grid grid-cols-2 tablet-small:grid-cols-1 gap-6 mobile-large:gap-3 mobile-medium:gap-6 mobile-large:flex-col mobile-large:items-start">
        <div id="tariff-summary" class="relative overflow-hidden">
            <!-- Company Package Tariff by Age Range with Tabs -->
        </div>
        <div class="flex justify-start items-start tablet-small:items-center flex-col">
            <h1 id="company-name" class="text-vkl-t-h2 font-bold text-red-950">
                <!-- Company Name -->
            </h1>
            <p id="company-intro" class="mt-6 mobile-medium:mt-3 text-justify tablet-small:pb-4">
                <!-- Company Intro -->
            </p>
            <div class="mt-auto flex justify-start items-center tablet-small:justify-center gap-4 w-full text-vkl-c-header">
                <p>لیست مراکز درمانی طرف قرارداد</p>
                <button class="pri-btn">دانلود لیست</button>
            </div>
        </div>
    </div>
</section>

<section id="faq" class="py-6 center-sec">
    <h3 class="h3-bar mb-6">سوالات متداول</h3>
    <div class="grid grid-cols-3 tablet-small:grid-cols-1 gap-6 tablet-small:gap-0 mobile-medium:gap-0 mobile-large:flex-col mobile-large:items-start">
        <ul id="qa-text" class="col-span-2">
            <?php foreach ($faqs as $post) : ?>
                <li class="mb-6 tablet-medium:mb-5 mobile-large:mb-4">
                    <button id="qa-button" class="p-4 tablet-medium:p-3 mobile-large:p-2 relative z-30 bg-neutral-200 text-vkl-c-header shadow-button rounded-xl tablet-medium:rounded-lg flex justify-between items-center w-full">
                        <h4 class="font-bold"><?php echo $post['title']; ?></h4>
                        <i class="ph ph-caret-down text-xl mobile-large:text-base"></i>
                    </button>
                    <p class="hidden h-0 opacity-0 relative z-10 p-3">
                        <?php echo nl2br($post['caption']); ?>
                    </p>
                </li>
            <?php endforeach; ?>
            <div class="flex justify-end mt-1">
                <a href="/posts/faq" class="pri-btn">همه سئوالات</a>
            </div>
        </ul>
        <img width="380" height="300" class="mobile-medium:hidden" alt="مرد کنار زمین" src="/public/assets/a-vector-globe-GME6DF1B.png" />
    </div>
</section>

<section id="gift" class="py-6 center-sec mt-0">
    <h3 class="h3-bar mb-2">هدیه ویژه ارزان بیمه</h3>
    <p class="text-vkl-c-header mb-9 tablet-large:mb-6 mobile-large:mb-8">
        با استفاده از کد اختصاصی خود، دوستانتان را معرفی کنید و هدیه بگیرید.
    </p>
    <div class="flex justify-between items-center tablet-large:flex-col">
        <div class="rounded-lg border border-gray-400 p-2 pb-1 flex justify-between items-center gap-2 overflow-hidden mobile-medium:overflow-scroll max-h-10 mobile-medium:max-w-full">
            <p id="copy-text" dir="ltr">
                https://arzanbime.com/X25SS25
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

<section id="notice" class="py-6 center-sec mb-6">
    <h3 class="h3-bar mb-6">اطلاعیه های اداره اقامت</h3>
    <div class="grid grid-cols-3 tablet-small:grid-cols-1 gap-6 mobile-large:flex-col mobile-large:items-start">
        <img class="mobile-medium:hidden" width="380" height="300" alt="مرد کنار زمین" src="/public/assets/a-vector-globe-GME6DF1B.png" />
        <ul id="qa-text" class="col-span-2 tablet-small:col-span-1">
            <?php foreach ($notices as $notice) : ?>
                <li class="mb-6 tablet-medium:mb-5 mobile-large:mb-4">
                    <button class="p-4 tablet-medium:p-3 mobile-large:p-2 relative z-30 bg-neutral-200 text-vkl-c-header shadow-button rounded-xl tablet-medium:rounded-lg flex justify-between items-center w-full notice-button" data-id="<?php echo $notice['id']; ?>">
                        <h4 class="font-bold"><?php echo $notice['title']; ?></h4>
                        <a href="/post/<?php echo $notice['id']; ?>">
                            <i class="ph ph-eye text-xl mobile-large:text-base"></i>
                        </a>
                    </button>
                </li>
            <?php endforeach; ?>
            <div class="flex justify-end mt-1">
                <a href="/posts/notice" class="pri-btn">همه اطلاعیه ها</a>
            </div>
        </ul>
    </div>
</section>

<section id="offices" class="py-6 mt-0 mb-0 py-10 tablet-medium:py-24 mobile-large:py-16 bg-neutral-300">
    <div class="center-sec mt-0 mb-0">
        <h3 class="h3-bar mb-1">موقعیت ادارات اقامت ترکیه</h3>
        <div class="flex justify-center items-start mobile-medium:items-center gap-6 mobile-medium:gap-3 flex-col text-neutral-200 min-w-fit mb-6 mobile-medium:mb-0 w-45% mobile-medium:w-fit mobile-medium:mx-auto">
            <select id="province" title="province" class="bg-neutral-950 border-1 hover:bg-red-700 hover:text-neutral-50 border-red-700 py-1 px-3 rounded-lg">
                <?php foreach ($provinces as $province) : ?>
                    <option value="<?php echo $province['id']; ?>"><?php echo $province['name_fa'] . " (" . $province['name'] . ")"; ?></option>
                <?php endforeach; ?>
            </select>
            <div id="office-list" class="gap-3 justify-center items-center flex flex-wrap">
                <?php if (!empty($offices)) : ?>
                    <?php foreach ($offices as $office) : ?>
                        <div id="office-contacts<?php echo $office['id']; ?>" dir="ltr" class="border-red-700 border-2 pointer-events-auto map-message-box text-neutral-900 w-fit mobile-medium:w-full bg-neutral-50 rounded-2xl z-0 p-6 mobile-large:p-5 relative dashed-br-dark">
                            <h3 class="text-vkl-t-sub-header font-bold text-red-700 mb-2">
                                <?php echo $office['name']; ?>
                            </h3>
                            <ul class="grid gap-2 grid-cols-1 mobile-medium:mt-5">
                                <li class="flex justify-start items-center gap-2">
                                    <span><i class="ph text-red-700 ph-map-pin text-xl"></i></span>
                                    <span><?php echo $office['address']; ?></span>
                                </li>
                                <li class="flex justify-start items-center gap-2">
                                    <span><i class="ph text-red-700 ph-phone text-xl"></i></span>
                                    <a href="tel:<?php echo $office['telephone']; ?>"><?php echo $office['telephone']; ?></a>
                                </li>
                                <li class="flex justify-start items-center gap-2">
                                    <span><i class="ph text-red-700 ph-envelope-simple text-xl"></i></span>
                                    <a href="mailto:<?php echo $office['email']; ?>"><?php echo $office['email']; ?></a>
                                </li>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No offices available.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section id="blog" class=" center-sec py-28 tablet-medium:py-24 mobile-large:py-16">
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
                        <a href="/post/<?php echo $post['id']; ?>">
                        <div class="w-full text-vkl-c-header p-3 relative">
                            <div class="font-bold absolute bottom-0 left-0 w-full text-center h-full z-30">
                                <p class="w-fit h-fit m-auto rounded-full bg-red-700 text-neutral-50 -translate-y-1/2 py-1 px-3 opacity-0 group-hover:opacity-100 duration-200 ease-in transition-all">
                                    بیمه
                                </p>
                            </div>
                            <h4 class="font-bold"><?php echo $post['title']; ?></h4>
                                </div>
                            </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>

<!-- ******* MODAL ******** -->
<!-- OTP Modal -->
<div id="otp-modal" class="modal hidden fixed z-50 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen">
        <div class="modal-content bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-2xl font-bold mb-4">تایید هویت</h2>
            <p>لطفا کد تایید ارسال شده به موبایل خود را وارد کنید.</p>
            <p>در صورت وارد کردن کد صحیح شما به صفحه نمایش نرخ هدایت میشوید</p>
            <form id="otp-form">
                <input id="otp" class="input placeholder:text-vkl-c-normal w-full mb-4" type="text" placeholder="Enter OTP" required />
                <button type="submit" class="pri-btn w-full">کنترل</button>
            </form>
        </div>
    </div>
</div>
<!-- ******* SCRIPT ******** -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Function to check if the user is logged in
        function isUserLoggedIn() {
            // Implement your logic to check if the user is logged in
            // This could be a check for a session variable, cookie, etc.
            // For example:
            return <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
        }

        // Calculate age based on birth date input
        document.getElementById("birth").addEventListener("input", function() {
            const birthDate = new Date(this.value);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            document.getElementById("age").value = age;
        });

        // Function to remove spaces from the telephone number
        function removeSpaces(str) {
            return str.replace(/\s+/g, '');
        }

        // Handle form submission
        document.getElementById("quota-form-element").addEventListener("submit", function(e) {
            e.preventDefault();

            const formData = {
                birth: document.getElementById("birth").value,
                age: document.getElementById("age").value,
                duration: document.querySelector('input[name="duration"]:checked').value,
                role: "user",
            };

            const telElement = document.getElementById("tel");
            if (telElement) {
                const tel = removeSpaces(document.getElementById("country-code").value + telElement.value);
                formData.tel = tel;
                fetch("/auth/check-tel", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            tel: formData.tel
                        })
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.exists) {
                            // User exists, store the quotation and redirect
                            formData.user_id = data.user_id;
                            return fetch("/auth/store-quotation-data", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json"
                                    },
                                    body: JSON.stringify(formData)
                                })
                                .then((response) => response.json())
                                .then((data) => {
                                    if (data.success) {
                                        window.location.href = data.redirect; // Redirect to offers result page
                                    } else {
                                        throw new Error(data.message || "Failed to store quotation data");
                                    }
                                });
                        } else {
                            // User does not exist, send OTP
                            return fetch("/auth/send-otp", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json"
                                    },
                                    body: JSON.stringify(formData)
                                })
                                .then((response) => response.json())
                                .then((data) => {
                                    if (data.success) {
                                        document.getElementById("otp-modal").classList.remove("hidden");
                                    } else {
                                        throw new Error(data.message || "Failed to send OTP");
                                    }
                                });
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                    });
            } else {
                // User is logged in, store the quotation directly
                formData.user_id = <?php echo $_SESSION['user_id'] ?? 'null'; ?>;
                fetch("/auth/store-quotation-data", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(formData)
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            window.location.href = data.redirect;
                        } else {
                            alert(data.message || "Failed to store quotation data");
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                    });
            }
        });

        // Handle OTP form submission
        document.getElementById("otp-form").addEventListener("submit", function(e) {
            e.preventDefault();

            const otp = document.getElementById("otp").value;

            fetch("/auth/verify-otp", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        otp: otp
                    })
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        window.location.href = data.redirect; // Redirect to offers result page
                    } else {
                        alert(data.message || "Invalid OTP");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        });

        // Province DropDown Select
        document.getElementById('province').addEventListener('change', function() {
            const provinceId = this.value;
            fetch(`/offices/byProvince/${provinceId}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(offices => {
                    const officeList = document.getElementById('office-list');
                    officeList.innerHTML = ''; // Clear the current office list

                    if (offices.length > 0) {
                        offices.forEach(office => {
                            const officeDiv = document.createElement('div');
                            officeDiv.id = `office-contacts${office.id}`;
                            officeDiv.className = 'border-red-700 border-2 pointer-events-auto map-message-box text-neutral-900 w-fit mobile-medium:w-full bg-neutral-50 rounded-2xl z-0 p-6 mobile-large:p-5 relative dashed-br-dark';

                            const officeName = document.createElement('h3');
                            officeName.className = 'text-vkl-t-sub-header font-bold text-red-700 mb-2';
                            officeName.textContent = office.name;

                            const officeDetails = document.createElement('ul');
                            officeDetails.className = 'grid gap-2 grid-cols-1 mobile-medium:mt-5';

                            const addressLi = document.createElement('li');
                            addressLi.className = 'flex justify-start items-center gap-2';
                            addressLi.innerHTML = `<span><i class="ph text-red-700 ph-map-pin text-xl"></i></span><span>${office.address}</span>`;

                            const phoneLi = document.createElement('li');
                            phoneLi.className = 'flex justify-start items-center gap-2';
                            phoneLi.innerHTML = `<span><i class="ph text-red-700 ph-phone text-xl"></i></span><a href="tel:${office.telephone}">${office.telephone}</a>`;

                            const emailLi = document.createElement('li');
                            emailLi.className = 'flex justify-start items-center gap-2';
                            emailLi.innerHTML = `<span><i class="ph text-red-700 ph-envelope-simple text-xl"></i></span><a href="mailto:${office.email}">${office.email}</a>`;

                            officeDetails.appendChild(addressLi);
                            officeDetails.appendChild(phoneLi);
                            officeDetails.appendChild(emailLi);

                            officeDiv.appendChild(officeName);
                            officeDiv.appendChild(officeDetails);

                            officeList.appendChild(officeDiv);
                        });
                    } else {
                        officeList.innerHTML = '<p>No offices available.</p>';
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.querySelector('.slider');
        const slides = document.querySelectorAll('.slide');
        let currentIndex = slides.length - 1;

        function showPreviousSlide() {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            slider.style.transform = `translateX(-${currentIndex * 100}%)`;
        }

        setInterval(showPreviousSlide, 1000); // Change slide every 3 seconds
    });

    // Function to load company details and tariff summary
    document.addEventListener("DOMContentLoaded", function() {
        const companyCards = document.querySelectorAll(".company-card");
        const firstCompanyCard = companyCards[0];

        function loadCompanyDetails(companyId, color, card) {
            fetch(`/companies/details/${companyId}`, {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                    },
                })
                .then((response) => response.json())
                .then((data) => {
                    document.getElementById("company-name").textContent = data.name;
                    document.getElementById("company-intro").textContent = data.intro;
                    document.getElementById("company-card-detail").style.backgroundColor = hexToRgba(color, 0.4);

                    companyCards.forEach((card) => {
                        card.classList.remove("active-company-card");
                        card.style.backgroundColor = "";
                    });

                    card.classList.add("active-company-card");
                    card.style.backgroundColor = hexToRgba(color, 0.4);

                    return fetch(`/getTariffSummary/${companyId}`, {
                        headers: {
                            "X-Requested-With": "XMLHttpRequest",
                        },
                    });
                })
                .then((response) => response.json())
                .then((tariffs) => {
                    const tariffSummary = document.getElementById("tariff-summary");
                    tariffSummary.innerHTML = "";

                    const tabs = document.createElement("div");
                    tabs.className = "tabs gap-3";
                    const tabContents = document.createElement("div");
                    tabContents.className = "tab-contents";

                    let firstTab = true;
                    for (const [tip, data] of Object.entries(tariffs)) {
                        const tabId = `tab-${tip.replace(/\s+/g, '-')}`;

                        const tabButton = document.createElement("button");
                        tabButton.className = `tab-button pri-btn ${firstTab ? 'active' : ''}`;
                        tabButton.textContent = `${tip}`;
                        tabButton.setAttribute("data-tab", tabId);
                        tabButton.style.width = '100%';
                        tabButton.style.color = data.color; // Use the package color as text color
                        tabButton.style.border = `solid 2px ${data.color}`; // Use the package color as border color
                        tabs.appendChild(tabButton);

                        const tabContent = document.createElement("div");
                        tabContent.id = tabId;
                        tabContent.className = `tab-content ${firstTab ? 'active' : ''}`;

                        const table = document.createElement("table");
                        table.className = "table-tariff table-auto w-full border-collapse border border-gray-200";
                        table.innerHTML = `
                        <thead>
                            <tr>
                                <th class="px-4 py-2">محدوده سنی</th>
                                <th class="px-4 py-2">یک ساله</th>
                                <!-- <th class="px-4 py-2">سال دوم</th> -->
                                <th class="px-4 py-2">دو ساله</th>
                            </tr>
                        </thead>
                        <tbody id="${tabId}-body"></tbody>
                    `;
                        tabContent.appendChild(table);
                        tabContents.appendChild(tabContent);

                        const tabBody = tabContent.querySelector(`#${tabId}-body`);
                        tabBody.style.backgroundColor = 'white';
                        data.tariffs.forEach((tariff) => {
                            const row = document.createElement("tr");
                            row.innerHTML = `
                            <td class="py-2 px-4 text-xl border-b">${tariff.age_range}</td>
                            <td class="py-2 px-4 text-xl border-b numwc">${tariff.first_year}</td>
                            <!--  <td class="py-2 px-4 text-xl border-b numwc">${tariff.second_year}</td> -->
                            <td class="py-2 px-4 text-xl border-b numwc">${tariff.two_year}</td>
                        `;
                            tabBody.appendChild(row);
                        });

                        firstTab = false;
                    }

                    tariffSummary.appendChild(tabs);
                    tariffSummary.appendChild(tabContents);

                    document.querySelectorAll(".tab-button").forEach(button => {
                        button.addEventListener("click", function() {
                            const tabId = this.getAttribute("data-tab");

                            document.querySelectorAll(".tab-button").forEach(btn => {
                                btn.classList.remove("active");
                            });
                            this.classList.add("active");

                            document.querySelectorAll(".tab-content").forEach(content => {
                                content.classList.remove("active");
                            });
                            document.getElementById(tabId).classList.add("active");
                        });
                    });
                })
                .catch((error) => console.error("Error:", error));
        }

        companyCards.forEach((card) => {
            card.addEventListener("click", function() {
                const companyId = this.getAttribute("data-id");
                const companyColor = this.getAttribute("data-color");
                loadCompanyDetails(companyId, companyColor, this);
            });
        });

        if (firstCompanyCard) {
            firstCompanyCard.click();
        }
    });
</script>