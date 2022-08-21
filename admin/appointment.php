<?php
include 'include/db.php';

$msg='';
if(isset($_POST['export'])){
	$date1 = $_POST['date1'];
	$date2 = $_POST['date2'];

if($date1 >= $date2){
	$msg='<div class="alert alert-danger" role="alert">
  You cant generate appointment record in start date is greater than or equal end date!<br>
</div>';

}else{

	$query = "SELECT * FROM `appoint` WHERE `created` >= '$date1' AND `created` <= '$date2'
";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

require('include\fpdf182\fpdf.php');

class PDF_HTML extends FPDF
{
	function Header()
{
	$date1 = $_POST['date1'];
	$date2 = $_POST['date2'];

    // Logo
    // $this->Image('logo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    $this->Cell(80);
    $this->Cell(30,10,'Appointment Record',0,1,'C');
	$this->Ln(20);
    $this->SetFont('Arial','B',12);
    $this->Cell(50,10,'Start Date: '. $date1,0,0,'C');
	$this->Ln(7);
    $this->Cell(50,10,'End Date: '. $date2,0,0,'C');

    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);

}
}
$pdf=new PDF_HTML();

$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Image('img/pdfLogo.png',0,0,-300);

$width_cell=array(20,24,50,20,20,30,40);
$pdf->SetFillColor(193,229,252); // Background color of header 
// Header starts /// 
$pdf->Cell($width_cell[0],10,'APP ID',1,0,'C',true);
$pdf->Cell($width_cell[1],10,'CLIENT ID',1,0,'C',true);
$pdf->Cell($width_cell[2],10,'APPOiNTMENT DATE',1,0,'C',true);
$pdf->Cell($width_cell[3],10,'TIME',1,0,'C',true);
$pdf->Cell($width_cell[4],10,'STATUS',1,0,'C',true);

$pdf->Cell($width_cell[6],10,'DATE BOOKED',1,1,'C',true); 
//// header is over ///////

$pdf->SetFont('Arial','',10);
while ($row = mysqli_fetch_assoc($result)) {

$pdf->Cell($width_cell[0],10,$row['appId'],1,0,'C',false);
$pdf->Cell($width_cell[1],10,$row['clientId'],1,0,'C',false);
$pdf->Cell($width_cell[2],10,$row['date'],1,0,'C',false);
$pdf->Cell($width_cell[3],10,$row['time'],1,0,'C',false);
$pdf->Cell($width_cell[4],10,$row['status'],1,0,'C',false);
$pdf->Cell($width_cell[6],10,$row['created'],1,1,'C',false);
}

$pdf->Output();


}

	

}




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
									<h5 class="card-title mb-0">Appointment List</h5>
								</div>
     				<div><?php echo $msg; ?></div>

								<table id="datatables-dashboard-projects" class="table table-striped my-0 appTable" enctype="multipart/form-data">
									<thead>
										<tr>
											<th>Appointment ID</th>
											<th>Client Id</th>
											<th class="d-none d-lg-table-cell">Appointment Date</th>
											<th class="d-none d-lg-table-cell">Apointment Time</th>
											<th>Status</th>
											<th class="d-none d-sm-table-cell">Action</th>
										</tr>
									</thead>
									<tbody>


										<?php
										$query = "SELECT * FROM appoint";
										$result = mysqli_query($connection, $query) or die(mysqli_error($connection));


										if (mysqli_num_rows($result) == 0) {
											echo "<tr colspan='4'>>No appointment record available</tr";
										} else {
											while ($row = mysqli_fetch_assoc($result)) {
												echo '
												<tr class="tr">
												<td>' . $row['appId'] . '</td>
												<td>' . $row['clientId'] . '</td>
												<td class="d-none d-xl-table-cell">' . $row['date'] . '</td>
												<td class="d-none d-xl-table-cell">' . $row['time'] . '</td>
												<td>' . $row['status'] . '</td>
												<td class="d-none d-md-table-cell">
												<a class="fa fa-edit pr-3" style="font-size:25px;color:green"  href="appointmentUpdate.php?appId=' . $row['appId'] . '"></a>
												<a class="fa fa-trash delete" style="font-size:25px;color:red" href="appointmentDelete.php?appId=' . $row['appId'] . '"></a>
												</td>
												</tr>

												
												';
											}
										}
										?>

									</tbody>
								</table>
								<!--  <form method="post" action="export.php">
     									<input type="submit" name="export" class="btn btn-success" value="Export" />
     								</form> -->
     								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
     									export
     								</button>
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


     	<!-- Modal -->
     	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     		<div class="modal-dialog" role="document">
     			<div class="modal-content">
     				<div class="modal-header">
     					<h5 class="modal-title" id="exampleModalLabel">Generate Appointment Records</h5>
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
     	</div>




     	<script src="js/app.js"></script>


     	<!-- delete message -->
     	<script>
     		$('.delete').on('click', function(e) {
     			e.preventDefault();
     			var self = $(this);
     			console.log(self.data('title'));
     			Swal.fire({
     				title: 'Are you sure?',
     				text: "You want to cancel the appointment?",
     				icon: 'warning',
     				showCancelButton: true,
     				confirmButtonColor: '#3085d6',
     				cancelButtonColor: '#d33',
     				confirmButtonText: 'Yes'
     			}).then((result) => {
     				if (result.isConfirmed) {
     					Swal.fire(
     						'Cancelled!',
     						'Appointment has been cancelled.',
     						'success'
     						)
     					location.href = self.attr('href');
     				}
     			})

     		})
     	</script>


<!-- combobox filter -->



     	<!-- pagination -->
     	<script>
     		$(function() {
     			$('#datatables-dashboard-projects').DataTable({
     				pageLength: 6,
     				lengthChange: false,
     				bFilter: false,
     				autoWidth: false,
     				image:true
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
     				$('#datatables-dashboard-projects .tr').each(function(){  
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