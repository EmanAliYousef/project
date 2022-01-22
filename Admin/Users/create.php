<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
// require '../helpers/checkLogin.php';
 //require '../helpers/checkAdmin.php';

#########################################################################
# Fetch Roles .... 
$sql = "select * from role";
$RoleOp = mysqli_query($con,$sql);

#########################################################################



# Code .....

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name      = Clean($_POST['name']);
    $email     = Clean($_POST['email']);
    $password  = Clean($_POST['password']); 
    $role_id   = $_POST['Role_id'];

    # Validate name ....
    $errors = [];

    if (!Validate($name, 1)) {
        $errors['Name'] = 'Required Field';
    } elseif (!Validate($name, 6)) {
        $errors['Name'] = 'Invalid String';
    }


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
   # Validate Image
   if (!Validate($_FILES['image']['name'],1)) {
    $errors['Image'] = 'Field Required';
}else{

     $ImgTempPath = $_FILES['image']['tmp_name'];
     $ImgName     = $_FILES['image']['name'];

     $extArray = explode('.',$ImgName);
     $ImageExtension = strtolower(end($extArray));

     if (!Validate($ImageExtension,7)) {
        $errors['Image'] = 'Invalid Extension';
     }else{
         $FinalName = time().rand().'.'.$ImageExtension;
     }

}
    
     # Validate role_id .... 
     if (!Validate($role_id,1)) {
        $errors['Role'] = 'Field Required';
    }elseif(!Validate($role_id,4)){
        $errors['Role'] = "Invalid Id";
    }

    if (count($errors) > 0) {
        $Message = $errors;
    } else {
        // DB CODE .....

       $disPath = './uploads/'.$FinalName;


       if(move_uploaded_file($ImgTempPath,$disPath)){

        $password = md5($password);
        $sql = "insert into users (Name,Email,Password,Profile_Picture,Role_id) values ('$name','$email','$password','$FinalName',$role_id)";
        $op = mysqli_query($con, $sql);

        if ($op) {
            $Message = ['Message' => 'Raw Inserted'];
        } else {
            $Message = ['Message' => 'Error Try Again ' . mysqli_error($con)];
        }
    
       }else{
        $Message = ['Message' => 'Error  in uploading Image  Try Again ' ];
       }
    
    }
    # Set Session ......
    $_SESSION['Message'] = $Message;
}

require '../layouts/header.php';
require '../layouts/sideNav.php';
require '../layouts/nav.php';
?>



<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard/Users/Create</li>

            <?php
            echo '<br>';
            if (isset($_SESSION['Message'])) {
                Messages($_SESSION['Message']);
            
                # Unset Session ...
                unset($_SESSION['Message']);
            }
            
            ?>

        </ol>


        <div class="card mb-4">

            <div class="card-body">

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputName">Name</label>
                        <input type="text" class="form-control" id="exampleInputName" name="name" aria-describedby=""
                            placeholder="Enter Name">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail">Email </label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="email"
                            aria-describedby="emailHelp" placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                            placeholder="Password">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Image</label>
                        <input type="file" name="image">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword">Role</label>
                        <select class="form-control" id="exampleInputPassword1" name="Role_id">

                            <?php
                               while($data = mysqli_fetch_assoc($RoleOp)){
                            ?>

                            <option value="<?php echo $data['id'];?>"><?php echo $data['Name'];?></option>

                            <?php }
                            ?>

                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</main>


<?php
require '../layouts/footer.php';
?>
