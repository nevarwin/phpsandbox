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
        [
            'name' => 'book3',
            'releaseYear' => '2000',
            'author' => 'author3',
            'purchaseUrl' => 'google.com',
        ],
    ];

    // Normal Php function
    function filterBooks($books) {
        $filteredItems = [];

        foreach ($books as $book) {
            if ($book['author'] === 'author1') {
                $filteredItems[] = $book;
            }
        }

        return $filteredItems;
    }

    // Added arguments Php function
    function filterBooksAdded($books, $author) {
        $filteredItems = [];

        foreach ($books as $book) {
            if ($book['author'] === $author) {
                $filteredItems[] = $book;
            }
        }

        return $filteredItems;
    }

    // Anon Function
    $filterBooksAnon = function ($books, $author) {
        $filteredItems = [];

        foreach ($books as $book) {
            if ($book['author'] === $author) {
                $filteredItems[] = $book;
            }
        }

        return $filteredItems;
    };

    // Filter with more arguments Function
    function filterMoreArgu($books, $key, $value) {
        $filteredItems = [];

        foreach ($books as $book) {
            if ($book[$key] === $value) {
                $filteredItems[] = $book;
            }
        }

        return $filteredItems;
    }

    // Filter Function
    function filter2($items, $fn) {
        $filteredItems = [];

        foreach ($items as $item) {
            if ($fn($item)) {
                $filteredItems[] = $item;
            }
        }

        return $filteredItems;
    }

    $filteredItems = filter2($books, function ($book) {
        return $book['releaseYear'] >= '2000';
    });

    // php own filter - array filter
    $phpownfilter = array_filter($books, function ($book) {
        return $book['name'] === 'book2';
    });

    ?>
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
        <!-- lambda function -->
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