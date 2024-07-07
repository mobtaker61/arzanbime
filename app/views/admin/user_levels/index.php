<!-- app/views/admin/user_levels/index.php -->
<button class="btn btn-primary mb-3 create-btn">ایجاد سطح کاربر جدید</button>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>کد</th>
            <th>نام</th>
            <th>رنگ</th>
            <th>حداقل</th>
            <th>حداکثر</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($userLevels as $level) : ?>
            <tr>
                <td><?= htmlspecialchars($level['id']) ?></td>
                <td><?= htmlspecialchars($level['name']) ?></td>
                <td><span style="background-color: <?= htmlspecialchars($level['color']) ?>;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                <td><?= htmlspecialchars($level['min_value']) ?></td>
                <td><?= htmlspecialchars($level['max_value']) ?></td>
                <td>
                    <button class="btn btn-warning edit-btn" data-id="<?= $level['id'] ?>">ویرایش</button>
                    <a href="/admin/user-levels/delete/<?= $level['id'] ?>" class="btn btn-danger">حذف</a>
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
                <h5 class="modal-title" id="createModalLabel">سطح کاربر جدید</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createForm">
                    <div class="form-group">
                        <label for="name">نام:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="color">رنگ:</label>
                        <input type="color" id="color" name="color" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="min_value">حداقل:</label>
                        <input type="number" id="min_value" name="min_value" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="max_value">حداکثر:</label>
                        <input type="number" id="max_value" name="max_value" class="form-control" required>
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
                <h5 class="modal-title" id="editModalLabel">ویرایش سطح کاربر</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-group">
                        <label for="edit_name">نام:</label>
                        <input type="text" id="edit_name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_color">رنگ:</label>
                        <input type="color" id="edit_color" name="color" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_min_value">حداقل:</label>
                        <input type="number" id="edit_min_value" name="min_value" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_max_value">حداکثر:</label>
                        <input type="number" id="edit_max_value" name="max_value" class="form-control" required>
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
        document.querySelector(".create-btn").addEventListener("click", function() {
            $('#createModal').modal('show');
        });

        // AJAX for create form
        document.getElementById("createForm").addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch("/admin/user-levels/store", {
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
                fetch(`/admin/user-levels/edit/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("edit_id").value = data.id;
                        document.getElementById("edit_name").value = data.name;
                        document.getElementById("edit_color").value = data.color;
                        document.getElementById("edit_min_value").value = data.min_value;
                        document.getElementById("edit_max_value").value = data.max_value;
                        $('#editModal').modal('show');
                    }).catch(error => console.error("Error:", error));
            });
        });

        // AJAX for edit form
        document.getElementById("editForm").addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = document.getElementById("edit_id").value;
            fetch(`/admin/user-levels/update/${id}`, {
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