<div class="row mb-3">
    <div class="col-md-6 d-flex align-items-center justify-content-start">
        <form id="filter-form" method="get" action="/admin/broker_transactions" class="d-flex form-group mr-3">
            <input type="date" name="date_start" class="form-control" value="<?php echo $filterDateStart; ?>">
            <input type="date" name="date_end" class="form-control ml-2" value="<?php echo $filterDateEnd; ?>">
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
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBrokerTransactionModal">
            ایجاد تراکنش بروکر جدید
        </button>
    </div>
</div>
<div id="transaction-table">
    <?php include 'broker_transaction_table.php'; ?>
</div>

<!-- Create Broker Transaction Modal -->
<div class="modal fade" id="createBrokerTransactionModal" tabindex="-1" role="dialog" aria-labelledby="createBrokerTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="create-broker-transaction-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="createBrokerTransactionModalLabel">ایجاد تراکنش بروکر جدید</h5>
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
                        <label for="broker_id">بروکر</label>
                        <select class="form-control" id="broker_id" name="broker_id" required>
                            <?php foreach ($brokers as $broker) : ?>
                                <option value="<?php echo $broker['id']; ?>"><?php echo $broker['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="order_id">کد سفارش</label>
                        <input type="number" class="form-control" id="order_id" name="order_id">
                    </div>
                    <div class="form-group">
                        <label for="description">شرح</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="debit">بدهکار</label>
                        <input type="number" class="form-control" id="debit" name="debit">
                    </div>
                    <div class="form-group">
                        <label for="credit">بستانکار</label>
                        <input type="number" class="form-control" id="credit" name="credit">
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

<!-- Edit Broker Transaction Modal -->
<div class="modal fade" id="editBrokerTransactionModal" tabindex="-1" role="dialog" aria-labelledby="editBrokerTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="edit-broker-transaction-form">
                <input type="hidden" id="edit_transaction_id" name="transaction_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBrokerTransactionModalLabel">ویرایش تراکنش بروکر</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_transaction_date">تاریخ تراکنش</label>
                        <input type="date" class="form-control" id="edit_transaction_date" name="transaction_date" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_transaction_type_id">نوع تراکنش</label>
                        <select class="form-control" id="edit_transaction_type_id" name="transaction_type_id" required>
                            <?php foreach ($transactionTypes as $type) : ?>
                                <option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_broker_id">بروکر</label>
                        <select class="form-control" id="edit_broker_id" name="broker_id" required>
                            <?php foreach ($brokers as $broker) : ?>
                                <option value="<?php echo $broker['id']; ?>"><?php echo $broker['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_order_id">کد سفارش</label>
                        <input type="number" class="form-control" id="edit_order_id" name="order_id">
                    </div>
                    <div class="form-group">
                        <label for="edit_description">شرح</label>
                        <textarea class="form-control" id="edit_description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_debit">بدهکار</label>
                        <input type="number" class="form-control" id="edit_debit" name="debit">
                    </div>
                    <div class="form-group">
                        <label for="edit_credit">بستانکار</label>
                        <input type="number" class="form-control" id="edit_credit" name="credit">
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
        // Handle form submission for creating broker transaction
        document.getElementById('create-broker-transaction-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('/admin/broker_transactions/store', {
                method: 'POST',
                body: formData
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    alert(data.message);
                    $('#createBrokerTransactionModal').modal('hide');
                    location.reload();
                } else {
                    alert('Error creating broker transaction');
                }
            }).catch(error => console.error('Error:', error));
        });

        // Handle form submission for editing broker transaction
        document.getElementById('edit-broker-transaction-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            const transactionId = document.getElementById('edit_transaction_id').value;

            fetch(`/admin/broker_transactions/update/${transactionId}`, {
                method: 'POST',
                body: formData
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    alert(data.message);
                    $('#editBrokerTransactionModal').modal('hide');
                    location.reload();
                } else {
                    alert('Error updating broker transaction');
                }
            }).catch(error => console.error('Error:', error));
        });

        // Handle edit button click
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const transactionId = this.getAttribute('data-id');
                
                fetch(`/admin/broker_transactions/edit/${transactionId}`).then(response => response.json()).then(data => {
                    document.getElementById('edit_transaction_id').value = data.id;
                    document.getElementById('edit_transaction_date').value = data.transaction_date;
                    document.getElementById('edit_transaction_type_id').value = data.transaction_type_id;
                    document.getElementById('edit_broker_id').value = data.broker_id;
                    document.getElementById('edit_order_id').value = data.order_id;
                    document.getElementById('edit_description').value = data.description;
                    document.getElementById('edit_debit').value = data.debit;
                    document.getElementById('edit_credit').value = data.credit;

                    $('#editBrokerTransactionModal').modal('show');
                }).catch(error => console.error('Error fetching broker transaction data:', error));
            });
        });

        // Set current date for transaction date input when the create modal is shown
        $('#createBrokerTransactionModal').on('shown.bs.modal', function() {
            document.getElementById('transaction_date').value = new Date().toISOString().split('T')[0];
        });
    });
</script>
