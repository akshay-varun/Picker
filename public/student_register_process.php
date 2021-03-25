<?php
session_start();

// initializing variables
$s_name = "";
$s_usn="";
$s_email="";
$email    = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'picker_user', 'Aksh!rthmcjjdskm8', 'picker');

// REGISTER USER
if (isset($_POST['reg_stud'])) {
    // receive all input values from the form
    $s_name = mysqli_real_escape_string($db, $_POST['s_name']);
    $s_usn = mysqli_real_escape_string($db, $_POST['s_usn']);
    $s_email = mysqli_real_escape_string($db, $_POST['s_email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($s_name)) { array_push($errors, "Name is required"); }
    if (empty($s_usn)) { array_push($errors, "USN is required"); }
    if (empty($s_email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }


    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM student_register WHERE s_email='$s_email' LIMIT 1";

    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['s_email'] === $s_email) {
            array_push($errors, "email already exists");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database

        $query = "INSERT INTO student_register(s_name,s_usn, s_email, password) VALUES('$s_name','$s_usn','$s_email','$password')";

        mysqli_query($db, $query);
        $_SESSION['s_email'] = $s_email;
        $_SESSION['s_name']=$s_name;
        $_SESSION['success'] = "You are now logged in";
        header('location: student_dashboard.php');
    }
}

if (isset($_POST['login_student'])) {
    $s_email = mysqli_real_escape_string($db, $_POST['s_email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($s_email)) {
        array_push($errors, "EMAIL is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM student_register WHERE s_email='$s_email' AND password='$password'";
        $results = mysqli_query($db, $query);
        $res=mysqli_fetch_assoc($results);

        if (mysqli_num_rows($results) == 1) {
            $_SESSION['s_email'] = $s_email;
            $_SESSION['s_name'] = $res['s_name'];
            $_SESSION['success'] = "You are now logged in";
            header('location: student_dashboard.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}

?>

