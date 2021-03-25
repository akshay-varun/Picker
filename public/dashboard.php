<?php
session_start();

if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="style/admin.css">
    <link rel="stylesheet" href="style/common.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fondamento&family=Sigmar+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Enriqueta:wght@500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Enriqueta:wght@500&family=Vollkorn&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
</head>
<body>


<nav class="nav-extended">
    <div class="nav-wrapper">
        <a href="#!" class="brand-logo" style="margin-left: 750px;font-family: 'Fondamento', cursive;font-size: 40px">Hey, <?php echo $_SESSION['name'];?></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="index.php?logout='1'" class="waves-effect waves-teal btn-flat logout " >LOGOUT</a> </li>

        </ul>
    </div>
    <br>
    <div class="nav-content">
        <span class="nav-title " style="margin-left: 450px;font-family: 'Enriqueta', serif;">WE RESPECT, YOU SINCE YOU STRIVE FOR STUDENT WEALTH</span>
        <a class="btn-floating   halfway-fab waves-effect waves-light teal button-size" href="add_task.php">
            <i class="material-icons plus" style="font-size:90px" >+</i>
        </a>
    </div>
</nav>
<br>
<br>
<?php
$db = mysqli_connect('localhost', 'picker_user', 'Aksh!rthmcjjdskm8', 'picker');
$email=$_SESSION['email'];
$user_check = "SELECT * FROM admin WHERE email='$email'";
$result = mysqli_query($db, $user_check);
$user = mysqli_fetch_assoc($result);
$id=$user['id'];


$query="SELECT * FROM teacher_event WHERE id='$id'";
$result1=mysqli_query($db,$query);
$n=mysqli_num_rows($result1);;
echo "<div class=\"main card_size\">";
while($row = $result1->fetch_assoc()){


   echo "<div class=\"flex-container\"> 
   <div class=\"row\">
    <div class=\"col s12 m12\">
      <div class=\"card blue-grey darken-1\">   
        <div class=\"card-content white-text\">
          <span class=\" title\" style='font-family: Vollkorn, serif;'>";echo $row['subject'];
          echo "</span>
          
        <br>
        <p class='code' style='font-family: Roboto, sans-serif;'>";echo "Subject Code: ".$row['code'];echo "</p><br><p class='topic' style='font-family: Roboto, sans-serif;'>"; echo "Topic: ".$row['title'];
            echo "<br>";
            echo "DUE DATE: ".$row['due'];
          echo "
        </div>
       
        <div>
          <a class=\" waves-teal task\">";echo "TASK CODE: ".$row['public_key'];echo "</a>
        
        </div>
           
        <div>
        <div class='submit'>
          <form method='post' action='submission.php'>
        <button class=\"btn waves - effect waves - light\"  name='teach' type=\"submit\" value='$row[public_key]'>SUBMISSION</button>
        </form>
        </div>
        </div>
      </div>
    </div>
  </div>
  </div>
 ";
}
echo "</div>";
?>
<?php
$db = mysqli_connect('localhost', 'picker_user', 'Aksh!rthmcjjdskm8', 'picker');
$email=$_SESSION['email'];
$user_check = "SELECT * FROM admin WHERE email='$email'";
$result = mysqli_query($db, $user_check);
$user = mysqli_fetch_assoc($result);
//$_SESSION['name']=$user['name1'];
?>
</body>
</html>
