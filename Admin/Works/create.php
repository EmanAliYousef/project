<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
// require '../helpers/checkLogin.php';
// require '../helpers/checkAdmin.php';

#########################################################################
# Fetch Roles .... 
$sql = "select * from users";
$sql1 = "select * from category";

$userOp = mysqli_query($con,$sql);
$catOp = mysqli_query($con,$sql1);

#########################################################################


//id	Name	Content	image	User_id	cat_id	

# Code .....

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name      = Clean($_POST['name']);
    $user_id   = $_POST['user_id'];
    $cat_id   = $_POST['cat_id'];

    # Validate name ....
    $errors = [];

    if (!Validate($name, 1)) {
        $errors['Name'] = 'Required Field';
    } elseif (!Validate($name, 6)) {
        $errors['Name'] = 'Invalid String';
    }


    // # Validate Content
    // if (!Validate($content,1)) {
    //     $errors['Content'] = 'Field Required';
    // }


   # Validate content
   if (!Validate($_FILES['content']['name'],1)) {
    $errors['content'] = 'Field Required';
}else{

     $ConTempPath = $_FILES['content']['tmp_name'];
     $ConName     = $_FILES['content']['name'];

     $extArray = explode('.',$ConName);
     $ConExtension = strtolower(end($extArray));

     if (!Validate($ConExtension,8)) {
        $errors['content'] = 'Invalid Extension';
     }else{
         $FinalConName = time().rand().'.'.$ConExtension;
     }

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

 

    
     # Validate user_id .... 
     if (!Validate($user_id,1)) {
        $errors['User'] = 'Field Required';
    }elseif(!Validate($user_id,4)){
        $errors['User'] = "Invalid Id";
    }

    # Validate cat_id .... 
    if (!Validate($user_id,1)) {
        $errors['Cat'] = 'Field Required';
    }elseif(!Validate($user_id,4)){
        $errors['Cat'] = "Invalid Id";
    }

    if (count($errors) > 0) {
        $Message = $errors;
    } else {
        // DB CODE .....
        
       $disPath = './uploads/'.$FinalName;
       $CondisPath = './files/'.$FinalConName;


       if(move_uploaded_file($ImgTempPath,$disPath)){

        if(move_uploaded_file($ConTempPath,$CondisPath)){

        $sql = "insert into talent_work (Name,Content,Image,User_id,Cat_id) values ('$name','$FinalConName','$FinalName','$user_id','$cat_id')";
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
            <li class="breadcrumb-item active">Dashboard/Work/Create</li>

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
                        <label for="exampleInputEmail">Content </label>
                        <input type="file" class="form-control" id="exampleInputEmail1" name="content"
                            aria-describedby="emailHelp" placeholder="Enter content">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Image</label>
                        <input type="file" name="image">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword">User</label>
                        <select class="form-control" id="exampleInputPassword1" name="user_id">

                            <?php
                               while($data = mysqli_fetch_assoc($userOp)){
                            ?>

                            <option value="<?php echo $data['id'];?>"><?php echo $data['Name'];?></option>

                            <?php }
                            ?>

                        </select>
                    </div>
                    

                    <div class="form-group">
                        <label for="exampleInputPassword">Category</label>
                        <select class="form-control" id="exampleInputPassword1" name="cat_id">

                            <?php
                               while($data = mysqli_fetch_assoc($catOp)){
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
