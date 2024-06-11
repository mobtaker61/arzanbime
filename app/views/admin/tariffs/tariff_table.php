<table class="table table-striped">
    <thead>
        <tr>
            <th data-sort-field="id" data-package-id="<?php echo $packageId; ?>" class="sortable">ID</th>
            <th data-sort-field="company_name" data-package-id="<?php echo $packageId; ?>" class="sortable">Company</th>
            <th data-sort-field="package_tip" data-package-id="<?php echo $packageId; ?>" class="sortable">Package</th>
            <th data-sort-field="age" data-package-id="<?php echo $packageId; ?>" class="sortable">Age</th>
            <th>First Year</th>
            <th>Second Year</th>
            <th>Two Year</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tariffs as $tariff): ?>
            <tr data-id="<?php echo $tariff['id']; ?>">
                <td><?php echo $tariff['id']; ?></td>
                <td><?php echo $tariff['company_name']; ?></td>
                <td><?php echo $tariff['package_tip']; ?></td>
                <td><?php echo $tariff['age']; ?></td>
                <td class="editable" data-field="first_year"><?php echo $tariff['first_year']; ?></td>
                <td class="editable" data-field="second_year"><?php echo $tariff['second_year']; ?></td>
                <td class="two-year"><?php echo $tariff['two_year']; ?></td>
                <td>
                    <button class="btn btn-warning edit-tariff" data-id="<?php echo $tariff['id']; ?>" title="Edit"><i class="fas fa-edit"></i></button>
                    <!-- <button class="btn btn-danger delete-tariff" data-id="<?php echo $tariff['id']; ?>" title="Delete"><i class="fas fa-trash"></i></button> -->
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
$totalPages = ceil($totalTariffs / $limit);
?>

<nav aria-label="Page navigation">
    <ul class="pagination tariff-pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                <a class="page-link tariff-page-link" href="#" data-page="<?php echo $i; ?>" data-package-id="<?php echo $packageId; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
