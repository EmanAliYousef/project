<?php
require '../Admin/helpers/dbConnection.php';
require '../Admin/helpers/functions.php';

$sql = "select talent_work.Image ,talent_work.Name,users.Name as user_name ,category.Name as category_name ,department.   Name as department from 
 talent_work inner join category on talent_work.Cat_id = category.id
 inner join users  on  talent_work.User_id = users.id 
 inner join  department on department.Id=category.Dep_id 
 where department.Id=1 ";
$op = mysqli_query($con, $sql);

?>




<!-- header................... -->



<!DOCTYPE html>
<html lang="en">

<head>
    <!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
  <![endif]-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/hover.css" rel="stylesheet">
    <link href="css/all.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar  navbar-dark  navbar-expand-lg  mainNav " >

        <a href="#" class="navbar-brand"><img class="img-fluid navimg" src="images/folkLogo.jpg"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nti">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nti">
            <ul class="navbar-nav navLinks pull-right">
                <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="ContactUs.html">contactUs</a></li>
                <li class="nav-item"><a class="nav-link" href="#">AboutUs</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Register</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Our productions</a></li>

            </ul>
        </div>
    </nav>


    <!-- body......................... -->


        <!--blog start-->

        <section>
            <div class=" container">
                <div class="row">



                    <?php
                    // Fetch data .... 
                    while ($data = mysqli_fetch_assoc($op)) {

                    ?>
                      

                        <div class="col-lg-6 col-md-6">
                            <div class="post">
                                <div class="post-image">
                                    <img class="img-fluid h-100 w-100" src="../Admin/Works/uploads/<?php echo $data['Image']; ?>" alt="">
                                </div>


                                <div class="post-desc">

                                    <div class="post-title">
                                        <h5><a href="blog-details.html"><?php echo $data['Name'] . ' ( ' . $data['Name'] . ')'; ?></a></h5>
                                    </div>
                                    <!-- <p><?php echo substr($data['content'], 0, 100); ?></p> -->


                                    <div> <span><?php echo $data['category_name']; ?></span></div>
                                    <div> <span><?php echo $data['department']; ?></span> </div>

                                </div>
                            </div>
                        </div>

                    <?php } ?>








                </div>
            </div>
        </section>
        </div>



<div>
<br><br><br><br><br><br><br>
<br><br><br><br><br><br><br>
<br><br><br><br><br><br><br>
<br><br><br><br><br><br><br>
<br><br><br><br><br><br><br>
</div>






        <!-- footer........................ -->




        <footer class="row bg-light container-fluid no-gutters text-light">
                  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <div class="col-1"></div>
            <div class="col-5 col-md-3 col-lg-2">
                <br>

                <div class="socials">
                    <a class="sociallink" href="https://www.facebook.com/1Folk/"><img src="images/icons8-facebook-48.png"></img></a>
                </div>

            </div>
            <div class="col-5 col-md-3 col-lg-2">
                <br>

                <div class="socials">
                    <a class="sociallink" href="https://twitter.com/Folk1_2?s=20"><img src="images/icons8-twitter-48.png"></img></a>
                </div>

            </div>
            <div class="col-5 col-md-3 col-lg-2">
                <br>

                <div class="socials">
                    <a class="sociallink" href="https://instagram.com/folk1_2?utm_medium=copy_link"><img src="images/icons8-instagram-logo-48.png"></img></a>

                </div>

            </div>
            <div class="col-5 col-md-3 col-lg-2">
                <br>

                <div class="socials">
                    <a class="sociallink" href="https://www.youtube.com/channel/UCuRtjfDZdrS58Ubos5HrrPg"><img src="images/icons8-youtube-logo-48.png"></img></a>

                </div>

            </div>


        </footer>
        <footer class="bg-dark text-light">
            <p class="text-center mx-auto d-block ">Copyright<span>&copy</span>2021 | Developed By <span class="text-warning">Folk.com</span></p>
            <br>
            <br>
        </footer>

        </div>



        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/bootstrap.bundle.js"></script>

</body>

</html>