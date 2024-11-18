<?php
	session_start();
	if($_SESSION['student_details_login_status']!="loged in" and ! isset($_SESSION['Student_ID']))
		header("Location:login2.php");
	if(isset($_GET['sign']) and $_GET['sign']=="out"){
		$_SESSION['student_details_login_status']="loged out";
		unset($_SESSION['Student_ID']);
		header("Location:login2.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>PUC-Student | Enrollment</title>
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
	grid-column: 1 / span 6;
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
th{
	background-color: #001c3d;
	color: white;
	text-align: center;
}


#navigation {
  list-style-type: none;
  margin: 0;
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

.spc {
					width: 100%;
					padding: 12px 12px;
					margin: 8px 0;
					display: inline-block;
					border: 1px solid #ccc;
					border-radius: 23px;
					box-sizing: border-box;
}

</style>
</head>
<body>
<div class="grid-container">

  	<div class="grid-item item1">
		<div style="background-color:#001c3d;text-align:center;margin:0px;padding-top:10px;padding-bottom:10px;">
			<p style="font-weight:bold;color:white;padding-top:70px;padding-bottom:70px;">Student Enrollment Management System<br><br>
			<img src="puc_logo.jpg" height="140" alt="Logo of Premier University">	
			</P>
		</div>
	</div>

  	<div class="grid-item item2">
		<ul id="navigation">
  			<li><a href="index.php" class="nav"><b>Home</b></a></li>
         	<li><a href="select_session.php" class="nav"><b>Select Session</b></a></li>
  		 	<li style="float:right"><a href="?sign=out" class="nav"><b>Signout</b></a></li>
		</ul>  	
	</div>
	

  	

  	<div class="grid-item item3">
		<?php
		include("connection.php");
		$sql="select session_id from session";
		$r=mysqli_query($con,$sql);
		$row=mysqli_fetch_assoc($r);
		$session_id=$row['session_id'];
		
	
		echo"<form action='select_session.php' method='post' enctype='multipart/form-data'>
	
			<p style='text-align:center;font-size:40px;font-weight:bold;color:#001c3d'>Select session</p><hr>
			<label for='sess' style='text-align:center;color:#001c3d'>Select Available Session : </label><br><br>
			<select name='sess' class='spc' style='color:#001c3d;font-size:22px'>
				<option value='select'>Select</option>
				<option value='$session_id' name='$session_id'>$session_id</option>
		
			</select>
			<br><br>
			<input style='background-color:#001c3d;font-size:20px;color:white;text-align:center;width:200px;float:right' type='submit' value='Select' name='select'><br><br>
		
		</form> ";
		
		if(isset($_POST['select'])){
			$s=$_POST['sess'];
			
			$query="select * from session where session.session_id='$s'";
			$r=mysqli_query($con,$query);
			$row=mysqli_fetch_assoc($r);
			$session_id=$row['session_id'];
			$start_time=$row['start_time'];
			$end_time=$row['end_time'];
			
			$today = date('Y-m-d');
	
			$today=date('Y-m-d', strtotime($today));


			

			if (($today >= $start_time) && ($today <= $end_time)){
				$status = "true";
				if($status="true"){
					header("Location:enrollment.php");
				}
			}
			else{
				$status= "false";  
			}
		}
	?>
	
	</div>
	
  	<hr>

  	<div class="grid-item item5" style="text-align:center;">
  		<p style="color:#001c3d;text-align:center">Author:Tamanna Kawser Chowdhury<br>
  		<a href="mailto:tamannakawser45@gmail.com" style="color:#001c3d;">tamannakawser45@gmail.com</a></p>
  	</div>

</div>
</body>
</html> 