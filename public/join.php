<html>
<head>
    <title>Join</title>
    <link rel="stylesheet" href="style/join.css">
</head>
<body>
<div class="login-box">
    <h2>Join Task</h2>
    <form method="post" action="join.php">
        <div class="user-box">
            <input type="text" name="code" required="">
            <label>Task Code</label>
        </div>
        <a href="#">
            <div class="input-group join">
                <button type="submit" class="btn" name="join">Join</button>
            </div>
        </a>

    </form>
</div>

<?php
session_start();
$db = mysqli_connect('localhost', 'picker_user', 'Aksh!rthmcjjdskm8', 'picker');

// REGISTER USER
if (isset($_POST['join'])) {
    // receive all input values from the form
    $code = mysqli_real_escape_string($db, $_POST['code']);
    $email= $_SESSION['s_email'];
    $get_id = "SELECT * FROM student_register WHERE s_email='$email' LIMIT 1";
    $got = mysqli_query($db, $get_id);
    $got_id = mysqli_fetch_assoc($got);
    $id=$got_id['reg_no'];
    echo "Hey";
    $user_check_query = "SELECT * FROM teacher_event WHERE code='$code' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $task_code = mysqli_fetch_assoc($result);
    $flag=0;

    if ($task_code) { // if user exists
        if ($task_code['code'] === $code) {
           $flag=1;
        }
    }
    if($flag==0)
    {
        echo "WRONG CODE";
    }
    $query = "INSERT INTO student_event (reg_no,code)
  			  VALUES('$id','$code')";
    mysqli_query($db, $query);
    header('location: student_dashboard.php');
}
    ?>
</body>
</html>