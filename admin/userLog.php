<?php
include 'include/db.php';

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
									<div class="card-actions float-right">
										  <input type="text" name="search" id="search"  class="form-control" placeholder="search" onkeyup="this.value=this.value.replace(/^[0-9]{4}[a-z]/gi,'');"/>  
									</div>
									<h5 class="card-title mb-0">User Log</h5>
								</div>
								<table id="datatables-dashboard-projects" class="table table-striped my-0">
									<thead>
										<tr>
											<th class="d-none d-lg-table-cell">Log ID</th>
											<th class="d-none d-lg-table-cell">Client ID</th>
											<th>Date</th>
									
										
										</tr>
									</thead>
									<tbody>


										<?php
										$query = "SELECT * FROM userlogs";
										$result = mysqli_query($connection, $query) or die(mysqli_error($connection));


										if (mysqli_num_rows($result) == 0) {
											echo "<tr colspan='5'>>No appointment record available</tr";
										} else {
											while ($row = mysqli_fetch_assoc($result)) {
												echo '
												<tr>
                                                <td class="d-none d-xl-table-cell">' . $row['id'] . '</td>
                                                <td class="d-none d-xl-table-cell">' . $row['clientId'] . '</td>
											<td class="d-none d-xl-table-cell">' . $row['date'] . '</td>
								
								


										</tr>

												
												';
											}
										}
										?>

									</tbody>
								</table>
                               
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



    
     	<!-- Modal -->
     	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     		<div class="modal-dialog" role="document">
     			<div class="modal-content">
     				<div class="modal-header">
     					<h5 class="modal-title" id="exampleModalLabel">Generate User Log Records</h5>
     					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
     						<span aria-hidden="true">&times;</span>
     					</button>
     				</div>
     				<form method="post" action="">
     				<div class="modal-body">
     					<label>Start Date</label>
     					<input type="date" name="date1" required>
     					<label>End Date</label>
     					<input type="date" name="date2" required>

     				</div>
     				<div class="modal-footer">
     					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     					
     						<input type="submit" name="export" class="btn btn-success" value="Export" />
     				
                            </form>

     				</div>	
     			</div>
     		</div>


	<!-- delete message -->
	<script>
		$('.delete').on('click', function(e) {
			e.preventDefault();
			var self = $(this);
			console.log(self.data('title'));
			Swal.fire({
				title: 'Are you sure?',
				text: "You want to remove the user?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes'
			}).then((result) => {
				if (result.isConfirmed) {
					Swal.fire(
						'Remove!',
						'User has been removed.',
						'success'
					)
					location.href = self.attr('href');
				}
			})

		})
	</script>






	<!-- pagination -->
	<script>
		$(function() {
			$('#datatables-dashboard-projects').DataTable({
				pageLength: 6,
				lengthChange: false,
				bFilter: false,
				autoWidth: false
			});
		});
	</script>
<script>  
        $(document).ready(function(){  
           $('#search').keyup(function(){  
                search_table($(this).val());  
                $('.alphaonly').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/^[0-9]{4}[a-z]/gi,'') ); }
);
           });  
           function search_table(value){  
                $('#datatables-dashboard-projects tr').each(function(){  
                     var found = 'false';  
                     $(this).each(function(){  
                          if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)  
                          {  
                               found = 'true';

                          }  
                     });  
                     if(found == 'true')  
                     {  
                          $(this).show();  
                     }  
                     else  
                     {  
                          $(this).hide();  
                     }  
                });  
           }  
      });  
 </script>  
</body>



</html>