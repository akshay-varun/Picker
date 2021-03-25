<?php include('student_register_process.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <link rel="stylesheet" type="text/css" href="style/register.css">
</head>
<body>

<div class="position">
<div class="header">
    <h2>Login</h2>
</div>

<form method="post" action="student_login.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
        <label>Email</label>
        <input type="text" name="s_email" >
    </div>
    <div class="input-group">
        <label>Password</label>
        <input type="password" name="password">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="login_student">Login</button>
    </div>
    <p>
        Not yet a member? <a href="student_register.php">Sign up</a>
    </p>
</form>
</div>
</body>
</html>