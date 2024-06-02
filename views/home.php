<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h1>Home</h1>
    <h2>Notices & Help Articles</h2>
    <ul>
        <?php foreach ($contents as $content): ?>
            <li>
                <a href="content.php?id=<?php echo $content['id']; ?>">
                    <?php echo htmlspecialchars($content['title']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
