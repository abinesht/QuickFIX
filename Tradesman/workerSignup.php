<!-- Modal -->
<div class="modal fade" id="staticBackdropRAC" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #142F61; color: white;">
                <h5 class="modal-title" id="staticBackdropLabel">Register As Tradesman</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"
                    style="opacity: 1;"></button>
            </div>
            <form method="POST">
                <div class="modal-body ">

                    <div class="mb-3">
                        <textarea rows="3" class="form-control form-textarea" id="message-text"
                            placeholder="Small description about you(maximum 50 words)" maxlength="250" name="description"></textarea>
                    </div>

                    <div class="mb-3">
                        <textarea rows="1" class="form-control form-textarea" id="message-text" placeholder="Years Of Experience"
                            maxlength="10" name="experience"></textarea>
                    </div>
                    <div class="form-group has-search" style="margin-left: 100px; margin-right: 100px;">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input class="form-control" type="search" placeholder="Search for services,peoples..."
                            aria-label="Search" aria-describedby="search-icon"
                            style="border-radius: 2px;padding-left: 2.375rem;background-color: #e9ecef;">
                    </div>

                    <div class="container my-3 fw-bold">
                        <?php
                            $query = "SELECT `provider_name` FROM `service`";
                            $result = QueryHandler::query($query);
                            $rows = $result->fetch_all(MYSQLI_ASSOC);
                            $i = 0;
                            foreach ($rows as $row) {
                                $PName = $row['provider_name'];
                                if($i == 0){echo '<div class="row">';}
                                echo '<div class="col-6 form-check">
                                        <input class="form-check-input form-checkbox" type="checkbox" value="'.$PName.'"
                                            id="flexCheckDefault" name = "works[]">
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
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary register" name="registerSubmit" >Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
