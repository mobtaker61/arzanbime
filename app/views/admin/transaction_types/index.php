<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTransactionTypeModal">ایجاد نوع تراکنش جدید</button>
<table class="table table-striped mt-3">
    <thead>
        <tr>
            <th>شناسه</th>
            <th>نام</th>
            <th>توضیحات</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transactionTypes as $transactionType) : ?>
            <tr>
                <td><?php echo $transactionType['id']; ?></td>
                <td><?php echo $transactionType['name']; ?></td>
                <td><?php echo $transactionType['description']; ?></td>
                <td>
                    <button type="button" class="btn btn-warning edit-btn" data-id="<?php echo $transactionType['id']; ?>" data-name="<?php echo $transactionType['name']; ?>" data-description="<?php echo $transactionType['description']; ?>" data-bs-toggle="modal" data-bs-target="#editTransactionTypeModal">ویرایش</button>
                    <form action="/admin/transaction-types/delete/<?php echo $transactionType['id']; ?>" method="POST" style="display:inline;">
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Create Transaction Type Modal -->
<div class="modal fade" id="createTransactionTypeModal" tabindex="-1" role="dialog" aria-labelledby="createTransactionTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="create-transaction-type-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTransactionTypeModalLabel">ایجاد نوع تراکنش جدید</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="create-name">نام</label>
                        <input type="text" class="form-control" id="create-name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="create-description">توضیحات</label>
                        <textarea class="form-control" id="create-description" name="description"></textarea>
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

<!-- Edit Transaction Type Modal -->
<div class="modal fade" id="editTransactionTypeModal" tabindex="-1" role="dialog" aria-labelledby="editTransactionTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="edit-transaction-type-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTransactionTypeModalLabel">ویرایش نوع تراکنش</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="form-group">
                        <label for="edit-name">نام</label>
                        <input type="text" class="form-control" id="edit-name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-description">توضیحات</label>
                        <textarea class="form-control" id="edit-description" name="description"></textarea>
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
        // Handle form submission for creating new transaction type
        document.getElementById('create-transaction-type-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('/admin/transaction-types/store', {
                method: 'POST',
                body: formData
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    alert(data.message);
                    $('#createTransactionTypeModal').modal('hide');
                    location.reload();
                } else {
                    alert('خطا در ایجاد نوع تراکنش');
                }
            }).catch(error => console.error('Error:', error));
        });

        // Handle form submission for editing transaction type
        document.getElementById('edit-transaction-type-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('/admin/transaction-types/update/' + document.getElementById('edit-id').value, {
                method: 'POST',
                body: formData
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    alert(data.message);
                    $('#editTransactionTypeModal').modal('hide');
                    location.reload();
                } else {
                    alert('خطا در ویرایش نوع تراکنش');
                }
            }).catch(error => console.error('Error:', error));
        });

        // Fill edit modal with data
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('edit-id').value = this.getAttribute('data-id');
                document.getElementById('edit-name').value = this.getAttribute('data-name');
                document.getElementById('edit-description').value = this.getAttribute('data-description');
            });
        });
    });
</script>