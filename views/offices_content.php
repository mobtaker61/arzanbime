<div class="mt-4">
    <h1>Offices</h1>
    <form method="GET" action="">
        <div class="form-group">
            <label for="province">Select Province:</label>
            <select class="form-control" name="province_id" id="province">
                <option value="">--Select Province--</option>
                <?php foreach ($provinces as $province): ?>
                    <option value="<?php echo $province['id']; ?>">
                        <?php echo htmlspecialchars($province['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>
    <ul id="offices-list">
        <!-- Offices will be loaded here by AJAX -->
    </ul>
</div>

<script>
$(document).ready(function(){
    $('#province').change(function(){
        var provinceId = $(this).val();
        $.ajax({
            url: '/ajax/offices.php',
            type: 'GET',
            data: { province_id: provinceId },
            dataType: 'json',
            success: function(response) {
                var officesList = $('#offices-list');
                officesList.empty();
                if(response.length === 0) {
                    officesList.append('<p>No offices found for the selected province.</p>');
                } else {
                    response.forEach(function(office) {
                        officesList.append(
                            '<li>' +
                            '<strong>' + office.name + '</strong><br>' +
                            'Address: ' + office.postal_address + '<br>' +
                            'Phone: ' + office.telephone + '<br>' +
                            'Email: ' + office.email + '<br>' +
                            '<a href="' + office.google_location + '" target="_blank">Google Map</a>' +
                            '</li>'
                        );
                    });
                }
            }
        });
    });
});
</script>
