<div class="row mb-3">
    <div class="col-md-6 d-flex align-items-center justify-content-start">
        <form id="filter-form" method="get" action="/admin/orders" class="d-flex form-group mr-3">
            <input type="date" name="date_start" class="form-control" value="<?php echo $filterDateStart; ?>">
            <input type="date" name="date_end" class="form-control ml-2" value="<?php echo $filterDateEnd; ?>">
            <select name="operator" class="form-control ml-2">
                <option value="">Select Operator</option>
                <?php foreach ($operators as $operator) : ?>
                    <option value="<?php echo $operator['id']; ?>" <?php echo $filterOperator == $operator['id'] ? 'selected' : ''; ?>><?php echo $operator['username']; ?></option>
                <?php endforeach; ?>
            </select>
            <select name="broker" class="form-control ml-2">
                <option value="">Select Broker</option>
                <?php foreach ($brokers as $broker) : ?>
                    <option value="<?php echo $broker['id']; ?>" <?php echo $filterBroker == $broker['id'] ? 'selected' : ''; ?>><?php echo $broker['title']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-secondary ml-2">Filter</button>
        </form>
    </div>
    <div class="col-md-6 d-flex align-items-center justify-content-end">
        <a href="/admin/orders/export" class="btn btn-primary">Export to Excel</a>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createOrderModal">سفارش جدید</button>
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
                        <div class="row mb-3"><!-- OPERATOR -->
                            <label class="col-sm-4 col-form-label" for="operator_user_id">درخواست کننده</label>
                            <div class="col-sm-8"> <select class="form-select" id="operator_user_id" name="operator_user_id" required>
                                    <?php foreach ($operators as $operator) : ?>
                                        <option value="<?php echo $operator['id']; ?>" data-user-level-id="<?php echo $operator['user_level_id']; ?>" <?php echo $operator['id'] == $_SESSION['user_id'] ? 'selected' : ''; ?>>
                                            <?php echo $operator['name']; ?> <?php echo $operator['surname']; ?> (<?php echo $operator['username']; ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3"><!-- USER -->
                            <label class="col-sm-4 col-form-label" for="user_id">مشتری</label>
                            <div class="col-sm-8">
                                <div class="d-flex">
                                    <div class="col-sm-8 p-0">
                                        <select class="form-select" id="user_id" name="user_id" required>
                                            <?php foreach ($users as $user) : ?>
                                                <option value="<?php echo $user['id']; ?>" data-age="<?php echo $user['age']; ?>">
                                                    <?php echo $user['username']; ?> (<?php echo $user['name']; ?> <?php echo $user['surname']; ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-2  p-0">
                                        <input type="text" class="form-control ml-2 text-center" id="age" name="age" placeholder="Age">
                                    </div>
                                    <div class="col-sm-2  p-0">
                                        <button type="button" class="btn btn-warning" id="add-new-user">جدید</button>
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
                                    <span class="input-group-text" id="basic-addon1">لیر</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label" for="payment">پرداختی</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text" id="user_com_rate">درصد</span>
                                    <input type="number" class="form-control numwc" id="payment" name="payment" required>
                                    <span class="input-group-text" id="basic-addon2">لیر</span>
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
                                    <option value="New">New</option>
                                    <option value="Following">Following</option>
                                    <option value="Canceled">Canceled</option>
                                    <option value="Rejected">Rejected</option>
                                    <option value="Finished">Finished</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add New User Modal -->
<div class="modal fade" id="addNewUserModal" tabindex="-1" role="dialog" aria-labelledby="addNewUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="add-new-user-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewUserModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="surname">Surname</label>
                        <input type="text" class="form-control" id="surname" name="surname" required>
                    </div>
                    <div class="form-group">
                        <label for="birth_date">Birth Date</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
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
        const operatorUserIdSelect = document.getElementById('operator_user_id');
        const userIdSelect = document.getElementById('user_id');
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
            const userLevelId = operatorUserIdSelect.selectedOptions[0].getAttribute('data-user-level-id');

            if (packageId && age && duration && userLevelId) {
                fetch(`/admin/tariffs/getTariff?package_id=${packageId}&age=${age}&duration=${duration}&user_level_id=${userLevelId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('tariff').value = Math.floor(data.tariff);
                        document.getElementById('payment').value = Math.floor(data.tariff - (data.tariff * data.commission_rate / 100));
                        document.getElementById('user_com_rate').innerText = data.commission_rate + ' درصد';
                        // Apply number formatting to new content
                        applyNumberFormatting();

                        // Fetch highest commission and set broker
                        fetch(`/admin/tariffs/getHighestCommission/${packageId}`)
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

            const userLevelId = operatorUserIdSelect.selectedOptions[0].getAttribute('data-user-level-id');
            formData.append('user_level_id', userLevelId);

            fetch('/admin/orders/store', {
                method: 'POST',
                body: formData
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    alert(data.message);
                    $('#createOrderModal').modal('hide');
                    location.reload();
                } else {
                    alert('Error creating order');
                }
            }).catch(error => console.error('Error:', error));
        });

        // Handle form submission for adding new user
        document.getElementById('add-new-user-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('/admin/users/store', {
                method: 'POST',
                body: formData
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    alert(data.message);
                    $('#addNewUserModal').modal('hide');

                    // Add new user to the user dropdown in the Create Order modal
                    const userDropdown = document.getElementById('user_id');
                    const newUserOption = document.createElement('option');
                    newUserOption.value = data.user.id;
                    newUserOption.text = `${data.user.name} ${data.user.surname}`;
                    userDropdown.appendChild(newUserOption);

                    // Set the new user as the selected option
                    userDropdown.value = data.user.id;

                    // Calculate age and set it to the age input
                    const birthDate = new Date(data.user.birth_date);
                    const today = new Date();
                    let age = today.getFullYear() - birthDate.getFullYear();
                    const monthDifference = today.getMonth() - birthDate.getMonth();
                    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }
                    document.getElementById('age').value = age;

                    // Show the Create Order modal
                    $('#createOrderModal').modal('show');
                } else {
                    alert('Error adding user');
                }
            }).catch(error => console.error('Error:', error));
        });

        // Handle add new user button click
        document.getElementById('add-new-user').addEventListener('click', function() {
            $('#addNewUserModal').modal('show');
        });

        // Handle user selection change
        userIdSelect.addEventListener('change', function() {
            const selectedUser = this.options[this.selectedIndex];
            const age = selectedUser.getAttribute('data-age');
            document.getElementById('age').value = age;
            calculateTariffAndPayment();
        });

        // Handle operator selection change
        operatorUserIdSelect.addEventListener('change', calculateTariffAndPayment);

        // Fetch package tariff and broker on package change
        packageIdSelect.addEventListener('change', calculateTariffAndPayment);
    });
</script>