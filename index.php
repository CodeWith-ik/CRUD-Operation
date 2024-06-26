<?php
    require("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Products Store</title>
</head>
<body class="bg-light">
    <div class="container bg-dark text-light p-3 rounded my-4">
        <div class="d-flex align-items-center justify-content-between px-3"> 
            <h2>
                <a href="index.php" class="text-white text-decoration-none"><i class="bi bi-bar-chart-fill"></i>Products Store</a>
            </h2>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addproduct">
                <i class="bi bi-plus"></i>Add Products
            </button>
        </div>
    </div>

    <!-- Product view start -->
    <div class="container mt-5 p-0">
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th width="10%" class="bg-dark text-light rounded-start" scope="col">Sr. No.</th>
                    <th width="15%" class="bg-dark text-light" scope="col">Image</th>
                    <th width="10%" class="bg-dark text-light" scope="col">Name</th>
                    <th width="10%" class="bg-dark text-light" scope="col">Price</th>
                    <th width="35%" class="bg-dark text-light" scope="col">Description</th>
                    <th width="20%" class="bg-dark text-light rounded-end" scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php
                    $query = "SELECT * FROM `products`";
                    $result = mysqli_query($con, $query);

                    $i = 1;
                    $fetch_src = FETCH_SRC;

                    while ($fetch = mysqli_fetch_assoc($result)) {
                        $imagePath = $fetch_src . $fetch['image'];
                        echo <<<product
                        <tr class="align-middle">
                            <th scope="row">$i</th>
                            <td><img src="$imagePath" width="150px"></td>
                            <td>{$fetch['name']}</td>
                            <td>$ {$fetch['price']}</td>
                            <td>{$fetch['description']}</td>
                            <td>
                                <a href="edit.php?id={$fetch['id']}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                <a href="delete.php?id={$fetch['id']}" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        product;
                        $i++;
                    }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Product view -->

    <!-- Modal -->
    <div class="modal fade" id="addproduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="crud.php" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Add Products</h1>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Name</span>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Price</span>
                            <input type="number" class="form-control" name="price" min="1" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Description</span>
                            <textarea class="form-control" name="desc" required></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text">Image</label>
                            <input type="file" class="form-control" name="image" accept=".jpg, .png, .svg" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="addproduct">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
