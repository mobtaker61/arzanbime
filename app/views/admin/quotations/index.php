<div class="row mb-3">
    <div class="col-md-6 d-flex align-items-center justify-content-start">
        <form id="filter-form" method="get" action="/admin/quotations" class="d-flex form-group mr-3">
            <input type="text" name="tel" class="form-control" placeholder="جستجو با تلفن" value="<?php echo $filterTel; ?>">
            <select name="status" class="form-control ml-2">
                <option value="">همه وضیعتها</option>
                <option value="New" <?php echo $filterStatus === 'New' ? 'selected' : ''; ?>>جدید</option>
                <option value="Following" <?php echo $filterStatus === 'Following' ? 'selected' : ''; ?>>در حال انجام</option>
                <option value="Canceled" <?php echo $filterStatus === 'Canceled' ? 'selected' : ''; ?>>ابطال</option>
                <option value="Rejected" <?php echo $filterStatus === 'Rejected' ? 'selected' : ''; ?>>ریجکت</option>
                <option value="Finished" <?php echo $filterStatus === 'Finished' ? 'selected' : ''; ?>>تمام شده</option>
            </select>
            <button type="submit" class="btn btn-secondary ml-2">فیلتر</button>
        </form>
    </div>
    <div class="col-md-6 d-flex align-items-center justify-content-end">
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createQuotationModal">استعلام جدید</a>
    </div>
</div>
<div id="quotation-table">
    <?php include 'quotation_table.php'; ?>
</div>

<nav>
    <ul class="pagination">
        <?php for ($i = 1; $i <= ceil($totalQuotations / $limit); $i++) : ?>
            <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>&limit=<?php echo $limit; ?>&sortField=<?php echo $sortField; ?>&sortOrder=<?php echo $sortOrder; ?>&tel=<?php echo $filterTel; ?>&status=<?php echo $filterStatus; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>

<!-- Create Modal -->
<div class="modal fade" id="createQuotationModal" tabindex="-1" role="dialog" aria-labelledby="createQuotationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="create-quotation-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="createQuotationModalLabel">استعلام جدید</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col">
                            <label for="tel">تلفن</label>
                            <input type="text" class="form-control" id="tel" name="tel">
                        </div>
                        <div class="col">
                            <label for="user_id">کاربر</label>
                            <select class="form-select" id="user_id" name="user_id">
                                <option value="">انتخاب کاربر</option>
                                <?php foreach ($users as $user) : ?>
                                    <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="name">نام</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col">
                            <label for="surname">فامیلی</label>
                            <input type="text" class="form-control" id="surname" name="surname" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="birth_date">تاریخ تولد</label>
                            <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                        </div>
                        <div class="col">
                            <label for="age">سن</label>
                            <input type="number" class="form-control" id="age" name="age" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="duration">مدت</label>
                        <div class="d-flex btn-group">
                            <input type="radio" class="btn-check" name="duration" id="duration1" value="1" required checked>
                            <label class="btn btn-outline-primary me-2" for="duration1">1 ساله</label>

                            <input type="radio" class="btn-check" name="duration" id="duration2" value="2" required>
                            <label class="btn btn-outline-primary" for="duration2">2 ساله</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div class="modal fade" id="quotationDetailModal" tabindex="-1" role="dialog" aria-labelledby="quotationDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quotationDetailModalLabel">جزییات درخواست</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row" id="quotation-detail-content">
                <?php include 'detail.php'; ?>
                <!-- Quotation details will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success pull-right" id="capture-pricelist">دریافت عکس</button>
                <button type="button" class="btn btn-primary add-comment" data-id="<?php echo $quotation['id']; ?>">ثبت اقدام</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Comment Modal -->
<div class="modal fade" id="addCommentModal" tabindex="-1" role="dialog" aria-labelledby="addCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: antiquewhite;">
            <form id="add-comment-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCommentModalLabel">Add Follow-up Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="quotation_id" name="quotation_id">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="datetime-local" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="responsible_user">Responsible User</label>
                        <select class="form-control" id="responsible_user" name="responsible_user" required>
                            <?php foreach ($adminUsers as $user) : ?>
                                <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea class="form-control" id="comment" name="comment" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="refer_to">Referred To</label>
                        <select class="form-control" id="refer_to" name="refer_to">
                            <option value="">None</option>
                            <?php foreach ($adminUsers as $user) : ?>
                                <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_closed" name="is_closed">
                        <label class="form-check-label" for="is_closed">Is Closed</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Comment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Offers Modal -->
<div class="modal fade" id="quotationOffersModal" tabindex="-1" role="dialog" aria-labelledby="quotationOffersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">پیشنهاد قیمتی برای درخواست #<?php echo $quotation['id']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="offers-modal-content" style="background-color: white;">
                <?php include 'offer_modal_content.php'; ?>
                <!-- Offers content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success pull-right" id="capture-price_table">دریافت عکس</button>
            </div>
        </div>
    </div>
</div>

<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Profile Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="profile-form">
                    <input type="hidden" id="profile_user_id" name="user_id">
                    <div class="mb-3">
                        <label for="profile_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="profile_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="profile_surname" class="form-label">Surname</label>
                        <input type="text" class="form-control" id="profile_surname" name="surname" required>
                    </div>
                    <div class="mb-3">
                        <label for="profile_birth_date" class="form-label">Birth Date</label>
                        <input type="date" class="form-control" id="profile_birth_date" name="birth_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="profile_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="profile_email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="profile_phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="profile_phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="profile_image" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="profile_image" name="profile_image">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Calculate age based on birth date
        document.getElementById('birth_date').addEventListener('change', function() {
            const birthDate = new Date(this.value);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDifference = today.getMonth() - birthDate.getMonth();
            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            document.getElementById('age').value = age;
        });

        // Handle form submission
        document.getElementById('create-quotation-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            const tel = formData.get('tel');
            const userId = formData.get('user_id');

            if (!tel && !userId) {
                alert('Please enter a phone number or select a user.');
                return;
            }

            // Submit the form data via AJAX
            fetch('/admin/quotations/check-or-create-user', {
                method: 'POST',
                body: formData
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            }).then(result => {
                if (result.success) {
                    // Set the user_id field with the returned user ID
                    formData.set('user_id', result.user_id);

                    // Now submit the form to create the quotation
                    return fetch('/admin/quotations/store', {
                        method: 'POST',
                        body: formData
                    });
                } else {
                    alert('Error: ' + result.message);
                    throw new Error('User creation or retrieval failed');
                }
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            }).then(result => {
                if (result.success) {
                    // Show the quotation detail modal with the new quotation details
                    const quotationId = result.quotation_id;
                    $('#createQuotationModal').modal('hide');
                    fetch(`/admin/quotations/detail/${quotationId}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }).then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text();
                    }).then(html => {
                        document.getElementById('quotation-detail-content').innerHTML = html;
                        $('#quotationDetailModal').modal('show');
                    }).catch(error => {
                        console.error('Error:', error);
                    });
                } else {
                    alert('Error: ' + result.message);
                }
            }).catch(error => {
                console.error('Error:', error);
            });
        });

        // View Details
        document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', function() {
                const quotationId = this.getAttribute('data-id');
                fetch(`/admin/quotations/detail/${quotationId}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                }).then(html => {
                    document.getElementById('quotation-detail-content').innerHTML = html;
                    $('#quotationDetailModal').modal('show');

                    // Update add-comment button data-id attribute
                    document.querySelector('.add-comment').setAttribute('data-id', quotationId);

                    // Apply number formatting to new content
                    applyNumberFormatting();
                }).catch(error => {
                    console.error('Error:', error);
                });
            });
        });

        // Add Comment
        document.getElementById('add-comment-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            fetch('/admin/quotations/addFollowup', {
                method: 'POST',
                body: formData
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            }).then(result => {
                if (result.success) {
                    $('#addCommentModal').modal('hide');
                    document.querySelector('.view-details[data-id="' + document.getElementById('quotation_id').value + '"]').click();
                } else {
                    alert('Error: ' + result.message);
                }
            }).catch(error => {
                console.error('Error:', error);
            });
        });

        // Show Add Comment Modal  //TODO: comment quotation id for each row
        document.querySelectorAll('.add-comment').forEach(button => {
            button.addEventListener('click', function() {
                const quotationId = this.getAttribute('data-id');
                document.getElementById('quotation_id').value = quotationId;
                document.getElementById('date').value = new Date().toISOString().slice(0, 16);
                $('#addCommentModal').modal('show');
            });
        });

        // Show Offers
        document.querySelectorAll('.show-offers').forEach(button => {
            button.addEventListener('click', function() {
                const quotationId = this.getAttribute('data-id');
                fetch(`/admin/quotations/getOffers/${quotationId}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                }).then(html => {
                    document.getElementById('offers-modal-content').innerHTML = html;
                    $('#quotationOffersModal').modal('show');
                    // Apply number formatting to new content
                    applyNumberFormatting();
                }).catch(error => {
                    console.error('Error:', error);
                });
            });
        });

        // Filter Form
        document.getElementById('filter-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const url = this.action + '?' + new URLSearchParams(new FormData(this)).toString();
            window.location.href = url;
        });

        // View Profile
        document.querySelectorAll('.view-profile').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                fetch(`/admin/profiles/${userId}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                }).then(data => {
                    document.getElementById('profile_user_id').value = data.user_id;
                    document.getElementById('profile_name').value = data.name;
                    document.getElementById('profile_surname').value = data.surname;
                    document.getElementById('profile_birth_date').value = data.birth_date;
                    document.getElementById('profile_email').value = data.email;
                    document.getElementById('profile_phone').value = data.phone;
                    $('#profileModal').modal('show');
                }).catch(error => {
                    console.error('Error:', error);
                });
            });
        });

        // Submit Profile Form
        document.getElementById('profile-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            fetch('/admin/profiles/update', {
                method: 'POST',
                body: formData
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            }).then(result => {
                if (result.success) {
                    alert('Profile updated successfully.');
                    $('#profileModal').modal('hide');
                    location.reload();
                } else {
                    alert('Error: ' + result.message);
                }
            }).catch(error => {
                console.error('Error:', error);
            });
        });

        // Capture pricelist div as image using html-to-image.js
        document.getElementById('capture-pricelist').addEventListener('click', function() {
            htmlToImage.toJpeg(document.getElementById('pricelist'), {
                    quality: 0.95
                })
                .then(function(dataUrl) {
                    const link = document.createElement('a');
                    link.href = dataUrl;
                    link.download = 'pricelist.png';
                    link.click();
                })
                .catch(function(error) {
                    console.error('oops, something went wrong!', error);
                });
        });
    });
</script>