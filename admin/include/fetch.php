<?php


include 'db.php';

session_start();

date_default_timezone_set('Asia/Manila');

function facebook_time_ago($timestamp)
{
	$time_ago = strtotime($timestamp);
	$current_time = time();
	$time_difference = $current_time - $time_ago;
	$seconds = $time_difference;
	$minutes      = round($seconds / 60);           // value 60 is seconds  
	$hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
	$days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
	$weeks          = round($seconds / 604800);          // 7*24*60*60;  
	$months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
	$years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
	if ($seconds <= 60) {
		return "Just Now";
	} else if ($minutes <= 60) {
		if ($minutes == 1) {
			return "one minute ago";
		} else {
			return "$minutes minutes ago";
		}
	} else if ($hours <= 24) {
		if ($hours == 1) {
			return "an hour ago";
		} else {
			return "$hours hrs ago";
		}
	} else if ($days <= 7) {
		if ($days == 1) {
			return "yesterday";
		} else {
			return "$days days ago";
		}
	} else if ($weeks <= 4.3) //4.3 == 52/12  
	{
		if ($weeks == 1) {
			return "a week ago";
		} else {
			return "$weeks weeks ago";
		}
	} else if ($months <= 12) {
		if ($months == 1) {
			return "a month ago";
		} else {
			return "$months months ago";
		}
	} else {
		if ($years == 1) {
			return "one year ago";
		} else {
			return "$years years ago";
		}
	}
}



if (isset($_POST["view"])) {







	if ($_POST["view"] != '') {
		mysqli_query($connection, "update `notif` set status='1' where status='0' and fromId='0'");
	}

	$query = mysqli_query($connection, "select * from `notif` where fromId='0' order by id desc limit 10");
	$output = '';

	if (mysqli_num_rows($query) > 0) {
		$output .= '<h4 class="text-bold text-italic text-center pb-3">Notification</h4>';
		while ($row = mysqli_fetch_array($query)) {
			$output .= '
	
				<div class="col-10">
				<div class="text-black">' . $row['message'] . '</div>
				<div class="text-muted small mt-1">' . facebook_time_ago($row['created']) . '</div>
			</div>
         

			<div class="dropdown-divider pb-3"></div>
	
	';
		}
	} else {
		$output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
	}

	$query1 = mysqli_query($connection, "select * from `notif` where status='0' and fromId='0'");
	$count = mysqli_num_rows($query1);
	$data = array(
		'notification'   => $output,
		'unseen_notification' => $count
	);
	echo json_encode($data);
}
