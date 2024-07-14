<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Order Date</th>
            <th>Operator</th>
            <th>User</th>
            <th>Package</th>
            <th>Tariff</th>
            <th>Payment</th>
            <th>Duration</th>
            <th>End Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order) : ?>
            <tr>
                <td><?php echo $order['id']; ?></td>
                <td><?php echo $order['order_date']; ?></td>
                <td><?php echo $order['operator_username']; ?> (<?php echo $order['operator_name']; ?> <?php echo $order['operator_surname']; ?>)</td>
                <td><?php echo $order['user_username']; ?> (<?php echo $order['user_name']; ?> <?php echo $order['user_surname']; ?>)</td>
                <td><?php echo $order['company_name'] . ' - ' . $order['package_name']; ?></td>
                <td class="numwc"><?php echo $order['tariff']; ?></td>
                <td class="numwc"><?php echo $order['payment']; ?></td>
                <td><?php echo $order['duration']; ?> ساله</td>
                <td><?php echo $order['end_date']; ?></td>
                <td><?php echo $order['status']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<nav>
    <ul class="pagination">
        <?php for ($i = 1; $i <= ceil($totalOrders / $limit); $i++) : ?>
            <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>&limit=<?php echo $limit; ?>&sortField=<?php echo $sortField; ?>&sortOrder=<?php echo $sortOrder; ?>&date_start=<?php echo $filterDateStart; ?>&date_end=<?php echo $filterDateEnd; ?>&operator=<?php echo $filterOperator; ?>&broker=<?php echo $filterBroker; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>