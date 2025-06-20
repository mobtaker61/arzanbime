<table class="table table-bordered">
    <thead>
        <tr>
            <th>تاریخ</th>
            <th>مشتری</th>
            <th>پکیج</th>
            <th>بروکر</th>
            <th>تعرفه</th>
            <th>پرداختی</th>
            <th>مدت</th>
            <th>تاریخ انقضاء</th>
            <th>وضعیت</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order) : ?>
            <tr>
                <td><?php echo $order['order_date']; ?></td>
                <td>
                    <?php echo $order['user_name'] . ' ' . $order['user_surname']; ?>
                    <br>
                    <small class="text-muted"><?php echo $order['user_username']; ?></small>
                </td>
                <td>
                    <?php if ($order['company_icon']): ?>
                        <img src="<?php echo $order['company_icon']; ?>" style="width:24px;" alt="<?php echo $order['company_name']; ?>">
                    <?php endif; ?>
                    <?php echo $order['package_name']; ?>
                </td>
                <td><?php echo $order['broker_name']; ?></td>
                <td><span class="numwc"><?php echo number_format($order['tariff']); ?></span></td>
                <td><span class="numwc"><?php echo number_format($order['payment']); ?></span></td>
                <td><?php echo $order['duration']; ?> ساله</td>
                <td><?php echo $order['end_date']; ?></td>
                <td>
                    <span class="badge <?php 
                        switch($order['status']) {
                            case 'Finished':
                                echo 'bg-success';
                                break;
                            case 'Following':
                                echo 'bg-warning';
                                break;
                            case 'Rejected':
                                echo 'bg-danger';
                                break;
                            case 'Canceled':
                                echo 'bg-secondary';
                                break;
                            default:
                                echo 'bg-info';
                        }
                    ?>">
                        <?php 
                            switch($order['status']) {
                                case 'Finished':
                                    echo 'تکمیل شده';
                                    break;
                                case 'Following':
                                    echo 'در حال پیگیری';
                                    break;
                                case 'Rejected':
                                    echo 'رد شده';
                                    break;
                                case 'Canceled':
                                    echo 'لغو شده';
                                    break;
                                default:
                                    echo 'جدید';
                            }
                        ?>
                    </span>
                </td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="editOrder(<?php echo $order['id']; ?>)">ویرایش</button>
                    <?php if ($order['status'] !== 'Finished'): ?>
                        <button class="btn btn-sm btn-danger" onclick="deleteOrder(<?php echo $order['id']; ?>)">حذف</button>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="d-flex justify-content-between align-items-center mt-3">
    <div>
        نمایش <?php echo $limit; ?> مورد از <?php echo $totalOrders; ?> مورد
    </div>
    <div>
        <?php
        $totalPages = ceil($totalOrders / $limit);
        if ($totalPages > 1):
        ?>
        <nav>
            <ul class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&date_start=<?php echo $filterDateStart; ?>&date_end=<?php echo $filterDateEnd; ?>&broker=<?php echo $filterBroker; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
        <?php endif; ?>
    </div>
</div>

<script>
    function deleteOrder(id) {
        if (confirm('آیا از حذف این سفارش مطمئن هستید؟')) {
            fetch('/agent/orders/destroy/' + id, {
                method: 'DELETE'
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert('خطا در حذف سفارش');
                }
            }).catch(error => console.error('Error:', error));
        }
    }

    function editOrder(id) {
        fetch('/agent/orders/edit/' + id).then(response => response.json()).then(data => {
            if (data.success) {
                const order = data.order;

                document.getElementById('user_id').value = order.user_id;
                document.getElementById('package_id').value = order.package_id;
                document.getElementById('duration_' + order.duration).checked = true;
                document.getElementById('start_date').value = order.start_date;
                document.getElementById('end_date').value = order.end_date;
                document.getElementById('tariff').value = order.tariff;
                document.getElementById('payment').value = order.payment;
                document.getElementById('auxiliary_info').value = order.auxiliary_info;
                document.getElementById('broker_id').value = order.broker_id;
                document.getElementById('status').value = order.status;

                $('#createOrderModal').modal('show');
            } else {
                alert('خطا در بارگذاری سفارش');
            }
        }).catch(error => console.error('Error:', error));
    }
</script> 