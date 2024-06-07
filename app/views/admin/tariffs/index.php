<div class="row mb-3">
    <div class="col-md-6">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createTariffModal">Create New Tariff</button>
    </div>
    <div class="col-md-6">
        <form id="filter-form" method="get" action="/admin/tariffs" class="form-inline">
            <div class="form-group mr-3">
                <select name="company_id" id="company_id" class="form-control">
                    <option value="">All Companies</option>
                    <?php foreach ($companies as $company): ?>
                        <option value="<?php echo $company['id']; ?>" <?php echo $company['id'] == $companyId ? 'selected' : ''; ?>><?php echo $company['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group mr-3">
                <select name="package_id" id="package_id" class="form-control">
                    <option value="">All Packages</option>
                    <?php foreach ($packages as $package): ?>
                        <option value="<?php echo $package['id']; ?>" <?php echo $package['id'] == $packageId ? 'selected' : ''; ?>><?php echo $package['tip']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-secondary">Filter</button>
        </form>
    </div>
</div>

<div id="tariff-table">
    <?php include 'tariff_table.php'; ?>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createTariffModal" tabindex="-1" role="dialog" aria-labelledby="createTariffModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="create-tariff-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTariffModalLabel">Create New Tariff</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="package_id_modal">Package</label>
                        <select class="form-control" id="package_id_modal" name="package_id" required>
                            <?php foreach ($packages as $package): ?>
                                <option value="<?php echo $package['id']; ?>"><?php echo $package['tip']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" class="form-control" id="age" name="age" required>
                    </div>
                    <div class="form-group">
                        <label for="first_year">First Year</label>
                        <input type="number" class="form-control" id="first_year" name="first_year" required>
                    </div>
                    <div class="form-group">
                        <label for="second_year">Second Year</label>
                        <input type="number" class="form-control" id="second_year" name="second_year" required>
                    </div>
                    <div class="form-group">
                        <label for="two_year">Two Year</label>
                        <input type="number" class="form-control" id="two_year" name="two_year" required>
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
<div class="modal fade" id="editTariffModal" tabindex="-1" role="dialog" aria-labelledby="editTariffModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="edit-tariff-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTariffModalLabel">Edit Tariff</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_tariff_id" name="id">
                    <div class="form-group">
                        <label for="edit_package_id_modal">Package</label>
                        <select class="form-control" id="edit_package_id_modal" name="package_id" required>
                            <?php foreach ($packages as $package): ?>
                                <option value="<?php echo $package['id']; ?>"><?php echo $package['tip']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_age">Age</label>
                        <input type="number" class="form-control" id="edit_age" name="age" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_first_year">First Year</label>
                        <input type="number" class="form-control" id="edit_first_year" name="first_year" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_second_year">Second Year</label>
                        <input type="number" class="form-control" id="edit_second_year" name="second_year" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_two_year">Two Year</label>
                        <input type="number" class="form-control" id="edit_two_year" name="two_year" required>
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
    function loadTariffs(url = '/admin/tariffs') {
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById('tariff-table').innerHTML = html;
            attachEventListeners();
        })
        .catch(error => console.error('Error:', error));
    }

    function attachEventListeners() {
        document.querySelectorAll('.edit-tariff').forEach(button => {
            button.addEventListener('click', function() {
                const tariffId = this.getAttribute('data-id');
                fetch(`/admin/tariffs/edit/${tariffId}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(tariff => {
                    document.getElementById('edit_tariff_id').value = tariff.id;
                    document.getElementById('edit_package_id_modal').value = tariff.package_id;
                    document.getElementById('edit_age').value = tariff.age;
                    document.getElementById('edit_first_year').value = tariff.first_year;
                    document.getElementById('edit_second_year').value = tariff.second_year;
                    document.getElementById('edit_two_year').value = tariff.two_year;
                    $('#editTariffModal').modal('show');
                })
                .catch(error => console.error('Error:', error));
            });
        });

        document.querySelectorAll('.delete-tariff').forEach(button => {
            button.addEventListener('click', function() {
                const tariffId = this.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this tariff?')) {
                    fetch(`/admin/tariffs/delete/${tariffId}`, {
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
                            alert('Tariff deleted successfully.');
                            loadTariffs();
                        } else {
                            alert('Error: ' + result.message);
                        }
                    }).catch(error => {
                        console.error('Error:', error);
                    });
                }
            });
        });

        document.querySelectorAll('.page-link').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const page = this.getAttribute('data-page');
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set('page', page);
                const url = `/admin/tariffs?${urlParams.toString()}`;
                loadTariffs(url);
            });
        });

        document.getElementById('create-tariff-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            fetch('/admin/tariffs/store', {
                method: 'POST',
                body: formData
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            }).then(result => {
                if (result.success) {
                    alert('Tariff created successfully.');
                    $('#createTariffModal').modal('hide');
                    loadTariffs();
                } else {
                    alert('Error: ' + result.message);
                }
            }).catch(error => {
                console.error('Error:', error);
            });
        });

        document.getElementById('edit-tariff-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            const tariffId = document.getElementById('edit_tariff_id').value;
            fetch(`/admin/tariffs/update/${tariffId}`, {
                method: 'POST',
                body: formData
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            }).then(result => {
                if (result.success) {
                    alert('Tariff updated successfully.');
                    $('#editTariffModal').modal('hide');
                    loadTariffs();
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