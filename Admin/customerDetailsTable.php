<?php

include '../classes.php';
// session_start();

// if (!isset($_SESSION["user"])) {
//     header("location:login.php");
// }
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous" />
    <style>
        #customertable-adminpage {
            background-image: linear-gradient(to right, #def2f1, #597292);
        }

        #customertable-row,
        #customertable-head {
            color: #17252A;
        }

        #nav {
            color: black;
            background-color: #142f61;
        }

        .padd {
            
            background-color: #def2f1;
            color: rgb(85, 85, 74) !important;
            font-family: cursive;
            border-radius: 10rem;

        }

        body {
            background-image: linear-gradient(to left, #FFFFFF, #597292);
        }
    </style>
</head>

<body>
    <?php

    include 'admin_nav.php';

    if (isset($_SESSION['page'])) {
        $results_per_page = $_SESSION['page'];
    } else {
        $results_per_page = 3;
    }

    if (isset($_POST['submit'])) {
        if (!empty($_POST['pages'])) {
            $_SESSION['page'] = $_POST['pages'];
            $results_per_page = $_SESSION['page'];
        }
    }



    // $conn = mysqli_connect("localhost", "root", "", "hipster");
    $sql = "SELECT * from customer;";
    $result = QueryHandler::query($sql);
    $number_of_result = mysqli_num_rows($result);

    $number_of_page = ceil($number_of_result / $results_per_page);


    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }

    $page_first_result = ($page - 1) * $results_per_page;

    ?>

    <div class="container" style="background-color: white;">
        <h2 class="mt-4 text-center">Customer Details</h2>
    </div>

    <!-- selection <1,2,3,4> options for one page view -->
    <div class="container">
        <div class="row mx-3 my-2 ">
            <form action="" method="post" class="row d-flex justify-content-start">
                <div class="col-5 col-md-3 col-lg-2">
                    <select name="order_page" class="form-select" aria-label="Default select example">
                        <option selected value="2">Select num of items</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">three</option>
                        <option value="4">Four</option>
                    </select>

                </div>
                <div class=" col-5 col-md-3 col-lg-1 text-center">
                    <input class="btn btn-primary" type="submit" name="selection" vlaue="Select Movie" style="background-color: #142f61;">
                </div>
            </form>
        </div>
    </div>
    <!-- selection end -->

    <div class="container">
        <!-- customer detail table -->
        <div style="border: 5px double #142f61; padding:10px;">
            <div id="customertable-adminpage" class="table-bg table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr id="customertable-head">
                            <th scope="col">ID</th>
                            <th scope="col">Firstname</th>
                            <th scope="col">Lastname</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Address</th>
                            <th scope="col">Date</th>
                            <th scope="col">Total payment</th>
                        </tr>
                    </thead>


                    <tbody>

                        <?php
                        $sql = "SELECT * from customer limit " . $page_first_result . ',' . $results_per_page;
                        $result = QueryHandler::query($sql);
                        if (!$result) {
                            die('QUERY FAIL!');
                        }
                        while ($row = mysqli_fetch_assoc($result)) {
                            $customer_id = $row['customer_id'];
                            $customer = new Customer();
                            $customer->read($customer_id);

                        ?>
                            <!-- customer table details ROW                 -->
                            <tr id="customertable-row">
                                <td> <?php echo $customer_id ?></td>
                                <td><?php echo $customer->getFirstname() ?></td>
                                <td><?php echo $customer->getLastname() ?></td>
                                <td><?php echo $customer->getEmail() ?></td>
                                <td><?php echo $customer->getPhone_no() ?></td>
                                <td><?php echo $customer->getAddress() ?></td>
                                <td><?php echo $customer->getRegistered_date() ?></td>
                                <td><?php echo $customer->getTotal_payment() ?>.00</td>

                            </tr>
                        <?php


                        }

                        ?>

                    </tbody>
                </table>

            </div>
        </div>
        <!-- paggination navbar -->
        <nav id="nav" aria-label="Blog Page navigation example" class="my-5">
            <ul class="pagination  justify-content-center">
                <?php
                for ($page = 1; $page <= $number_of_page; $page++) {
                    echo ' <li class="page-item"><a class="page-link" href="customerDetailsTable.php?page=' . $page . '">' . $page . ' </a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
    <!-- paggination - active(padd classname will add)    -->
    <script>
        const currentLocationn = location.href
        const menuItemm = document.querySelectorAll('.page-item .page-link')
        const menuLengthh = menuItemm.length
        for (let i = 0; i < menuLengthh; i++) {
            if (menuItemm[i].href === currentLocationn) {
                menuItemm[i].className += " padd"
            }
        }


        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>


</body>

</html>