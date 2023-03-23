<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <title>Document</title>
</head>

<body>
    <?php include 'server-info.php'; ?>
    <div class="container">
        <h1>Server & Client</h1>
        <?php if ($server) : ?>
            <ul class='list-group'>
                <?php foreach ($server as $key => $value) : ?>
                    <li class='list-group-item'>
                        <strong><?php echo "$key: " ?></strong>
                        <?php echo $value ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <br>
        <?php if ($client) : ?>
            <ul class='list-group'>
                <?php foreach ($server as $key => $value) : ?>
                    <li class='list-group-item'>
                        <strong><?php echo "$key: " ?></strong>
                        <?php echo $value ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>

</html>