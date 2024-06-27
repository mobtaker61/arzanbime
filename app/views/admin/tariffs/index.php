<div class="row mb-3">
    <div class="col-md-6 d-flex align-items-center justify-content-start">
        <form id="filter-form" method="get" action="/admin/tariffs" class="d-flex form-group mr-3">
            <select name="company_id" id="company_id" class="form-control">
                <option value="">همه شرکتها</option>
                <?php foreach ($companies as $company): ?>
                    <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <select name="package_id" id="package_id" class="form-control ml-2">
                <option value="">همه پکیجها</option>
            </select>
            <button type="submit" class="btn btn-secondary ml-2">فیلتر</button>
        </form>
    </div>
    <div class="col-md-6 d-flex align-items-center justify-content-end">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#setTariffModal">تعیین نرخ</button>
    </div>
</div>

<div id="tariff-table">
    <?php include 'tariff_table.php'; ?>
</div>

<!-- Set Tariff Modal -->
<div class="modal fade" id="setTariffModal" tabindex="-1" aria-labelledby="setTariffModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="set-tariff-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="setTariffModalLabel">Set Tariff</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="set_package_id">Package</label>
                        <select class="form-control" id="set_package_id" name="package_id" required>
                            <?php foreach ($packages as $package): ?>
                                <option value="<?php echo $package['id']; ?>"><?php echo $package['company_name'] . ' - '.$package['tip']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="start_age">Start Age</label>
                            <input type="number" class="form-control" min="0" max="70" id="start_age" name="start_age" required>
                        </div>
                        <div class="col-md-6">
                            <label for="end_age">End Age</label>
                            <input type="number" class="form-control" min="0" max="70"  id="end_age" name="end_age" required>
                        </div>
                        <div class="col-md-6">
                            <label for="first_year">First Year</label>
                            <input type="number" class="form-control" id="first_year" name="first_year" required>
                        </div>
                        <div class="col-md-6">
                            <label for="second_year">Second Year</label>
                            <input type="number" class="form-control" id="second_year" name="second_year" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Set Tariff</button>
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

    function loadPackagesByCompany(companyId) {
        fetch(`/admin/packages/company/${companyId}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            const packageSelect = document.getElementById('package_id');
            packageSelect.innerHTML = '<option value="">All Packages</option>';
            data.packages.forEach(package => {
                packageSelect.innerHTML += `<option value="${package.id}">${package.tip}</option>`;
            });
        })
        .catch(error => console.error('Error:', error));
    }

    function attachEventListeners() {
        document.getElementById('company_id').addEventListener('change', function() {
            const companyId = this.value;
            loadPackagesByCompany(companyId);
        });

        document.querySelectorAll('.tariff-page-link').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const page = this.getAttribute('data-page');
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set('page', page);
                const url = `/admin/tariffs?${urlParams.toString()}`;
                loadTariffs(url);
            });
        });

        document.querySelectorAll('.sortable').forEach(header => {
            header.addEventListener('click', function() {
                const sortField = this.getAttribute('data-sort-field');
                let sortOrder = this.getAttribute('data-sort-order');
                if (!sortOrder || sortOrder === 'ASC') {
                    sortOrder = 'DESC';
                } else {
                    sortOrder = 'ASC';
                }
                this.setAttribute('data-sort-order', sortOrder);
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set('sortField', sortField);
                urlParams.set('sortOrder', sortOrder);
                const url = `/admin/tariffs?${urlParams.toString()}`;
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

                            attachEventListeners(); // Re-attach the event listeners
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

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('set-tariff-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        const data = {};
        formData.forEach((value, key) => { data[key] = value; });

        fetch('/admin/tariffs/setTariff', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        }).then(result => {
            if (result.success) {
                $('#setTariffModal').modal('hide');
                loadTariffs();
            } else {
                alert('Error: ' + result.message);
            }
        }).catch(error => {
            console.error('Error:', error);
        });
    });
});
</script>
