<div class="row">
    <div class="col-12">
        <h1>Companies</h1>
        <a href="/admin/companies/create" class="btn btn-primary">Create New Company</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Intro</th>
                    <th>Color</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($companies as $company): ?>
                    <tr>
                        <td><img src="<?php echo $company['logo']; ?>" alt="<?php echo $company['name']; ?>" class="img-thumbnail" width="100"></td>
                        <td><?php echo $company['name']; ?></td>
                        <td><?php echo $company['intro']; ?></td>
                        <td><span style="background-color: <?php echo $company['color']; ?>;">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                        <td><?php echo $company['is_active'] ? 'Yes' : 'No'; ?></td>
                        <td>
                            <a href="/admin/companies/edit/<?php echo $company['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="/admin/companies/delete/<?php echo $company['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
