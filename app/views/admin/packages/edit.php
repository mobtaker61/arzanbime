<div class="row">
    <div class="col-12">
        <h1>Edit Package</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="/admin/packages/update/<?php echo $package['id']; ?>" method="post">
            <div class="form-group">
                <label for="company_id">Company</label>
                <select class="form-control" id="company_id" name="company_id" required>
                    <?php foreach ($companies as $company): ?>
                        <option value="<?php echo $company['id']; ?>" <?php echo $company['id'] == $package['company_id'] ? 'selected' : ''; ?>><?php echo $company['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tip">Tip</label>
                <input type="text" class="form-control" id="tip" name="tip" value="<?php echo $package['tip']; ?>" required>
            </div>
            <div class="form-group">
                <label for="discount_rate">Discount Rate</label>
                <input type="number" class="form-control" id="discount_rate" name="discount_rate" value="<?php echo $package['discount_rate']; ?>" required>
            </div>
            <div class="form-group">
                <label for="sort">Sort</label>
                <input type="number" class="form-control" id="sort" name="sort" value="<?php echo $package['sort']; ?>" required>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" <?php echo $package['is_active'] ? 'checked' : ''; ?>>
                <label class="form-check-label" for="is_active">Is Active</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
