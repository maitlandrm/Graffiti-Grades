<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "utf-8"/>
	<link rel = "stylesheet" type = "text/css" href = "/access/css/style.css">
	<title>Registration</title>
</head>
<body>
	<div id = "wrapper">
		<h2 class = "login">Login & Registration</h2>
		<form action = "/sessions/create" method = "post">
			<?="<p class = 'red'>" . $this->session->flashdata('login_errors') . "</p>";?>
			<fieldset>
				<legend>Log In</legend>
				<label>Email: </label>
				<input type = "email" name = "email"/>
				<label>Password</label>
				<input type = "password" name = "password" />
				<input class = "submit" type = "submit" value = "Login" />
			</fieldset>	
		</form>
		<form action = "/users/create" method = "post">
			<?="<p class = 'red'>" . $this->session->flashdata('errors') . "</p>";?>
			<fieldset>
				<legend>Register</legend>
				<label>First Name: </label>
				<input type = "text" name = "first_name" />
				<label>Last Name: </label>
				<input type = "text" name = "last_name" />
				<label>Email Address: </label>
				<input type = "email" name = "email" />
				<label>Alias: </label>
				<input type = "text" name = "alias" />
				<label>Password: </label>
				<input type = "password" name ="password" />
				<label>Confirm Password: </label>
				<input type = "password" name ="confirm_password" />
				<input class = "submit" type = "submit" name = "Register" />
			</fieldset>
		</form>
	</div>
</body>
</html>