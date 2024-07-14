<?php if (!empty($transactions)) : ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>تاریخ تراکنش</th>
                <th>نوع تراکنش</th>
                <th>بروکر</th>
                <th>کد سفارش</th>
                <th>شرح</th>
                <th>بدهکار</th>
                <th>پرداخت</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction) : ?>
                <tr>
                    <td><?php echo $transaction['transaction_date']; ?></td>
                    <td><?php echo $transaction['type_name']; ?></td>
                    <td><?php echo $transaction['broker_name']; ?></td>
                    <td><?php echo $transaction['order_id'] ? $transaction['order_id'] : 'ندارد'; ?></td>
                    <td><?php echo $transaction['description']; ?></td>
                    <td class="numwc"><?php echo $transaction['debit']; ?></td>
                    <td class="numwc"><?php echo $transaction['credit']; ?></td>
                    <td>
                        <button type="button" class="btn btn-warning edit-btn" data-id="<?php echo $transaction['id']; ?>">ویرایش</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <p>هیچ تراکنشی یافت نشد.</p>
<?php endif; ?>
