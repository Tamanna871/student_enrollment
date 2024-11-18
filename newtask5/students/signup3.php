<!DOCTYPE html>
<html>
	<head>
		<title>Sign Up Page</title>
			<style>
				.grid-container {
					display: grid;
					gap: 0px;
				}
				.grid-item {
					text-align: left;
					padding: 20px;
					font-size: 20px;
					color: white;
				}
				.item1 {
					grid-column: 1 / span 6;
					grid-row: 1;
					background-color: #76b852
				}
				.item2 {
					grid-column: 1/span 2;
					grid-row: 2/span 2;
					background-color: #76b852
				}
				.item3 {
					grid-column: 3 / span 2;
					grid-row: 2/span 2;
					background-color: #32611f
				}
				.item4 {
					grid-column: 5 / span 2;
					grid-row: 2/span 2;
					background-color: #76b852
				}
				.item5 {
					grid-column: 1/span 6;
					grid-row: 4;
					background-color: #76b852
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
				.button1 {
					border: 1px solid #ccc;
					border-radius: 23px;
					display: block;
					background-color: #76b852;
					color: white;
					text-align: left;
					padding: 4px 70px;
					font-size: 20px;
				}
				.button2 {
					border: 1px solid #ccc;
					border-radius: 23px;
					display: block;
					background-color: #76b852;
					color: white;
					padding: 4px 70px;
					float: right;
					font-size: 20px;
				}
				a {
					text-decoration: none;
					color: white;
				}
				.bt {
					display:inline
				}
		</style>
	</head>
	<body>
		<div class="grid-container">
			<div class="grid-item item1"></div>
			<div class="grid-item item2"></div>
			<div class="grid-item item4"></div>
			<div class="grid-item item5"></div>
			<div class="grid-item item3">
				<p align="center">Already have an account? Please <a href="login2.php"><b>Log In.</b></a></p>
				<hr>
				<h2 align="center"><u>Sign Up</u></h2>
				<form action="signup3.php" method="post" enctype="multipart/form-data">
			
					<label for="fname">Full name:</label><br><br>
					<input type="text" id="fname" class="spc" name="name" size="50" required><br><br>

					<label for="ename">Email ID:</label><br><br>
					<input type="email" id="ename" class="spc" name="email" size="50" required><br><br>

					<label for="stuid">Student ID(This will be your User ID after registration):</label><br><br>
					<input type="text" id="stuid" class="spc" name="id" size="50" required><br><br>

					<label for="pass">Password (8 characters minimum):</label><br><br>
					<input type="password" class="spc" id="pass" name="password" minlength="8" size="50" required><br><br>

					<label for="sname">Section:</label><br><br>
					<input type="text" id="sname" class="spc" name="section" size="50" required><br><br>

					<label for="bname">Batch:</label><br><br>
					<input type="text" id="bname" class="spc" name="batch" size="50" required><br><br>

					<label for="DOB">Date of Birth:</label><br><br>
					<input type="date" id="DOB" class="spc" name="dob" required><br><br>

					Department:<br><br>
					<input type="radio" class="pl" id="cse" name="dept" value="cse" required>
					<label for="cse">CSE</label><br><br>
					<input type="radio" class="pl" id="eee" name="dept" value="eee" required>
					<label for="eee">EEE</label><br><br>
					<input type="radio" class="pl" id="arch" name="dept" value="arch" required>
					<label for="arch">Arch.</label><br><br>

					<label for="phone">Enter your phone number:</label><br><br>
					<input type="text" id="phone" class="spc" name="phone" length="11" required><br><br>

					<label for="myfile">Upload your image:</label><br><br>
					<input type="file" id="myfile" name="myfile" required><br><br>

					<input type="submit" class="button1 bt" value="Submit" name="submit">
					<input type="reset" class="button2 bt" value="Reset">

				</form> 
			</div>
		</div>
	</body>
</html> 

<?php
	include("connection.php");
	if(isset($_POST['submit'])){
		$name=$_POST['name'];
		$email=$_POST['email'];
		$id=$_POST['id'];
		$password=$_POST['password'];
		$section=$_POST['section'];
		$batch=$_POST['batch'];
		$dob=$_POST['dob'];
		$dept=$_POST['dept'];
		$phone=$_POST['phone'];

		$ext=explode(".",$_FILES['myfile']['name']);
		$c=count($ext);
		$ext=$ext[$c-1];
		$date=date("D:M:Y");
		$time=date("h:i:s");
		$image_name=md5($date.$time.$id);
		$image=$image_name.".".$ext;

		$query="insert into student_details values('$id','$name','$email','$section','$batch','$dept','$dob','$phone','$image','$password')";

		if(mysqli_query($con,$query)) {
			echo "Successfully inserted!";
			if($image !=null){
				move_uploaded_file($_FILES['myfile']['tmp_name'],"image_container/$image");
			}
		}
		else {
			echo "error!".mysqli_error($con);
		}
	}
?>