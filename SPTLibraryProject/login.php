<?php
session_start();
 
require_once('openDB.php');
 
//if user is logged in redirect to myaccount page
if (isset($_SESSION['position'])) {
    header('Location: home.php');
}
 
$error_message = '';
if (isset($_POST['submit'])) {
 
    extract($_POST);
 
    if (!empty($username) && !empty($password)) {
        $sql = "SELECT position, name FROM staff WHERE username = '".$conn->real_escape_string($username)."' AND password = '".$conn->real_escape_string($password)."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if($row['name']) {
                $_SESSION['position'] = $row['position'];
				$_SESSION['name'] = $row['name'];
                header('Location: home.php');
            } else {
                $error_message = 'Your account is not active yet.';
            }
        } else {
            $error_message = 'Incorrect username or password.';
        }
    }
}
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Login Form</title>
		<style>
			@import url('https://fonts.googleapis.com/css?family=Roboto:400,700');
			body {
				font-family: "Roboto",sans-serif !important;
				margin: 0;
				background-color: #E82200;
				color: #404F48;
			}
			.container {
				padding: 20px;
			}
			.row {
				max-width: 480px;
				margin: auto;
				padding: 30px;
				box-sizing: border-box;
				background-color: #E8D5D2;
			}
			h3 {
				margin-top: 0;
				text-align: center;
				font-size: 36px;
			}
			.form-group {
				margin: 15px 0;
			}
			label {
				display: block;
			}
			.btn {
				display: block;
				font-size: 20px;
				background-color: #404F48;
				border: 2px solid #404F48;
				padding: 10px 30px;
				transition: 300ms all;
				outline: none;
				width: 50%;
				margin: auto;
				text-align: center;
				color: #E8D5D2;
			}
			.btn:hover {
				background-color: transparent;
				color: #404F48;
			}
			.form-control {
				width: 100%;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-sizing: border-box;
			}
		</style>
	</head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>Login</h3>
                    <?php if(!empty($error_message)) { ?>
                        <div class="alert alert-danger"><?php echo $error_message; ?></div>
                    <?php } ?>
                    <form method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                        </div>
                        <button type="submit" name="submit" class="btn">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>