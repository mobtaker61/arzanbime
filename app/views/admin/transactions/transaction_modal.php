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
                        <label for="transaction_date">تاریخ</label>
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
                        <label for="user_id">کاربر</label>
                        <select class="form-control" id="user_id" name="user_id" required>
                            <?php foreach ($users as $user) : ?>
                                <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
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
                        <label for="description">شرح</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="debit">بدهکار</label>
                        <input type="number" class="form-control" id="debit" name="debit" required>
                    </div>
                    <div class="form-group">
                        <label for="credit">بستانکار</label>
                        <input type="number" class="form-control" id="credit" name="credit" required>
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
                alert('خطا در ایجاد تراکنش');
            }
        }).catch(error => console.error('Error:', error));
    });
</script>
