<?php
session_start();
error_reporting(0);

include('includes/dbconnection.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Zoo Management System | Animal Detail</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<!--lightbox-->
<link rel="stylesheet" type="text/css" href="css/jquery.lightbox.css">
<script src="js/jquery.lightbox.js"></script>
<script>
  // Initiate Lightbox
  $(function() {
    $('.gallery a').lightbox(); 
  });
</script>
<!--lightbox-->
</head>
<body>
<?php include_once('includes/header.php');?>
		<div class="banner-header">
			<div class="container">
				<h2>Animal Detail</h2>
			</div>
			</div>
	<div class="content">
	<!--gallery-->
			<div class="gallery-section">
					<div class="container">
					<div class="welcome-grid">
				
				<div class="col-md-8">
					<div>
						<?php 
						$anid=$_GET['anid'];
 $query=mysqli_query($con,"select * from tblanimal where ID='$anid'");
 while ($row=mysqli_fetch_array($query)) {
 ?>
						<div style="width: 300px; height: 300px; overflow: hidden; background-color: #f5f5f5; position: relative; margin-bottom: 20px;">
							<img src="<?php echo 'admin/images/'.$row['AnimalImage']; ?>" 
								style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%; height: 100%; object-fit: cover;"
								alt="<?php echo htmlspecialchars($row['AnimalName']); ?>" />
						</div>
<h4 style="padding-top: 20px"><?php echo $row['AnimalName'];?>(<?php echo $row['Breed'];?>)</h4>
<p style="padding-top: 20px"><?php echo $row['Description'];?>.</p>
<strong style="padding-top: 20px">Breed: <?php echo $row['Breed'];?></strong><br>
<strong style="padding-top: 20px">Cage Number: <?php echo $row['CageNumber'];?>.</strong><br>
<strong style="padding-top: 20px">Feed Number: <?php echo $row['FeedNumber'];?>.</strong>
					<?php }?>
					</div>	
				</div>
				
				<div class="clearfix"> </div>
			</div>
	
		</div>
	</div>
<!--gallery-->
<!--specials-->
		<?php include_once('includes/special.php');?>
			</div>
		<?php include_once('includes/footer.php');?>
</body>
</html>