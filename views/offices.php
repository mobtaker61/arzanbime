<!DOCTYPE html>
<html>
<head>
    <title>Offices</title>
</head>
<body>
    <h1>Offices</h1>

    <form method="GET" action="">
        <label for="province">Select Province:</label>
        <select name="province_id" id="province">
            <option value="">--Select Province--</option>
            <?php foreach ($provinces as $province): ?>
                <option value="<?php echo $province['id']; ?>" <?php echo ($province['id'] == $province_id) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($province['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Filter">
    </form>

    <?php if ($province_id && empty($offices)): ?>
        <p>No offices found for the selected province.</p>
    <?php elseif ($province_id): ?>
        <h2>Offices in <?php echo htmlspecialchars($offices[0]['province_name']); ?></h2>
        <ul>
            <?php foreach ($offices as $office): ?>
                <li>
                    <strong><?php echo htmlspecialchars($office['name']); ?></strong><br>
                    Address: <?php echo htmlspecialchars($office['postal_address']); ?><br>
                    Phone: <?php echo htmlspecialchars($office['telephone']); ?><br>
                    Email: <?php echo htmlspecialchars($office['email']); ?><br>
                    <a href="<?php echo htmlspecialchars($office['google_location']); ?>" target="_blank">Google Map</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
