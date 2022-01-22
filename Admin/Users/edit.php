<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
// require '../helpers/checkLogin.php';
 //require '../helpers/checkAdmin.php';



#############################################################################
$id = $_GET['id'];

$sql = "select * from users where id = $id";
$op = mysqli_query($con, $sql);

if (mysqli_num_rows($op) == 1) {
    // code .....
    $UserData = mysqli_fetch_assoc($op);
} else {
    $_SESSION['Message'] = ['Message' => 'Invalid Id'];
    header('Location: index.php');
    exit();
}
#############################################################################

#########################################################################
# Fetch Roles ....
$sql = 'select * from role';
$RoleOp = mysqli_query($con, $sql);

#########################################################################

# Code .....

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = Clean($_POST['name']);
    $email = Clean($_POST['email']);
    $password = Clean($_POST['password']);
    $role_id = $_POST['role_id'];

    # Validate name ....
    $errors = [];

    if (!Validate($name, 1)) {
        $errors['Name'] = 'Required Field';
    } elseif (!Validate($name, 6)) {
        $errors['Name'] = 'Invalid String';
    }

    # Validate Email
    if (!Validate($email, 1)) {
        $errors['Email'] = 'Field Required';
    } elseif (!Validate($email, 2)) {
        $errors['Email'] = 'Invalid Email';
    }

   

    # Validate Password ....
    if (!Validate($password, 1)) {
        $errors['password'] = 'Field Required';
    } elseif (!Validate($password, 3)) {
        $errors['password'] = 'Password should be more than 6 characters';
    }

    # Validate Image
    if (Validate($_FILES['image']['name'], 1)) {
        $ImgTempPath = $_FILES['image']['tmp_name'];
        $ImgName = $_FILES['image']['name'];

        $extArray = explode('.', $ImgName);
        $ImageExtension = strtolower(end($extArray));

        if (!Validate($ImageExtension, 7)) {
            $errors['Image'] = 'Invalid Extension';
        } else {
            $FinalName = time() . rand() . '.' . $ImageExtension;
        }
    }

     # Validate role_id ....
     if (!Validate($role_id, 1)) {
        $errors['Role'] = 'Field Required';
    } elseif (!Validate($role_id, 4)) {
        $errors['Role'] = 'Invalid Id';
    }
       $Message = $errors;
    if (!count($errors) > 0){
        // DB CODE .....

        if (Validate($_FILES['image']['name'], 1)) {
            $disPath = './uploads/' . $FinalName;

            if (!move_uploaded_file($ImgTempPath, $disPath)) {
                $Message = ['Message' => 'Error  in uploading Image  Try Again '];
            } else {
                unlink('./uploads/' . $UserData['Profile_Picture']);
            }
        } else {
            $FinalName = $UserData['Profile_Picture'];
        }

        if (count($Message) == 0) {
            $sql = "update users set Name='$name' , Email='$email' , Password= '$password' , Role_id = $role_id , Profile_Picture ='$FinalName' where id = $id";

            $op = mysqli_query($con, $sql);

            if ($op) {
                $Message = ['Message' => 'Raw Updated'];
            } else {
                $Message = ['Message' => 'Error Try Again ' . mysqli_error($con)];
            }
        }
        # Set Session ......
        $_SESSION['Message'] = $Message;
        header('Location: index.php');
        exit();
    }
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

                <form action="edit.php?id=<?php echo $UserData['id']; ?>" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputName">Name</label>
                        <input type="text" class="form-control" id="exampleInputName" name="name" aria-describedby=""
                            placeholder="Enter Name" value="<?php echo $UserData['Name']; ?>">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail">Email address</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="email"
                            aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo $UserData['Email']; ?>">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputName">Password</label>
                        <input type="text" class="form-control" id="exampleInputName" name="password" aria-describedby=""
                            placeholder="Enter password" value="<?php echo $UserData['Password']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Image</label>
                        <input type="file" name="image">
                    </div>

                    <img src="./uploads/<?php echo $UserData['Profile_Picture']; ?>" alt="" height="50px" width="50px"> <br>

                    <div class="form-group">
                        <label for="exampleInputPassword">Role</label>
                        <select class="form-control" id="exampleInputPassword1" name="role_id">

                            <?php
                               while($data = mysqli_fetch_assoc($RoleOp)){
                            ?>

                            <option value="<?php echo $data['id']; ?>" <?php if ($data['id'] == $UserData['Role_id']) {
                            echo 'selected';
                          } ?>><?php echo $data['Name']; ?></option>

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
