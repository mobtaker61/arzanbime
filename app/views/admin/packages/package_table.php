<table class="table table-striped">
    <thead>
        <tr>
            <th><a href="#" class="sortable" data-url="?page=<?php echo $page; ?>&limit=<?php echo $limit; ?>&sortField=id&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>&company_id=<?php echo $selectedCompany; ?>">ID</a></th>
            <th><a href="#" class="sortable" data-url="?page=<?php echo $page; ?>&limit=<?php echo $limit; ?>&sortField=company_name&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>&company_id=<?php echo $selectedCompany; ?>">Company Name</a></th>
            <th><a href="#" class="sortable" data-url="?page=<?php echo $page; ?>&limit=<?php echo $limit; ?>&sortField=tip&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>&company_id=<?php echo $selectedCompany; ?>">Tip</a></th>
            <th><a href="#" class="sortable" data-url="?page=<?php echo $page; ?>&limit=<?php echo $limit; ?>&sortField=discount_rate&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>&company_id=<?php echo $selectedCompany; ?>">Discount Rate</a></th>
            <th><a href="#" class="sortable" data-url="?page=<?php echo $page; ?>&limit=<?php echo $limit; ?>&sortField=sort&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>&company_id=<?php echo $selectedCompany; ?>">Sort</a></th>
            <th><a href="#" class="sortable" data-url="?page=<?php echo $page; ?>&limit=<?php echo $limit; ?>&sortField=is_active&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>&company_id=<?php echo $selectedCompany; ?>">Active</a></th>
            <th>Color</th>
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
                <td><input type="color" value="<?php echo $package['color']; ?>" disabled></td>
                <td>
                    <button class="btn btn-primary view-tariffs" data-id="<?php echo $package['id']; ?>" title="View Tariffs"><i class="fas fa-dollar-sign"></i></button>
                    <button class="btn btn-warning edit-package" data-id="<?php echo $package['id']; ?>" title="Edit"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger delete-package" data-id="<?php echo $package['id']; ?>" title="Delete"><i class="fas fa-trash"></i></button>
                    <?php if ($package['has_tariffs'] == 0): ?>
                        <button class="btn btn-primary add-ages" data-id="<?php echo $package['id']; ?>" title="Add Ages"><i class="fas fa-plus"></i></button>
                    <?php endif; ?>
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