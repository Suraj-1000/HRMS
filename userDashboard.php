<?php
// Database Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_pass = '';
$db_name = 'HRMS';

// Database connection
$db = new mysqli($db_host, $db_username, $db_pass, $db_name);

// Check Database Connection
if ($db->connect_error) {
    die("Connection failed" . $db->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Human Resource Management System</title>
    <link href="adminDashboard.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="Logo">
            <div id="logo"></div>
            <h3 id="logoName">Innovate Nepal</h3>
        </div>

        <nav>
            <a href="adminDashboard.php" id="home">Home</a>
        </nav>

        <div class="userlogo">
            <p>Suraj Kanwar</p>
            <div class="image"></div>
        </div>

        <p class="role">User</p>
    </header>

    <section>
        <div class="sideNavbar">
            <button id="dashboard" onclick="das()">Dashboard</button>
            <button id="employeeDataManagement" onclick="am()">Employee Data Management</button>
            <button id="payroll" onclick="ab()">Payroll Management</button>
            <button id="Benefits">Benefits Management</button>
            <button id="performanceEvaluation">performance Evaluation</button>
            <button id="logout" onclick="ae()">Logout</button>

            <script>
                function das(){
                    location = 'UserDashboard.php';
                }

                function am(){
                    location = 'employeeDataManagement.php';
                }

                function ab(){
                    location = 'employeePayroll.php';
                }

                function eac(){
                    location = 'employeeAttendanceChecker.php';
                }

                function ae(){
                    location = 'index.html';
                }


            </script>
        </div>    

        <div class="content1">
            <div class="totalEmployees">
                <i class="fa-solid fa-users" style="color: #fff;"></i>
                <h3>Total Employees</h3>
            </div>
            <p id="employees">400</p>

            <div class="girls">
                <p>Female</p>
                <p>150</p>
            </div>

            <div class="boys">
                <p>Male</p>
                <p>250</p>
            </div>
        </div>

        <div class="content2">
            <div class="newEmployee">
                <i class="fa-solid fa-user" style="color: #ffffff;"></i>
                <h3>New Employee</h3>
            </div>
            <p id="newEmployee">30</p>
        </div>

        <div class="content3">
            <div class="GNP">
                <i class="fa-solid fa-arrow-up" style="color: #ffffff;"></i>
                <h3>Gross Net Profit</h3>
            </div>
            <p id="grossNetProfit">100000</p>
        </div>

        <div class="content4">
            <div class="present">
                <h3>Present</h3>
                <p>250</p>
            </div>

            <div class="late">
                <h3>Late</h3>
                <p>100</p>
            </div>

            <div class="absent">
                <h3>Absent</h3>
                <p>50</p>
            </div>

            <div class="EAC" onclick="eac()">
                <i class="fa-solid fa-calendar-days" style="color: #ffffff;"></i>
                <h3>Employee Attendance Checker</h3>
            </div>
        </div>

        
        <div class="content5">
            <div class="searchSection">
                <form method="post">
                    <input type="text" id="searchbar" name="searchbar" placeholder="Search.....">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i></button>
                </form>
            </div>
            <div class="employeePerformance">
                <table>
                    <tr id="heading">
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Performance</th>
                    </tr>
                        <tr id="data1">
                            <td><img src="./Images/Bijay.jpg" height="40px" width="40px"></td>
                            <td>Bijay Gurung</td>
                            <td>Fullstack Developer</td>
                            <td><button>Excellent</button></td>
                        </tr>               

                        <tr id="data1">
                            <td><img src="./Images/Bijay.jpg" height="40px" width="40px"></td>
                            <td>Suraj Kanwar</td>
                            <td>Fullstack Developer</td>
                            <td><button>Excellent</button></td>
                        </tr>

                        <tr id="data1">
                            <td><img src="./Images/Bijay.jpg" height="40px" width="40px"></td>
                            <td>Isbin Shrestha</td>
                            <td>Fullstack Developer</td>
                            <td><button>Excellent</button></td>
                        </tr>
                </table>
        </div>

        <div class="content6">
            <h3>To DO List</h3>
            <?php
            $sql = "SELECT * FROM todolist";
            $result = $db->query($sql);
            echo "<div class='Tasks'>";
            if ($result->num_rows > 0) {
                echo "<ul>";
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='new'>";
                    echo "<li>" . $row["task"] . "</li>";
                    echo "</div>";
                }
                echo "</ul>";
            }
            echo "</div>";
            ?>
        </div>
    </section>

    <script src="script.js"></script>
    <script src="https://kit.fontawesome.com/4f9d824da5.js" crossorigin="anonymous"></script>
</body>
</html>
