<table class="table table-bordered">
    <thead>
        <tr>
            <th>تاریخ</th>
            <th>نوع تراکنش</th>
            <th>سفارش</th>
            <th>کاربر</th>
            <th>بروکر</th>
            <th>شرح</th>
            <th>بدهکار</th>
            <th>بستانکار</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transactions as $transaction) : ?>
            <tr>
                <td><?php echo $transaction['transaction_date']; ?></td>
                <td><?php echo $transaction['type_name']; ?></td>
                <td><?php echo $transaction['order_id'] ? $transaction['order_id'] : 'بدون سفارش'; ?></td>
                <td><?php echo $transaction['user_username']; ?></td>
                <td><?php echo $transaction['broker_name']; ?></td>
                <td><?php echo $transaction['description']; ?></td>
                <td class="numwc"><?php echo $transaction['debit']; ?></td>
                <td class="numwc"><?php echo $transaction['credit']; ?></td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="editTransaction(<?php echo $transaction['id']; ?>)">ویرایش</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteTransaction(<?php echo $transaction['id']; ?>)">حذف</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    function deleteTransaction(id) {
        if (confirm('آیا از حذف این تراکنش مطمئن هستید؟')) {
            fetch('/admin/transactions/destroy/' + id, {
                method: 'DELETE'
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert('خطا در حذف تراکنش');
                }
            }).catch(error => console.error('Error:', error));
        }
    }

    function editTransaction(id) {
        fetch('/admin/transactions/edit/' + id).then(response => response.json()).then(data => {
            if (data.success) {
                const transaction = data.transaction;

                document.getElementById('edit-transaction-id').value = transaction.id;
                document.getElementById('edit-transaction-date').value = transaction.transaction_date;
                document.getElementById('edit-transaction-type-id').value = transaction.transaction_type_id;
                document.getElementById('edit-order-id').value = transaction.order_id || '';
                document.getElementById('edit-user-id').value = transaction.user_id;
                document.getElementById('edit-description').value = transaction.description;
                document.getElementById('edit-debit').value = transaction.debit;
                document.getElementById('edit-credit').value = transaction.credit;

                $('#editTransactionModal').modal('show');
            } else {
                alert('خطا در بارگذاری تراکنش');
            }
        }).catch(error => console.error('Error:', error));
    }
</script>
