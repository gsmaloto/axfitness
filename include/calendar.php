<?php

include 'include/db.php';

function build_calendar($month, $year)
{

    include 'include/db.php';


    // Create array containing abbreviations of days of week.
    $daysOfWeek = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

    // What is the first day of the month in question?
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    // How many days does this month contain?
    $numberDays = date('t', $firstDayOfMonth);

    // Retrieve some information about the first day of the
    // month in question.
    $dateComponents = getdate($firstDayOfMonth);

    // What is the name of the month in question?
    $monthName = $dateComponents['month'];

    // What is the index value (0-6) of the first day of the
    // month in question.
    $dayOfWeek = $dateComponents['wday'];

    // Create the table tag opener and day headers

    $datetoday = date('Y-m-d');



    $calendar = "<table class='table table-bordered bg-white'>";
    $calendar .= "<center><h2 class='text-warning'>$monthName $year</h2>";

    $calendar .= "<a class='btn btn-xs btn-primary' href='?month=" . date('m', mktime(0, 0, 0, $month - 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month - 1, 1, $year)) . "'>Previous Month</a> ";

    $calendar .= " <a class='btn btn-xs btn-primary' href='?month=" . date('m') . "&year=" . date('Y') . "'>Current Month</a> ";

    $calendar .= "<a class='btn btn-xs btn-primary' href='?month=" . date('m', mktime(0, 0, 0, $month + 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month + 1, 1, $year)) . "'>Next Month</a></center><br>";



    $calendar .= "<tr>";

    // Create the calendar headers

    foreach ($daysOfWeek as $day) {
        $calendar .= "<th  class='header'>$day</th>";
    }

    // Create the rest of the calendar

    // Initiate the day counter, starting with the 1st.

    $currentDay = 1;

    $calendar .= "</tr><tr>";

    // The variable $dayOfWeek is used to
    // ensure that the calendar
    // display consists of exactly 7 columns.

    if ($dayOfWeek > 0) {
        for ($k = 0; $k < $dayOfWeek; $k++) {
            $calendar .= "<td  class='empty'></td>";
        }
    }


    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    $sched='';
    $once = "SELECT date FROM `appoint` where clientId= '$_SESSION[clientId]' and status not like '%cancel%'";
    $resultOnce = mysqli_query($connection, $once) or die(mysqli_error($connection));

    if (mysqli_num_rows($resultOnce) == 0) {
    } else {
        while ($row = mysqli_fetch_assoc($resultOnce)) {

            $sched = $row['date'];
        }
    }





    while ($currentDay <= $numberDays) {

        // Seventh column (Saturday) reached. Start a new row.

        if ($dayOfWeek == 7) {

            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }

        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";

        $dayname = strtolower(date('l', strtotime($date)));
        $eventNum = 0;
        $today = $date == date('Y-m-d') ? "today" : "";

        $resultAm = mysqli_query($connection, "SELECT COUNT(*) AS `am` FROM `appoint` where date = '$date' and time = 'am' and status not like '%cancel%'");
        $row = mysqli_fetch_array($resultAm);
        $am = $row['am'];

        $resultPm = mysqli_query($connection, "SELECT COUNT(*) AS `pm` FROM `appoint` where date = '$date' and time = 'pm' and status not like '%cancel%'");
        $row = mysqli_fetch_array($resultPm);
        $pm = $row['pm'];




        $query = "SELECT max FROM webDetail where id ='1'";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

        while ($row = mysqli_fetch_assoc($result)) {

            $max = (int)$row['max'];
        }


        if ($date < date('Y-m-d')) {
            // disable the past date
            $calendar .= "<td><h4>$currentDay</h4>
                            <button class='btn btn-danger btn-xs' disabled>N/A</button>";

        } elseif ($pm >= $max && $am >= $max) {
            // display fully booked if no available slot
            $calendar .= "<td  class='$today'><h4>$currentDay</h4>
                            <button class='btn btn-danger btn-xs btn-block' disabled></button>
                                Fully Booked
                            </button>";


        }elseif($sched != ''){
                $calendar .= "<td class='$today'><h4>$currentDay</h4>
                            <button href='appointmentForm.php?date=" . $date . "' class='btn btn-success btn-xs btn-block' disabled>
                                AM:" . $am . "/" . $max . "<br>PM:" . $pm . "/" . $max . "
                            </button>";
         

        } else {

                $calendar .= "<td class='$today'><h4'>$currentDay</h4>
                <a href='appointmentForm.php?date=" . $date . "' class='btn btn-success btn-xs btn-block'>
                    AM:" . $am . "/" . $max . "<br>PM:" . $pm . "/" . $max . "
                </a>
                ";

     
            
        }




        $calendar .= "</td>";
        // Increment counters

        $currentDay++;
        $dayOfWeek++;
    }



    // Complete the row of the last week in month, if necessary

    if ($dayOfWeek != 7) {

        $remainingDays = 7 - $dayOfWeek;
        for ($l = 0; $l < $remainingDays; $l++) {
            $calendar .= "<td class='empty'></td>";
        }
    }

    $calendar .= "</tr>";

    $calendar .= "</table>";

    echo $calendar;
}
