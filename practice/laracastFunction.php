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
    [
        'name' => 'book4',
        'releaseYear' => '1951',
        'author' => 'author4',
        'purchaseUrl' => 'google.com',
    ],
    [
        'name' => 'book5',
        'releaseYear' => '2019',
        'author' => 'author5',
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
    return $book['releaseYear'] >= 1950 and $book['releaseYear'] < 2024;
});


// for referencing the html file that uses the code above.
require('laracastFunction.view.php');
