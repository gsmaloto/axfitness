    <?php
    include 'db.php';

    if (isset($_SESSION['username']) and $_SESSION['username'] != '') {
    ?>

    



        <!-- Header Nav Start -->
        <div id="header">
            <div class="container-fluid">
                <div id="logo" class="pull-left">
                    <a href="index.html"><img src="img/logo.jpg" alt="Logo" /></a>
                </div>

                <nav id="nav-menu-container">
                    
                    <ul class="nav-menu">
                      <!-- notification bell -->
<!-- 
			<li class="dropdown">
			<a href="#" class="dropdown-toggle bell" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="fas fa-bell"></span></a>
				<ul class="dropdown-menu message"></ul>
			</li> -->



                        <li class="menu-active"><a href="index.php">Home</a></li>
                        <!--   <li><a href="#about">About Us</a></li>
                    <li><a href="#services">Our Services</a></li>
                    <li><a href="#portfolio">Our Portfolio</a></li>
                    <li><a href="#contact">Contact Us</a></li> -->

                        <!-- bell icon -->
                        <li class="nav-item dropdown ml-lg-2" >
                            <a class="nav-link position-relative" data-toggle="dropdown">
                                <i class="align-middle fas fa-bell px-3 bell"><span class="badge badge-danger"><h6 class="count text-white px-1"></h6></span></i> 
                            </a>
                          
                            <div class="dropdown-menu dropdown-menu-right p-2 message" aria-labelledby="userDropdown">
                        
                            </div>
                         

                        </li>
                        <!-- end bell icon -->

                     


                        <!-- gear icon -->
                        <li class="nav-item dropdown ml-lg-2">
                            <a class="nav-link position-relative" href="#" id="userDropdown" data-toggle="dropdown">
                                <i class="align-middle fas fa-user"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-2" aria-labelledby="userDropdown">
                                <a class="dropdown-item text-dark" href="appointment.php"><i class="align-middle mr-1 fas fa-book"></i>
                                    My Appointment</a>

                                <div class="dropdown-divider p-1"></div>

                                <a class="dropdown-item text-dark" href="profile.php"><i class="align-middle mr-1 fas fa-fw fa-user"></i>
                                    View Profile</a>

                                <div class="dropdown-divider p-1"></div>

                                <a class="dropdown-item text-dark" href="membership.php"><i class="align-middle mr-1 fas fa-address-card"></i>
                                    Membership</a>

                                <div class="dropdown-divider p-1"></div>
                                <a class="dropdown-item text-dark" href="logout.php"><i class="align-middle mr-1 fas fa-fw fa-arrow-alt-circle-right"></i>Logout</a>
                            </div>
                        </li>
                        <!-- end gear icon -->
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Header Nav End -->
    <?php
    } else { ?>
        <!-- Header Nav Start -->
        <div id="header">
            <div class="container-fluid">
                <div id="logo" class="pull-left">
                    <a href="index.html"><img src="img/logo.jpg" alt="Logo" /></a>
                </div>



                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="menu-active"><a href="index.php">Home</a></li>
                        <!-- <li><a href="#about">About Us</a></li>
                <li><a href="#services">Our Services</a></li>
                <li><a href="#portfolio">Our Portfolio</a></li>
                <li><a href="#contact">Contact Us</a></li> -->
                        <li><a href="login.php">Login</a></li>



                    </ul>


                </nav>
            </div>
        </div>
        <!-- Header Nav End -->

    <?php
    }
    ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <script>
        $('#exampleModal').modal({
            backdrop: 'static',
            keyboard: false
        });
    </script>


<script>
$(document).ready(function(){
	
	function load_unseen_notification(view = '')
	{
		$.ajax({
			url:"include/fetch.php",
			method:"POST",
			data:{view:view},
			dataType:"json",
			success:function(data)
			{
			$('.message').html(data.notification);
			if(data.unseen_notification > 0){
			$('.count').html(data.unseen_notification);
			}
			}
		});
	}
 
	load_unseen_notification();

 
	$(document).on('click', '.bell', function(){
	$('.count').html('');
	load_unseen_notification('yes');
	});
 
	setInterval(function(){ 
		load_unseen_notification();; 
	}, 5000);
 
});

</script>

