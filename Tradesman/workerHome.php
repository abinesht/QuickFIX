<?php
include "header.php";

?>

<html>
  <head>
    <link
      rel="stylesheet"
      href="path/to/font-awesome/css/font-awesome.min.css"
    />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/workerSignup.css">
    <style>
      #top1 {
        background-color: rgb(223, 223, 223);
        font-weight: bold;
      }
    
      #earnsHeading {
        border-bottom: 0.2rem solid #142f61;
      }
      #workerPhoto {
        border-radius: 35%;
        height: 7rem;
        width: 7rem;
      }
      #reviewtext{
        color:#818589; ;
      }

      @media (max-width: 992px) {
        #details {
          text-align: center;
        }
        #number {
          text-align: center;
        }

        
      }
      @media (min-width: 768px) {
          #profile {
            border-right: 0.3rem solid #142f61;
          }
        }
     

      /*------------------------------------------------------------------------*/
      .calendar {
        display: flex;
        flex-flow: column;
      }

      .calendar .days {
        display: flex;
        flex-flow: wrap;
      }

      .calendar .days .day_name {
        width: calc(100% / 7);
        border-right: 1px solid #ffffff;
        padding: 0.25rem;
        text-transform: none;
        font-size: 0.75rem;
        font-weight: bold;
        color: #818589;
        color: #fff;
        background-color: #142f61;
      }

      .calendar .days .day_name:nth-child(7) {
        border: none;
      }

      .calendar .days .day_num {
        display: flex;
        flex-flow: column;
        width: calc(100% / 7);
        border-right: 1px solid #000000;
        border-bottom: 1px solid #000000;
        padding: 2px;
        font-weight: bold;
        color: #000000;
        cursor: pointer;
        min-height: 50px !important;
        max-height: 50px !important;
      }

      .calendar .days .day_num span {
        display: inline-flex;
        width: 30px;
        font-size: 14px;
      }

      .calendar .days .day_num .scheduled_event {
        margin-top: -13px;
        font-weight: 500;
        font-size: 14px;
        padding-left: 10px;
        color: rgb(0, 0, 0);
        max-height: 50px;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
      }

      .calendar .days .day_num:nth-child(7n + 1) {
        border-left: 1px solid #000000;
      }

      .calendar .days .day_num:hover {
        background-color: #fdfdfde8;
      }

      .calendar .days .day_num.ignore_dates {
        background-color: #fdfdfd;
        color: #ced2d4;
        cursor: inherit;
      }

      .calendar .days .day_num.selected {
        background-color: #f1f2f3;
        cursor: inherit;
      }

      .horizontal_line_customer {
        border-top: 6px solid #142f61;
        /* height: 25rem; */
        width: 22rem;
        position: relative;
        /* right: 60%; */
        top: -1rem;
      }

      .new1 {
        border: 6px solid #142f61;
        width: 6rem;
      }

      #schedule_list {
        margin: auto;
      }

      #calendar_box {
        border: 6px solid #142f61;
        border-width: 0 0 0 0.4rem;
        padding-left: 2rem;
      }

      @media (max-width: 992px) {
        #calendar_box {
          border: 6px hidden #142f61;
        }

        .horizontal_line_customer {
          border-top: 6px solid #142f61;
          position: relative;
          top: -1rem;
          padding-top: 2rem;
          width: 18rem;
        }
      }

      /* --------------------------------------------------------------- */
      .horizontal_line_customer {
        border-top: 6px solid #142f61;
        width: 22rem;
        position: relative;
        top: -1rem;
      }

      #job_images {
        width: 15rem;
        height: 10rem;
        border-radius: 2rem;
        padding: 1rem;
      }

      /* #job{
        border-bottom: 0.18rem solid #0d56dd;
        padding-bottom: 0.5rem;
       } */
      #star {
        color: #df8918;
        position: relative;
        top: 0.4rem;
      }

      #box {
        border-bottom: 0.2rem solid #142f61;
      }

      #topServices,
      #lastHiringUnderline,
      #yourScheduleUnderline {
        border-bottom: 0.4rem solid #142f61;
      }

      @media (max-width: 768px) {
        #service_detail {
          align-items: center;
        }
      }
      /* ---------------------------------------------------------------------------------- */

      #photoWorker {
        width: 8rem;
        height: 8rem;
        border-radius: 50%;
        padding: 1rem;
      }
      #hireBox {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),
          0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-radius: 2%;
      }



      /* ----------------------------------------------------------------------------------*/
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
    </style>
  </head>
  <body>
    <div class="container-fluid bg-danger">
      <!-- --------------------Top  box 1 ------------------------------------------- -->
      <div id="top1" class="row py-5">
        <div class="col-md-5 com-sm-12 ms-lg-5 pe-0" id="profile">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-3" id="photo">
              <div class="text-center">
                <img src="images/abinesh.JPG" id="workerPhoto" class="" />
              </div>
              <div class="text-center pt-3">@abinesh26</div>
            </div>
            <div
              class="col-sm-12 col-md-12 col-lg-8 ms-lg-4 ms-md-4 ms-lg-0"
              id="details"
            >
              <div class="row" id="name">
                <div class="text-uppercase">ABINESH THAVENTHIRARAJAH</div>
              </div>
              <div class="row pt-3" id="number">
                <div>0771231231</div>
                <div>abinesh12@gmail.com</div>
                <div>No 23,Alvai East Alvai</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-5 com-sm-12 ms-4 row mt-sm-3" id="earnings">
          <div id="counts" class="col-md-12 col-sm-6">
            <div>Total Hirings - 23</div>
            <div>Total Ratings - 13</div>
            <div>Total Reviews - 11</div>
            <div>Average Rating - 4.9</div>
            <div>Total Earnings - Rs 8200.00</div>
          </div>
          <div id="eanrs" class=" mt-sm-0 mt-md-3 col-md-12 col-sm-6">
            <span id="earnsHeading" class="text-uppercase pb-1 pe-5"
              >earnings
            </span>
            <div class="mt-2">Plumbing - 10 - Hirings - Rs 3600/=</div>
            <div>Electrical work - 13 - Hirings - Rs 4600/=</div>
          </div>
        </div>
      </div>
    </div>
<div class="container">
      <!-- ------------------------------------------------------------------------- -->
      <!-- CUSTOMER scheduleS -> show scheduled details in 2 way. CALENDAR & LIST  -->
      <div class="h1 text-uppercase mt-2 ms-3">
        <span id="yourScheduleUnderline">your schedules</span>
      </div>

      <!-- <div class="horizontal_line_customer"></div> -->
      <!-- LIST VIEW OF scheduleS   :: example ::  "Sep 1, 02.10 p.m - Jeyabawan"  -->
      <div class="row m-3">
        <div class="col-md-12 col-lg-5 mb-5" id="schedule_list">
          <div class="fw-bold me-5" id="schedule_list_box">
            <p class="h3 fw-bold">You have 3 scheduled works for this month</p>
            <ul>
              <li class="fw bold h5">Sep 4, 9.00 a.m - Plumbing</li>
              <li class="fw bold h5">Sep 14, 4.00 p.m - Plumbing</li>
              <li class="fw bold h5">Sep 25, 3.00 p.m - Electrical work</li>
            </ul>
          </div>
        </div>
        <!-- this virtical line problem. when I uncomment this, CSS style of <position: relative> will  disturubing <modal> function -->
        <!-- <span class="vl"></span> -->

        <!-- CALENDAR    
          1. show scheduled details in limited box. 
           2. For more details you can mousehover on date box
          -->
        <div class="col-md-12 col-lg-7" id="calendar_box">
          <div class="calendar">
            <div class="header">
              <div class="month-year fw-bold text-center h1">
                September 2021
              </div>
            </div>

            <div class="days">
              <div class="day_name">Sunday</div>
              <div class="day_name">Monday</div>
              <div class="day_name">Tuesday</div>
              <div class="day_name">Wednesday</div>
              <div class="day_name">Thursday</div>
              <div class="day_name">Friday</div>
              <div class="day_name">Saturday</div>

              <div class="day_num ignore_dates">29</div>
              <div class="day_num ignore_dates">30</div>
              <div class="day_num ignore_dates">31</div>
              <!--scheduled day-->
              <div id="month_date1" class="day_num">
                <span>1</span>
                <div id="test1" class="scheduled_event">
                  Jeyabawan <br />
                  02.10 PM
                </div>
              </div>
              <div id="month_date2" class="day_num"><span>2</span></div>
              <div id="month_date3" class="day_num"><span>3</span></div>
              <div id="month_date4" class="day_num"><span>4</span></div>
              <div id="month_date5" class="day_num"><span>5</span></div>
              <div id="month_date6" class="day_num"><span>6</span></div>
              <div id="month_date7" class="day_num"><span>7</span></div>
              <div id="month_date8" class="day_num"><span>8</span></div>
              <div id="month_date9" class="day_num selected">
                <span>9</span>
              </div>
              <div id="month_date10" class="day_num">
                <span>10</span>
                <div id="test10" class="scheduled_event">
                  Mathiyalakan<br />
                  10.10 AM <br />Laksman <br />10.10 PM
                </div>
              </div>
              <div id="month_date11" class="day_num"><span>11</span></div>
              <div id="month_date12" class="day_num"><span>12</span></div>
              <div id="month_date13" class="day_num"><span>13</span></div>
              <div id="month_date14" class="day_num"><span>14</span></div>
              <div id="month_date15" class="day_num">
                <span>15</span>
                <div class="scheduled_event" id="test15">
                  Jeyabawan<br />
                  08.10 PM <br />
                  Saravanan <br />02.10 PM <br />
                  Laksman<br />
                  08.10 PM
                </div>
              </div>
              <div id="month_date16" class="day_num"><span>16</span></div>
              <div id="month_date17" class="day_num"><span>17</span></div>
              <div id="month_date18" class="day_num"><span>18</span></div>
              <div id="month_date19" class="day_num"><span>19</span></div>
              <div id="month_date20" class="day_num"><span>20</span></div>
              <div id="month_date21" class="day_num"><span>21</span></div>
              <div id="month_date22" class="day_num"><span>22</span></div>
              <div id="month_date23" class="day_num"><span>23</span></div>
              <div id="month_date24" class="day_num"><span>24</span></div>
              <div id="month_date25" class="day_num"><span>25</span></div>
              <div id="month_date26" class="day_num"><span>26</span></div>
              <div id="month_date27" class="day_num"><span>27</span></div>
              <div id="month_date28" class="day_num"><span>28</span></div>
              <div id="month_date29" class="day_num"><span>29</span></div>
              <div id="month_date30" class="day_num"><span>30</span></div>
              <div id="month_date31" class="day_num"><span>31</span></div>

              <div class="day_num ignore_dates">1</div>
            </div>
          </div>
        </div>
      </div>

      <!-- --------------------Third  box - LAST HIRINGS ------------------------------------------- -->
      <div class="h1 text-uppercase mt-2 ms-5">
        <span id="lastHiringUnderline">last hirings</span>
      </div>

      <div class="row fw-bold ms-3" id="hiringRow">
        <div
          class="d-flex justify-content-center row col-sm-12 col-md-12 col-lg-6"
        >
          <div id="hireBox" class="p-2 m-3 col-sm-12 col-lg-11">
            <div class="row">
              <div class="col-4  d-flex justify-content-center">
                <img src="images/mathi.jpeg" id="photoWorker" />
              </div>
              <div class="col-8" id="statics">
                <div>ID No &nbsp; &nbsp; :<span> 23</span></div>
                <div>Name &nbsp; &nbsp; :<span> Mathiyalakan</span></div>
                <div>Address &nbsp;:<span> No 22, Puloly south</span></div>
                <div>2021 Sep 12 @4.00pm</div>
                <div>Plumping</div>
              </div>
            </div>
            <div class="row">
              <div>
                Hiring amount &nbsp;&nbsp; &nbsp;:<span> Rs 400/=</span>
              </div>
              <div>Payment method :<span> online</span></div>
            </div>
            <div class="row">
              <div class="row">
                <div class="col-3 col-sm-3 col-md-2 col-lg-3 ">Rating :</div>
                <div class="col-9 col-sm-9 col-md-10 col-lg-9 p-0 m-0" id="ratingStar">
                  <span id="star" class="material-icons"> grade</span>
                  <span id="star" class="material-icons"> grade</span>
                  <span id="star" class="material-icons"> grade</span>
                  <span id="star" class="material-icons"> grade</span>
                  <span id="star" class="material-icons"> grade</span>
                </div>
              </div>
              <div class="row">
                <div class="col-3 col-sm-3 col-md-2 col-lg-3 ">Review :</div>
                <div class="col-9 col-sm-9 col-md-10 col-lg-9 p-0 m-0" id="reviewtext">Not given</div>
              </div>
            </div>
          </div>
        </div>
        <div
          class="d-flex justify-content-center row col-sm-12 col-md-12 col-lg-6"
        >
          <div id="hireBox" class="p-2 m-3 col-sm-12 col-lg-11">
            <div class="row">
              <div class="col-4  d-flex justify-content-center">
                <img src="images/laksman.JPG" id="photoWorker" />
              </div>
              <div class="col-8" id="statics">
                <div>ID No &nbsp; &nbsp; :<span> 21</span></div>
                <div>Name &nbsp; &nbsp; :<span> Laksman</span></div>
                <div>Address &nbsp;:<span> No 22, Chunnakam</span></div>
                <div>2021 Sep 11 @4.00pm</div>
                <div>Electrical work</div>
              </div>
            </div>
            <div class="row">
              <div>
                Hiring amount &nbsp;&nbsp; &nbsp;:<span> Rs 400/=</span>
              </div>
              <div>Payment method :<span> Directly</span></div>
            </div>
            <div class="row">
              <div class="row">
                <div class="col-3 col-sm-3 col-md-2 col-lg-3 ">Rating :</div>
                <div class="col-9 col-sm-9 col-md-10 col-lg-9 p-0 m-0" id="ratingStar">
                  <span id="star" class="material-icons"> grade</span>
                  <span id="star" class="material-icons"> grade</span>
                  <span id="star" class="material-icons"> grade</span>
                </div>
              </div>
              <div class="row">
                <div class="col-3 col-sm-3 col-md-2 col-lg-3 ">Review :</div>
                <div class="col-9 col-sm-9 col-md-10 col-lg-9 p-0 m-0" id="reviewtext">"Good worker highly recommended and great trooper! He showed up early and was dedicated to get it done!"</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ---------------------------------TOP SERVIES------------------------------------------- -->

      <p id="top-services " class="h1 fw-bold p-3">
        <span id="topServices" class="pe-5">TOP SERVICES</span>
      </p>

      <!-- ---------------------------------PLUMBER  BOX------------------------------------------- -->
      <div class="row d-flex justify-content-evenly">
        <div id="box_service" class="col-md-5 mb-5">
          <div id="box" class="row">
            <div class="col text-center">
              <img
                id="job_images"
                class=""
                src="images/plumber.jpg"
                alt=""
              />
            </div>
            <div
              id="service_detail "
              class="
                col
                pt-3
                d-flex
                flex-column
                align-items-xs-center align-items-md-center align-items-lg-start
              "
            >
              <div id="job" class="d-flex text-center fw-bold h5 mt-1">
                <div id="box" class="pb-2">Plumber</div>
              </div>
              <div class="fw-bolder">25 Total Order</div>
              <div class="fw-bolder">
                <p class="">
                  Avg Review 4.8
                  <span id="star" class="material-icons"> grade</span>
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- ---------------------------------ELECTRICIAN  BOX------------------------------------------- -->

        <div id="box_service" class="col-md-5 mb-5">
          <div id="box" class="row">
            <div class="col text-center">
              <img
                id="job_images"
                class=""
                src="images/electrician.jpg"
                alt=""
              />
            </div>
            <div
              id="service_detail "
              class="
                col
                pt-3
                d-flex
                flex-column
                align-items-xs-center align-items-md-center align-items-lg-start
              "
            >
              <div id="job" class="d-flex text-center fw-bold h5 mt-1">
                <div id="box" class="pb-2">Electrician</div>
              </div>
              <div class="fw-bolder">25 Total Order</div>
              <div class="fw-bolder">
                <p class="">
                  Avg Review 4.8
                  <span id="star" class="material-icons"> grade</span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


     <!-- footer code start here ------------------------------------------------->
     <div class="footer">
      <div class="container">
          <div class="row pt-4">

              <!-- --------------------footer1 -------------------------------------->
              <div class="col-lg-2 col-md-4 text-center footer1 footer1234">
                  <div class="row">
                      <div class="col logo">
                          <img src="images/logo_footer.png" alt="QuickFIX" width="130">
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

   
    <!-- Nav bar active-->
    <script>
        var btns =
            $(".nav-link");

        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click",
                function() {
                    var current = document
                        .getElementsByClassName("active");

                    current[0].className = current[0]
                        .className.replace(" active", "");

                    this.className += " active";
                });
        }

        $("#site_state").click(function(){
            $("#toggleBtn").click();
        });
    </script>

  </body>
</html>
