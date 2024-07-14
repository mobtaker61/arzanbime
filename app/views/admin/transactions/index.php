<div class="row mb-3">
    <div class="col-md-6 d-flex align-items-center justify-content-start">
        <form id="filter-form" method="get" action="/admin/transactions" class="d-flex form-group mr-3">
            <input type="date" name="date_start" class="form-control" value="<?php echo $filterDateStart; ?>">
            <input type="date" name="date_end" class="form-control ml-2" value="<?php echo $filterDateEnd; ?>">
            <select name="user_id" class="form-control ml-2">
                <option value="">انتخاب کاربر</option>
                <?php foreach ($users as $user) : ?>
                    <option value="<?php echo $user['id']; ?>" <?php echo $filterUserId == $user['id'] ? 'selected' : ''; ?>><?php echo $user['username']; ?></option>
                <?php endforeach; ?>
            </select>
            <select name="broker_id" class="form-control ml-2">
                <option value="">انتخاب بروکر</option>
                <?php foreach ($brokers as $broker) : ?>
                    <option value="<?php echo $broker['id']; ?>" <?php echo $filterBrokerId == $broker['id'] ? 'selected' : ''; ?>><?php echo $broker['title']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-secondary ml-2">فیلتر</button>
        </form>
    </div>
    <div class="col-md-6 d-flex align-items-center justify-content-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTransactionModal">
            ایجاد تراکنش جدید
        </button>
    </div>
</div>
<div id="transaction-table">
    <?php include 'transaction_table.php'; ?>
</div>

<!-- Create Transaction Modal -->
<div class="modal fade" id="createTransactionModal" tabindex="-1" role="dialog" aria-labelledby="createTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="create-transaction-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTransactionModalLabel">ایجاد تراکنش جدید</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="transaction_date">تاریخ تراکنش</label>
                        <input type="date" class="form-control" id="transaction_date" name="transaction_date" required>
                    </div>
                    <div class="form-group">
                        <label for="transaction_type_id">نوع تراکنش</label>
                        <select class="form-control" id="transaction_type_id" name="transaction_type_id" required>
                            <?php foreach ($transactionTypes as $type) : ?>
                                <option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="order_id">سفارش</label>
                        <select class="form-control" id="order_id" name="order_id">
                            <option value="">بدون سفارش</option>
                            <?php foreach ($orders as $order) : ?>
                                <option value="<?php echo $order['id']; ?>"><?php echo $order['id']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="user_id">کد کاربر</label>
                        <select class="form-control" id="user_id" name="user_id" required>
                            <?php foreach ($users as $user) : ?>
                                <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">شرح</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="debit">بدهکار</label>
                        <input type="number" class="form-control numwc" id="debit" name="debit" value="0" required>
                    </div>
                    <div class="form-group">
                        <label for="credit">بستانکار</label>
                        <input type="number" class="form-control numwc" id="credit" name="credit" value="0" required>
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

<!-- Edit Transaction Modal -->
<div class="modal fade" id="editTransactionModal" tabindex="-1" role="dialog" aria-labelledby="editTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="edit-transaction-form">
                <input type="hidden" id="edit-transaction-id" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTransactionModalLabel">ویرایش تراکنش</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-transaction-date">تاریخ تراکنش</label>
                        <input type="date" class="form-control" id="edit-transaction-date" name="transaction_date" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-transaction-type-id">نوع تراکنش</label>
                        <select class="form-control" id="edit-transaction-type-id" name="transaction_type_id" required>
                            <?php foreach ($transactionTypes as $type) : ?>
                                <option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-order-id">کد سفارش</label>
                        <input type="text" class="form-control" id="edit-order-id" name="order_id">
                    </div>
                    <div class="form-group">
                        <label for="edit-user-id">کد کاربر</label>
                        <select class="form-control" id="edit-user-id" name="user_id" required>
                            <?php foreach ($users as $user) : ?>
                                <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-description">شرح</label>
                        <textarea class="form-control" id="edit-description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit-debit">بدهکار</label>
                        <input type="number" class="form-control" id="edit-debit" name="debit" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-credit">بستانکار</label>
                        <input type="number" class="form-control" id="edit-credit" name="credit" required>
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
        // Set today's date in transaction_date when modal is shown
        $('#createTransactionModal').on('show.bs.modal', function(event) {
            var today = new Date().toISOString().split('T')[0];
            document.getElementById('transaction_date').value = today;
        });

        // Handle form submission for creating new transaction
        document.getElementById('create-transaction-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('/admin/transactions/store', {
                method: 'POST',
                body: formData
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    alert(data.message);
                    $('#createTransactionModal').modal('hide');
                    location.reload();
                } else {
                    alert('Error creating transaction');
                }
            }).catch(error => console.error('Error:', error));
        });

        // Handle form submission for editing transaction
        document.getElementById('edit-transaction-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            const transactionId = document.getElementById('edit-transaction-id').value;

            fetch(`/admin/transactions/update/${transactionId}`, {
                method: 'POST',
                body: formData
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    alert(data.message);
                    $('#editTransactionModal').modal('hide');
                    location.reload();
                } else {
                    alert('Error updating transaction');
                }
            }).catch(error => console.error('Error:', error));
        });

        // Load transaction data into edit modal
        $('#editTransactionModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var transactionId = button.data('id');

            fetch(`/admin/transactions/${transactionId}`).then(response => response.json()).then(data => {
                if (data.success) {
                    document.getElementById('edit-transaction-id').value = data.transaction.id;
                    document.getElementById('edit-transaction-date').value = data.transaction.transaction_date;
                    document.getElementById('edit-transaction-type-id').value = data.transaction.transaction_type_id;
                    document.getElementById('edit-order-id').value = data.transaction.order_id;
                    document.getElementById('edit-user-id').value = data.transaction.user_id;
                    document.getElementById('edit-description').value = data.transaction.description;
                    document.getElementById('edit-debit').value = data.transaction.debit;
                    document.getElementById('edit-credit').value = data.transaction.credit;
                } else {
                    alert('Error loading transaction data');
                    $('#editTransactionModal').modal('hide');
                }
            }).catch(error => console.error('Error:', error));
        });
    });
</script>