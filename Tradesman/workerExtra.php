<div class="form-group row my-3 ">
    <label class="col-lg-3 col-md-4 col-sm-4  control-label mt-1">Description:</label>
    <div class="col-lg-9 col-md-6 col-sm-8 col-xs-4">
        <input class="form-control " type="text" id="description" value="<?php echo $user->getDescription(); ?>" name="description">
    </div>
</div>
<div class="modal-body">
    <div class="form-group has-search" style="margin-left: 100px; margin-right: 100px;">
        <span class="fa fa-search form-control-feedback"></span>
        <input class="form-control" type="search" placeholder="Search for services,peoples..." aria-label="Search" aria-describedby="search-icon" style="border-radius: 2px;padding-left: 2.375rem;background-color: #e9ecef;">
    </div>
    <div class="container my-3 fw-bold">
        <?php
            $query = "SELECT `provider_name`,`service_id` FROM `service`";
            $result = QueryHandler::query($query);
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $i = 0;
            foreach ($rows as $row) {
                $PName = $row['provider_name'];
                if($i == 0){echo '<div class="row">';}
                echo '<div class="col-6 form-check">
                        <input class="form-check-input form-checkbox" type="checkbox" value="'.$PName.'"
                            id="flexCheckDefault" name = "works[]" ';
                            if ($user->hasService($row['service_id'])) {
                                echo 'checked';
                            }
                            echo '>
                        <label class="form-check-label" for="flexCheckDefault">'
                            .$PName.
                        '</label>
                    </div>';
                if($i == 2){echo '</div>';}
                $i = ($i+1)/3;
            }
            if ($i!=0) {
                echo '</div>';
            }
        
        ?>
    
        <div>
            <button type="button" class="btn btn-sm register mt-2"
                style="color: rgb(255, 255, 255); margin-left: 180px;">Load more..</button>
        </div>
    </div>
</div>