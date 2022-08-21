<?php
    session_start();
    $server = "localhost";
    $username="root";
    $password="";
    $dbname="ax";

    $conn = new mysqli($server,$username,$password,$dbname);

    // if($conn->connect_error){
    //     die("Connection failed" .$conn->connect_error);
    // }

    

    if(isset($_POST['code'])){
        
        $code =$_POST['code'];
		$date = date('Y-m-d');
		$time = date('H:i:s A');

		$query = "SELECT * FROM appoint
WHERE code LIKE '%{$code}%' AND date LIKE '%{$date}%'";
		$result = mysqli_query($conn, $query);

       
          $query2 = "INSERT INTO `income`(`clientId`, `detail`, `payment`, `created`) VALUES ('$clientId','Session','70', '$created')";
          mysqli_query($connection, $query2);
        

		if(mysqli_num_rows($result) == 0){
			$_SESSION['error'] = '
            <div class="card mb-3" style="max-width: 540px;">
            <div class="alert alert-danger p-3" role="alert">This QR Code is not valid!</div>
                                <div class="row no-gutters">
                                
                                  <div class="col-md-4">
                                    <img src="https://chart.googleapis.com/chart?chs=175x175&cht=qr&chl='.$code.'>&choe=UTF-8">
                                  </div>
                                  <div class="col-md-8">
                                    <div class="card-body">
                                      <h5 class="card-title">Appointment Details</h5>
                                      
                                      <p class="card-text">Date: '.$date.'</p>
                                      <p class="card-text">Time: '.$time.'</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
            
            ';
		}else{
			while ($row = mysqli_fetch_assoc($result)) {
				$code = $row['code'];
				$clientId = $row['clientId'];
				$date = $row['date'];
				$time = $row['time'];
			}
			
          
            

			$_SESSION['success'] = '
            
            <div class="card mb-3" style="max-width: 540px;">
            <h3 class="alert alert-success p-3" role="alert">This QR Code is valid!</h3>
                                <div class="row no-gutters">
                                
                                  <div class="col-md-4">
                                    <img src="https://chart.googleapis.com/chart?chs=175x175&cht=qr&chl='.$code.'>&choe=UTF-8">
                                  </div>
                                  <div class="col-md-8">
                                    <div class="card-body">
                                      <h5 class="card-title">Appointment Details</h5>
                                      
                                      <p class="card-text">Date: '.$date.'</p>
                                      <p class="card-text">Time: '.$time. '</p>
                                  
                                    </div>
                                  </div>
                                </div>
                              </div>
            
            ';

			}	
		
	

	}
header("location: qrScan.php");
	   
?>