<button class="btn btn-primary create-btn">ایجاد بروکر جدید</button>
<input type="text" id="search" placeholder="جستجو..." value="<?php echo htmlspecialchars($search); ?>">
<button class="btn btn-secondary search-btn">جستجو</button>
<table class="table">
    <thead>
        <tr>
            <th>لوگو</th>
            <th>عنوان</th>
            <th>بالانس</th>
            <th>آدرس</th>
            <th>تلفن</th>
            <th>وبسایت</th>
            <th>ایمیل</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($brokers as $broker) : ?>
            <tr>
                <td><img src="<?php echo htmlspecialchars('/'. $broker['logo']); ?>" alt="Logo" class="img-thumbnail" width="50"></td>
                <td><?php echo $broker['title']; ?></td>
                <td class="numwc"><?php echo $broker['balance']; ?></td>
                <td><?php echo $broker['address']; ?></td>
                <td><?php echo $broker['phone']; ?></td>
                <td><a href="<?php echo htmlspecialchars($broker['website']); ?>"><?php echo htmlspecialchars($broker['website']); ?></a></td>
                <td><?php echo htmlspecialchars($broker['email']); ?></td>
                <td><button class="btn btn-warning edit-btn" data-id="<?php echo $broker['id']; ?>">ویرایش</button><button class="btn btn-danger delete-btn" data-id="<?php echo $broker['id']; ?>">حذف</button></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<nav>
    <ul class="pagination">
        <?php for ($i = 1; $i <= ceil($totalBrokers / $limit); $i++) : ?>
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
            <form id="createForm" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">ایجاد بروکر جدید</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="create_logo" class="form-label">لوگو</label>
                        <input type="file" class="form-control" id="create_logo" name="logo">
                    </div>
                    <div class="mb-3">
                        <label for="create_title" class="form-label">عنوان</label>
                        <input type="text" class="form-control" id="create_title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="create_manager" class="form-label">مسئول</label>
                        <input type="text" class="form-control" id="create_manager" name="manager" required>
                    </div>
                    <div class="mb-3">
                        <label for="create_address" class="form-label">آدرس</label>
                        <textarea class="form-control" id="create_address" name="address" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="create_phone" class="form-label">تلفن</label>
                        <input type="text" class="form-control" id="create_phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="create_website" class="form-label">وبسایت</label>
                        <input type="text" class="form-control" id="create_website" name="website">
                    </div>
                    <div class="mb-3">
                        <label for="create_email" class="form-label">ایمیل</label>
                        <input type="email" class="form-control" id="create_email" name="email">
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
            <form id="editForm" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">ویرایش بروکر</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-3">
                        <label for="edit_logo" class="form-label">لوگو</label>
                        <input type="file" class="form-control" id="edit_logo" name="logo">
                        <img src="" alt="Logo" id="edit_logo_pr" class="img-thumbnail" width="50">
                    </div>
                    <div class="mb-3">
                        <label for="edit_title" class="form-label">عنوان</label>
                        <input type="text" class="form-control" id="edit_title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_manager" class="form-label">مسئول</label>
                        <input type="text" class="form-control" id="edit_manager" name="manager" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_address" class="form-label">آدرس</label>
                        <textarea class="form-control" id="edit_address" name="address" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_phone" class="form-label">تلفن</label>
                        <input type="text" class="form-control" id="edit_phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_website" class="form-label">وبسایت</label>
                        <input type="text" class="form-control" id="edit_website" name="website">
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">ایمیل</label>
                        <input type="email" class="form-control" id="edit_email" name="email">
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
            fetch("/admin/brokers/store", {
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
                fetch(`/admin/brokers/edit/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("edit_id").value = data.id;
                        document.getElementById("edit_logo_pr").src = "/" + data.logo;
                        document.getElementById("edit_title").value = data.title;
                        document.getElementById("edit_manager").value = data.manager;
                        document.getElementById("edit_address").value = data.address;
                        document.getElementById("edit_phone").value = data.phone;
                        document.getElementById("edit_website").value = data.website;
                        document.getElementById("edit_email").value = data.email;
                        $('#editModal').modal('show');
                    }).catch(error => console.error("Error:", error));
            });
        });

        // AJAX for edit form
        document.getElementById("editForm").addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = document.getElementById("edit_id").value;
            fetch(`/admin/brokers/update/${id}`, {
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

        // Delete broker
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function() {
                if (confirm("آیا مطمئن هستید؟")) {
                    const id = this.getAttribute("data-id");
                    fetch(`/admin/brokers/delete/${id}`, {
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

        // Search brokers
        document.querySelector(".search-btn").addEventListener("click", function() {
            const search = document.getElementById("search").value;
            window.location.href = `?search=${search}&limit=<?php echo $limit; ?>&page=1`;
        });
    });
</script>