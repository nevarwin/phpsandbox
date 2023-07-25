<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $books = [
        [
            'name' => 'book1',
            'releaseYear' => '2023',
            'author' => 'author1',
            'purchaseUrl' => 'google.com',
        ],
        [
            'name' => 'book2',
            'releaseYear' => '2021',
            'author' => 'author2',
            'purchaseUrl' => 'google.com',
        ],
    ];
    ?>
    <ol>
        <?php foreach ($books as $book) : ?>
            <li>
                <a href="<?= $book['purchaseUrl'] ?>">
                    <?= $book['name'] ?>
                    <?= $book['releaseYear'] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ol>
</body>

</html>