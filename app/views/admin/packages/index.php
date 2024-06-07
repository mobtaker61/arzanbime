<div class="row mb-3">
    <div class="col-md-6 d-flex align-items-center justify-content-start">
        <form id="filter-form" method="get" action="/admin/packages" class="d-flex form-group mr-3">
            <select name="company_id" id="company_id" class="form-control">
                <option value="">All Companies</option>
                <?php foreach ($companies as $company): ?>
                    <option value="<?php echo $company['id']; ?>" <?php echo $company['id'] == $selectedCompany ? 'selected' : ''; ?>><?php echo $company['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-secondary ml-2">Filter</button>
        </form>
    </div>
    <div class="col-md-6 d-flex align-items-center justify-content-end">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createPackageModal">Create New Package</button>
    </div>
</div>

<div id="package-table">
    <?php include 'package_table.php'; ?>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createPackageModal" tabindex="-1" role="dialog" aria-labelledby="createPackageModalLabel" aria-hidden="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="create-package-form">
                <div class="modal-header justify-content-space-between">
                    <h5 class="modal-title" id="createPackageModalLabel">Create New Package</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="company_id_modal">Company</label>
                        <select class="form-control" id="company_id_modal" name="company_id" required>
                            <?php foreach ($companies as $company): ?>
                                <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tip">Tip</label>
                        <input type="text" class="form-control" id="tip" name="tip" required>
                    </div>

                    <div class="col-md-6"> 
                        <label for="discount_rate" class="form-label">Discount Rate</label>
                        <div class="input-group has-validation"> 
                            <span class="input-group-text" id="inputGroupPrepend">%</span>                         
                            <input type="text" class="form-control" id="discount_rate" name="discount_rate" aria-describedby="inputGroupPrepend" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sort">Sort</label>
                            <input type="number" class="form-control" id="sort" name="sort" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active">
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editPackageModal" tabindex="-1" role="dialog" aria-labelledby="editPackageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="edit-package-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPackageModalLabel">Edit Package</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_package_id" name="id">
                    <div class="form-group">
                        <label for="edit_company_id_modal">Company</label>
                        <select class="form-control" id="edit_company_id_modal" name="company_id" required>
                            <?php foreach ($companies as $company): ?>
                                <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_tip">Tip</label>
                        <input type="text" class="form-control" id="edit_tip" name="tip" required>
                    </div>
                    <div class="col-md-6"> 
                        <label for="edit_discount_rate" class="form-label">Discount Rate</label>
                        <div class="input-group has-validation"> 
                            <span class="input-group-text" id="inputGroupPrepend">%</span>                         
                            <input type="text" class="form-control" id="edit_discount_rate" name="discount_rate" aria-describedby="inputGroupPrepend" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="edit_sort">Sort</label>
                            <input type="number" class="form-control" id="edit_sort" name="sort" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="edit_is_active" name="is_active">
                            <label class="form-check-label" for="edit_is_active">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    function loadPackages(url = '/admin/packages') {
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById('package-table').innerHTML = html;
            attachEventListeners();
        })
        .catch(error => console.error('Error:', error));
    }

    function attachEventListeners() {
        document.querySelectorAll('.sortable').forEach(header => {
            header.addEventListener('click', function() {
                const url = this.getAttribute('data-url');
                loadPackages(url);
            });
        });

        document.querySelectorAll('.page-link').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const url = this.getAttribute('href');
                loadPackages(url);
            });
        });

        document.querySelectorAll('.delete-package').forEach(button => {
            button.addEventListener('click', function() {
                const packageId = this.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this package?')) {
                    fetch(`/admin/packages/delete/${packageId}`, {
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
                            alert('Package deleted successfully.');
                            loadPackages();
                        } else {
                            alert('Error: ' + result.message);
                        }
                    }).catch(error => {
                        console.error('Error:', error);
                    });
                }
            });
        });

        document.querySelectorAll('.edit-package').forEach(button => {
            button.addEventListener('click', function() {
                const packageId = this.getAttribute('data-id');
                fetch(`/admin/packages/edit/${packageId}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(package => {
                    document.getElementById('edit_package_id').value = package.id;
                    document.getElementById('edit_company_id_modal').value = package.company_id;
                    document.getElementById('edit_tip').value = package.tip;
                    document.getElementById('edit_discount_rate').value = package.discount_rate;
                    document.getElementById('edit_sort').value = package.sort;
                    document.getElementById('edit_is_active').checked = package.is_active;
                    $('#editPackageModal').modal('show');
                })
                .catch(error => console.error('Error:', error));
            });
        });

        document.getElementById('filter-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const url = this.action + '?' + new URLSearchParams(new FormData(this)).toString();
            loadPackages(url);
        });

        document.getElementById('create-package-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            fetch('/admin/packages/store', {
                method: 'POST',
                body: formData
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            }).then(result => {
                if (result.success) {
                    $('#createPackageModal').modal('hide');
                    loadPackages();
                } else {
                    alert('Error: ' + result.message);
                }
            }).catch(error => {
                console.error('Error:', error);
            });
        });

        document.getElementById('edit-package-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            fetch(`/admin/packages/update/${document.getElementById('edit_package_id').value}`, {
                method: 'POST',
                body: formData
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            }).then(result => {
                if (result.success) {
                    //alert('Package updated successfully.');
                    $('#editPackageModal').modal('hide');
                    loadPackages();
                } else {
                    alert('Error: ' + result.message);
                }
            }).catch(error => {
                console.error('Error:', error);
            });
        });
    }

    attachEventListeners();
});
</script>