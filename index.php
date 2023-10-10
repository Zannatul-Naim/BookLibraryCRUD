<?php
$data = file_get_contents('books.json');
//decode into php array
$books = json_decode($data);
// $books_search = json_decode($data, true)
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Library</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
    .inline-container {
      display: flex;
      align-items: center;
    }

    .search-box {
      margin-left: 10px; /* Add some space between the link and the search box */
    }
  </style>
</head>

<body>

    <div class="container">
        <h1 class="page-header text-center">My Book Library</h1>
        <br> <br>
        <div class="row">
            <div class="col-12">

                <div class="inline-container">
                    <a href="add.php" class="btn btn-primary">Add New </a>
                    <form method="post">
                        <input type="text" name="input_text" id="" class="from-control rounded"
                            placeholder="Search a Book" style="margin-left:10px">
                        <input type="submit" name="search" value="search" class="btn-primary">
                    </form>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Check if the search button was clicked
                        if (isset($_POST["search"])) {
                            // Retrieve the search query from the form input
                            $searchQuery = $_POST["input_text"];
                            $flag = false;
                            foreach ($books as $book) {
                                if ($book->title == $searchQuery) {
                                    if ($book->available == "YES") {
                                        echo "<p style='background-color: white; border-radius: 10px; border: 1px solid black; color: green; padding: 10px; margin-left:25px;'><b>Available!</b></p>";
                                        $flag = true;
                                    }
                                }
                            }
                            if (!$flag) {
                                echo "<p style='background-color: white; border-radius: 10px; border: 1px solid black; color: red; padding: 10px; margin-left:25px;'><b>Not Available!</b></p>";
                            }

                        }
                    }
                    ?>
                </div>

                <table class="table table-bordered table-striped" style="margin-top:20px;">
                    <thead>
                        <th>Title</th>
                        <th>Author's Name</th>
                        <th>Availability</th>
                        <th>No. of Pages</th>
                        <th>ISBN No.</th>
                        <th>Action</th>
                    </thead>
                    <?php
                    // fetch data from json
                    
                    $index = 0;
                    foreach ($books as $book) {
                        echo "
                    <tr>
                    <td>" . $book->title . "</td>
                    <td>" . $book->author . "</td>
                    <td>" . $book->available . "</td>
                    <td>" . $book->pages . "</td>
                    <td>" . $book->isbn . "</td>
                    <td>
                    <a href='update.php?index=" . $index . "' class='btn btn-secondary btn-sm' >Update</a>
                    <a href='delete.php?index=" . $index . "' class='btn btn-danger btn-sm' >Delete</a>
                    </td>
                </tr>
                    ";
                        $index += 1;
                    }
                    ?>

                </table>
            </div>
        </div>
    </div>

</body>

</html>