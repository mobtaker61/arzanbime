<table class="table table-striped">
    <thead>
        <tr>
            <th><a href="#" class="sortable" data-url="?sortField=id&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>">ID</a></th>
            <th><a href="#" class="sortable" data-url="?sortField=company_name&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>">Company</a></th>
            <th><a href="#" class="sortable" data-url="?sortField=package_tip&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>">Package</a></th>
            <th><a href="#" class="sortable" data-url="?sortField=age&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>">Age</a></th>
            <th><a href="#" class="sortable" data-url="?sortField=first_year&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>">First Year</a></th>
            <th><a href="#" class="sortable" data-url="?sortField=second_year&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>">Second Year</a></th>
            <th><a href="#" class="sortable" data-url="?sortField=two_year&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>">Two Year</a></th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tariffs as $tariff): ?>
            <tr>
                <td><?php echo $tariff['id']; ?></td>
                <td><?php echo $tariff['company_name']; ?></td>
                <td><?php echo $tariff['package_tip']; ?></td>
                <td><?php echo $tariff['age']; ?></td>
                <td><?php echo $tariff['first_year']; ?></td>
                <td><?php echo $tariff['second_year']; ?></td>
                <td><?php echo $tariff['two_year']; ?></td>
                <td>
                    <button class="btn btn-warning edit-tariff" data-id="<?php echo $tariff['id']; ?>">Edit</button>
                    <button class="btn btn-danger delete-tariff" data-id="<?php echo $tariff['id']; ?>">Delete</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<nav>
    <ul class="pagination">
        <?php for ($i = 1; $i <= ceil($totalTariffs / $limit); $i++): ?>
            <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                <a class="page-link" href="#" data-page="<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
