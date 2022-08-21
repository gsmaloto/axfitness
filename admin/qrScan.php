<?php


include 'include/db.php';




$msg = '';
$data = '';

// //  check qr code

// //  check qr code






?>


<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from spark.bootlab.io/dashboard-default.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Apr 2021 05:21:48 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <?php include 'include/head.php'; ?>
</head>

<body>
    <div class="splash active">
        <div class="splash-icon"></div>
    </div>
    <div class="wrapper">

        <!-- side nav -->
        <?php include 'include/sideNav.php'; ?>
        <div class="main">
            <!-- topNav -->
            <?php include 'include/topNav.php'; ?>

            <main class="content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12 col-lg-12 col-xxl-9 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <!-- <div class="card-actions float-right">
                                        <a href="#" class="mr-1">
                                            <i class="align-middle" data-feather="refresh-cw"></i>
                                        </a>
                                        <div class="d-inline-block dropdown show">
                                            <a href="#" data-toggle="dropdown" data-display="static">
                                                <i class="align-middle" data-feather="more-vertical"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </div> -->
                                   

                                    <div class="row">
                                        <div class="col-4" >
                                                <video id="preview" width="100%"></video>
                                            <h5 class="card-title mb-0">QR Code Scanner</h5>
                                        </div>
                                        <div class="col">
                                        <div><?php echo  $msg; ?></div>
                                        <div><?php echo  $data; ?></div>
                                        <form method="post" action="qrScanCode.php">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4">Code</label>
                                                    <input type="text" readonly name="code" id="text" placeholder="scan qrcode" class="form-control">
                                                </div>

                                                <!-- <button type="submit" class="btn btn-primary col-md-12 mt-3" name="check">Check</button> -->
                                            </div>
                                        </form>

                                        <?php

					if(isset($_SESSION['error'])){
					  echo $_SESSION['error'];
					  unset($_SESSION['error']);
					}
					if(isset($_SESSION['success'])){
					  echo "
						.$_SESSION[success].
					  ";
					  unset($_SESSION['success']);
					}
				  ?>

                                      

                                        </div>
                                    </div>

                                </div>
                                
                            </div>
                        </div>









                    </div>

                </div>
        </div>

    </div>

    </div>


    
    </main>
    <footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-8 text-left">
							<ul class="list-inline">
							
							</ul>
						</div>
						<div class="col-4 text-right">
							<p class="mb-0">
								&copy; 2022 - <a href="https://www.facebook.com/AXgym/" class="text-muted">AX Fitness</a>
							</p>
						</div>
					</div>
				</div>
			</footer>
    </div>

    </div>

    <script src="js/app.js"></script>



    <script>
        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview')
        });
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert('No cameras found');
            }

        }).catch(function(e) {
            console.error(e);
        });

        scanner.addListener('scan', function(c) {
            document.getElementById('text').value = c;
            document.forms[0].submit();
        });
    </script>


</html>