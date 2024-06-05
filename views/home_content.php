<div class="mt-4">
    <h1>Home</h1>

    <!-- Image Slider -->
    <div class="slider mt-5">
        <?php for ($i = 1; $i <= 10; $i++): ?>
            <div>
                <img src="/images/image<?php echo $i; ?>.jpg" alt="Image <?php echo $i; ?>">
            </div>
        <?php endfor; ?>
    </div>

    <h2 class="mt-5">Offices</h2>
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
    <div class="row">
        <div id="offices-list" class="col-md-6">
            <?php foreach ($offices as $office): ?>
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <iframe
                                width="100%"
                                height="100%"
                                frameborder="0" style="border:0"
                                src="https://www.google.com/maps/embed/v1/place?key=YOUR_GOOGLE_MAPS_API_KEY&q=<?php echo urlencode($office['google_location']); ?>"
                                allowfullscreen>
                            </iframe>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($office['name']); ?></h5>
                                <p class="card-text">Address: <?php echo htmlspecialchars($office['postal_address']); ?></p>
                                <p class="card-text">Phone: <?php echo htmlspecialchars($office['telephone']); ?></p>
                                <p class="card-text">Emailس: <?php echo htmlspecialchars($office['email']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <h2 class="mt-5">راهنما</h2>
    <div class="row">
        <?php foreach ($latestHelpContents as $content): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="<?php echo htmlspecialchars($content['image']); ?>" class="card-img-top" alt="Help Article Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($content['title']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars(substr($content['body'], 0, 100)) . '...'; ?></p>
                        <a href="?route=content&id=<?php echo $content['id']; ?>" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
$(document).ready(function(){
    $('.slider').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });

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
                            '<div class="card mb-3">' +
                            '<div class="row no-gutters">' +
                            '<div class="col-md-4">' +
                            '<iframe width="100%" height="100%" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=YOUR_GOOGLE_MAPS_API_KEY&q=' + encodeURIComponent(office.google_location) + '" allowfullscreen></iframe>' +
                            '</div>' +
                            '<div class="col-md-8">' +
                            '<div class="card-body">' +
                            '<h5 class="card-title">' + office.name + '</h5>' +
                            '<p class="card-text">Address: ' + office.postal_address + '</p>' +
                            '<p class="card-text">Phone: ' + office.telephone + '</p>' +
                            '<p class="card-text">Email: ' + office.email + '</p>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>'
                        );
                    });
                }
            }
        });
    });
});
</script>
