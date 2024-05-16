<?php
$eid = "";
$ename = "";
$role = "";
$department = "";
$branch = "";
$date = "";
$efficiency = ""; // Corrected variable name
$pa = "";

// Database connection
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "HRMS"; 
$db = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['evaluate'])){
    $eid = isset($_POST['eid']) ? validateInput($_POST['eid']) : "";
    $ename = isset($_POST['ename']) ? validateInput($_POST['ename']) : "";
    $role = isset($_POST['role']) ? validateInput($_POST['role']) : "";
    $department = isset($_POST['department']) ? validateInput($_POST['department']) : "";
    $branch = isset($_POST['branch']) ? validateInput($_POST['branch']) : "";
    $date = isset($_POST['date']) ? validateInput($_POST['date']) : "";
    $efficiency = isset($_POST['efficiency']) ? validateInput($_POST['efficiency']) : ""; // Corrected variable name
    $pa = isset($_POST['pa']) ? validateInput($_POST['pa']) : "";

    $stmt = $db->prepare("INSERT INTO pe(eid, ename, role, department, branch, date,efficiency,pa) VALUES (?,?,?,?,?,?,?,?)"); // Corrected column name
    if (!$stmt) {
        die("Error in preparing statement: " . $db->error);
    }

    $stmt->bind_param('ssssssss',$eid,$ename,$role,$department,$branch,$date,$efficiency,$pa);
    if (!$stmt->execute()) {
        die("Error in executing statement: " . $stmt->error);
    }

    header("Location: " . $_SERVER['REQUEST_URI']);
    echo "<script>alert('Performance Evaluated Successfully.');</script>";
    exit();
}

// Function to sanitize input
function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Human Resource Management System</title>
    <link href="adminPerformanceEvaluation.css" rel="stylesheet">
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
            <p>Bijay Gurung</p>
            <div class="image"></div>
        </div>

        <p class="role">Admin</p>
    </header>

    <section>
        <div class="sideNavbar">
            <button id="dashboard" onclick="dashboard()">Dashboard</button>
            <button id="employeeDataManagement" onclick="edm()">Employee Data Management</button>
            <button id="payroll" onclick="pm()">Payroll Management</button>
            <button id="Benefits" onclick="bm()">Benefits Management</button>
            <button id="performanceEvaluation" onclick="cm()">Performance Evaluation</button>
            <button id="logout" onclick="ae()">Logout</button>

            <script>
                function dashboard(){
                    location = 'adminDashboard.php';
                }

                function edm(){
                    location = 'adminEmployeeDataManagement.php';
                }

                function pm(){
                    location = 'adminEmployeePayroll.php';
                }

                function bm(){
                    location = 'adminBenefitManagementSystem.php';
                }

                function cm(){
                    location = 'adminPerformanceEvaluation.php';
                }

                function ae(){
                    location = 'index.html';
                }
                
            </script>
        </div>    
        
        <div class="content">
            <div class="title">
                <h3>Performance Evaluation</h3>
            </div>

            <div class="action">
                <form method="post">
                    <input type="text" id="eid" name="eid" value="" placeholder="Employee ID" required>
                    <input type="text" id="ename" name="ename" value="" placeholder="Employee Name" required>
                    <input type="text" id="role" name="role" value="" placeholder="Role" required>
                    <input type="text" id="department" name="department" placeholder="Department" required>
                    <input type="text" id="branch" name="branch" placeholder="Branch" required>
                    <input type="date" id="date" name="date" required>
                    <input type="text" id="efficiency" name="efficiency" placeholder="Efficiency" value="" required> <!-- Corrected field name -->
                    <input type="text" id="pa" name="pa" placeholder="Performance Average" value="" required>

                    <button type="submit" name="evaluate">Evaluate</button>

                    <div class="generateReport">
                        <button class="gp" id="gp">Generate Report</button>
                    </div>
                </form>
            </div>

            <div class="report" id="reports" role="dialog">
                <div class="content">
                    <table>
                        <tr>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Role</th>
                            <th>Department</th>
                            <th>Branch</th>
                            <th>Date</th>
                            <th>Efficiency</th> <!-- Corrected column name -->
                            <th>Performance Average</th>
                        </tr>
                        <?php
                        // Database connection
                        $servername = "localhost";
                        $username = "root"; 
                        $password = ""; 
                        $dbname = "HRMS"; 
                        $db = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($db->connect_error) {
                            die("Connection failed: " . $db->connect_error);
                        }

                        $sql = "SELECT * FROM pe";
                        $result = $db->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>".$row["eid"]."</td>
                                        <td>".$row["ename"]."</td>
                                        <td>".$row["role"]."</td>
                                        <td>".$row["department"]."</td>
                                        <td>".$row["branch"]."</td>
                                        <td>".$row["date"]."</td>
                                        <td>".$row["efficiency"]."</td> <!-- Corrected column name -->
                                        <td>".$row["pa"]."</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>No records found</td></tr>";
                        }
                        ?>
                    </table>
                </div>

                <div class="footer">
                    <button id="close">Close</button>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const gp = document.getElementById('gp');
            const modal = document.getElementById('reports');
            const closebtn = document.getElementById('close');

            gp.addEventListener('click', () => {
                modal.style.display = 'block';
            });

            closebtn.addEventListener('click', () => {
                modal.style.display = 'none';
            });
        });
    </script>

    <script src="https://kit.fontawesome.com/4f9d824da5.js" crossorigin="anonymous"></script>
</body>
</html>
