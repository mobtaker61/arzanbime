<?php
$pagetitle = "مدیریت سفارشات";
?>

<div class="row mb-3">
    <div class="col-md-6 d-flex align-items-center justify-content-start">
        <form id="filter-form" method="get" action="/agent/orders" class="d-flex form-group mr-3">
            <input type="date" name="date_start" class="form-control" value="<?php echo $filterDateStart; ?>">
            <input type="date" name="date_end" class="form-control ml-2" value="<?php echo $filterDateEnd; ?>">
            <select name="broker" class="form-control ml-2">
                <option value="">انتخاب بروکر</option>
                <?php foreach ($brokers as $broker) : ?>
                    <option value="<?php echo $broker['id']; ?>" <?php echo $filterBroker == $broker['id'] ? 'selected' : ''; ?>><?php echo $broker['title']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-secondary ml-2">فیلتر</button>
        </form>
    </div>
    <div class="col-md-6 d-flex align-items-center justify-content-end">
        <a href="/agent/orders/export" class="btn btn-primary">خروجی اکسل</a>
    </div>
</div>

<div id="order-table">
    <?php include 'order_table.php'; ?>
</div>

<!-- Create Order Modal -->
<div class="modal fade" id="createOrderModal" tabindex="-1" role="dialog" aria-labelledby="createOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card card-warning card-outline mb-4">
            <form id="create-order-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="createOrderModalLabel">سفارش جدید</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body card-body row">
                    <div class="col-md-6">
                        <div class="row mb-3"><!-- USER -->
                            <label class="col-sm-4 col-form-label" for="client_id">مشتری</label>
                            <div class="col-sm-8">
                                <div class="d-flex">
                                    <div class="col-sm-8 p-0">
                                        <select class="form-select" id="client_id" name="client_id" required>
                                            <option value="">انتخاب مشتری</option>
                                            <?php foreach ($clients as $client) : ?>
                                                <?php 
                                                    $birthDate = new DateTime($client['birth_date']);
                                                    $today = new DateTime();
                                                    $age = $birthDate->diff($today)->y;
                                                ?>
                                                <option value="<?php echo $client['id']; ?>" data-age="<?php echo $age; ?>">
                                                    <?php echo $client['name'] . ' ' . $client['family']; ?> (<?php echo $client['id_no']; ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-2 p-0">
                                        <input type="text" class="form-control ml-2 text-center" id="age" name="age" placeholder="سن">
                                    </div>
                                    <div class="col-sm-2 p-0">
                                        <button type="button" class="btn btn-warning" id="add-new-client">جدید</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label" for="package_id">پکیج انتخابی</label>
                            <div class="col-sm-8">
                                <select class="form-select" id="package_id" name="package_id" required>
                                    <option value="0">انتخاب پکیج</option>
                                    <?php foreach ($packages as $package) : ?>
                                        <option value="<?php echo $package['id']; ?>">
                                            <?php echo $package['company_name']; ?> (<?php echo $package['tip']; ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label" for="duration">مدت</label>
                            <div class="col-sm-8">
                                <div>
                                    <input class="btn-check" type="radio" id="duration_1" name="duration" value="1" checked>
                                    <label class="btn btn-outline-primary" for="duration_1">1 ساله</label>
                                    <input class="btn-check" type="radio" id="duration_2" name="duration" value="2">
                                    <label class="btn btn-outline-primary" for="duration_2">2 ساله</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label" for="start_date">محدوده تاریخ</label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                                    <span class="input-group-text"> تا </span>
                                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label" for="tariff">نرخ تعرفه</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="number" class="form-control numwc" id="tariff" name="tariff" required>
                                    <span class="input-group-text">لیر</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label" for="payment">پرداختی</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><span class="numwc" id="user_com_rate"></span> درصد</span>
                                    <input type="number" class="form-control numwc" id="payment" name="payment" required>
                                    <span class="input-group-text">لیر</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label" for="auxiliary_info">اطلاعات اضافه</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="auxiliary_info" name="auxiliary_info"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label" for="broker_id">بروکر</label>
                            <div class="col-sm-8">
                                <select class="form-select" id="broker_id" name="broker_id" required>
                                    <?php foreach ($brokers as $broker) : ?>
                                        <option value="<?php echo $broker['id']; ?>">
                                            <?php echo $broker['title']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label" for="status">وضعیت</label>
                            <div class="col-sm-8">
                                <select class="form-select" id="status" name="status" required>
                                    <option value="New">جدید</option>
                                    <option value="Following">در حال پیگیری</option>
                                    <option value="Canceled">لغو شده</option>
                                    <option value="Rejected">رد شده</option>
                                    <option value="Finished">تکمیل شده</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <button type="submit" class="btn btn-primary">ذخیره</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add New Client Modal -->
<div class="modal fade" id="addNewClientModal" tabindex="-1" role="dialog" aria-labelledby="addNewClientModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="add-new-client-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewClientModalLabel">مشتری جدید</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_no">کد ملی</label>
                        <input type="text" class="form-control" id="id_no" name="id_no" required>
                    </div>
                    <div class="form-group">
                        <label for="name">نام</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="family">نام خانوادگی</label>
                        <input type="text" class="form-control" id="family" name="family" required>
                    </div>
                    <div class="form-group">
                        <label for="birth_date">تاریخ تولد</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                    </div>
                    <div class="form-group">
                        <label for="email">ایمیل</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="phone">تلفن</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <button type="submit" class="btn btn-primary">ذخیره</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const urlParams = new URLSearchParams(window.location.search);
        const showModal = urlParams.get('showModal');

        if (showModal) {
            var myModal = new bootstrap.Modal(document.getElementById('createOrderModal'), {
                keyboard: false
            });
            myModal.show();
        }

        const createOrderModal = document.getElementById('createOrderModal');
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const durationInputs = document.querySelectorAll('input[name="duration"]');
        const clientIdSelect = document.getElementById('client_id');
        const packageIdSelect = document.getElementById('package_id');

        // Function to format date to yyyy-mm-dd
        function formatDate(date) {
            const d = new Date(date);
            let month = '' + (d.getMonth() + 1);
            let day = '' + d.getDate();
            const year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('-');
        }

        // Function to update end date
        function updateEndDate() {
            const startDate = new Date(startDateInput.value);
            const selectedDuration = document.querySelector('input[name="duration"]:checked').value;
            startDate.setFullYear(startDate.getFullYear() + parseInt(selectedDuration));
            endDateInput.value = formatDate(startDate);
        }

        // Function to calculate tariff and payment
        function calculateTariffAndPayment() {
            const packageId = packageIdSelect.value;
            const age = document.getElementById('age').value;
            const duration = document.querySelector('input[name="duration"]:checked').value;

            if (packageId && age && duration) {
                fetch(`/agent/tariffs/getTariff?package_id=${packageId}&age=${age}&duration=${duration}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('tariff').value = Math.floor(data.tariff);
                        document.getElementById('payment').value = Math.floor(data.tariff - (data.tariff * data.commission_rate / 100));
                        document.getElementById('user_com_rate').innerText = data.commission_rate;
                        // Apply number formatting to new content
                        applyNumberFormatting();

                        // Fetch highest commission and set broker
                        fetch(`/agent/tariffs/getHighestCommission/${packageId}`)
                            .then(response => response.json())
                            .then(commissionData => {
                                document.getElementById('broker_id').value = commissionData.broker_id;
                            })
                            .catch(error => console.error('Error fetching highest commission:', error));
                    })
                    .catch(error => console.error('Error fetching tariff:', error));
            }
        }

        // Set start date to today when modal is opened
        createOrderModal.addEventListener('shown.bs.modal', function() {
            const today = new Date();
            startDateInput.value = formatDate(today);
            updateEndDate(); // Update end date initially
        });

        // Update end date when duration changes
        durationInputs.forEach(input => {
            input.addEventListener('change', function() {
                updateEndDate();
                calculateTariffAndPayment();
            });
        });

        // Update end date when start date changes
        startDateInput.addEventListener('change', function() {
            updateEndDate();
            calculateTariffAndPayment();
        });

        // Handle form submission for creating new order
        document.getElementById('create-order-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('/agent/orders/store', {
                method: 'POST',
                body: formData
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    alert(data.message);
                    $('#createOrderModal').modal('hide');
                    location.reload();
                } else {
                    alert('خطا در ایجاد سفارش');
                }
            }).catch(error => console.error('Error:', error));
        });

        // Handle form submission for adding new client
        document.getElementById('add-new-client-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('/agent/clients/store', {
                method: 'POST',
                body: formData
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    alert(data.message);
                    $('#addNewClientModal').modal('hide');

                    // Add new client to the client dropdown in the Create Order modal
                    const clientDropdown = document.getElementById('client_id');
                    const newClientOption = document.createElement('option');
                    newClientOption.value = data.client.id;
                    newClientOption.text = `${data.client.name} ${data.client.family} (${data.client.id_no})`;
                    newClientOption.setAttribute('data-age', data.client.age);
                    clientDropdown.appendChild(newClientOption);

                    // Set the new client as the selected option
                    clientDropdown.value = data.client.id;

                    // Calculate age and set it to the age input
                    document.getElementById('age').value = data.client.age;

                    // Show the Create Order modal
                    $('#createOrderModal').modal('show');
                } else {
                    alert('خطا در افزودن مشتری');
                }
            }).catch(error => console.error('Error:', error));
        });

        // Handle add new client button click
        document.getElementById('add-new-client').addEventListener('click', function() {
            $('#addNewClientModal').modal('show');
        });

        // Handle client selection change
        clientIdSelect.addEventListener('change', function() {
            const selectedClient = this.options[this.selectedIndex];
            const age = selectedClient.getAttribute('data-age');
            document.getElementById('age').value = age;
            calculateTariffAndPayment();
        });

        // Fetch package tariff and broker on package change
        packageIdSelect.addEventListener('change', calculateTariffAndPayment);
    });
</script> 