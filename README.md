
# **Student Enrollment System**

## **Project Overview**
This project is a **Student Enrollment System** that enables admins and students to manage course enrollment seamlessly. It includes a comprehensive database setup, user authentication, course session management, and enrollment approval functionality.

---

## **Installation and Setup**

### **1. Clone the Repository**
1. Open your command prompt.
2. Run the following command to clone the repository:
   ```bash
   git clone https://github.com/Tamanna871/student_enrollment
   ```
3. A folder named `student_enrollment` will be downloaded. Open this folder to proceed.

---

### **2. Move Files to XAMPP**
1. Inside the `student_enrollment` folder, locate the `newtask5` folder.
2. Copy the `newtask5` folder and paste it into the `htdocs` directory of your XAMPP installation.

---

### **3. Start XAMPP**
1. Open the **XAMPP Control Panel**.
2. Start both **Apache** and **MySQL** services as administrator.

---

### **4. Setup the Database**
1. Open your browser and navigate to:
   ```
   http://localhost/phpmyadmin
   ```
2. Create a new database named `student_enrollment`.
3. Select the `SQL` tab in the database and paste the following SQL code to create the required tables:

   ```sql
   CREATE TABLE `admin_details` (
     `Admin_ID` varchar(50) NOT NULL,
     `name` varchar(255) DEFAULT NULL,
     `email` varchar(255) DEFAULT NULL,
     `dob` date DEFAULT NULL,
     `phone` varchar(11) DEFAULT NULL,
     `image` varchar(255) DEFAULT NULL,
     `Passwrd` varchar(255) DEFAULT NULL
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

   CREATE TABLE `course_list` (
     `course_id` varchar(20) NOT NULL,
     `course_title` varchar(100) NOT NULL,
     `course_credit` int(11) NOT NULL
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

   CREATE TABLE `course_under_semester` (
     `year` varchar(20) NOT NULL,
     `course_id` varchar(20) NOT NULL,
     `course_title` varchar(100) NOT NULL
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

   CREATE TABLE `enrollline` (
     `enrollment_id` int(11) NOT NULL,
     `course_id` varchar(50) NOT NULL
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

   CREATE TABLE `session` (
     `session_id` varchar(50) NOT NULL,
     `start_time` date DEFAULT NULL,
     `end_time` date DEFAULT NULL
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

   CREATE TABLE `student_details` (
     `Student_ID` varchar(50) NOT NULL,
     `name` varchar(255) DEFAULT NULL,
     `email` varchar(255) DEFAULT NULL,
     `section` varchar(50) DEFAULT NULL,
     `batch` varchar(50) DEFAULT NULL,
     `dept` varchar(50) DEFAULT NULL,
     `dob` date DEFAULT NULL,
     `phone` varchar(11) DEFAULT NULL,
     `image` varchar(255) DEFAULT NULL,
     `Passwrd` varchar(255) DEFAULT NULL
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

   CREATE TABLE `student_req` (
     `enrollment_id` int(11) NOT NULL,
     `student_id` int(11) NOT NULL,
     `enrollment_date` date NOT NULL,
     `status` int(11) NOT NULL
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
   ```
4. Uncheck the **Enable foreign key check** option and click **Go**.

---

### **5. Start the Application**

#### **Admin Panel**
1. Open the admin signup page:
   ```
   http://localhost/newtask5/admin/signup3.php
   ```
2. Fill out the signup form and submit it.
3. Login to the admin panel:
   ```
   http://localhost/newtask5/admin/login2.php
   ```

#### **Session and Course Management**
1. After logging in, click the **Enrollment** button.
2. Create a session using the following sample information:
   ```sql
   (`session_id`, `start_time`, `end_time`) 
   ('Fall 2024', '2024-03-23', '2045-03-21');
   ```
3. Scroll down and select the newly created session.
4. Add the following courses:
   ```sql
   ('ACC 101', 'Basic Accounting', 2),
   ('ACC 105', 'Basic Accounting 3', 3),
   ('CSE 103', 'Structured Programming', 3),
   ('CSE 110', 'Introduction to Computer System', 3),
   ('CSE 111', 'Structured Programming Lab', 2),
   ('CSE 112', 'Compiler Construction', 3),
   ('CSE 211', 'Object Oriented Programming', 3),
   ('CSE 212', 'Object Oriented Programming Lab', 2),
   ('CSE 221', 'Data Structure', 3),
   ('CSE 222', 'Data Structure Lab', 2);
   ```
5. Scroll down to verify that the courses have been added. You can update courses via the **Update Course** option and manage enrollment requests through the **Enrollment Request** option.

#### **Student Panel**
1. Open the student signup page:
   ```
   http://localhost/newtask5/students/signup3.php
   ```
2. Complete the signup process.
3. Login to the student panel:
   ```
   http://localhost/newtask5/students/login2.php
   ```
4. Go to the **Enrollment** option from the left menu, select a session, choose courses, and click **Enroll**.
5. Go to the **Pending** option to see unapproved courses. Approved courses will appear under the **Approved Requests** page once the admin approves them.

#### **Sign Out**
Always sign out from both panels after completing your tasks.

---

## **Contact**
For any queries, feel free to contact:

**Tamanna Kawser Chowdhury**  
GitHub: [Tamanna871](https://github.com/Tamanna871)

---
