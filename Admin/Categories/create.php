<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
// require '../helpers/checkAdmin.php';

# Fetch departments .... 
$sql = "select * from department";

$DeptOp = mysqli_query($con,$sql);

if($_SERVER['REQUEST_METHOD'] == "POST"){

   $Name = Clean($_POST['Name']);
   $dept_id =$_POST['Dept_id'];

   # Validate Title .... 
   $errors = [];

   # Validate Title 
   if(!Validate($Name,1)){
      $errors['cat_Name'] = "Required Field";
   }elseif(!Validate($Name,6)){
      $errors['cat_Name'] = "Invalid String"; 
   }
  # Validate dept_id .... 
  if (!Validate($dept_id,1)) {
    $errors['department'] = 'Field Required';
}elseif(!Validate($dept_id,4)){
    $errors['department'] = "Invalid Id";
}


   if(count($errors) > 0){
          $Message = $errors;
     }else{
        // DB CODE ..... 
        $sql = "insert into category (Name,Dep_id) values ('$Name','$dept_id')";
        $op  = mysqli_query($con,$sql);

        if($op){
            $Message = ["Message" => "Raw Inserted"];
        }else{
            $Message = ["Message" => "Error Try Again ".mysqli_error($con)];
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
            <li class="breadcrumb-item active">Dashboard/Category/Create</li>

           <?php 
               echo '<br>';
              if(isset($_SESSION['Message'])){
                Messages($_SESSION['Message']);
             
                 # Unset Session ... 
                 unset($_SESSION['Message']);
            }
           
           ?>

        </ol>


        <div class="card mb-4">

            <div class="card-body">

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                    <div class="form-group">
                        <label for="exampleInputName">Name</label>
                        <input type="text" class="form-control" id="exampleInputName" name="Name" aria-describedby=""
                            placeholder="Enter Title">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputPassword">Department</label>
                        <select class="form-control" id="exampleInputPassword1" name="Dept_id">

                            <?php
                               while($data = mysqli_fetch_assoc($DeptOp)){
                            ?>

                            <option value="<?php echo $data['id'];?>"><?php echo $data['Name'];?></option>

                            <?php }
                            ?>

                        </select>
                    </div>



                    <button type="submit" class="btn btn-primary">Save</button>
                </form>





            </div>
        </div>
    </div>
</main>


<?php
require '../layouts/footer.php';
?>
