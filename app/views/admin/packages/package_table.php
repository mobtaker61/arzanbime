<table class="table table-striped">
    <thead>
        <tr>
            <th><a href="#" class="sortable" data-url="?page=<?php echo $page; ?>&limit=<?php echo $limit; ?>&sortField=id&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>&company_id=<?php echo $selectedCompany; ?>">ID</a></th>
            <th><a href="#" class="sortable" data-url="?page=<?php echo $page; ?>&limit=<?php echo $limit; ?>&sortField=company_name&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>&company_id=<?php echo $selectedCompany; ?>">Company Name</a></th>
            <th><a href="#" class="sortable" data-url="?page=<?php echo $page; ?>&limit=<?php echo $limit; ?>&sortField=tip&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>&company_id=<?php echo $selectedCompany; ?>">Tip</a></th>
            <th><a href="#" class="sortable" data-url="?page=<?php echo $page; ?>&limit=<?php echo $limit; ?>&sortField=discount_rate&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>&company_id=<?php echo $selectedCompany; ?>">Discount Rate</a></th>
            <th><a href="#" class="sortable" data-url="?page=<?php echo $page; ?>&limit=<?php echo $limit; ?>&sortField=sort&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>&company_id=<?php echo $selectedCompany; ?>">Sort</a></th>
            <th><a href="#" class="sortable" data-url="?page=<?php echo $page; ?>&limit=<?php echo $limit; ?>&sortField=is_active&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>&company_id=<?php echo $selectedCompany; ?>">Active</a></th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($packages as $package): ?>
            <tr>
                <td><?php echo $package['id']; ?></td>
                <td><?php echo $package['company_name']; ?></td>
                <td><?php echo $package['tip']; ?></td>
                <td><?php echo $package['discount_rate']; ?></td>
                <td><?php echo $package['sort']; ?></td>
                <td><?php echo $package['is_active'] ? 'Yes' : 'No'; ?></td>
                <td>
                    <button class="btn btn-warning edit-package" data-id="<?php echo $package['id']; ?>">Edit</button>
                    <button class="btn btn-danger delete-package" data-id="<?php echo $package['id']; ?>">Delete</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<nav>
    <ul class="pagination">
        <?php for ($i = 1; $i <= ceil($totalPackages / $limit); $i++): ?>
            <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>&limit=<?php echo $limit; ?>&sortField=<?php echo $sortField; ?>&sortOrder=<?php echo $sortOrder; ?><?php echo $selectedCompany ? '&company_id=' . $selectedCompany : ''; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
