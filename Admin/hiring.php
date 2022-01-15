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

    <style>
        td:hover {
            background-color: #def2f1;
        }

        tr {
            color: #142f61;
        }

        .item_table {
            background-image: linear-gradient(to right, #def2f1, #597292);
        }

        #table-text {
            color: #17252A;

        }

        .badge:hover {
            background-color: #17252A !important;
        }

        #change:hover {
            background-color: rgba(236, 29, 29, 0) !important;
        }


        body {
            background-image: linear-gradient(to left, #FFFFFF, #597292);
        }

        .menu-section .section-title {
            margin-bottom: 40px;
        }

        .menu-tabs {
            background-color: #fafafa;
            padding: 0 15px;
            width: 100%;
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 2px;
        }

        .menu-tab-item {
            color: #597292;
            font-size: 18px;
            font-family: inherit;
            text-transform: capitalize;
            border: none;
            background-color: transparent;
            font-weight: 500;
            cursor: pointer;
            margin: 0 10px 10px;
            transition: color 0.3s ease;
        }

        .active {
            color: #142f61;
            font-weight: 700;
        }

        .menu-item {
            width: 50%;
            padding: 20px 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;

        }

        .menu-item-title {
            display: flex;
            align-items: center;

        }

        .menu-item-title h3 {
            color: #fafafa;
            font-size: 16px;
            text-transform: capitalize;
            transition: color 0.3s ease;
        }

        .menu-item:hover .menu-item-title h3 {
            color: #1a948e;
        }

        .menu-item-title img {
            max-width: 100px;
            margin-right: 15px;
        }

        .menu-item-price {
            color: white;
            font-size: 16px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .menu-item:hover .menu-item-price {
            color: #1a948e;
        }

        .menu-tab-content {
            display: none;
        }

        .menu-tab-content.active {
            display: flex;
        }
    </style>
</head>

<body>


    <?php
    include 'admin_nav.php';
    ?>


    <section class="menu-section sec-padding" id="our-menu">
        <div class="container">
            <div class="row">
                <!-- Button trigger modal -->

                <div class="menu-tabs mt-3 mb-3 pt-1">
                    <button type="button" class="menu-tab-item  active" data-target="#all">All</button>
                    <button type="button" class="menu-tab-item" data-target="#ongoing">Ongoing</button>
                    <button type="button" class="menu-tab-item" data-target="#completed">Completed</button>
                    <button type="button" class="menu-tab-item" data-target="#scheduled">Scheduled</button>
                    <button type="button" class="menu-tab-item" data-target="#cancelled">Cancelled</button>
                </div>
            </div>
            <div class="row menu-tab-content active" id="all">
                <?php showItems("SELECT * FROM hiring") ?>
            </div>

            <div class="row menu-tab-content " id="ongoing">
                <?php showItems("SELECT * FROM hiring WHERE final_status = 'Ongoing'") ?>
            </div>
            <div class="row menu-tab-content" id="completed">
                <?php showItems("SELECT * FROM hiring WHERE final_status = 'Completed'") ?>
            </div>
            <div class="row menu-tab-content" id="scheduled">
                <?php showItems("SELECT * FROM hiring WHERE final_status = 'Scheduled'") ?>
            </div>
            <div class="row menu-tab-content" id="cancelled">
                <?php showItems("SELECT * FROM hiring WHERE final_status = 'Cancelled'") ?>
            </div>
        </div>
    </section>


    <?php
    function showItems($item_query)
    {
        
    ?>


        <div class="table-responsive" style="border-style: double; border-color:#142f61; padding-top: 12px; border-width: 5px;">
            <table class="item_table  table text-center">
                <thead>
                    <tr id="table-text">
                        <th scope="col" id="itemid">Hiring_ID</th>
                        <th scope="col">Service Name</th>
                        <th scope="col">Tradesman Name</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Register Date</th>
                        <th scope="col">Address</th>
                        <th scope="col">Amount</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php


                    
                    $item_result = QueryHandler::query($item_query);

                    if (mysqli_num_rows($item_result) > 0) {
                        while ($row = mysqli_fetch_assoc($item_result)) {
                            $hiring_id = $row['hiring_id'];
                            $service_id = $row['service_id'];
                            $tradesman_id = $row['tradesman_id'];
                            $customer_id = $row['customer_id'];

                            $hiring = new Hiring();
                            $hiring->read($hiring_id);
                            
                            $service =new Service();
                            $service->read($service_id);

                            $tradesman = new Tradesman();
                            $tradesman->read($tradesman_id);

                            $customer = new Customer();
                            $customer->read($customer_id);
                    ?>

                            <tr id="table-text">
                                <td scope="row"><?php echo $hiring_id ?></td>
                                <td><?php echo $service->getService_name() ?></td>
                                <td><?php echo $tradesman->getUsername() ?></td>
                                <td><?php echo $customer->getUsername() ?></td>
                                <td><?php echo $hiring->getRegistered_dateTime() ?></td>
                                <td><?php echo $hiring->getAddress() ?></td>
                                <td><?php echo $hiring->getHiring_amount() ?>.00</td>


                            </tr>

                    <?php
                        }
                    } else {
                        echo '<td colspan="7"><center>No Hirings to show!</center></td>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <?php
    }
    ?>

    
    <script type="text/javascript">
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        const menuTabs = document.querySelector(".menu-tabs");
        menuTabs.addEventListener("click", function(e) {
            if (e.target.classList.contains("menu-tab-item") && !e.target.classList.contains("active")) {
                const target = e.target.getAttribute("data-target");

                menuTabs.querySelector(".active").classList.remove("active");
                e.target.classList.add("active");
                const menuSection = document.querySelector(".menu-section");
                menuSection.querySelector(".menu-tab-content.active").classList.remove("active");
                menuSection.querySelector(target).classList.add("active");
            }
        });

        $("#myBtn").click(function() {
            // Show the Modal on load
            $("#myModal").modal("show");

        });
    </script>

</body>

</html>