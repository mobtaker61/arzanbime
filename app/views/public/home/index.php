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

<section id="companies" class="center-sec">
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
    <div id="company-card-detail" class="p-6 mobile-large:p-3 pady mt-0 overflow-hidden bg-red-200 rounded-3xl tablet-medium:rounded-2xl mobile-large:rounded-xl grid grid-cols-2 tablet-small:grid-cols-1 gap-6 mobile-large:gap-3 mobile-medium:gap-6 mobile-large:flex-col mobile-large:items-start">
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
        <div id="assurance-table" dir="ltr" class="relative overflow-hidden">
            <p class="image">image</p>
        </div>
    </div>
</section>

<section id="faq" class="pady center-sec">
    <h3 class="h3-bar mb-6">سوالات متداول</h3>
    <div class="grid grid-cols-3 tablet-small:grid-cols-1 gap-6 tablet-small:gap-0 mobile-medium:gap-0 mobile-large:flex-col mobile-large:items-start">
        <ul id="qa-text" class="col-span-2">
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
        <img width="380" height="300" alt="مرد کنار زمین" src="/public/assets/a-vector-globe-GME6DF1B.png" />
    </div>
</section>

<section id="gift" class="pady center-sec mt-0">
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

<section id="notice" class="pady center-sec mb-6">
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
        </ul>
    </div>
    <div class="flex justify-end mt-1">
        <a href="/posts?type=notice" class="pri-btn">همه اطلاعیه ها</a>
    </div>
</section>

<section id="offices" class="pady pady mt-0 mb-0 py-10 tablet-medium:py-24 mobile-large:py-16 bg-neutral-300">
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

<!-- *************** -->
<script>
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
                    document.getElementById("company-card-detail").style.backgroundColor =
                        color;
                    // Remove active background color from all cards
                    companyCards.forEach((card) => {
                        card.classList.remove("active-company-card");
                        card.style.backgroundColor = "";
                    });

                    // Add active background color to the selected card
                    card.classList.add("active-company-card");
                    card.style.backgroundColor = color;
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

        // Trigger click event on the first company card
        if (firstCompanyCard) {
            firstCompanyCard.click();
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
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
</script>