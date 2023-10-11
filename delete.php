<?php
    // get index
    $index = $_GET['index'];

    // fetch data from json
    $data = file_get_contents('books.json');
    $books = json_decode($data, true);

    // delete the row with the index
    unset($books[$index]);

    $books = array_values($books);

    // echo "<pre>";
    // print_r($books);
    // echo "</pre>";
    // var_dump($books);
    // encode back to json
    $data = json_encode($books, JSON_PRETTY_PRINT);
    file_put_contents('books.json', $data);

    header('location: index.php');
?>