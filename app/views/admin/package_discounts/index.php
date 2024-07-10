<!-- app/views/admin/package_discounts/index.php -->
<button class="btn btn-primary mb-3 create-btn" data-toggle="modal" data-target="#createModal">ایجاد تخفیف بسته جدید</button>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>بسته</th>
            <th>سطح کاربر</th>
            <th>درصد تخفیف</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($packageDiscounts as $discount) : ?>
            <tr>
                <td><?= htmlspecialchars($discount['id']) ?></td>
                <td><?= htmlspecialchars($discount['company_name'] . ' - ' . $discount['tip']) ?></td>
                <td><?= htmlspecialchars($discount['user_level_name']) ?></td>
                <td><?= htmlspecialchars($discount['discount_rate']) ?>%</td>
                <td>
                    <button class="btn btn-warning edit-btn" data-id="<?= $discount['id'] ?>">ویرایش</button>
                    <a href="/admin/package-discounts/delete/<?= $discount['id'] ?>" class="btn btn-danger">حذف</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal for Create -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">تخفیف بسته جدید</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createForm">
                    <div class="form-group">
                        <label for="package_id">بسته:</label>
                        <select id="package_id" name="package_id" class="form-control" required>
                            <?php foreach ($packages as $package) : ?>
                                <option value="<?= $package['id'] ?>"><?= htmlspecialchars($package['company_name'] . ' - ' . $package['tip']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="user_level_id">سطح کاربر:</label>
                        <select id="user_level_id" name="user_level_id" class="form-control" required>
                            <?php foreach ($userLevels as $level) : ?>
                                <option value="<?= $level['id'] ?>"><?= htmlspecialchars($level['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="discount_rate">درصد تخفیف:</label>
                        <input type="number" id="discount_rate" name="discount_rate" step="0.01" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">ذخیره</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">ویرایش تخفیف بسته</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-group">
                        <label for="edit_package_id">بسته:</label>
                        <select id="edit_package_id" name="package_id" class="form-control" required>
                            <?php foreach ($packages as $package) : ?>
                                <option value="<?= $package['id'] ?>"><?= htmlspecialchars($package['company_name'] . ' - ' . $package['tip']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_user_level_id">سطح کاربر:</label>
                        <select id="edit_user_level_id" name="user_level_id" class="form-control" required>
                            <?php foreach ($userLevels as $level) : ?>
                                <option value="<?= $level['id'] ?>"><?= htmlspecialchars($level['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_discount_rate">درصد تخفیف:</label>
                        <input type="number" id="edit_discount_rate" name="discount_rate" step="0.01" class="form-control" required>
                    </div>
                    <input type="hidden" id="edit_id" name="id">
                    <button type="submit" class="btn btn-primary">ذخیره</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Open create modal
        document.querySelector(".create-btn").addEventListener("click", function() {$('#createModal').modal('show');});

        // AJAX for create form
        document.getElementById("createForm").addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch("/admin/package-discounts/store", {
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
                fetch(`/admin/package-discounts/edit/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("edit_id").value = data.id;
                        document.getElementById("edit_package_id").value = data.package_id;
                        document.getElementById("edit_user_level_id").value = data.user_level_id;
                        document.getElementById("edit_discount_rate").value = data.discount_rate;
                        $('#editModal').modal('show');
                    }).catch(error => console.error("Error:", error));
            });
        });

        // AJAX for edit form
        document.getElementById("editForm").addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = document.getElementById("edit_id").value;
            fetch(`/admin/package-discounts/update/${id}`, {
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
    });
</script>