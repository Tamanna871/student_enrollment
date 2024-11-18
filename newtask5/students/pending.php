<?php
session_start();
if ($_SESSION['student_details_login_status'] != "loged in" && !isset($_SESSION['Student_ID'])) {
    header("Location: login2.php");
}
if (isset($_GET['sign']) && $_GET['sign'] == "out") {
    $_SESSION['student_details_login_status'] = "loged out";
    unset($_SESSION['Student_ID']);
    header("Location: login2.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>PUC-Student | Pending Requests</title>
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
    background-color: #001c3d;
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

th {
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
#course {
    font-size: 12px;
}
</style>
</head>
<body>
<div class="grid-container">
    <div class="grid-item item1">
        <p style="text-align:center;font-weight:bold;color:white;">Student Record Management System</p>
        <img src="puc_logo.jpg" height="140" alt="Logo of Premier University">    
    </div>

    <div class="grid-item item2">
        <ul id="navigation">
            <li><a href="index.php" class="nav"><b>Home</b></a></li>
            <li><a href="enrollment.php" class="nav"><b>Select Courses & Enroll</b></a></li>
            <li><a href="pending.php" class="nav"><b>Pending Requests</b></a></li>
            <li><a href="approved.php" class="nav"><b>Approved Requests</b></a></li>
            <li style="float:right"><a href="?sign=out" class="nav"><b>Signout</b></a></li>
        </ul>     
    </div>

    <div class="grid-item item3">
        <?php
        include("connection.php");
        $student_id = $_SESSION['Student_ID']; // Logged-in student's ID

        // Query to get pending requests for the logged-in student
        $sql = "
            SELECT 
                course_list.course_id, 
                course_list.course_title, 
                course_list.course_credit 
            FROM 
                enrollline 
            INNER JOIN 
                course_list 
            ON 
                enrollline.course_id = course_list.course_id 
            INNER JOIN 
                student_req 
            ON 
                enrollline.enrollment_id = student_req.enrollment_id
            WHERE 
                student_req.student_id = '$student_id' 
                AND student_req.status = 0"; // 0 = Pending requests

        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table id='tdesign'>";
            echo "<tr>
                <th>Course ID</th>
                <th>Course Title</th>
                <th>Course Credit</th>
            </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$row['course_id']}</td>
                    <td>{$row['course_title']}</td>
                    <td>{$row['course_credit']}</td>
                </tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='color:red;'>No pending requests found.</p>";
        }
        ?>
    </div>
    
    <hr>

    <div class="grid-item item5">
        <p>Author: Tamanna Kawser Chowdhury<br>
        <a href="mailto:tamannakawser45@gmail.com" style="color:black">tamannakawser45@gmail.com</a></p>
    </div>
</div>
</body>
</html>
