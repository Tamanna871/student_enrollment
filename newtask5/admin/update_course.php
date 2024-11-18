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

#tdesign {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#tdesign td, #tdesign th {
  border: 1px solid #001c3d;
  padding: 8px;
}

#tdesign tr:nth-child(even){background-color: #f2f2f2;}



#tdesign th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #001c3d;
  color: white;
}

</style>
</head>
<body>
<div class="grid-container">

  	<div class="grid-item item1">
		<div style="background-color:#001c3d;text-align:center;margin:0px;padding-top:10px;padding-bottom:10px;">
			<p style="font-weight:bold;color:white;padding-top:70px;padding-bottom:70px;">Student Enrollment Management System<br>Admin Page<br>
			<img src="puc_logo.jpg" height="140" alt="Logo of Premier University">	
			</P>
		</div>
	</div>

  	<div class="grid-item item2">
		<ul id="navigation">
  			<li><a href="index.php" class="nav"><b>Home</b></a></li>
			<li><a href="session.php" class="nav"><b>Session</b></a></li>
         	<li><a href="Add_course.php" class="nav"><b>Add Courses</b></a></li>
			<li><a href="update_course.php" class="nav"><b>Update Course</b></a></li>
			<li><a href="sreq.php" class="nav"><b>Enrollment Requests</b></a></li>
  		 	<li style="float:right"><a href="?sign=out" class="nav"><b>Signout</b></a></li>
		</ul>  	
	</div>
	

  	

  	<div class="grid-item item3">
	<form action="update_course.php" method="post" enctype="multipart/form-data">
			<label for="cid" style="text-align:left;color:#001c3d">Course ID:</label><br><br>
			<input type="text" id="cid" class="spc" name="course_id" size="50" required><br><br>
			
			<label for="ctitle" style="text-align:center;color:#001c3d">Select Course : </label>
			<select name="ctitle" class="spc">
	<?php
		include("connection.php");
		$sql="select course_title from course_list";
		$r=mysqli_query($con,$sql);
		while($row=mysqli_fetch_array($r)){
			$course_title=$row['course_title'];
		
			echo"<option value='$course_title'>$course_title</option>";
		}
	?>
		</select><br><br>
			
			<label for="cttl" style="text-align:left;color:#001c3d">Course Title:</label><br><br>
			<input type="text" id="cttl" class="spc" name="course_title" size="100" required><br><br>
			
			<label for="ccr" style="text-align:left;color:#001c3d">Course Credit:</label><br><br>
			<input type="text" id="ccr" class="spc" name="course_credit" size="50" required><br><br>
			
			<input style="background-color:#001c3d;font-size:25px;color:white;text-align:center;width:200px;float:right" type="submit" value="Update Course" name="update"><br><br>
	</form> 
	<?php
		include("connection.php");
		if(isset($_POST['update'])){
			$s=$_POST['ctitle'];
			$course_id=$_POST['course_id'];
			$course_title=$_POST['course_title'];
			$course_credit=$_POST['course_credit'];
			$query="update course_list set course_id='$course_id',course_title='$course_title',course_credit='$course_credit' where course_title='$s'";
			if(mysqli_query($con,$query)) {
				echo "Successfully Updated!";
			}
			else {
				echo "error!".mysqli_error($con);
			}	
		}
	?>
	<?php
	include("connection.php");
	$sql="select * from course_list";
	$r=mysqli_query($con,$sql);
	echo"<table id='tdesign'>";
	echo "<tr style='text-align:center;'>
	<th style='text-align:center;'>Course ID</th>	
	<th style='text-align:center;'>Course Title</th>	
	<th style='text-align:center;'>Course Credit</th>	
	</tr>";	
	while($row=mysqli_fetch_array($r)){
		$course_id=$row['course_id'];
		$course_title=$row['course_title'];
		$course_credit=$row['course_credit'];

	echo"<tr style='text-align:center;'>
	<td style='text-align:center;color:#001c3d'>$course_id</td><td style='text-align:center;color:#001c3d'>$course_title</td><td style='text-align:center;color:#001c3d'>$course_credit</td>
	</tr>";
	}
	echo"</table>";
	
	?>
		
	</div>
	
  	<hr>

  	<div class="grid-item item5" style="text-align:center;">
  		<p style="color:#001c3d;text-align:center">Author:Tamanna Kawser Chowdhury<br>
  		<a href="mailto:tamanna.kawser218@gmail.com" style="color:#001c3d;">tamanna.kawser218@gmail.com</a></p>
  	</div>

</div>
</body>
</html> 

