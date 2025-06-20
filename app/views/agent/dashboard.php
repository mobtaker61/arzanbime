<?php
$pagetitle = "Agent Dashboard";
?>

<section class="pady center-sec">
    <!-- Info boxes -->
    <div class="row" id="info_box">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-primary shadow-sm">
                    <i class="bi bi-cart-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">تعداد سفارشات</span>
                    <span class="info-box-number numwc">
                        <?php echo $ordersCount; ?>
                        <small>سفارش</small>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-success shadow-sm">
                    <i class="bi bi-file-text-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">تعداد استعلامات</span>
                    <span class="info-box-number numwc">
                        <?php echo $quotationsCount; ?>
                        <small>استعلام</small>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-info shadow-sm">
                    <i class="bi bi-people-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">تعداد زیرمجموعه</span>
                    <span class="info-box-number numwc">
                        <?php echo $subUsersCount; ?>
                        <small>کاربر</small>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-warning shadow-sm">
                    <i class="bi bi-wallet-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">موجودی حساب</span>
                    <span class="info-box-number numwc">
                        <?php echo number_format($accountBalance); ?>
                        <small>لیر</small>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- نمودار -->
    <div class="row"><!-- SECTION 1 -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">پکیج‌های تخفیف‌دار</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>شرکت</th>
                                    <th>پکیج</th>
                                    <th>تخفیف</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($packageDiscounts as $discount): ?>
                                    <tr>
                                        <td>
                                            <?php if ($discount['company_icon']): ?>
                                                <img src="<?php echo $discount['company_icon']; ?>" style="width:24px;" alt="<?php echo $discount['company_name']; ?>">
                                            <?php endif; ?>
                                            <?php echo $discount['company_name']; ?>
                                        </td>
                                        <td><?php echo $discount['package_name']; ?></td>
                                        <td><span class="badge bg-success">% <?php echo number_format($discount['discount_rate']); ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">گزارش فروش تفکیکی</h5>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool days-selector text-bg-warning" data-days="7">7 روز</a>
                        <a href="#" class="btn btn-tool days-selector" data-days="15">15 روز</a>
                        <a href="#" class="btn btn-tool days-selector" data-days="30">30 روز</a>
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse"> <i data-lte-icon="expand" class="bi bi-plus-lg"></i> <i data-lte-icon="collapse" class="bi bi-dash-lg"></i> </button>
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-remove"> <i class="bi bi-x-lg"></i> </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div id="sales-chart"></div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-3 col-6">
                            <div class="text-center border-end">
                                <h5 id="total-sales" class="fw-bold mb-0 numwc">$0</h5>
                                <span class="text-uppercase">جمع فروش</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="text-center border-end">
                                <h5 id="total-expenses" class="fw-bold mb-0 numwc">$0</h5>
                                <span class="text-uppercase">جمع هزینه</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="text-center border-end">
                                <h5 id="total-orders" class="fw-bold mb-0 numwc">0</h5>
                                <span class="text-uppercase">تعداد فروش</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="text-center">
                                <h5 id="total-quotations" class="fw-bold mb-0 numwc">0</h5>
                                <span class="text-uppercase">تعداد استعلام</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row"> <!-- SECTION 2 -->
        <div class="col-md-8"> <!-- اخرین سفارشات -->
            <div class="card card-primary card-outline g-4 mb-4 last_order" style="min-height: 400px;">
                <div class="card-header">
                    <h3 class="card-title">آخرین سفارشات</h3>
                </div>
                <div class="card-body">
                    <table class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                <th>زمان</th>
                                <th>پکیج</th>
                                <th>بنام</th>
                                <th>پرداختی</th>
                                <th>وضعیت</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentOrders as $order) : ?>
                                <tr>
                                    <td><span class="dur_date"><?php echo $order['order_date']; ?></span></td>
                                    <td>
                                        <?php if ($order['company_icon']): ?>
                                            <img src="<?php echo $order['company_icon']; ?>" style="width:24px;" alt="<?php echo $order['company_name']; ?>">
                                        <?php endif; ?>
                                        <?php echo $order['package_name']; ?>
                                    </td>
                                    <td><?php echo $order['user_name'] . ' ' . $order['user_surname']; ?></td>
                                    <td><span class="numwc"><?php echo number_format($order['payment']); ?></span> لیر</td>
                                    <td>
                                        <span class="badge <?php echo $order['status'] === 'completed' ? 'bg-success' : 'bg-warning'; ?>">
                                            <?php echo $order['status'] === 'completed' ? 'تکمیل شده' : 'در حال بررسی'; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="clearfix">
                        <a href="/agent/orders" class="btn btn-sm btn-secondary float-end">همه</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4"> <!-- استعلام -->
            <div class="card card-primary g-4 mb-4 last_quotation" style="min-height: 400px;">
                <div class="card-header">
                    <h3 class="card-title">آخرین استعلامات</h3>
                </div>
                <div class="card-body">
                    <table class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                <th>کد</th>
                                <th>تاریخ</th>
                                <th>کاربر</th>
                                <th>سن</th>
                                <th>مدت</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentQuotations as $quotation) : ?>
                                <tr>
                                    <td><a href="/offers/<?php echo $quotation['uid']; ?>" target="new"><?php echo $quotation['id']; ?></a></td>
                                    <td><span class="dur_date"><?php echo $quotation['created_at']; ?></span></td>
                                    <td><?php echo $quotation['name'] . ' ' . $quotation['surname']; ?></td>
                                    <td><?php echo $quotation['age']; ?></td>
                                    <td><?php echo $quotation['duration'] == 1 ? 'یک' : 'دو'; ?> ساله</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="clearfix">
                        <a href="/agent/quotations/create" class="btn btn-sm btn-primary float-start">جدید</a>
                        <a href="/agent/quotations" class="btn btn-sm btn-secondary float-end">همه</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row"> <!-- SECTION 3 -->
        <div class="col-md-4"> <!-- Birthday Reminder -->
            <div class="card card-success g-4 mb-4 user_bdate" style="min-height: 400px;">
                <div class="card-header"> <!-- card header -->
                    <h3 class="card-title">تولدهای نزدیک</h3>
                </div>
                <div class="card-body"> <!-- card body -->
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>کاربر</th>
                                <th>تاریخ تولد</th>
                                <th>act</th>
                            </tr>
                        </thead>
                        <?php foreach ($usersWithUpcomingBirthdays as $user) : ?>
                            <tr>
                                <td><?php echo $user['name'] . ' ' . $user['surname']; ?></td>
                                <td><?php echo $user['birth_date']; ?></td>
                                <td>
                                    <button class="btn btn-sm btn-primary open-modal" data-name="<?php echo $user['name']; ?>" data-surname="<?php echo $user['surname']; ?>" data-birthdate="<?php echo $user['birth_date']; ?>" data-phone="<?php echo $user['phone']; ?>"><i class="bi bi-eye"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="birthdayModal" tabindex="-1" role="dialog" aria-labelledby="birthdayModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document" style="width: 618px;zoom: 70%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="birthdayModalLabel">پیام تبریک</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="modal-content">
                            <div id="tabrik_text" class="hbd_box" style="background-color: white;">
                                <div class="name">
                                    <p><span id="user-name"></span> عزیز</p>
                                </div>
                                <div class="text">
                                    <p>بهار زندگیتان را به شما تبریک میگوییم. امیدورایم، هر روز از زندگیتان سرشار از خوشحالی، سلامت و رضایت باشد.</p>
                                    <p>همچنین آرزو میکنیم،<br />هرگز از بیمه ای که میخرید استفاده نکنید!</p>
                                </div>
                                <div class="gift">
                                    <p>بعنوان هدیه، بمدت 1 هفته هر بیمه ای که برای خود یا هر شخصی که معرفی کنید شامل 70% تخفیف خواهد بود</p>
                                </div>
                            </div>
                            <div id="tabrik_sms" class="text-center" hidden>
                                <p><span id="user-name2"></span> عزیز</p>
                                <p>بهار زندگیتان را به شما تبریک میگوییم. امیدورایم، هر روز از زندگیتان سرشار از سلامت و خنده باشد.</p>
                                <p>بعنوان هدیه، بمدت 1 هفته هر بیمه ای که برای خود یا هر شخصی که معرفی کنید شامل 75% تخفیف خواهد بود</p>
                            </div>
                            <button id="download-image" class="btn btn-success mt-5 float-end">دانلود عکس</button>
                            <button id="send-sms" class="btn btn-info mt-5 float-end">ارسال پیامک</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4"> <!-- Renew Reminder -->
            <div class="card card-danger g-4 mb-4 renew_reminder" style="min-height: 400px;">
                <div class="card-header"> <!-- card header -->
                    <h3 class="card-title">یادآور تمدید</h3>
                </div>
                <div class="card-body"> <!-- card body -->
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>نماینده</th>
                                <th>بیمه شده</th>
                                <th>تاریخ انقضاء</th>
                                <th>act</th>
                            </tr>
                        </thead>
                        <?php foreach ($ordersExpiringSoon as $order) :
                            $isExpiringSoon = (strtotime($order['end_date']) >= strtotime("-10 days")) && (strtotime($order['end_date']) <= strtotime("now"));
                        ?>
                            <tr class="<?php echo $isExpiringSoon ? 'table-danger' : ''; ?>">
                                <td><?php echo $order['operator_username']; ?></td>
                                <td><?php echo $order['user_name'] . ' ' . $order['user_surname']; ?></td>
                                <td><?php echo $order['end_date']; ?></td>
                                <td>
                                    <button class="btn btn-sm btn-primary open-order-modal" data-id="<?php echo $order['id']; ?>" data-user-id="<?php echo $order['user_id']; ?>" data-operator="<?php echo $order['operator_name'] . ' ' . $order['operator_surname']; ?>" data-user="<?php echo $order['user_name'] . ' ' . $order['user_surname']; ?>" data-phone="<?php echo $order['phone']; ?>" data-birth-date="<?php echo $order['birth_date']; ?>" data-package="<?php echo $order['package_name']; ?>" data-company="<?php echo $order['company_name']; ?>" data-tariff="<?php echo $order['tariff']; ?>" data-payment="<?php echo $order['payment']; ?>" data-end-date="<?php echo $order['end_date']; ?>">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
            <!-- Order Info Modal -->
            <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="orderModalLabel">اطلاعات سفارش</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>نام اپراتور:</strong> <span id="modal-operator"></span></p>
                            <p><strong>کد کاربر:</strong> <span id="modal-userId"></span></p>
                            <p><strong>نام کاربر:</strong> <span id="modal-user"></span></p>
                            <p><strong>شماره تلفن:</strong> <span id="modal-phone"></span></p>
                            <p><strong>تاریخ تولد:</strong> <span id="modal-birthDate"></span></p>
                            <p><strong>سن:</strong> <span id="modal-age"></span></p>
                            <p><strong>نام پکیج:</strong> <span id="modal-package"></span></p>
                            <p><strong>نام شرکت:</strong> <span id="modal-company"></span></p>
                            <p><strong>تعرفه:</strong> <span id="modal-tariff"></span></p>
                            <p><strong>پرداخت:</strong> <span id="modal-payment"></span></p>
                            <p><strong>تاریخ انقضاء:</strong> <span id="modal-end-date"></span></p>
                            <button id="send-reminder" class="btn btn-warning">ارسال یادآور</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4"> <!-- Latest Transactions -->
            <div class="card card-info g-4 mb-4 latest_transactions" style="min-height: 400px;">
                <div class="card-header">
                    <h3 class="card-title">آخرین تراکنش‌ها</h3>
                </div>
                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>تاریخ</th>
                                <th>بدهکار</th>
                                <th>بستانکار</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($latestTransactions as $transaction) : ?>
                                <tr>
                                    <td><?php echo $transaction['transaction_date']; ?></td>
                                    <td><span class="numwc"><?php echo number_format($transaction['debit']); ?></span></td>
                                    <td><span class="numwc"><?php echo number_format($transaction['credit']); ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initial call to apply number formatting on page load
        applyNumberFormatting();

        // birthDay background color
        const today = new Date();
        const todayMonth = today.getMonth() + 1; // ماه‌ها از 0 شروع می‌شوند
        const todayDate = today.getDate();

        document.querySelectorAll('.user_bdate .table tbody tr').forEach(row => {
            const birthDateCell = row.querySelector('td:nth-child(2)').textContent;
            const birthDate = new Date(birthDateCell);
            const birthMonth = birthDate.getMonth() + 1;
            const birthDay = birthDate.getDate();

            if (birthMonth === todayMonth && birthDay === todayDate) {
                row.classList.add('table-success');
            }
        });
        const modal = new bootstrap.Modal(document.getElementById('birthdayModal'));

        document.querySelectorAll('.open-modal').forEach(button => {
            button.addEventListener('click', function() {
                const name = this.getAttribute('data-name');
                const surname = this.getAttribute('data-surname');
                const birthdate = this.getAttribute('data-birthdate');
                const phone = this.getAttribute('data-phone');

                document.getElementById('user-name').textContent = name + ' ' + surname;
                document.getElementById('user-name2').textContent = name + ' ' + surname;
                // document.getElementById('user-birthdate').textContent = birthdate;
                document.getElementById('send-sms').setAttribute('data-phone', phone);

                modal.show();
            });
        });

        document.getElementById('download-image').addEventListener('click', function() {
            htmlToImage.toPng(document.getElementById('tabrik_text'))
                .then(function(dataUrl) {
                    const link = document.createElement('a');
                    link.href = dataUrl;
                    link.download = 'birthday-message.png';
                    link.click();
                })
                .catch(function(error) {
                    console.error('oops, something went wrong!', error);
                });
        });

        document.getElementById('send-sms').addEventListener('click', function() {
            const phone = this.getAttribute('data-phone');
            const message = document.getElementById('tabrik_sms').textContent;

            fetch('/agent/sendSms', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({
                        phone: phone,
                        message: message
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('پیام با موفقیت ارسال شد.');
                    } else {
                        alert('خطا در ارسال پیام.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        // Handle opening order modal
        document.querySelectorAll('.open-order-modal').forEach(button => {
            button.addEventListener('click', function() {
                // Calculate age based on birth date
                const birthDate = new Date(this.getAttribute('data-birth-date'));
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const monthDifference = today.getMonth() - birthDate.getMonth();
                if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                document.getElementById('modal-operator').innerText = this.getAttribute('data-operator');
                document.getElementById('modal-user').innerText = this.getAttribute('data-user');
                document.getElementById('modal-userId').innerText = this.getAttribute('data-user-id');
                document.getElementById('modal-phone').innerText = this.getAttribute('data-phone');
                document.getElementById('modal-birthDate').innerText = this.getAttribute('data-birth-date');
                document.getElementById('modal-age').innerText = age;
                document.getElementById('modal-package').innerText = this.getAttribute('data-package');
                document.getElementById('modal-company').innerText = this.getAttribute('data-company');
                document.getElementById('modal-tariff').innerText = this.getAttribute('data-tariff');
                document.getElementById('modal-payment').innerText = this.getAttribute('data-payment');
                document.getElementById('modal-end-date').innerText = this.getAttribute('data-end-date');
                document.getElementById('orderModal').dataset.id = this.getAttribute('data-id');
                new bootstrap.Modal(document.getElementById('orderModal')).show();
            });
        });

        // Handle sending reminder
        document.getElementById('send-reminder').addEventListener('click', function() {
            const userId = document.getElementById('modal-userId').innerText;
            const birthDate = document.getElementById('modal-birthDate').innerText;
            const phone = document.getElementById('modal-phone').innerText;
            const age = document.getElementById('modal-age').innerText;
            const package = document.getElementById('modal-package').innerText;
            const company = document.getElementById('modal-company').innerText;
            const validate = document.getElementById('modal-end-date').innerText;

            // Create quotation
            fetch('/agent/quotations/createFromOrder', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        user_id: userId,
                        birth_date: birthDate,
                        tel: phone,
                        age: age,
                        duration: 1
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const quotationLink = window.location.origin + '/offers/' + data.quotationId;
                        const message = 'یادآوری تمدید: بیمه اقامتی شما با پکیج ' + company + ' - ' + package + ' تا تاریخ ' + validate + ' معتبر است.\n\nاستعلام شما: ' + quotationLink + '\nارزان بیمه';

                        // Send SMS
                        fetch('/agent/sendSms', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    phone: phone,
                                    message: message
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert('یادآور با موفقیت ارسال شد.');
                                } else {
                                    alert('خطا در ارسال یادآور.');
                                }
                            });
                    } else {
                        alert('خطا در ایجاد استعلام.');
                    }
                });
        });

        // Load CHART Data
        function fetchChartData(days) {
            fetch(`/agent/getChartData?days=${days}`)
                .then(response => response.json())
                .then(data => {
                    updateChart(data.dates, data.data);
                    updateFooterStats(data.totalSales, data.totalExpenses, data.totalOrders, data.totalQuotations);
                })
                .catch(error => console.error('Error fetching chart data:', error));
        }

        function updateChart(dates, data) {
            const seriesData = Object.keys(data).map(company => {
                return {
                    name: company,
                    data: dates.map(date => data[company][date] || 0)
                };
            });

            chart.updateOptions({
                series: seriesData,
                xaxis: {
                    categories: dates
                }
            });
        }

        function updateFooterStats(totalSales, totalExpenses, totalOrders, totalQuotations) {
            document.getElementById('total-sales').textContent = `${totalSales}`;
            document.getElementById('total-expenses').textContent = `${totalExpenses}`;
            document.getElementById('total-orders').textContent = totalOrders;
            document.getElementById('total-quotations').textContent = totalQuotations;
            applyNumberFormatting();

        }

        const options = {
            chart: {
                height: 280,
                type: 'area',
                toolbar: {
                    show: false,
                },
            },
            stroke: {
                curve: "smooth",
            },
            series: [],
            xaxis: {
                type: "datetime",
                categories: []
            },
            yaxis: {
                stepSize: 1,
            }
        };

        const chart = new ApexCharts(document.querySelector("#sales-chart"), options);
        chart.render();

        document.querySelectorAll('.days-selector').forEach(function(el) {
            el.addEventListener('click', function(e) {
                e.preventDefault();
                // Remove 'selected' class from all buttons
                document.querySelectorAll('.days-selector').forEach(function(btn) {
                    btn.classList.remove('text-bg-warning');
                });
                // Add 'selected' class to the clicked button
                this.classList.add('text-bg-warning');

                const days = this.getAttribute('data-days');
                fetchChartData(days);
            });
        });

        // Load default chart data for 7 days
        fetchChartData(7);
    });
    document.addEventListener('DOMContentLoaded', function() {
        // Handle payment type change
        document.querySelectorAll('input[name="payment_type"]').forEach(function(element) {
            element.addEventListener('change', function() {
                const paymentType = this.value;
                const selectElement = document.getElementById('select_id');

                fetch(`/agent/get${paymentType === 'broker' ? 'Brokers' : 'Users'}`)
                    .then(response => response.json())
                    .then(data => {
                        selectElement.innerHTML = '';
                        data.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.id;
                            option.text = paymentType === 'broker' ? item.title : `${item.name} ${item.surname}`;
                            selectElement.appendChild(option);
                        });
                    });
            });
        });

        // Handle form submission
        document.getElementById('quick-payment-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            const paymentType = document.querySelector('input[name="payment_type"]:checked').value;

            fetch(`/agent/fast/${paymentType === 'broker' ? 'broker-transactions' : 'transactions'}`, {
                    method: 'POST',
                    body: formData
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('پرداخت با موفقیت ثبت شد.');
                        location.reload();
                    } else {
                        alert('خطایی رخ داده است.');
                    }
                }).catch(error => console.error('Error:', error));
        });
    });
</script>