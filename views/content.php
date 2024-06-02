<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($content['title']); ?></title>
</head>
<body>
    <h1><?php echo htmlspecialchars($content['title']); ?></h1>
    <p><?php echo nl2br(htmlspecialchars($content['body'])); ?></p>
    <a href="../index.php">Back to Home</a>
</body>
</html>