<?php
$title = "Login";
$pagename = "Login";
session_start();
include_once('includes/functions/functions.php');
include_once('connection.php');
//Check If User Is Login Befor
if (isset($_SESSION['user_name'])) {
    header('Location: dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashpassword = sha1($password);
    $Error = [];

    if (empty($username)) {
        $Error['username_required'] = 'Username Is Required';
    }
    if (empty($password)) {
        $Error['password_required'] = 'Password Is Required';
    }

    //If Not Error 
    if (empty($Error)) {
        //Check If User Is Exist
        $statement = $connection->query("select * from users WHERE Username='$username' AND Password='$hashpassword' AND admin=1;");
        $count = $statement->rowCount();
        if ($count) {
            $_SESSION['user_name'] = $username;
            $admin = $statement->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user_id'] = $admin['UserID'];
            header('Location: dashboard.php');
            exit();
        } else {
            $Error['wrong_login'] = 'Password Or Username Is Wrong';
        }
    }
}


?>





<?php
include_once('includes/templates/header.php');
?>
<div class="container-fluid  p-3 d-flex justify-content-center align-items-center content-loginPage">
    <div class="container p-3 ">
        <?php
        if (!empty($Error)) {
            foreach ($Error as $err) {
                echo "<div class='alert alert-danger'>" . $err . "</div>";
            }
        }
        ?>
        <h1 class="text-center text-danger">Admin Login</h1>
        <form action="" method="post" class="loginForm">

            <div class="input-required">
                <input type="text" name="username" class="form-control my-3" placeholder="Username">
            </div>
            <div class="input-required">
                <input type="password" id="password" name="password" class="form-control  my-3 input-pass" placeholder="Password">
                <i class="fas fa-eye show-pass"></i>
            </div>
            <input type="submit" value="Login" class="btn btn-primary d-block w-100">
        </form>
    </div>
</div>
<?php
include_once('includes/templates/footer.php');
?>