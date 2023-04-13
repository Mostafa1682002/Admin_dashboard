<?php
$title  = 'Approve Comment';
include_once('../session.php');
include_once('../connection.php');
include_once('../includes/functions/functions.php');
include_once('../includes/templates/header.php');
include_once('../includes/templates/navbar.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('Location: comments.php');
    exit();
}
if (countItems('comments', 'comment_id', $id) == 1) {
    $connection->query("UPDATE `comments` SET `comment_status`=1  WHERE `comment_id`=$id ");
    echo   "<div class='container py-5'>
                <div class='alert alert-success'>Successed Approve Comment</div>
            </div>";
    header('Refresh:3;url=comments.php');
    exit();
} else {
    echo "<div class='container py-5'>
                <div class='alert alert-danger'>Comment Is Not Exist</div>
        </div>";
    header('Refresh:3;url=comments.php');
    exit();
}

?>
<?php
include_once('../includes/templates/footer.php');
?>