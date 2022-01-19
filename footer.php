<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Footer</title>
</head>

<style>
    @font-face {
        font-family: 'Lucida Fax';
        src: url(fonts/Lucida\ Fax\ Regular.ttf);
    }

    @font-face {
        font-family: 'proxima nova';
        src: url(fonts/Proxima\ Nova\ Regular.ttf);
    }

    /* ------------------------------------------------------------------------------------------------ */

    .footer {
        background-color: #142f61;
        color: white;
    }

    .footer1234 {
        font-family: 'Lucida Fax', Arial, Helvetica, sans-serif;
        font-style: italic;
        font-weight: 600;
        font-size: calc(15px + 0.1vw);
    }

    .footer234 {
        padding-top: 25px;
    }

    .footer2 form input[type=submit] {
        background: #5c726a;
        border: none;
        padding: 3px 15px;
        border-radius: 10px;
        color: #fff;
        margin-top: 9px;
        margin-left: 6px;
        height: 32px;
        font-family: 'Lucida Fax', Arial, Helvetica, sans-serif;
        font-style: italic;
        font-weight: 600;
    }
    .footer2 form input[type=submit]:hover{
        background-color: #d1d4d3;
        color: black;
        
    }

    .footer2 form input[type=email] {
        width: 330px;
        height: 30px;
        border: none;
        border-radius: 3px;
        margin-top: 9px;
    }

    .footer3 span {
        margin-left: 5px;
        padding: 0;
    }

    .footer3 a {
        background: #d1d3d2;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        padding: 0px 1px;
        margin: 3.5px 0.5vw;
        font-size: 20px;
    }
    .footer3 a:hover{
        background-color: white;
    }

    .footer3 a i {
        color: #142f61;
        padding-left: 4.5px;
        padding-bottom: px;
    }

    .copyright {
        border-top-style: solid;
        border-color: white;
        border-width: 3.5px;
        font-size: calc(17px + 0.1vw);
        font-family: 'proxima nova', Arial, Helvetica, sans-serif;
        font-weight: lighter;
    }

    /* ----------------------------------------------------------------------------------------------------------- */

    @media (max-width: 1400px) {

        .footer2 form input[type=submit] {
            font-weight: 600;
        }

        .footer2 form input[type=email] {
            width: 310px;
        }
    }

    @media (max-width: 1200px) {

        .footer2 form input[type=email] {
            width: 300px;
        }
    }

    @media (max-width: 992px) {

        .footer1 {
            margin-bottom: -28px;
        }

        .footer34 {
            display: grid;
            justify-content: center;
        }

        .footer3 {
            margin-right: 150px;
        }

        .copyright {
            margin-top: -20px;
        }

    }

    @media (max-width: 768px) {

        .footer2 form input[type=email] {
            width: 360px;
        }

        .footer1 {
            display: grid;
            justify-content: center;
            margin-bottom: -22px;
        }

        .logo {
            margin-right: 12px;
            margin-top: -12px;
        }

        .footer34 {
            display: grid;
            justify-content: center;
        }

        .footer3 {
            margin-right: 20px;
            width: 250px;
        }

        .copyright {
            margin-top: -20px;
        }

        .footer3 a {
            width: calc(20px + 0.3vw);
            height: calc(20px + 0.3vw);
            padding: 0px 1px;
            margin: 3.5px 0.9vw;
            font-size: calc(13px + 0.3vw);
        }

        .footer3 a i {
            color: #142f61;
            padding-left: 4.5px;
            padding-bottom: px;
        }

        .footer2 form input[type=submit] {
            height: 34px;
            
        }

        .footer2 form input[type=email] {
            height: 32px;
            
        }
    }

    @media (max-width: 576px) {

        .footer1 {
            display: grid;
            justify-content: center;
            margin-bottom: -24px;
        }

        .logo {
            margin-right: 9px;
            margin-top: -14px;
        }

        .footer2 form input[type=submit] {
            width: 60%;
        }

        .footer2 form input[type=email] {
            width: 80%;
        }

        .footer3 {
            margin-right: 20px;
            width: 250x;
            margin-left: 4%;
        }

        .copyright {
            margin-top: -25px;
        }
    }

    @media (max-width: 300px) {
        .footer3 {
            margin-right: 02px;
            width: 250x;
            margin-left: 4%;
        }

        .copyright {
            margin-top: -15px;
        }
    }

    .upload {
    background-color: #142f61;
    font-weight: bold;
    font-size: large;
    border: none;
    color: rgb(255, 255, 255);
    }

    .upload:focus {
    box-shadow: none;
    background-color: #142f61;
    }
    .upload:hover {
    background-color: #1d345f;
    }
    .savechanges{
    background-color:#142F61;
    font-weight: bold;
    border: none;
    }

    .savechanges:focus{
    box-shadow: none;
    background-color: #142F61;
    }
    .savechanges:hover{
    background-color:#1d345f;
    }

    .dropdownbtn {
    background-color: #142f61;
    font-weight: bold;
    border: none;
    }
    
    .hire_now_button {
        width: 14rem;
        color: rgb(255, 255, 255);
        background-color: #142f61;
    }
    .schedule_hiring_button {
            color: rgb(0, 0, 0);
            background-color: #F6E92F;
            width: 14rem;
    }
        .dropdownbtn {
    background-color: #142f61;
    font-weight: bold;
    border: none;
    }

    .dropdownbtn:focus {
    box-shadow: none;
    background-color: #142f61;
    }
    .dropdownbtn:hover {
    background-color: #1d345f;
    }

        .register{
        background-color:#142F61;
        font-weight: bold;
        border: none;
        
    }

    .register:focus{
        box-shadow: none;
        background-color: #142F61;
    }
    .register:hover{
        background-color:#1d345f;
    }

    .form-checkbox:checked {
    background-color: #1d345f;
    }


    .form-textarea{
    resize: none;
    }
</style>
<!-- ----------------------------------------------------------------------------------------------------- -->


<body>
    <!-- footer code start here ------------------------------------------------->
    <div class="footer">
        <div class="container">
            <div class="row pt-4">

                <!-- --------------------footer1 -------------------------------------->
                <div class="col-lg-2 col-md-4 text-center footer1 footer1234">
                    <div class="row">
                        <div class="col logo">
                            <img src="Assets/Images/logo_footer.png" alt="QuickFIX" width="130">
                        </div>
                        <div class="col mt-2 mb-3">
                            <span>
                                Your Needs <br>
                                Our Priorities
                            </span>
                        </div>
                    </div>
                </div>

                <!------------------------------ footer2 --------------------------------->
                <div class="col text-center footer234 footer2 footer1234">
                    <span>
                        Join the conversation, Subscribe to receive
                        <br>
                        emails for events, updates and offers.
                    </span>
                    <form action="" class="">

                        <input type="email" id="subscribe" name="subscribe">

                        <input type="submit" class="" value="SUBSCRIBE">

                    </form>

                </div>

                <!------------------------- footer 3&4 ----------------------------------------->
                <div class="col-lg-4 footer234 footer34 footer1234">
                    <div class="row" style="min-height: 100px;">
                        <div class="col footer3 pb">
                            <div class="row">
                                <span>Follow us</span>
                            </div>

                            <div class="row">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>

                            </div>
                        </div>

                        <div class="col footer34 footer4">
                            <span>Call us
                                <br>
                                0212223456</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <span class="text-center mb-2 copyright pt-1">
                    Copyright &copy;2021 QuickFIX. All rights reserved
                </span>
            </div>
        </div>
    </div>

</body>

</html>