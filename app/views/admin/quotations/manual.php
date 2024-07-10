<!-- app/views/admin/manual_quotation.php -->

<div class="row">
    <div class="col-md-4">
        <form id="manual-quotation-form">
            <div class="form-group">
                <label for="user_id">نماینده یا کاربر</label>
                <select class="form-control" id="user_id" name="user_id" required>
                    <?php foreach ($users as $user) : ?>
                        <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="birth_date">تاریخ تولد</label>
                <input type="date" class="form-control" id="birth_date" name="birth_date" required>
            </div>
            <div class="form-group">
                <label for="age">سن</label>
                <input type="number" class="form-control" id="age" name="age">
            </div>
            <div class="form-group">
                <label for="duration">مدت</label>
                <div>
                    <label class="radio-inline">
                        <input type="radio" name="duration" value="1" checked> یک ساله
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="duration" value="2"> دو ساله
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">استعلام</button>
        </form>
    </div>
    <div class="col-md-8">
        <h4>پیشنهادات</h4>
        <div id="offers-container">
            <!-- پیشنهادات بصورت AJAX در اینجا نمایش داده می‌شود -->
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('birth_date').addEventListener('input', function() {
            const birthDate = new Date(this.value);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            document.getElementById('age').value = age;
        });

        document.getElementById('manual-quotation-form').addEventListener('submit', function(event) {
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
                    fetch(`/admin/quotations/getOffers/${result.quotation_id}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }).then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text();
                    }).then(html => {
                        document.getElementById('offers-container').innerHTML = html;
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
    });
</script>