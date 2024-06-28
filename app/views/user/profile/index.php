<!-- user/profile/index.php -->
<?php $pagetitle = "User Profiles"; ?>
<div class="container">
    <h1>User Profiles</h1>
    <a href="/user/profile/create" class="btn btn-primary">Create Profile</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($profiles as $profile) : ?>
                <tr>
                    <td><?php echo $profile['name']; ?></td>
                    <td><?php echo $profile['surname']; ?></td>
                    <td><?php echo $profile['email']; ?></td>
                    <td><?php echo $profile['phone']; ?></td>
                    <td>
                        <a href="/user/profile/edit/<?php echo $profile['user_id']; ?>" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
