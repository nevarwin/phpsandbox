<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <ol>
        <!-- use of normal php function -->
        <?php foreach (filterBooks($books) as $book) : ?>
            <li>
                <a href="<?= $book['purchaseUrl'] ?>">
                    <?= $book['name'] ?>
                    <?= $book['releaseYear'] ?>
                </a>
            </li>
        <?php endforeach; ?>

        <!-- added arguments to the function -->
        <?php foreach (filterBooksAdded($books, 'author2') as $book) : ?>
            <li>
                <a href="<?= $book['purchaseUrl'] ?>">
                    <?= $book['name'] ?>
                    <?= $book['releaseYear'] ?>
                </a>
            </li>
        <?php endforeach; ?>

        <!-- anon function -->
        <?php foreach ($filterBooksAnon($books, 'author2') as $book) : ?>
            <li>
                <a href="<?= $book['purchaseUrl'] ?>">
                    <?= $book['name'] ?>
                    <?= $book['releaseYear'] ?>
                </a>
            </li>
        <?php endforeach; ?>

        <p>lambda function</p>
        <!-- lambda function -->
        <?php foreach ($filteredItems as $book) : ?>
            <li>
                <a href="<?= $book['purchaseUrl'] ?>">
                    <?= $book['name'] ?>
                    <?= $book['releaseYear'] ?>
                </a>
            </li>
        <?php endforeach; ?>

        <p>Php own filter</p>
        <!-- php own array function -->
        <?php foreach ($phpownfilter as $book) : ?>
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