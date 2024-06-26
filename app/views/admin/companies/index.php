<div class="row">
    <div class="col-12">
        <a href="/admin/companies/create" class="btn btn-primary mb-3">Create New Company</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>icon</th>
                    <th>Name</th>
                    <th>Intro</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($companies as $company): ?>
                    <tr>
                        <td><?php echo $company['id']; ?></td>
                        <td><img src="<?php echo $company['icon']; ?>" class="img-thumbnail" style="max-width: 100px;"/></td>
                        <td><?php echo $company['name']; ?></td>
                        <td><?php echo $company['intro']; ?></td>
                        <td>
                            <a href="/admin/companies/edit/<?php echo $company['id']; ?>" class="btn btn-warning"title="Edit"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-danger delete-company" data-id="<?php echo $company['id']; ?>"title="Delete"><i class="fas fa-trash"></i></button>
                            <a href="/admin/packages/company/<?php echo $company['id']; ?>" class="btn btn-info">Packages</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.delete-company').forEach(button => {
        button.addEventListener('click', function() {
            const companyId = this.getAttribute('data-id');
            if (confirm('Are you sure you want to delete this company?')) {
                fetch(`/admin/companies/delete/${companyId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                }).then(result => {
                    if (result.success) {
                        alert('Company deleted successfully.');
                        location.reload();
                    } else {
                        alert('Error: ' + result.message);
                    }
                }).catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    });
});
</script>