<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laracast Quiz View</title>
</head>

<body>
    <h1><?= $business['name'] ?></h1>

    <ol>
        <?php foreach ($business['subjects'] as $subject) : ?>
            <li><?= $subject ?></li>
        <?php endforeach; ?>
    </ol>

    <script src="index.js"></script>
</body>

</html>