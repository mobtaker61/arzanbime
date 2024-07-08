<button class="btn btn-primary create-btn">ایجاد کاربر جدید</button>
<input type="text" id="search" placeholder="جستجو..." value="<?php echo htmlspecialchars($search); ?>">
<button class="btn btn-secondary search-btn">جستجو</button>
<table class="table">
    <thead>
        <tr>
            <th>نام کاربری</th>
            <th>نام</th>
            <th>نام خانوادگی</th>
            <th>ایمیل</th>
            <th>شماره تلفن</th>
            <th>نقش</th>
            <th>سطح کاربر</th>
            <th>وضعیت</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td><?php echo htmlspecialchars($user['name']); ?></td>
                <td><?php echo htmlspecialchars($user['surname']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['phone']); ?></td>
                <td><?php echo htmlspecialchars($user['role']); ?></td>
                <td><?php echo htmlspecialchars($user['user_level_id']); ?></td>
                <td><?php echo $user['is_active'] ? 'فعال' : 'غیرفعال'; ?></td>
                <td>
                    <button class="btn btn-warning edit-btn" data-id="<?php echo $user['id']; ?>">ویرایش</button>
                    <button class="btn btn-danger delete-btn" data-id="<?php echo $user['id']; ?>">حذف</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<nav>
    <ul class="pagination">
        <?php for ($i = 1; $i <= ceil($totalUsers / $limit); $i++) : ?>
            <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>&limit=<?php echo $limit; ?>&search=<?php echo htmlspecialchars($search); ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="createForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">ایجاد کاربر جدید</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="create_username" class="form-label">نام کاربری</label>
                        <input type="text" class="form-control" id="create_username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="create_password" class="form-label">رمز عبور</label>
                        <input type="password" class="form-control" id="create_password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="create_role" class="form-label">نقش</label>
                        <select class="form-control" id="create_role" name="role" required>
                            <option value="user">کاربر</option>
                            <option value="agent">نماینده</option>
                            <option value="admin">ادمین</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="create_user_level_id" class="form-label">سطح کاربر</label>
                        <select class="form-control" id="create_user_level_id" name="user_level_id" required>
                            <?php foreach ($userLevels as $level) : ?>
                                <option value="<?php echo $level['id']; ?>"><?php echo htmlspecialchars($level['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="create_profile_image" class="form-label">تصویر پروفایل</label>
                        <input type="text" class="form-control" id="create_profile_image" name="profile_image">
                    </div>
                    <div class="mb-3">
                        <label for="create_name" class="form-label">نام</label>
                        <input type="text" class="form-control" id="create_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="create_surname" class="form-label">نام خانوادگی</label>
                        <input type="text" class="form-control" id="create_surname" name="surname" required>
                    </div>
                    <div class="mb-3">
                        <label for="create_birth_date" class="form-label">تاریخ تولد</label>
                        <input type="date" class="form-control" id="create_birth_date" name="birth_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="create_email" class="form-label">ایمیل</label>
                        <input type="email" class="form-control" id="create_email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="create_phone" class="form-label">شماره تلفن</label>
                        <input type="text" class="form-control" id="create_phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="create_is_active" class="form-label">فعال</label>
                        <input type="checkbox" class="form-check-input" id="create_is_active" name="is_active">
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
                    <h5 class="modal-title" id="editModalLabel">ویرایش کاربر</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-3">
                        <label for="edit_username" class="form-label">نام کاربری</label>
                        <input type="text" class="form-control" id="edit_username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_password" class="form-label">رمز عبور</label>
                        <input type="password" class="form-control" id="edit_password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="edit_role" class="form-label">نقش</label>
                        <select class="form-control" id="edit_role" name="role" required>
                            <option value="user">کاربر</option>
                            <option value="agent">نماینده</option>
                            <option value="admin">ادمین</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_user_level_id" class="form-label">سطح کاربر</label>
                        <select class="form-control" id="edit_user_level_id" name="user_level_id" required>
                            <?php foreach ($userLevels as $level) : ?>
                                <option value="<?php echo $level['id']; ?>"><?php echo htmlspecialchars($level['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_profile_image" class="form-label">تصویر پروفایل</label>
                        <input type="text" class="form-control" id="edit_profile_image" name="profile_image">
                    </div>
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">نام</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_surname" class="form-label">نام خانوادگی</label>
                        <input type="text" class="form-control" id="edit_surname" name="surname" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_birth_date" class="form-label">تاریخ تولد</label>
                        <input type="date" class="form-control" id="edit_birth_date" name="birth_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">ایمیل</label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_phone" class="form-label">شماره تلفن</label>
                        <input type="text" class="form-control" id="edit_phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_is_active" class="form-label">فعال</label>
                        <input type="checkbox" class="form-check-input" id="edit_is_active" name="is_active">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <button type="submit" class="btn btn-primary">ذخیره</button>
                </div>
            </form>
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
                fetch("/admin/users/store", {
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
                    fetch(`/admin/users/edit/${id}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById("edit_id").value = data.user.user_id;
                            document.getElementById("edit_username").value = data.user.username;
                            document.getElementById("edit_role").value = data.user.role;
                            document.getElementById("edit_user_level_id").value = data.user.user_level_id;
                            document.getElementById("edit_profile_image").value = data.user.profile_image;
                            document.getElementById("edit_name").value = data.user.name;
                            document.getElementById("edit_surname").value = data.user.surname;
                            document.getElementById("edit_birth_date").value = data.user.birth_date;
                            document.getElementById("edit_email").value = data.user.email;
                            document.getElementById("edit_phone").value = data.user.phone;
                            document.getElementById("edit_is_active").checked = data.user.is_active;
                            $('#editModal').modal('show');
                        }).catch(error => console.error("Error:", error));
                });
            });

            // AJAX for edit form
            document.getElementById("editForm").addEventListener("submit", function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const id = document.getElementById("edit_id").value;
                fetch(`/admin/users/update/${id}`, {
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

            // Delete user
            document.querySelectorAll(".delete-btn").forEach(button => {
                button.addEventListener("click", function() {
                    if (confirm("آیا مطمئن هستید؟")) {
                        const id = this.getAttribute("data-id");
                        fetch(`/admin/users/delete/${id}`, {
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

            // Search users
            document.querySelector(".search-btn").addEventListener("click", function() {
                const search = document.getElementById("search").value;
                window.location.href = `?search=${search}`;
            });
        });
    </script>