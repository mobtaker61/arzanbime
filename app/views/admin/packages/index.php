<div class="row mb-3">
    <div class="col-md-6 d-flex align-items-center justify-content-start">
        <form id="filter-form" method="get" action="/admin/packages" class="d-flex form-group mr-3">
            <select name="company_id" id="company_id" class="form-control">
                <option value="">همه شرکتها</option>
                <?php foreach ($companies as $company) : ?>
                    <option value="<?php echo $company['id']; ?>" <?php echo $company['id'] == $selectedCompany ? 'selected' : ''; ?>><?php echo $company['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-secondary ml-2">فیلتر</button>
        </form>
    </div>
    <div class="col-md-6 d-flex align-items-center justify-content-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPackageModal">Create New Package</button>
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
                            <?php foreach ($companies as $company) : ?>
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
                        <label for="color">Color</label>
                        <input type="color" class="form-control" id="color" name="color">
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
                            <?php foreach ($companies as $company) : ?>
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
                        <label for="edit_color">Color</label>
                        <input type="color" class="form-control" id="edit_color" name="color">
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
<!-- Add Age Modal HTML -->
<div class="modal fade" id="tariffModal" tabindex="-1" aria-labelledby="tariffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tariffModalLabel">Tariff Table</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="tariff-modal-body">
                <!-- Tariff table will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal for viewing tariffs -->
<div class="modal fade" id="tariffModal" tabindex="-1" aria-labelledby="tariffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tariffModalLabel">Tariff Table</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="tariff-modal-body">
                <!-- Tariff table will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        function loadPackages(url) {
            alert(url);
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

        function loadTariffs(url) {
            fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('tariff-modal-body').innerHTML = html;
                    attachTariffEventListeners();
                })
                .catch(error => console.error('Error:', error));
        }

        function attachEventListeners() {
            document.querySelectorAll('.edit-package').forEach(button => {
                button.addEventListener('click', function() {
                    const packageId = this.getAttribute('data-id');
                    fetch(`/admin/packages/edit/${packageId}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(pkg => {
                            // Populate the edit modal with package data
                            document.getElementById('edit_package_id').value = pkg.id;
                            document.getElementById('edit_company_id_modal').value = pkg.company_id;
                            document.getElementById('edit_tip').value = pkg.tip;
                            document.getElementById('edit_discount_rate').value = pkg.discount_rate;
                            document.getElementById('edit_sort').value = pkg.sort;
                            document.getElementById('edit_is_active').checked = pkg.is_active;
                            document.getElementById('edit_color').value = pkg.color;
                            $('#editPackageModal').modal('show');
                        })
                        .catch(error => console.error('Error:', error));
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

            // Handle pagination links
            document.querySelectorAll('.page-link').forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const url = this.getAttribute('href');
                    loadPackages(url);
                });
            });

            document.querySelectorAll('.add-ages').forEach(button => {
                button.addEventListener('click', function() {
                    const packageId = this.getAttribute('data-id');
                    if (confirm('Are you sure you want to add ages to this package?')) {
                        fetch(`/admin/packages/addAges/${packageId}`, {
                            method: 'POST',
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
                                alert('Ages added successfully.');
                                document.getElementById('tariff-modal-body').innerHTML = result.html;
                                $('#tariffModal').modal('show'); // Ensure this line triggers the modal
                            } else {
                                alert('Error: ' + result.message);
                            }
                        }).catch(error => {
                            console.error('Error:', error);
                        });
                    }
                });
            });

            document.querySelectorAll('.view-tariffs').forEach(button => {
                button.addEventListener('click', function() {
                    const packageId = this.getAttribute('data-id');
                    const urlParams = new URLSearchParams(window.location.search);
                    const url = `/admin/packages/tariffs/${packageId}?${urlParams.toString()}`;
                    loadTariffs(url);
                    $('#tariffModal').modal('show');
                });
            });

            document.querySelectorAll('.sortable').forEach(header => {
                header.addEventListener('click', function() {
                    const url = this.getAttribute('data-url');
                    loadPackages(url);
                });
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
                        alert('Package created successfully.');
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
                const packageId = document.getElementById('edit_package_id').value;
                fetch(`/admin/packages/update/${packageId}`, {
                    method: 'POST',
                    body: formData
                }).then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                }).then(result => {
                    if (result.success) {
                        alert('Package updated successfully.');
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

        function attachTariffEventListeners() {
            document.querySelectorAll('.tariff-page-link').forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const page = this.getAttribute('data-page');
                    const packageId = this.getAttribute('data-package-id');
                    const urlParams = new URLSearchParams(window.location.search);
                    urlParams.set('page', page);
                    const url = `/admin/packages/tariffs/${packageId}?${urlParams.toString()}`;
                    loadTariffs(url);
                });
            });

            document.querySelectorAll('.sortable').forEach(header => {
                header.addEventListener('click', function() {
                    const sortField = this.getAttribute('data-sort-field');
                    let sortOrder = this.getAttribute('data-sort-order');
                    const packageId = this.getAttribute('data-package-id');
                    if (!sortOrder || sortOrder === 'ASC') {
                        sortOrder = 'DESC';
                    } else {
                        sortOrder = 'ASC';
                    }
                    this.setAttribute('data-sort-order', sortOrder);
                    const urlParams = new URLSearchParams(window.location.search);
                    urlParams.set('sortField', sortField);
                    urlParams.set('sortOrder', sortOrder);
                    const url = `/admin/packages/tariffs/${packageId}?${urlParams.toString()}`;
                    loadTariffs(url);
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
                                loadTariffs(`${window.location.pathname}?${new URLSearchParams(window.location.search).toString()}`);
                            } else {
                                alert('Error: ' + result.message);
                            }
                        }).catch(error => {
                            console.error('Error:', error);
                        });
                    }
                });
            });

            document.querySelectorAll('.edit-tariff').forEach(button => {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    const firstYearCell = row.querySelector('[data-field="first_year"]');
                    const secondYearCell = row.querySelector('[data-field="second_year"]');
                    const twoYearCell = row.querySelector('.two-year');
                    const updateButton = document.createElement('button');

                    firstYearCell.contentEditable = true;
                    secondYearCell.contentEditable = true;

                    firstYearCell.focus();

                    updateButton.className = 'btn btn-success update-tariff';
                    updateButton.setAttribute('data-id', this.getAttribute('data-id'));
                    updateButton.innerHTML = '<i class="fas fa-check"></i>';
                    this.replaceWith(updateButton);

                    const updateTwoYear = () => {
                        const firstYear = parseInt(firstYearCell.innerText) || 0;
                        const secondYear = parseInt(secondYearCell.innerText) || 0;
                        const twoYear = firstYear + secondYear;
                        twoYearCell.innerText = twoYear;
                    };

                    firstYearCell.addEventListener('input', updateTwoYear);
                    secondYearCell.addEventListener('input', updateTwoYear);

                    const saveChanges = () => {
                        const tariffId = row.getAttribute('data-id');
                        const firstYear = parseInt(firstYearCell.innerText);
                        const secondYear = parseInt(secondYearCell.innerText);
                        const twoYear = firstYear + secondYear;

                        fetch(`/admin/tariffs/updateField/${tariffId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                first_year: firstYear,
                                second_year: secondYear,
                                two_year: twoYear
                            })
                        }).then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        }).then(result => {
                            if (result.success) {
                                firstYearCell.contentEditable = false;
                                secondYearCell.contentEditable = false;

                                const editButton = document.createElement('button');
                                editButton.className = 'btn btn-warning edit-tariff';
                                editButton.setAttribute('data-id', tariffId);
                                editButton.innerHTML = '<i class="fas fa-edit"></i>';
                                updateButton.replaceWith(editButton);

                                attachTariffEventListeners(); // Re-attach the event listeners
                            } else {
                                alert('Error: ' + result.message);
                            }
                        }).catch(error => {
                            console.error('Error:', error);
                        });
                    };

                    updateButton.addEventListener('click', saveChanges);
                });
            });
        }

        attachEventListeners();
    });
</script>