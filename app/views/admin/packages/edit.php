<div class="modal fade" id="editPackageModal" tabindex="-1" aria-labelledby="editPackageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPackageModalLabel">Edit Package</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPackageForm">
                    <input type="hidden" id="edit_package_id" name="id">
                    <div class="mb-3">
                        <label for="edit_company_id" class="form-label">Company</label>
                        <select class="form-control" id="edit_company_id" name="company_id" required>
                            <?php foreach ($companies as $company): ?>
                                <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_tip" class="form-label">Tip</label>
                        <input type="text" class="form-control" id="edit_tip" name="tip" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_discount_rate" class="form-label">Discount Rate</label>
                        <input type="number" class="form-control" id="edit_discount_rate" name="discount_rate" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_sort" class="form-label">Sort</label>
                        <input type="number" class="form-control" id="edit_sort" name="sort" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_color" class="form-label">Color</label>
                        <input type="text" class="form-control" id="edit_color" name="color" required>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="edit_is_active" name="is_active">
                        <label class="form-check-label" for="edit_is_active">Is Active</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
