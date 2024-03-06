<script>
  var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>

<?php
include('connectDB.php');

$idp=0;
$conn = connectDB();
if (isset($_GET['id'])) {
    
    $idp = $_GET['id'];}
$sql = "select CateID, catename, modifyDate from category";
$result = mysqli_query($conn, $sql);
if($idp==0)
{
  $sql2="SELECT ProID, proName, proprice, proDate, proimage,Procontent,proNumber,CateID from product";
}
else{
$sql2="SELECT ProID, proName, proprice, proDate, proimage,Procontent,proNumber,CateID from product WHERE CateID=$idp";
}
$result1=mysqli_query($conn,$sql2);
?>
<!DOCTYPE html>
<html lang="vi" meta charset="UTF-8">>

<head>
  
<style>
body{background-image: url(images/BG.jpg)}
.col-lg-4{background-image: url(images/BG.jpg)}
.col-md-6{background-image: url(images/BG.jpg)}
.list-group-item{background-color:blue}
</style>
  <meta charset="UTF-8">

  <title>User page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <!-- Bootstrap core CSS -->
    <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/shop-homepage.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  
  </head>
<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">Home</a>
        <ul class="navbar-nav ml-auto">
          <?php if (isset($_SESSION['success'])){ ?>
          <li class="nav-item active">
          <a class="nav-link" > <?php 
          
          echo $_SESSION['success']; 
          unset($_SESSION['success']);
            }
         ?></a> 
         
          </li>

          <?php if (isset($_SESSION['user'])){  ?>
          <li class="nav-item active">
     <strong style="color:white;"><?php
      echo $_SESSION['user']['username']; ?></strong>

     <small>
      <i  style="color: #888;">(<?php echo ($_SESSION['user']['user_type']); ?>)</i> 
      <br>
      <a href="index.php?logout='1'" style="color: red;">logout</a>
     </small>
          </li>
          <?php } else{ ?>
            <li class="nav-item active">
              <a href="login.php">login</a>
            </li>
          <?php } ?>
        </ul>

    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">Minh tú</h1>
        <div class="list-group">
        <?php if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
         $id=$row['CateID'];
        ?>
          <a href="index.php?id=<?php echo $id?>" class="list-group-item"><?php echo $row['catename']?></a>
          <?php }
        } else {
        echo "Don't have category";
        }
        
        ?>
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">
      <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="a1.jpg" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <div class="row">
        <?php 
        
        if (mysqli_num_rows($result1) > 0) {
    // output data of each row
        while($row1 = mysqli_fetch_assoc($result1)) {
        ?>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="detail_product.php?id=<?php echo $row1['ProID'];?>"><img class="card-img-top" src='<?php echo "images/".$row1['proimage'];?>'></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="detail_product.php?id=<?php echo $row1['ProID'];?>"><?php 
                        echo $row1['proName'];
                  ?></a>
                </h4>
                <h5> <?php  
                        echo $row1['proprice']." VND";
                     ?></h5>
                <p class="card-text"><?php if(strlen($row1['Procontent'])>100){
                                for($a=0;$a<=100;$a++){
                                echo $row1['Procontent'][$a];}  echo"...";}
                                else{echo $row1['Procontent'];}
                                ?></p>
              </div>
            </div>
          </div>
          <?php }
            } else {
            echo "0 results";
            }
            ?>

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->


</body>

</html>
<?php
mysqli_close($conn);
?>

