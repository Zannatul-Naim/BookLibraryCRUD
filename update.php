<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <?php
        $index = $_GET['index'];

        $data = file_get_contents('books.json');
        $books = json_decode($data);

        $book = $books[$index];

        if (isset($_POST['save'])) {
            $input = array(
                "title" => $_POST['title'],
                "author" => $_POST['author'],
                "available" => strtoupper($_POST['available']),
                "pages" => (int) $_POST['pages'],
                "isbn" => (int) $_POST['isbn']
            );

            $books[$index] = $input;
            $data = json_encode($books, JSON_PRETTY_PRINT);
            file_put_contents('books.json', $data);
            header('location: index.php');
        }
        ?>
        <h1 class="page-header text-center">Update Book</h1>
        <div class="row">
            <div class="col-8"><a href="index.php">Back</a></div>
            <form method="post">
                <div class="mb-3 row">
                    <label for="title" class="col-sm-2 col-form-label">Book Title</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" id="title" class="form-control" required
                            value="<?php echo $book->title ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="author" class="col-sm-2 col-form-label">Author's Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="author" id="author" class="form-control" required
                            value="<?php echo $book->author ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="available" class="col-sm-2 col-form-label">Availability</label>
                    <div class="col-sm-10">
                        <select name="available" id="availability" class="form-select" required>
                            <option value="Yes" <?php if ($book->available === 'Yes')
                                echo 'selected'; ?>>Yes</option>
                            <option value="No" <?php if ($book->available === 'No')
                                echo 'selected'; ?>>No</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="pages" class="col-sm-2 col-form-label">No. of Pages</label>
                    <div class="col-sm-10">
                        <input type="number" name="pages" id="pages" class="form-control" required
                            value="<?php echo $book->pages ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="isbn" class="col-sm-2 col-form-label">ISBN No.</label>
                    <div class="col-sm-10">
                        <input type="number" name="isbn" id="isbn" class="form-control" required
                            value="<?php echo $book->isbn ?>">
                    </div>
                </div>
                <input type="submit" name="save" value="Save" class="btn btn-primary">
            </form>
        </div>
        <div class="col-5"></div>
    </div>
</body>

</html>