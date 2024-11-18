<?php
	session_start();
	if($_SESSION['admin_details_login_status']!="loged in" and ! isset($_SESSION['Admin_ID']))
		header("Location:login2.php");
	if(isset($_GET['sign']) and $_GET['sign']=="out"){
		$_SESSION['admin_details_login_status']="loged out";
		unset($_SESSION['Admin_ID']);
		header("Location:login2.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Student Records</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

.grid-container {
  	display: grid;
  	grid-gap: 10px;
  	padding: 10px;
}

.grid-item {
  	background-color: lightblue;
  	text-align: center;
  	padding: 20px;
  	font-size: 30px;
}

.item1 {
	grid-column: 1 / span 6;
  	grid-row: 1;
	background-color: lightblue;
}
.item2 { 
  	grid-column: 1 / span 6;
  	grid-row: 2;
}
.item3 { 
	grid-column: 1 / span 2;
  	grid-row: 3; 
}
.item4 { 
	grid-column: 3 / span 4;
  	grid-row: 3;
 }
.item5 { 
	grid-column: 1 / span 6;
  	grid-row: 4; 
}
  
.stl:link, .stl:visited {
  	background-color: #001c3d;
 	color: white;
  	padding: 5px 25px;
  	text-align: center;
  	text-decoration: none;
  	display: inline-block;
	float:left;
  	width:150px;
  	height:15px;
  	font-size: 15px;
}
.stl:hover, .stl:active {
  	background-color: black;
}

#navigation {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #001c3d;
  padding: 0px 25px;
}

.nav {
  display: block;
  color: white;
  text-align: center;
  padding: 12px 16px;
  text-decoration: none;
  background-color: #001c3d;
  float: left;
  font-size: 18px;
  
}

.nav:hover, .nav:active {
  	background-color: black;
}

</style>
</head>
<body>
	<div class="grid-container">

		<div class="grid-item item1">
			<div style="background-color:#001c3d; margin:0px;padding-top:10px;padding-bottom:10px;">
				<p style="font-weight:bold;color:white;padding-top:70px;padding-bottom:70px;">Student Enrollment Management System<br>Admin Page<br>
				<img src="puc_logo.jpg" height="140" alt="Logo of Premier University">	
				</P>
			</div>
		</div>

		<div class="grid-item item2">
			<ul id="navigation">
				<li><a href="index.php" class="nav"><b>Home</b></a></li>
				<li style="float:right"><a href="?sign=out" class="nav"><b>Signout</b></a></li>
			</ul>  	
		</div>
	
		<div class="grid-item item3">
			<a href="#studentlist" class="stl"><b>Students List</b></a><br>
			<a href="session.php" class="stl"><b>Enrollment</b></a><br>
			<a href="#pay" class="stl"><b>Payment Status</b></a><br>
		</div>

		<div class="grid-item item4">
			<?php
				include("connection.php");
				$user_id=$_SESSION['Admin_ID'];
				$sql="select Admin_ID,Name from admin_details where Admin_ID='$user_id'";
				$r=mysqli_query($con,$sql);
				$row=mysqli_fetch_assoc($r);
				$id=$row['Admin_ID'];
				$name=$row['Name'];
				echo "<p style='color:#001c3d'>Id:$id<br>$name</p>";
			?>
			<h3 style="color:#001c3d">Premier University</h3>
			<p style="color:#001c3d">Welcome to Premier University Student Enrollment Website.</p>
		</div>

		<hr>

		<div class="grid-item item5">
			<p style="color:#001c3d">Author:Tamanna Kawser Chowdhury<br>
			<a href="mailto:tamanna.kawser218@gmail.com" style="color:#001c3d">tamanna.kawser218@gmail.com</a></p>
		</div>
		
	</div>
</body>
</html>
