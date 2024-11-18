<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
			<style>
				.grid-container {
					display: grid;
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
		<p align="center">Don't have an account? Please <a href="signup3.php"><b>Sign Up</b></a></p>
		<hr>
		<h3 id="lin" align="center"><u>Log In</u></h3>
		<form action="login2.php" method="post">
			<br>
			<label for="uname">User ID</label><br>
			<input type="text" id="uname" name="id" class="spc" size="50" required><br><br>
			<label for="pwd">Password</label><br>
			<input type="password" id="pwd" name="pwd" class="spc" size="50" minlength="8" required><br><br>
			<input type="submit" value="Log In" class="button1 bt" id="sbutton" name="login">
			<input type="reset" class="button2 bt" value="Reset">
		</form>
		</div>
	</div>
</body>
</html> 

<?php
	include("connection.php");
	if(isset($_POST['login'])){
		$user_id=$_POST['id'];
		$password=$_POST['pwd'];

		$sql1="select Student_ID,Passwrd from student_details where Student_ID='$user_id' and Passwrd='$password'";
	
		$r1=mysqli_query($con,$sql1);
		
		if(mysqli_num_rows($r1)>0){
			$_SESSION['Student_ID']=$user_id;
			$_SESSION['student_details_login_status']="loged in";
			header("Location:index.php");
		}

		else {
			echo "<p style='color:red;'>Incorrect UserId or Password.</p>";
		}
	}
?>