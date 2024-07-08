<div class="row mb-3">
    <div class="col-md-6 d-flex align-items-center justify-content-start">
        <form id="filter-form" method="get" action="/admin/quotations" class="d-flex form-group mr-3">
            <input type="text" name="tel" class="form-control" placeholder="Filter by Tel" value="<?php echo $filterTel; ?>">
            <select name="status" class="form-control ml-2">
                <option value="">All Statuses</option>
                <option value="New" <?php echo $filterStatus === 'New' ? 'selected' : ''; ?>>New</option>
                <option value="Following" <?php echo $filterStatus === 'Following' ? 'selected' : ''; ?>>Following</option>
                <option value="Canceled" <?php echo $filterStatus === 'Canceled' ? 'selected' : ''; ?>>Canceled</option>
                <option value="Rejected" <?php echo $filterStatus === 'Rejected' ? 'selected' : ''; ?>>Rejected</option>
                <option value="Finished" <?php echo $filterStatus === 'Finished' ? 'selected' : ''; ?>>Finished</option>
            </select>
            <button type="submit" class="btn btn-secondary ml-2">Filter</button>
        </form>
    </div>
    <div class="col-md-6 d-flex align-items-center justify-content-end">
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#createQuotationModal">Create New Quotation</a>
    </div>
</div>

<div id="quotation-table">
    <?php include 'quotation_table.php'; ?>
</div>

<nav>
    <ul class="pagination">
        <?php for ($i = 1; $i <= ceil($totalQuotations / $limit); $i++): ?>
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
                    <h5 class="modal-title" id="createQuotationModalLabel">Create New Quotation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tel">Tel</label>
                        <input type="text" class="form-control" id="tel" name="tel" required>
                    </div>
                    <div class="form-group">
                        <label for="birth_date">Birth Date</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" class="form-control" id="age" name="age" required>
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input type="number" class="form-control" id="duration" name="duration" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="New">New</option>
                            <option value="Following">Following</option>
                            <option value="Canceled">Canceled</option>
                            <option value="Rejected">Rejected</option>
                            <option value="Finished">Finished</option>
                        </select>
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

<!-- Detail Modal -->
<div class="modal fade" id="quotationDetailModal" tabindex="-1" role="dialog" aria-labelledby="quotationDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quotationDetailModalLabel">Quotation Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="quotation-detail-content">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCommentModal">Add Comment</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Comment Modal -->
<div class="modal fade" id="addCommentModal" tabindex="-1" role="dialog" aria-labelledby="addCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="add-comment-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCommentModalLabel">Add Follow-up Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
                            <?php foreach ($adminUsers as $user): ?>
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
                            <?php foreach ($adminUsers as $user): ?>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Comment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Offers Modal -->
<div class="modal fade" id="quotationOffersModal" tabindex="-1" role="dialog" aria-labelledby="quotationOffersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="offers-modal-content">
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('create-quotation-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        fetch('/admin/quotations/store', {
            method: 'POST',
            body: formData
        }).then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        }).then(result => {
            if (result.success) {
                alert('Quotation created successfully.');
                $('#createQuotationModal').modal('hide');
                location.reload();
            } else {
                alert('Error: ' + result.message);
            }
        }).catch(error => {
            console.error('Error:', error);
        });
    });

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
            }).catch(error => {
                console.error('Error:', error);
            });
        });
    });

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

    document.querySelectorAll('.add-comment').forEach(button => {
        button.addEventListener('click', function() {
            const quotationId = this.getAttribute('data-id');
            document.getElementById('quotation_id').value = quotationId;
            document.getElementById('date').value = new Date().toISOString().slice(0, 16);
            $('#addCommentModal').modal('show');
        });
    });

    document.querySelectorAll('.show-offers').forEach(button => {
        button.addEventListener('click', function() {
            const quotationId = this.getAttribute('data-id');
            fetch(`/admin/quotations/offers/${quotationId}`, {
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
            }).catch(error => {
                console.error('Error:', error);
            });
        });
    });
        
    document.getElementById('filter-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const url = this.action + '?' + new URLSearchParams(new FormData(this)).toString();
        window.location.href = url;
    });
});
</script>
