<?php
	session_start();
	if($_SESSION['admin_details_login_status'] != "loged in" && !isset($_SESSION['Admin_ID'])) {
		header("Location: login2.php");
	}
	if(isset($_GET['sign']) && $_GET['sign'] == "out") {
		$_SESSION['admin_details_login_status'] = "loged out";
		unset($_SESSION['Admin_ID']);
		header("Location: login2.php");
	}
	
	// Database connection
	include("connection.php");
	
	// Approve enrollment request
	if(isset($_GET['action']) && $_GET['action'] == "approve" && isset($_GET['id'])) {
		$enroll_id = $_GET['id'];
		// Update status to Approved in student_req table
		$update_query = "UPDATE student_req SET status = 1 WHERE enrollment_id = '$enroll_id'";
		mysqli_query($con, $update_query);
		// Redirect to same page after updating
		header("Location: ".$_SERVER['PHP_SELF']);
		exit;
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
		<div style="background-color:#001c3d; margin:0px;padding-top:10px;padding-bottom:10px;">
			<p style="font-weight:bold;color:white;padding-top:70px;padding-bottom:70px;">Student Enrollment Management System<br><br>
			<img src="puc_logo.jpg" height="140" alt="Logo of Premier University">	
			</p>
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
		<h2>All Student Enrollment Requests</h2>
		<table id="tdesign">
			<tr>
				<th>Status</th>
				<th>Enrollment ID</th>
				<th>Student ID</th>
				<th>Enrollment Date</th>
				<th>Action</th>
			</tr>
			<?php
			$sql = "SELECT * FROM student_req";
			$result = mysqli_query($con, $sql);
			if(mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					if($row['status'] == 0) {
						echo "<td>Pending</td>";
						echo "<td>" . $row['enrollment_id'] . "</td>";
						echo "<td>" . $row['student_id'] . "</td>";
						echo "<td>" . $row['enrollment_date'] . "</td>";
						echo "<td><a href='?action=approve&id=" . $row['enrollment_id'] . "'>Approve</a></td>";
					} elseif($row['status'] == 1) {
						echo "<td>Approved</td>";
						echo "<td>" . $row['enrollment_id'] . "</td>";
						echo "<td>" . $row['student_id'] . "</td>";
						echo "<td>" . $row['enrollment_date'] . "</td>";
						echo "<td>Approved</td>"; // You can add additional actions if needed
					} elseif($row['status'] == 2) {
						echo "<td>Rejected</td>";
						echo "<td>" . $row['enrollment_id'] . "</td>";
						echo "<td>" . $row['student_id'] . "</td>";
						echo "<td>" . $row['enrollment_date'] . "</td>";
						echo "<td>Rejected</td>"; // You can add additional actions if needed
					}
					echo "</tr>";
				}
			} else {
				echo "<tr><td colspan='5'>No enrollment requests found</td></tr>";
			}
			?>
		</table>
	</div>
	
  	<hr>

  	<div class="grid-item item5">
  		<p>Author:Tamanna Kawser Chowdhury<br>
  		<a href="mailto:tamanna.kawser218@gmail.com" style="color:black">tamanna.kawser218@gmail.com</a></p>
  	</div>

</div>
</body>
</html>
