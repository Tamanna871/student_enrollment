<?php
	session_start();
	if($_SESSION['student_details_login_status'] != "loged in" && !isset($_SESSION['Student_ID'])) {
		header("Location: login2.php");
	}
	if(isset($_GET['sign']) && $_GET['sign'] == "out") {
		$_SESSION['student_details_login_status'] = "loged out";
		unset($_SESSION['Student_ID']);
		header("Location: login2.php");
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
	grid-column: 1 / span 6;
  	grid-row: 3; 
}

.item5 { 
	grid-column: 1 / span 6;
  	grid-row: 4; 
}
  
th{
	background-color: #001c3d;
	color: white;
	text-align: center;
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
#course{
	font-size: 12px;
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

#tdesign tr:hover {background-color: #ddd;}

#tdesign th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #001c3d;
  color: white;
}
</style>
</head>
<body>
<div class="grid-container">

  	<div class="grid-item item1">
		<div style="background-color:#001c3d;text-align:center;margin:0px;padding-top:10px;padding-bottom:10px;">
			<p style="font-weight:bold;color:white;padding-top:70px;padding-bottom:70px;">Student Enrollment Management System<br><br>
			<img src="puc_logo.jpg" height="140" alt="Logo of Premier University">	
			</p>
		</div>
	</div>

  	<div class="grid-item item2">
		<ul id="navigation">
  			<li><a href="index.php" class="nav"><b>Home</b></a></li>
			<li><a href="select_session.php" class="nav"><b>Select Session</b></a></li>
         	<li><a href="enrollment.php" class="nav"><b>Select Courses & Enroll</b></a></li>
		 	<li><a href="pending.php" class="nav"><b>Pending Requests</b></a></li>
			<li><a href="approved.php" class="nav"><b>Approved Requests</b></a></li>
  		 	<li style="float:right"><a href="?sign=out" class="nav"><b>Signout</b></a></li>
		</ul>  	
	</div>
	<div class="grid-item item3">
		<form action='enrollment.php' method='post'> <!-- Open the form outside the loop -->
		<?php
		include("connection.php");
		$query = "SELECT * FROM course_under_semester, course_list WHERE course_under_semester.course_id=course_list.course_id";
		$r = mysqli_query($con, $query);
		echo "<table id='tdesign'>";
		echo "<tr>
		<th>Serial no.</th>   
		<th>Select</th>    
		<th>Year</th>    
		<th>Course ID</th>    
		<th>Course Title</th>    
		<th>Course Credit</th>   
		</tr>";   
		$count = 1;
		while ($row = mysqli_fetch_array($r)) {
		    $s_no = $count++;
		    $year = $row['year'];
		    $courseid = $row['course_id'];
		    $coursetitle = $row['course_title'];
		    $coursecredit = $row['course_credit'];
		    echo "<tr>
		    <td>$s_no</td><td><input type='checkbox' name='course_ids[]' value='$courseid' style='width:25px;height:25px'></td><td>$year</td><td id='course' style='font-size:20px'>$courseid</td><td id='course' style='font-size:20px'>$coursetitle</td><td id='course' style='font-size:20px'>$coursecredit</td>
		    </tr>";
		}
		echo "</table><br>";
		?>
		<input style="background-color:#001c3d;font-size:20px;color:white;text-align:center;width:200px;float:center;" type="submit" value="Enroll" name="enroll">
		</form> <!-- Close the form -->
	</div>
	
  	<hr>

  	<div class="grid-item item5">
  		<p>Author:Tamanna Kawser Chowdhury<br>
  		<a href="mailto:tamannakawser45@gmail.com" style="color:black">tamannakawser45@gmail.com</a></p>
  	</div>

	<?php
	include("connection.php");
	if(isset($_POST['enroll'])) {
		$en_date = date("Y-m-d");
		$stuid = $_SESSION['Student_ID'];
		$course_ids = $_POST['course_ids']; // Array of selected course IDs
		foreach ($course_ids as $course_id) {
			$e_id = rand(10, 1000);
			$sqlorder = "INSERT INTO student_req VALUES ('$e_id', '$stuid', '$en_date', 0)";
			mysqli_query($con, $sqlorder);
			$sql = "INSERT INTO enrollline (enrollment_id, course_id) VALUES ('$e_id', '$course_id')";
			mysqli_query($con, $sql);
		}
		echo "Enrollment Request sent";
	}
	?>
</div>
</body>
</html>
