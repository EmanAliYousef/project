<?php
require './helpers/dbConnection.php';
require './helpers/functions.php';

# Code ..... 

if($_SERVER['REQUEST_METHOD'] == "POST"){

   $firstname = Clean($_POST['firstname']);
//    $lastname = Clean($_POST['lastname']);
   $email     = Clean($_POST['email']);
   $password  = Clean($_POST['password']); 

   $errors = [];

   if (!Validate($firstname, 1)) {
       $errors['FName'] = 'Required Field';
   } elseif (!Validate($firstname, 6)) {
       $errors['FName'] = 'Invalid String';
   }

//    if (!Validate($lastname, 1)) {
//     $errors['LName'] = 'Required Field';
// } elseif (!Validate($lastname, 6)) {
//     $errors['LName'] = 'Invalid String';
// }


   # Validate Email
   if (!Validate($email,1)) {
       $errors['Email'] = 'Field Required';
   } elseif (!Validate($email,2)) {
       $errors['Email'] = 'Invalid Email';
   }


   # Validate Password
   if (!Validate($password,1)) {
       $errors['Password'] = 'Field Required';
   } elseif (!Validate($password,3)) {
       $errors['Password'] = 'Length must be >= 6 chars';
   }

    $password = md5($password);

//id	First_name	Last_name	Email	Password	

   $sql = "insert into  users (Name,Email,Password) values ('$firstname','$email','$password')";

   $op = mysqli_query($con, $sql);
   if ($op) {
       $Message = ['Message' => 'Raw Inserted'];
   } else {
       $Message = ['Message' => 'Error Try Again ' . mysqli_error($con)];
   }
    
       # Set Session ...... 
       $_SESSION['Message'] = $Message;

}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="First Name" name='firstname' >
                                    </div>
                                    <!-- <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Last Name" name='lastname'>
                                    </div> -->
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address" name='email'>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" name='password'>
                                    </div>
                                   
                                </div> 

                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                                <button type="submit" class="btn btn-primary">Register Account</button>
                                
                                <hr>
                                <a href="index.php" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.php" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.html">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>










    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>