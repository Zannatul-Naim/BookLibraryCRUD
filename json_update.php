<?php
   function json_update(array $input) {
     // open the json file
     $data = file_get_contents('books.json');
     $books = json_decode($data);
 
     $books[] = $input;
 
     // encode back to json
     $data = json_encode($books, JSON_PRETTY_PRINT);
     file_put_contents('books.json', $data);
   }

?>