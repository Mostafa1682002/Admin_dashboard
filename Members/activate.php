<?php
$title  = 'Activate Member';
include_once('../session.php');
include_once('../connection.php');
include_once('../includes/functions/functions.php');
include_once('../includes/templates/header.php');
include_once('../includes/templates/navbar.php');
if (isset($_GET['id']) && isset($_GET['username'])) {
    $id = $_GET['id'];
    $membername = $_GET['username'];
} else {
    header('Location: members.php');
    exit();
}

if (user_exist("users", "UserID", $id, "Username", $membername)) {
    $connection->query("UPDATE `users` SET `RegStatus`=1  WHERE `UserID`=$id AND `Username`='$membername'");
    echo   "<div class='container py-5'>
                <div class='alert alert-success'>Successed Activate Member Name : $membername</div>
            </div>";
    header('Refresh:3;url=members.php');
    exit();
} else {
    echo "<div class='container py-5'>
                <div class='alert alert-danger'>Member Is Not Exist</div>
        </div>";
    header('Refresh:3;url=members.php');
    exit();
}

?>
<?php
include_once('../includes/templates/footer.php');
?>