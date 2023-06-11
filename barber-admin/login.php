<?php
session_start();


if (isset($_SESSION['username_barbershop_Xw211qAAsq4']) && isset($_SESSION['password_barbershop_Xw211qAAsq4'])) {
	header('Location: index.php');
	exit();
}

$pageTitle = 'Barber Admin Login';
include 'connect.php';
include 'Includes/functions/functions.php';


?>


<!DOCTYPE html>
<html lang="pt">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Área de Administração</title>

	<link href="Design/fonts/css/all.min.css" rel="stylesheet" type="text/css">


	<link
		href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
		rel="stylesheet">


	<link href="Design/css/sb-admin-2.min.css" rel="stylesheet">
	<link href="Design/css/main.css" rel="stylesheet">
</head>

<body>
	<div class="login">
		<form class="login-container validate-form" name="login-form" method="POST" action="login.php"
			onsubmit="return validateLogInForm()">
			<span class="login100-form-title p-b-32">
				Barber Admin Login
			</span>



			<?php

			if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signin-button'])) {
				$username = test_input($_POST['username']);
				$password = test_input($_POST['password']);
				$hashedPass = sha1($password);



				$stmt = $con->prepare("Select admin_id, username,password from admin where username = ? and password = ?");
				$stmt->execute(array($username, $hashedPass));
				$row = $stmt->fetch();
				$count = $stmt->rowCount();



				if ($count > 0) {

					$_SESSION['username_barbershop_Xw211qAAsq4'] = $username;
					$_SESSION['password_barbershop_Xw211qAAsq4'] = $password;
					$_SESSION['admin_id_barbershop_Xw211qAAsq4'] = $row['admin_id'];
					header('Location: index.php');
					die();
				} else {
					?>

					<div class="alert alert-danger">
						<button data-dismiss="alert" class="close close-sm" type="button">
							<span aria-hidden="true">×</span>
						</button>
						<div class="messages">
							<div>Username e/ou password estão incorretas!</div>
						</div>
					</div>

					<?php
				}
			}

			?>



			<div class="form-input">
				<span class="txt1">Username</span>
				<input type="text" name="username" class="form-control"
					oninput="getElementById('required_username').style.display = 'none'" autocomplete="off">
				<span class="invalid-feedback" id="required_username">Username é obrigatório!</span>
			</div>



			<div class="form-input">
				<span class="txt1">Password</span>
				<input type="password" name="password" class="form-control"
					oninput="getElementById('required_password').style.display = 'none'" autocomplete="new-password">
				<span class="invalid-feedback" id="required_password">Passwordé obrigatória!</span>
			</div>



			<p>
				<button type="submit" name="signin-button">Entrar</button>
			</p>




		</form>
	</div>


	<footer class="sticky-footer bg-white">
		<div class="container my-auto">
			<div class="copyright text-center my-auto">
				<span>Copyright &copy; Barbershop Website by Fábio Cabral 2023</span>
			</div>
		</div>
	</footer>

	<script src="Design/js/jquery.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="Design/js/bootstrap.bundle.min.js"></script>
	<script src="Design/js/sb-admin-2.min.js"></script>
	<script src="Design/js/main.js"></script>
</body>

</html>