<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
//require '../helpers/checkAdmin.php'


// require '../helpers/checkLogin.php';
// require '../helpers/checkAdmin.php';


#############################################################################


$id = $_GET['id'];

$sql = "select * from category where id = $id";

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
# Fetch Roles ....

$sql = "select * from department";
$depOp = mysqli_query($con,$sql);

#########################################################################

# Code .....

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = Clean($_POST['name']);
    $dep_id =$_POST['dep_id'];

    # Validate Name....
    $errors = [];

    if (!Validate($name, 1)) {
        $errors['Name'] = 'Required Field';
    } elseif (!Validate($name, 6)) {
        $errors['Name'] = 'Invalid String';
    }

    # Validate dept_id .... 
    if (!Validate($dep_id,1)) {
        $errors['Department'] = 'Field Required';
    }elseif(!Validate($dep_id,4)){
        $errors['Department'] = "Invalid Id";
    }
    
 // DB CODE .....

    if (count($Message) == 0) {
    } else {
       
        $sql = "update category set Name='$name' , Dep_id ='$dep_id' where id = $id";
        $op = mysqli_query($con, $sql);

        if ($op) {
            $Message = ['Message' => 'Raw Updated'];
        } else {
            $Message = ['Message' => 'Error Try Again ' . mysqli_error($con)];
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
                        <label for="exampleInputPassword">Department</label>
                        <select class="form-control" id="exampleInputPassword1" name="dep_id">

                        <?php
                               while($data = mysqli_fetch_assoc($depOp)){
                            ?>


                            <option value="<?php echo $data['id']; ?>" <?php if ($data['id'] == $UserData['Dep_id']) {
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
