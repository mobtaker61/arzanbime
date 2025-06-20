<?php
$pagetitle = "Create New Quotation";
?>

<section class="pady">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create New Quotation</h3>
        </div>
        <div class="card-body">
            <form id="quotationForm" method="POST" action="/agent/quotations/store">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="client_id">Client</label>
                            <select class="form-control" id="client_id" name="client_id" required>
                                <option value="">Select a client</option>
                                <?php foreach ($clients as $client): ?>
                                    <option value="<?php echo $client['id']; ?>" 
                                            data-age="<?php echo $client['age']; ?>"
                                            data-birth-date="<?php echo $client['birth_date']; ?>">
                                        <?php echo $client['name'] . ' ' . $client['family'] . ' - ' . $client['id_no']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="number" class="form-control" id="age" name="age" readonly required>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="duration">Duration (Years)</label>
                            <select class="form-control" id="duration" name="duration" required>
                                <option value="1">1 Year</option>
                                <option value="2">2 Years</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="package_id">Package</label>
                            <select class="form-control" id="package_id" name="package_id" required>
                                <option value="">Select a package</option>
                                <?php foreach ($packages as $package): ?>
                                    <option value="<?php echo $package['id']; ?>">
                                        <?php echo $package['name'] . ' - ' . $package['company_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Create Quotation</button>
                        <a href="/agent/quotations" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const clientSelect = document.getElementById('client_id');
    const ageInput = document.getElementById('age');

    clientSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption.value) {
            ageInput.value = selectedOption.getAttribute('data-age');
        } else {
            ageInput.value = '';
        }
    });
});
</script> 