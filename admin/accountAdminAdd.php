<?php
include 'include/db.php';

if (isset($_POST['adminAdd'])) {


  $username = $_POST['username'];
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $email = $_POST['email'];
  $pssword = $_POST['password'];

  $query = "INSERT INTO `admin`(`username`, `firstName`, `lastName`, `email`, `password`)
  VALUES ('$username','$firstName','$lastName', '$email', md5('$password'))";
  mysqli_query($connection, $query);
   // $_SESSION['username'] = $username;
   // $_SESSION['success'] = "You are now logged in";
  header('location: accountAdmin.php');
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
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title mb-0">Admin Detail</h5>
                </div>
                <div class="card-body">



                  <form action="" method="POST">

                    <div class="form-row row">
                      <div class="col">
                        <label for="inputPassword" name="password">First Name</label>
                        <input class="form-control" type="text" name="firstName"  id="firstname" required />
                      </div>
                      <div class="col">
                        <label for="inputPassword" name="password">Last Name</label>
                        <input class="form-control" type="text" name="lastName" id="lastname" required />
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col">
                       <label for="inputPassword" name="password">Username</label>
                       <input class="form-control" type="text" name="username"  id="username"  required />
                     </div>
                     <div class="col">
                       <label for="inputPassword" name="password">Email</label>
                       <input class="form-control"  id="email" type="email" name="email" required />

                     </div>
                     </div>

                     <div class="form-row row">
                     <div class="col">
                       <label for="inputPassword" name="password">Password</label>
                       <input class="form-control" type="text" name="password" id="password"required />
                     </div>

                     <div class="col">
                       <label for="inputPassword" name="password">Retype Password</label>
                       <input class="form-control" type="text" name="password" id="password"required />
                     </div>
                     </div>
                     

                    
                  


                  <div class="form-floating mb-3">
                    <button type="submit" class="btn btn-success" name="adminAdd">Add</button>
                  </div>

                </form>
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

<svg width="0" height="0" style="position:absolute">
  <defs>
    <symbol viewBox="0 0 512 512" id="ion-ios-pulse-strong">
      <path d="M448 273.001c-21.27 0-39.296 13.999-45.596 32.999h-38.857l-28.361-85.417a15.999 15.999 0 0 0-15.183-10.956c-.112 0-.224 0-.335.004a15.997 15.997 0 0 0-15.049 11.588l-44.484 155.262-52.353-314.108C206.535 54.893 200.333 48 192 48s-13.693 5.776-15.525 13.135L115.496 306H16v31.999h112c7.348 0 13.75-5.003 15.525-12.134l45.368-182.177 51.324 307.94c1.229 7.377 7.397 11.92 14.864 12.344.308.018.614.028.919.028 7.097 0 13.406-3.701 15.381-10.594l49.744-173.617 15.689 47.252A16.001 16.001 0 0 0 352 337.999h51.108C409.973 355.999 427.477 369 448 369c26.511 0 48-22.492 48-49 0-26.509-21.489-46.999-48-46.999z">
      </path>
    </symbol>
  </defs>
</svg>
<script src="js/app.js"></script>
<script>
   // Validate Password
   $('#passcheck').hide();
   let passwordError = true;
   $('#password').keyup(function () {
    validatePassword();
  });
   function validatePassword() {
    let passwrdValue =
    $('#password').val();
    if (passwrdValue.length == '') {
      $('#passcheck').show();
      passwordError = false;
      return false;
    }
    if ((passwrdValue.length < 3)||
      (passwrdValue.length > 10)) {
      $('#passcheck').show();
    $('#passcheck').html
    ("**length of your password must be between 3 and 10");
    $('#passcheck').css("color", "red");
    passwordError = false;
    return false;
  } else {
    $('#passcheck').hide();
  }
}

//Validate firstname

$('#firstnames').hide();   
let usernameError = true;
$('#firstname').keyup(function () {
  validateUsername();
});

function validateUsername() {
  let usernameValue = $('#firstName').val();
  if (usernameValue.length == '') {
    $('#firstnames').show();
    usernameError = false;
    return false;
  }
  else if((usernameValue.length == 1)) {
    $('#firstnames').show();
    $('#firstnames').html
    ("*firstName is required");
    usernameError = false;
    return false;
  }
  else {
    $('#firstnames').hide();
  }
}       


    //Validate lastname

    $('#lastnames').hide();   
    let usernameError = true;
    $('#lastname').keyup(function () {
      validateUsername();
    });

    function validateUsername() {
      let usernameValue = $('#lastName').val();
      if (usernameValue.length == '') {
        $('#lastnames').show();
        usernameError = false;
        return false;
      }
      else if((usernameValue.length == 1)) {
        $('#lastnames').show();
        $('#lastnames').html
        ("*lastName is required");
        usernameError = false;
        return false;
      }
      else {
        $('#lastnames').hide();
      }
    }       


    //Validate username
    $('#usercheck').hide();   
    let usernameError = true;
    $('#usernames').keyup(function () {
      validateUsername();
    });

    function validateUsername() {
      let usernameValue = $('#usernames').val();
      if (usernameValue.length == '') {
        $('#usercheck').show();
        usernameError = false;
        return false;
      }
      else if((usernameValue.length < 3)||
        (usernameValue.length > 10)) {
        $('#usercheck').show();
      $('#usercheck').html
      ("**length of username must be between 3 and 10");
      usernameError = false;
      return false;
    }
    else {
      $('#usercheck').hide();
    }
  }


  // Validate Email
  const email =
  document.getElementById('email');
  email.addEventListener('blur', ()=>{
   let regex =
   /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
   let s = email.value;
   if(regex.test(s)){
    email.classList.remove(
      'is-invalid');
    emailError = true;
  }
  else{
    email.classList.add(
      'is-invalid');
    emailError = false;
  }
})


 // Validate Contact Number
 $('#contactNo').hide();
 let passwordError = true;
 $('#contact').keyup(function () {
  validatePassword();
});
 function validatePassword() {
  let passwrdValue =
  $('#contact').val();
  if (passwrdValue.length == '') {
    $('#contactNo').show();
    passwordError = false;
    return false;
  }
  if ((passwrdValue.length == 11)) {
    $('#contactNo').show();
    $('#contactNo').html
    ("**length of your ContactNo must be 11 digit code");
    $('#contactNo').css("color", "red");
    passwordError = false;
    return false;
  } else {
    $('#contactNo').hide();
  }
}
</script>
<script src=
"https://ajax.googleapis.com/ajax/libs/
jquery/3.3.1/jquery.min.js">
</script>
<!-- Popper JS -->
<script src=
"https://cdnjs.cloudflare.com/ajax/libs/
popper.js/1.12.9/umd/popper.min.js">
</script>
<!-- Latest compiled JavaScript -->
<script src=
"https://maxcdn.bootstrapcdn.com/bootstrap/
4.0.0/js/bootstrap.min.js">
</script>
</body>



</html>