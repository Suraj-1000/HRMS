<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Form</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f1f1f1;
        }

        form {
            max-width: 500px;
            padding: 80px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        label {
            margin-bottom: 5px;
        }

        input {
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            border: none;
        }

        .error {
            color: red;
            margin-bottom: 5px;
        }

        .success-message {
            color: green;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <form id="registrationForm" method="post">
        <h2>User Registration</h2>
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <br>
        <input type="submit" name="submit" value="Register">
        <br>
   

        <?php
        // process the form data when the form is submitted
        if (isset($_POST["submit"])) {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirm_password = $_POST["confirm_password"];

            //check if fields are not empty, validate email format and all
            $errors = array();
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "Invalid email format";
            }
            if (empty($name)) {
                $errors["name"] = "Name is required";
            }
            if (empty($password)) {
                $errors["password"] = "Password is required";
            }
            if ($password !== $confirm_password) {
                $errors["confirm_password"] = "Passwords do not match";
            }

            // if no errors occurs, proceed with registration
            if (empty($errors)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                // save the data to a JSON file
                $userData = array(
                    'name' => $name,
                    'email' => $email,
                    'password' => $hashed_password 
                );

                $jsonFile = 'users.json';
                $existingDataArray = array();
                if (file_exists($jsonFile)) {
                    $existingData = file_get_contents($jsonFile);
                    $existingDataArray = json_decode($existingData, true);
                }

                $existingDataArray[] = $userData;

                $updatedData = json_encode($existingDataArray, JSON_PRETTY_PRINT);
                file_put_contents($jsonFile, $updatedData);

                // display the success message 
                echo "<div class='success-message'>User registration successful!</div>";

                // display the inputted data by the user
                echo "<div id='userDataDisplay'>";
                echo "<p><strong>Name:</strong> " . $name . "</p>";
                echo "<p><strong>Email:</strong> " . $email . "</p>";
                echo "<hr>";
                echo "</div>";
            }
        }
        ?>
    </form>
</body>
</html>
