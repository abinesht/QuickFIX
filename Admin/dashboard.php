<?php
include '../classes.php';
// session_start();

// if (!isset($_SESSION["user"])) {
//     header("location:login.php");
// }

?>
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

    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body style="background-image: linear-gradient(to left, #FFFFFF, #597292);">
    <?php
    include 'admin_nav.php';
    $customer_count = mysqli_num_rows(QueryHandler::query("SELECT * FROM customer"));

    ?>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-4" >
                <div class="card col-10 mx-auto" style=" border-color: #142f61; ">
                    <div class="card-header mt-3 text-center h3" style="color: #142f61;  border-color: #142f61;">Customers</div>
                    <div class="card-body">
                        <div class="row d-flex text-center align-items-center">
                            <div class="col-6">
                                <img src="Assets/Images/admin_images/customer-icon.png" alt="itemicon" style="height: 150px;">
                            </div>
                            <div class="col-6 h1" style="color: #142f61;"><?php echo $customer_count;?></div>
                        </div>

                        <div class="h4 text-center my-4" style="color: #142f61;">Latest Customers</div>
                        <div class="row ">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Total Hirings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    

                                    $last_customer_query = "SELECT * FROM customer ORDER BY customer_id DESC LIMIT 5";
                                    $last_customer_result =QueryHandler::query($last_customer_query);

                                    if (mysqli_num_rows($last_customer_result) > 0) {
                                        while ($row_item = mysqli_fetch_assoc($last_customer_result)) {
                                            $customer_id = $row_item['customer_id'];
                                            $customer = new Customer();
                                            $customer->read($customer_id);


                                    ?>
                                            <tr>
                                                <td><?php echo $customer_id ?></td>
                                                <td><?php echo $customer->getUsername() ?></td>
                                                <td><?php echo $customer->getTotal_hirings_count() ?></td>
                                            </tr>

                                    <?php

                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $tradesman_count_query = "SELECT * FROM tradesman";
            $tradesman_count = mysqli_num_rows(QueryHandler::query($tradesman_count_query));
            ?>

            <div class="col-lg-4 mt-lg-0 mt-5">
                <div class="card col-10 mx-auto" style="border-color: #142f61;">
                    <div class="card-header mt-3 text-center h3" style="color: #142f61; border-color: #142f61;">Tradesmans</div>
                    <div class="card-body">
                        <div class="row d-flex text-center align-items-center">
                            <div class="col-6">
                                <img src="Assets/Images/admin_images/worker-icon.png" alt="itemicon" style="height: 150px;">
                            </div>
                            <div class="col-6 h1" style="color: #142f61;"><?php echo $tradesman_count ?></div>
                        </div>

                        <div class="h4 text-center my-4" style="color: #142f61;">Latest Tradesmans</div>
                        <div class="row ">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Total Hirings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php


                                    $last_tradesman_query = "SELECT * FROM tradesman ORDER BY tradesman_id DESC LIMIT 5";
                                    $last_tradesman_result = QueryHandler::query($last_tradesman_query);

                                    if (mysqli_num_rows($last_tradesman_result) > 0) {
                                        while ($row_item = mysqli_fetch_assoc($last_tradesman_result)) {
                                            $tradesman_id = $row_item['tradesman_id'];
                                            $tradesman = new Tradesman();
                                            $tradesman->read($tradesman_id);


                                    ?>
                                            <tr>
                                                <td><?php echo $tradesman_id ?></td>
                                                <td><?php echo $tradesman->getUsername() ?></td>
                                                <td><?php echo $tradesman->getNum_of_hirings() ?></td>
                                            </tr>

                                    <?php

                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <?php
            $service_count_query = "SELECT * FROM service";
            $service_count = mysqli_num_rows(QueryHandler::query($service_count_query));
            ?>

            <div class="col-lg-4 mt-lg-0 mt-5">
                <div class="card col-10 mx-auto" style="border-color: #142f61;">
                    <div class="card-header mt-3 text-center h3" style="color: #142f61; border-color: #142f61;">Services</div>
                    <div class="card-body">
                        <div class="row d-flex text-center align-items-center">
                            <div class="col-6">
                                <img src="Assets/Images/admin_images/service-icon.png" alt="itemicon" style="height: 150px;">
                            </div>
                            <div class="col-6 h1" style="color: #142f61;"><?php echo $service_count ?></div>
                        </div>

                        <div class="h4 text-center my-4" style="color: #142f61;">Latest Services</div>
                        <div class="row ">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Service Name</th>
                                        <th scope="col">Total Hirings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                    $last_service_query = "SELECT * FROM service ORDER BY service_id DESC LIMIT 5";
                                    $last_order_result = QueryHandler::query($last_service_query);

                                    if (mysqli_num_rows($last_order_result) > 0) {
                                        while ($row_item = mysqli_fetch_assoc($last_order_result)) {
                                            $service_id = $row_item['service_id'];
                                            $service = new Service();
                                            $service->read($service_id);


                                    ?>
                                            <tr>
                                                <td><?php echo $service_id ?></td>
                                                <td><?php echo $service->getService_name() ?></td>
                                                <td><?php echo $service->getTotal_hirings() ?></td>
                                            </tr>

                                    <?php

                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</body>

<script>



</script>

</html>