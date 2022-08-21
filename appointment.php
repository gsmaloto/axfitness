<?php
include 'include/calendar.php';

session_start();
if (empty($_SESSION['clientId']) || $_SESSION['clientId'] == '') {
  header("Location:login.php");
  die();
}
?>








<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include 'include/head.php';

  ?>


  <style>
    body {
      /* The image used */
      background-image: url("img/outside.jpg");

      /* Full height */
      height: 100%;

      /* Center and scale the image nicely */
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;

    }
  </style>

</head>

<body>
  <?php include 'include/nav.php' ?>


  <!-- About Us Start-->

  <div>
    <div class="container-fluid pt-5" style="height: 100%;">
      <div class="section-header">

      </div>
      <br><br>
      <div class="row d-flex justify-content-center">

        <div class="col-md about-col">
          <div class="bg-white about-content">

            <section class="container py-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="d-flex">
                    <ul id="tabsJustified" class="nav nav-pills flex-column">
                      <li class="nav-item"><a href="" data-target="#home1" data-toggle="tab" class="nav-link small text-uppercase active">Appointment</a></li>
                      <li class="nav-item"><a href="" data-target="#profile1" data-toggle="tab" class="nav-link small text-uppercase">Record</a></li>
                      <!-- <li class="nav-item"><a href="" data-target="#messages1" data-toggle="tab" class="nav-link small text-uppercase">Messages</a></li> -->
                    </ul>
                    <div class="tab-content border rounded p-3 w-100">
                      <div id="home1" class="tab-pane fade active show">
                        <div class="col-lg-12 about-cont">
                          <?php
                          $dateComponents = getdate();
                          if (isset($_GET['month']) && isset($_GET['year'])) {
                            $month = $_GET['month'];
                            $year = $_GET['year'];
                          } else {
                            $month = $dateComponents['mon'];
                            $year = $dateComponents['year'];
                          }
                          echo build_calendar($month, $year);
                          ?>
                        </div>
                      </div>



                      <div id="profile1" class="tab-pane fade ">
                        <!-- <h3 class="text-warning">Your appointment record</h3> -->


                        <div class="col-12 d-flex justify-content-center">
                          <?php
                          $query = "SELECT * FROM appoint where clientId= '$_SESSION[clientId]' and status='approve'";
                          $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

                          if (mysqli_num_rows($result) == 0) {
                            // echo "You dont have schedule appointment";
                          } else {
                            while ($row = mysqli_fetch_assoc($result)) {

                              $code = $row['code'];
                              $date = $row['date'];
                              $time = $row['time'];
                          ?>
                              <div class="card mb-3" style="max-width: 540px;">
                                <div class="row no-gutters">
                                  <div class="col-md-4">
                                    <img src="https://chart.googleapis.com/chart?chs=175x175&cht=qr&chl=<?php echo $code ?>&choe=UTF-8">
                                  </div>
                                  <div class="col-md-8">
                                    <div class="card-body">
                                      <h5 class="card-title">Appointment Schedule</h5>
                                      <p class="card-text">Date: <?php echo $date ?></p>
                                      <p class="card-text">Time: <?php echo $time ?></p>
                                      <p class="card-text"><small class="text-muted">Show this QR code in scheduled date.</small></p>
                                    </div>
                                  </div>
                                </div>
                              </div>


                          <?php
                            }
                          }
                          ?>
                        </div>

                        
                        <div class="row" style="height: 500px">
                          <div class="col-12 col-lg-12 col-xxl-9 d-flex">
                            <div class="card flex-fill">
                              <div class="card-header">
                                <div class="card-actions float-right">
                                  <input type="text" name="search" id="search" class="form-control" placeholder="search" onkeyup="this.value=this.value.replace(/^[0-9]{4}[a-z]/gi,'');" />
                                </div>
                                <h5 class="card-title mb-0">Appointment Record</h5>
                              </div>
                              <table id="appointment" class="table table-striped my-0">
                                <thead>
                                  <tr>
                                    <th class="d-none d-lg-table-cell">Appointment Date</th>
                                    <th class="d-none d-lg-table-cell">Apointment Time</th>
                                    <th>Status</th>
                                    <th class="d-none d-sm-table-cell">Action</th>
                                    
                                  </tr>
                                </thead>
                                <tbody>


                                  <?php
                                  $query = "SELECT * FROM appoint where clientId= '$_SESSION[clientId]'";
                                  $result = mysqli_query($connection, $query) or die(mysqli_error($connection));


                                  if (mysqli_num_rows($result) == 0) {
                                    echo "No appointment record available";
                                  } else {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                      echo '

                                        <tr>
                                          <td class="d-none d-xl-table-cell">' . $row['date'] . '</td>
                                          <td class="d-none d-xl-table-cell">' . $row['time'] . '</td>
                                          <td>' . $row['status'] . '</td>
                                          <td class="d-none d-md-table-cell">
                                            <form method="post" action="export.php?appId=' . $row['appId'] . '">
                                              <button type="submit" name="export" class="btn btn-link"><i style="font-size:20px;color:#ff0000"  class="fas fa-file-pdf"></i></button>
                                              ';
                                      if ($row['status'] == 'cancel') {
                                        echo '<a class="fa fa-trash" style="font-size:20px;color:#c2c2c2"></a>';
                                      } else {
                                        echo '<a class="fa fa-trash delete" style="font-size:20px;color:red" href="appointmentDelete.php?appId=' . $row['appId'] . '  "></a>';
                                      }
                                        echo '
                                            </form>
                                          </td>
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
                      <!--   <div id="messages1" class="tab-pane fade">
            Messages ...
          </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </section>



          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- About Us End-->
  

  
  <div style="height: 115px;">

                              </div>


  <?php include 'include/footer.php'; ?>
</body>



	<!-- pagination -->
	<script>
		$(function() {
			$('#appointment').DataTable({
				pageLength: 6,
				lengthChange: false,
				bFilter: false,
				autoWidth: false
			});
		});
	</script>


<!-- search appointment record -->
<script>
  $(document).ready(function() {
    $('#search').keyup(function() {
      search_table($(this).val());
      $('.alphaonly').bind('keyup blur', function() {
        var node = $(this);
        node.val(node.val().replace(/^[0-9]{4}[a-z]/gi, ''));
      });
    });

    function search_table(value) {
      $('#appointment tr').each(function() {
        var found = 'false';
        $(this).each(function() {
          if ($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0) {
            found = 'true';

          }
        });
        if (found == 'true') {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    }
  });
</script>




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




</html>