<button class="btn btn-primary create-btn">ایجاد کمیسیون جدید</button>
<input type="text" id="search" placeholder="جستجو..." value="<?php echo htmlspecialchars($search); ?>">
<button class="btn btn-secondary search-btn">جستجو</button>
<table class="table">
    <thead>
        <tr>
            <th>بروکر</th>
            <th>پکیج</th>
            <th>درصد کمیسیون</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($commissions as $commission) : ?>
            <tr>
                <td><?php echo htmlspecialchars($commission['broker_title']); ?></td>
                <td><?php echo htmlspecialchars($commission['package_tip']); ?></td>
                <td><?php echo htmlspecialchars($commission['commission_rate']); ?>%</td>
                <td>
                    <button class="btn btn-warning edit-btn" data-id="<?php echo $commission['id']; ?>">ویرایش</button>
                    <button class="btn btn-danger delete-btn" data-id="<?php echo $commission['id']; ?>">حذف</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<nav>
    <ul class="pagination">
        <?php for ($i = 1; $i <= ceil($totalCommissions / $limit); $i++) : ?>
            <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>&limit=<?php echo $limit; ?>&search=<?php echo htmlspecialchars($search); ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="createForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">ایجاد کمیسیون جدید</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="create_broker_id" class="form-label">بروکر</label>
                        <select class="form-select" id="create_broker_id" name="broker_id" required>
                            <?php foreach ($brokers as $broker) : ?>
                                <option value="<?php echo $broker['id']; ?>"><?php echo htmlspecialchars($broker['title']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="create_package_id" class="form-label">پکیج</label>
                        <select class="form-select" id="create_package_id" name="package_id" required>
                            <?php foreach ($packages as $package) : ?>
                                <option value="<?php echo $package['id']; ?>"><?php echo htmlspecialchars($package['company_name'] .' - '. $package['tip']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="create_commission_rate" class="form-label">درصد کمیسیون</label>
                        <input type="number" class="form-control" id="create_commission_rate" name="commission_rate" step="0.01" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <button type="submit" class="btn btn-primary">ذخیره</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">ویرایش کمیسیون</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-3">
                        <label for="edit_broker_id" class="form-label">بروکر</label>
                        <select class="form-select" id="edit_broker_id" name="broker_id" required>
                            <?php foreach ($brokers as $broker) : ?>
                                <option value="<?php echo $broker['id']; ?>"><?php echo htmlspecialchars($broker['title']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_package_id" class="form-label">پکیج</label>
                        <select class="form-select" id="edit_package_id" name="package_id" required>
                            <?php foreach ($packages as $package) : ?>
                                <option value="<?php echo $package['id']; ?>"><?php echo htmlspecialchars($package['company_name'] .' - '. $package['tip']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_commission_rate" class="form-label">درصد کمیسیون</label>
                        <input type="number" class="form-control" id="edit_commission_rate" name="commission_rate" step="0.01" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <button type="submit" class="btn btn-primary">ذخیره</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Open create modal
        document.querySelector(".create-btn").addEventListener("click", function() {
            $('#createModal').modal('show');
        });

        // AJAX for create form
        document.getElementById("createForm").addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch("/admin/commissions/store", {
                    method: "POST",
                    body: formData
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert("خطا در ذخیره سازی");
                    }
                }).catch(error => console.error("Error:", error));
        });

        // Open edit modal
        document.querySelectorAll(".edit-btn").forEach(button => {
            button.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                fetch(`/admin/commissions/edit/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("edit_id").value = data.id;
                        document.getElementById("edit_broker_id").value = data.broker_id;
                        document.getElementById("edit_package_id").value = data.package_id;
                        document.getElementById("edit_commission_rate").value = data.commission_rate;
                        $('#editModal').modal('show');
                    }).catch(error => console.error("Error:", error));
            });
        });

        // AJAX for edit form
        document.getElementById("editForm").addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = document.getElementById("edit_id").value;
            fetch(`/admin/commissions/update/${id}`, {
                    method: "POST",
                    body: formData
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert("خطا در به‌روزرسانی");
                    }
                }).catch(error => console.error("Error:", error));
        });

        // Delete commission
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function() {
                if (confirm("آیا مطمئن هستید؟")) {
                    const id = this.getAttribute("data-id");
                    fetch(`/admin/commissions/delete/${id}`, {
                            method: "DELETE"
                        }).then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            } else {
                                alert("خطا در حذف");
                            }
                        }).catch(error => console.error("Error:", error));
                }
            });
        });

        // Search commissions
        document.querySelector(".search-btn").addEventListener("click", function() {
            const search = document.getElementById("search").value;
            window.location.href = `?search=${search}&limit=<?php echo $limit; ?>&page=1`;
        });
    });
</script>