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
            color: #1b7a7a
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

    $service_name;
    $total_hirings;
    $total_tradesman;
    $average_rating;
    $cover_photo;
    $item_added_date;
    $img_err = "";

    // if (isset($_POST['add'])) {
        
    //     $service_name = $_POST['service_name'];
    //     $provider_name = $_POST['provider_name'];
    //     //$cover_photo = $_POST['cover_photo'];


    //     date_default_timezone_set("Asia/Colombo");
    //     $item_added_date = date("Y-m-d h:i:sa");

    //     if (!empty($_FILES['cover_photo'])) {

    //         $check = getimagesize($_FILES["cover_photo"]["tmp_name"] ?? "");
    //         if ($check !== false) {
    //             $cover_photo = $_FILES['cover_photo']['name'];
    //             $tmp_imageName = $_FILES['cover_photo']['tmp_name'];
    //             $folder = 'images/';
    //             move_uploaded_file($tmp_imageName, $folder . $cover_photo);
    //             $add_item_query = "INSERT INTO `service` (`service_name`, `provider_name`,`cover_photo`) VALUES ('$service_name','$provider_name','$cover_photo')";

    //             QueryHandler::query($add_item_query);
    //         } else {
    //             $img_err = "File is not an image.";
    //         }
    //     } 
        
    // }

    
    ?>


    <section class="menu-section sec-padding" id="our-menu">
        <div class="container">
            <div class="row">
                <!-- Button trigger modal -->

                <div class="menu-tabs mt-3 mb-3 pt-1">
                    <button type="button" class="btn my-0" data-toggle="modal" data-target="#exampleModal" style="background-color: #142f61; color:white; font-weight:600; ">
                        Add New Service
                    </button>
                    
                </div>
                <div class="table-responsive" style="border-style: double; border-color:#142f61; padding-top: 12px; border-width: 5px;">
            <table class="item_table  table text-center">
                <thead>
                    <tr id="table-text">
                        <th scope="col" id="itemid">Service_ID</th>
                        <th scope="col">Service Name</th>
                        <th scope="col">Total Tradesman</th>
                        <th scope="col">Total Hirings</th>
                        <th scope="col">Average Rating</th>
                        <th scope="col">Cover Photo</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php


                    
                    $item_query = "SELECT * FROM service";
                    $item_result = QueryHandler::query($item_query);

                    if (mysqli_num_rows($item_result) > 0) {
                        while ($row = mysqli_fetch_assoc($item_result)) {
                            $service_id = $row['service_id'];
                            $service = new Service();
                            $service->read($service_id);
                    ?>

                            <tr id="table-text">
                                <td><?php echo $service_id ?></td>
                                <td><?php echo $service->getService_name() ?></td>
                                <td><?php echo $service->getTotal_tradesman() ?></td>
                                <td><?php echo $service->getTotal_hirings() ?></td>
                                <td><?php echo $service->getAverage_rating() ?></td>
                                <td><img src="<?php echo "Assets/Images/" . $service->getCover_photo() ?>" class="img-responsive  radius" style="max-height:100px;max-width:150px;"></td>
                                

                            </tr>

                    <?php
                        }
                    } else {
                        echo '<td colspan="7"><center>No Dish-Data!</center></td>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        </div>
            
            

            
        </div>
    </section>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel" style="color: #142f61; border-color: #142f61;">Add a new service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="serviceForm" action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label my-1">Service Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="my-2 form-control inputstl" name="service_name" style="border-color: #142f61;" id="service_name" required />
                            </div>
                        </div>

                        <div class="form-group row my-3">
                            <label for="indexno" class="col-sm-4 col-form-label my-1">Provider Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="my-2 form-control inputstl" name="provider_name" style="border-color: #142f61;" id="provider_name" rows="2" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="selectfile" class="col-sm-4 col-form-label my-1">Cover photo:</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" name="cover_photo" id="inputGroupFile02" style="border-color: #142f61; color: #142f61; ">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="add" type="submit" class="btn fw-bold " name="add" style="background-color: #142f61; color:#FFFFFF;">Add Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
<?php
 if (isset($_POST['add'])) {
    $notification  = new Notification();
    // $admin = new Admin();
    $admin = Admin::getInstance();
    $service_name = $_POST['service_name'];
    $provider_name = $_POST['provider_name'];
    //$cover_photo = $_POST['cover_photo'];


    date_default_timezone_set("Asia/Colombo");
    $item_added_date = date("Y-m-d h:i:sa");

    if (!empty($_FILES['cover_photo'])) {

        $check = getimagesize($_FILES["cover_photo"]["tmp_name"] ?? "");
        if ($check !== false) {
            $cover_photo = $_FILES['cover_photo']['name'];
            $tmp_imageName = $_FILES['cover_photo']['tmp_name'];
            $folder = 'Assets/Images/';
            move_uploaded_file($tmp_imageName, $folder . $cover_photo);
            $add_item_query = "INSERT INTO `service` (`service_name`, `provider_name`,`cover_photo`) VALUES ('$service_name','$provider_name','$cover_photo')";

            QueryHandler::query( $add_item_query);

            $getNewServiceId =  "SELECT * FROM service where service_name='$service_name' AND provider_name='$provider_name';";
            $result_1 = QueryHandler::query($getNewServiceId);
            $row = mysqli_fetch_assoc($result_1);
            $newservice_id = $row['service_id'];
            $admin->sendNotificationALL($service_name, $newservice_id);

        } else {
            $img_err = "File is not an image.";
        }
    } 
    

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
<script>
      
       



    </script>
</body>

</html>