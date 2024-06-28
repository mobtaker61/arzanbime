<h1>User Dashboard</h1>
<p><?php echo $profile['name'] . ' ' . $profile['surname']; ?>، خوش آمدی!</p>

<?php foreach ($quotaInfo as $quota) : ?>
    <div class="flex justify-between">
        <p><?php echo $quota['birth_date'];?></p>
        <p><?php echo $quota['age'];?></p>
        <p><?php echo $quota['duration'];?></p>
        <p><?php echo $quota['uid'];?></p>
    </div>
<?php endforeach; ?>


<table class="table table-striped">
    <thead>
        <tr>
            <th><a href="#" class="sortable" data-url="?page=<?php echo $page; ?>&limit=<?php echo $limit; ?>&sortField=id&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>&tel=<?php echo $filterTel; ?>&status=<?php echo $filterStatus; ?>">ID</a></th>
            <th><a href="#" class="sortable" data-url="?page=<?php echo $page; ?>&limit=<?php echo $limit; ?>&sortField=birth_date&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>&tel=<?php echo $filterTel; ?>&status=<?php echo $filterStatus; ?>">Birth Date</a></th>
            <th><a href="#" class="sortable" data-url="?page=<?php echo $page; ?>&limit=<?php echo $limit; ?>&sortField=age&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>&tel=<?php echo $filterTel; ?>&status=<?php echo $filterStatus; ?>">Age</a></th>
            <th><a href="#" class="sortable" data-url="?page=<?php echo $page; ?>&limit=<?php echo $limit; ?>&sortField=duration&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>&tel=<?php echo $filterTel; ?>&status=<?php echo $filterStatus; ?>">Duration</a></th>
            <th><a href="#" class="sortable" data-url="?page=<?php echo $page; ?>&limit=<?php echo $limit; ?>&sortField=status&sortOrder=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>&tel=<?php echo $filterTel; ?>&status=<?php echo $filterStatus; ?>">Status</a></th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($quotaInfo as $quotation): ?>
            <tr>
                <td><?php echo $quotation['id']; ?></td>
                <td><?php echo $quotation['birth_date']; ?></td>
                <td><?php echo $quotation['age']; ?></td>
                <td><?php echo $quotation['duration']; ?></td>
                <td><?php echo $quotation['status']; ?></td>
                <td>
                    <button class="btn btn-primary show-offers" data-id="<?php echo $quotation['id']; ?>" title="Show Offers"><i class="fas fa-file-alt"></i></button>
                    <button class="btn btn-primary view-details" data-id="<?php echo $quotation['id']; ?>" title="View Details"><i class="fas fa-eye"></i></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>