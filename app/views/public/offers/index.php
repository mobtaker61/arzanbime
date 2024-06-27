<?php
$pagetitle = $pagetitle ?? 'پیشنهادات';
$description = $description ?? 'صفحه پیشنهادات بر اساس اطلاعات وارد شده در فرم.';
$keywords = $keywords ?? 'پیشنهادات, بیمه, تعرفه';
?>
<section class="pady center-sec">
    <div id="tariff_page" class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold"><?php echo $pagetitle ?></h1>
            <button id="download-btn" class="pri-btn bg-blue py-2 px-4">دانلود تصویر</button>
        </div>
        <div class="mb-6">
            <div class="mb-6 flex justify-between items-center gap-3">
                <div class="p-4 bg-white w-full field-box rounded-lg shadow-md flex flex-col items-center">
                    <p>تاریخ تولد:</p>
                    <p class="font-bold"><?php echo $quotation['birth_date']; ?></p>
                </div>
                <div class="p-4 bg-white w-full field-box rounded-lg shadow-md flex flex-col items-center">
                    <p>سن:</p>
                    <p class="font-bold"><?php echo $quotation['age']; ?></p>
                </div>
                <div class="p-4 bg-white w-full field-box rounded-lg shadow-md flex flex-col items-center">
                    <p>مدت درخواست:</p>
                    <p class="font-bold"><?php echo $quotation['duration'] == 1 ? 'یک سال' : 'دوسال'; ?> </p>
                </div>
            </div>
        </div>
        <!-- تعرفه ها -->
        <div class="flex titlebox bg-zereshki p-3">
            <h2 class="text-3xl font-bold mb-2 gap-3">یکساله</h2>
        </div>
        <div class="mb-6 gap-3">
            <?php if (!empty($tariffs)) : ?>
                <?php foreach ($tariffs as $tariff) : ?>
                    <div class="flex tariff-box">
                        <div class="flex info">
                            <div class="flex package w-full">
                                <div class="flex icon">
                                    <img style="width: 48px;height: 48px;" src="<?php echo $tariff['company_icon']; ?>" alt="<?php echo $tariff['company_name']; ?>" />
                                </div>
                                <div class="flex p_name p-1 text-xl">
                                    <p><?php echo $tariff['company_name']; ?></p>&nbsp;
                                    <p><?php echo "طرح " . $tariff['package_tip']; ?></p>
                                </div>
                                <div class="flex price p-1">
                                    <p>تعرفه اصلی: <span class="text-xl numwc"><?php echo $tariff['first_year']; ?></span>&nbsp;لیر</p>
                                    <p class="tooltip">تخفیف ویژه: <span class="text-xl text-red-950 numwc">
                                            <?php echo $tariff['first_year_discount']; ?></span>&nbsp;لیر
                                        <span class="tooltiptext">تخفیف <?php echo $tariff['discount_rate']; ?>&nbsp;درصد</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex cta">
                            <div class="flex justify-between p-1" style="align-items: center;">
                                <p>پرداختی شما&nbsp;</p>
                                <p><span class="text-xl text-red-950 numwc"><?php echo $tariff['first_year_pay']; ?></span>&nbsp;لیر</p>
                                <button type="button" class="pri-btn py-1 purchase-btn" data-quotation-id="<?php echo $quotation['id']; ?>" data-quotation-dur="1" data-tariff-id="<?php echo $tariff['id']; ?>" data-tariff-name="<?php echo $tariff['company_name'] . ' ' . $tariff['package_tip']; ?>" data-tariff-price="<?php echo $tariff['first_year_pay']; ?>">خرید</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>هیچ تعرفه‌ای یافت نشد.</p>
            <?php endif; ?>
        </div>

        <div class="flex titlebox p-3 bg-green">
            <h2 class="text-3xl font-bold mb-2 gap-3">دوساله</h2>
        </div>
        <div class="mb-6 gap-3">
            <?php if (!empty($tariffs)) : ?>
                <?php foreach ($tariffs as $tariff) : ?>
                    <div class="flex tariff-box">
                        <div class="flex info">
                            <div class="flex package w-full">
                                <div class="flex icon">
                                    <img style="width: 48px;height: 48px;" src="<?php echo $tariff['company_icon']; ?>" alt="<?php echo $tariff['company_name']; ?>" />
                                </div>
                                <div class="flex p_name p-1 text-xl">
                                    <p class="text-xl"><?php echo $tariff['company_name']; ?></p>
                                    <p class="text-sm"><?php echo "طرح " . $tariff['package_tip']; ?></p>
                                </div>
                                <div class="flex price p-1">
                                    <p>تعرفه اصلی: <span class="text-xl numwc"><?php echo $tariff['two_year']; ?></span>&nbsp;لیر</p>
                                    <p class="tooltip">تخفیف ویژه: <span class="text-xl text-red-950 numwc">
                                            <?php echo $tariff['two_year_discount']; ?></span>&nbsp;لیر
                                        <span class="tooltiptext">تخفیف <?php echo $tariff['discount_rate']; ?>&nbsp;درصد</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex cta">
                            <div class="flex justify-between p-1" style="align-items: center;">
                                <p>پرداختی شما&nbsp;</p>
                                <p><span class="text-xl text-red-950 numwc"><?php echo $tariff['two_year_pay']; ?></span>&nbsp;لیر</p>
                                <button type="button" class="pri-btn py-1 purchase-btn" data-quotation-id="<?php echo $quotation['id']; ?>" data-quotation-dur="2" data-tariff-id="<?php echo $tariff['id']; ?>" data-tariff-name="<?php echo $tariff['company_name'] . ' ' . $tariff['package_tip']; ?>" data-tariff-price="<?php echo $tariff['two_year_pay']; ?>">خرید</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>هیچ تعرفه‌ای یافت نشد.</p>
            <?php endif; ?>
        </div>

        <table id="tariff_table" class="table-auto w-full border-collapse border border-gray-200 hidden">
            <thead>
                <tr>
                    <th colspan="4" class="col-span-4"></th>
                    <th colspan="3" class="border border-gray-200">یکساله</th>
                    <th colspan="3" class="border border-gray-200">دوساله</th>
                </tr>
                <tr>
                    <th class="border border-gray-200 px-4 py-2">آیکون</th>
                    <th class="border border-gray-200 px-4 py-2">شرکت</th>
                    <th class="border border-gray-200 px-4 py-2">طرح</th>
                    <th class="border border-gray-200 px-4 py-2">تخفیف</th>
                    <th class="border border-gray-200 px-4 py-2">نرخ</th>
                    <th class="border border-gray-200 px-4 py-2">تخفیف</th>
                    <th class="border border-gray-200 px-4 py-2">پرداختی</th>
                    <th class="border border-gray-200 px-4 py-2">نرخ</th>
                    <th class="border border-gray-200 px-4 py-2">تخفیف</th>
                    <th class="border border-gray-200 px-4 py-2">پرداختی</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tariffs as $tariff) : ?>
                    <tr style="background-color: <?php echo $tariff['company_color']; ?>">
                        <td class="border border-gray-200 px-4 py-2"><img src="<?php echo $tariff['company_icon']; ?>" alt="Icon" width="30" height="30"></td>
                        <td class="border border-gray-200 px-4 py-2"><?php echo $tariff['company_name']; ?></td>
                        <td class="border border-gray-200 px-4 py-2"><?php echo $tariff['package_tip']; ?></td>
                        <td class="border border-gray-200 px-4 py-2"><?php echo number_format($tariff['commission']); ?>%</td>
                        <td class="border border-gray-200 px-4 py-2"><?php echo number_format($tariff['first_year']); ?></td>
                        <td class="border border-gray-200 px-4 py-2"><?php echo number_format($tariff['first_year_discount']); ?></td>
                        <td class="border border-gray-200 px-4 py-2"><?php echo number_format($tariff['first_year_pay']); ?></td>
                        <td class="border border-gray-200 px-4 py-2"><?php echo number_format($tariff['two_year']); ?></td>
                        <td class="border border-gray-200 px-4 py-2"><?php echo number_format($tariff['two_year_discount']); ?></td>
                        <td class="border border-gray-200 px-4 py-2"><?php echo number_format($tariff['two_year_pay']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/html-to-image@1.9.0/dist/html-to-image.js"></script>
<script>
    // Handle the download button click
    document.getElementById("download-btn").addEventListener("click", function() {
        htmlToImage.toPng(document.getElementById("tariff_page"))
            .then(function(dataUrl) {
                const link = document.createElement("a");
                link.href = dataUrl;
                link.download = "tariff_page.png";
                link.click();
            })
            .catch(function(error) {
                console.error("oops, something went wrong!", error);
            });
    });

    // Handle the purchase button click
    document.querySelectorAll(".purchase-btn").forEach(function(button) {
        button.addEventListener("click", function() {
            const quotationId = this.getAttribute("data-quotation-id");
            const duration = this.getAttribute("data-quotation-dur");
            const tariffId = this.getAttribute("data-tariff-id");
            const tariffName = this.getAttribute("data-tariff-name");
            const tariffPrice = this.getAttribute("data-tariff-price");
            const birthDate = "<?php echo $quotation['birth_date']; ?>";
            const age = "<?php echo $quotation['age']; ?>";
            const durationText = duration == 1 ? 'یک سال' : 'دوسال';

            const message1 = `آفر_جدید\nشماره: ${quotationId}\nتاریخ تولد: ${birthDate}\nسن: ${age}\nمدت درخواست: ${durationText}\nاز شرکت: ${tariffName}\nکد تعرفه بیمه انتخابی: ${tariffId}`;
            const message2 = `*مبلغ قابل پرداخت: ${tariffPrice} لیر*`;
            const message3 = `\n👇👇`;
            const message4 = `\nلطفا جهت ادامه خرید، مبلغ قابل پرداخت را به شماره حساب زیر واریز`;
            const message7 = `\nZIRAAT BANK`;
            const message5 = `\n\nSEYEDVAHID ASADI`;
            const message6 = `\n\nTR500001009010244828505001 `;
            const message8 = `\n\nو با ارسال:`;
            const message9 = `\n🪪 تصویر پاسپورت یا کیملیک\n🏧  فیش واریزی`;
            const message10 = `\n📍 آدرس`;
            const message11 = `\n📆 تاریخ ‌شروع`;
            const message12 = `\nدر همین مکالمه،  منتظر صدور و دریافت بیمه نامه بین 5 تا 15دقیقه آینده باشید`;

            const finalMessage = `${message1}\n\n${message2}${message3}${message4}${message7}${message5}${message6}${message8}${message9}${message10}${message11}${message12}`;

            const whatsappUrl = `https://wa.me/905511737383?text=${encodeURIComponent(finalMessage)}`;
            window.open(whatsappUrl, "_blank");
        });
    });
</script>