<?php

class Calendar
{

    private $active_year, $active_month, $active_day;
    private $events = [];

    public function __construct($date)
    {
        $this->active_year = date('Y', strtotime($date));
        $this->active_month = date('m', strtotime($date));
        $this->active_day = date('d', strtotime($date));
    }

    public function add_event($worker, $date, $days = 1, $color = '', $time)
    {
        $color = $color ? ' ' . $color : $color;
        $this->events[] = [$worker, $date, $days, $color, $time];
    }

    public function __toString()
    {

        $num_days = date('t', strtotime($this->active_day . '-' . $this->getActive_month() . '-' . $this->active_year));
        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->getActive_month() . '-' . $this->active_year)));
        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
        $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->getActive_month() . '-1')), $days);
        $html = '<div class="calendar">';
        $concat = strval($this->getActive_year()) . strval($this->getActive_month());
        $html .= '<div class="header d-flex justify-content-between"> <button id="del" class="btn del" data-id="' . $concat . '=' . $concat . '">
        <span class="material-icons"> arrow_back_ios</span>
      </button>';
        $html .= '<div class="month-year fw-bold text-center h1">';
        $html .= date('F Y', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day));
        $html .= '</div><button id="del1" class="btn del1" data-id="' . $concat . '=' . $concat . '">
        <span class="material-icons"> arrow_forward_ios</span>
      </button>';
        $html .= '</div>';
        $html .= '<div class="days">';
        foreach ($days as $day) {
            $html .= '
                <div class="day_name">
                    ' . $day . '
                </div>
            ';
        }
        for ($i = $first_day_of_week; $i > 0; $i--) {
            //  <div class="day_num ignore"> 2 </div> 
            //  <div class="day_num selected"> <span> 20 </span>
            //<div class="event3"> book for plumber </div>

            $html .= '
                <div class="day_num ignore_dates">
                    ' . ($num_days_last_month - $i + 1) . '
                </div>
            ';
        }
        for ($i = 1; $i <= $num_days; $i++) {
            $selected = '';
            if ($i == $this->active_day) {
                $selected = ' selected';
            }
            $html .= '<div class="day_num' . $selected . '"  id="month_date' . $i . '">';
            $html .= '<span>' . $i . '</span>';



            foreach ($this->events as $event) {
                for ($d = 0; $d <= ($event[2] - 1); $d++) {

                    // $this->events[] = [0- $worker, 1- $date, 2- $days, 3- $color, 4- $time];
                    if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                        $html .= '<div  id="test1"  class="scheduled_event' . $event[3] . '">';
                        $html .= $event[0] . '<br>';
                        $html .= date('g:i a', strtotime($event[4]));
                        $html .= '</div>';
                    }
                }
            }
            $html .= '</div>';
        }
        for ($i = 1; $i <= (35 - $num_days - max($first_day_of_week, 0)); $i++) {
            $html .= '
                <div class="day_num ignore_dates">
                    ' . $i . '
                </div>
            ';
        }
        $html .= '</div>';

        $html .= '</div>';

        $html .= '<script>
   $("#month_date1").click(function () {
      $("#modal_schedule_date_1").modal({ show: true });
    });
    </script>';

        return $html;
    }

    public function checkShedule($tradesmanID, $sheduledtime, $date)
    {
        $canSchedule = TRUE;
        // $conn = mysqli_connect("localhost", "root", "", "quickfix_database", "3310");
        $sql = "SELECT * from calendar where tradesman_id=1;";
        $result = QueryHandler::query($sql);
        if (!$result) {
            die('QUERY FAIL!');
        }
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['date'] == $date) {
                $startTime = $row['time'];
                $startTime = date("H:i:s", strtotime($startTime));
                $endTime = strtotime("-60 minutes", strtotime($startTime));
                $endTime = date('H:i:s', $endTime);
                // echo '<br> start time: '.$startTime.'<br> sheduled time: '.$sheduledtime.'<br> end time: '.$endTime;
                if (($sheduledtime <= $endTime) && ($sheduledtime >= $startTime)) {
                    $canSchedule = FALSE;
                    // echo "Can't schelude!!!<br>";
                } else {
                    // echo "You can Shedule. Success<br>";
                }
            }
        }
        return $canSchedule;
    }

    // public function getAllSchedulesThisMonth(){

    // }



    /**
     * Set the value of active_month
     *
     * @return  self
     */
    public function setActive_month($active_month)
    {
        $this->active_month = $active_month;

        return $this;
    }

    /**
     * Get the value of active_month
     */
    public function getActive_month()
    {
        return $this->active_month;
    }

    /**
     * Get the value of active_year
     */
    public function getActive_year()
    {
        return $this->active_year;
    }

    /**
     * Set the value of active_year
     *
     * @return  self
     */
    public function setActive_year($active_year)
    {
        $this->active_year = $active_year;

        return $this;
    }

    /**
     * Get the value of events
     */ 
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Set the value of events
     *
     * @return  self
     */ 
    public function setEvents($events)
    {
        $this->events = $events;

        return $this;
    }
}
