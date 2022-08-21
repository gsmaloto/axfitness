
<nav class="navbar navbar-expand navbar-theme">
				<a class="sidebar-toggle d-flex mr-2">
					<i class="hamburger align-self-center"></i>
				</a>
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav ml-auto">
			
						<li class="nav-item dropdown ml-lg-2">
							<a class="nav-link dropdown-toggle position-relative" href="#" id="alertsDropdown"
								data-toggle="dropdown">
								<i class="align-middle fas fa-bell bell"></i>
								<span class="badge badge-warning count"></span>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0"
								aria-labelledby="alertsDropdown" >
								
								<div class="list-group">
									<a href="appointment.php" class="list-group-item">
										
										
											<div class="col-12 message" >
												
												
											</div>
										
									</a>
							
								</div>
								<!-- <div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all notifications</a>
								</div> -->
							</div>
						</li>
						<li class="nav-item dropdown ml-lg-2">
							<a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown"
								data-toggle="dropdown">
								<i class="align-middle fas fa-cog"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="profile.php"><i class="align-middle mr-1 fas fa-fw fa-user"></i>
									View Profile</a>

								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="logout.php"><i
										class="align-middle mr-1 fas fa-fw fa-arrow-alt-circle-right"></i>Logout</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>


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