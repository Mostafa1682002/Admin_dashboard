<?php
$title = 'Edit Comment';
$pagename = 'Comments';
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
    $comm = $connection->query("SELECT * FROM `comments` WHERE `comment_id`=$id");
    $comm = $comm->fetch(PDO::FETCH_ASSOC);
    $oldcomment = $comm['comment_text'];
} else {
    echo "<div class='container py-5'>
            <div class='alert alert-danger'>Comment Is Not Exist</div>
        </div>";
    header('Refresh:3;url=comments.php');
    exit();
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newcomment = validate($_POST['comment']);
    $Errors = [];

    //validate Username
    if (empty($newcomment)) {
        $Errors['comment_required'] = "Comment Can't Be Empty";
    }
    //Update Comment
    if (empty($Errors)) {
        $connection->query("UPDATE `comments` SET `comment_text`='$newcomment' WHERE `comment_id`=$id");
    }
}


?>
<style>
    textarea {
        height: 300px !important;
        resize: none !important;
    }
</style>
<h1 class="text-center text-secondary mt-4"><?php echo $title ?></h1>
<div class="container">
    <form method="POST" class="formEdit" enctype="multipart/form-data">
        <?php
        if (empty($Errors) && isset($_POST['edite'])) {
            echo "<div class='alert alert-success'>Updated Comment Text</div>";
            //Refresh Page To Update Data
            header("Refresh:3;url=comments.php");
            exit();
        }
        ?>
        <!-- User name Filed -->
        <div class="form-group my-3">
            <label for="comment" class="control-label col-sm-2 col-12">Comment</label>
            <div class="col-sm-9 col-12 input-required">
                <textarea name="comment" id="comment" class="form-control "><?php echo $oldcomment ?></textarea>
            </div>
        </div>
        <?php
        if (isset($Errors['comment_required'])) {
            echo "<div class='alert alert-danger col-sm-9 col-12 ml-auto'>" . $Errors['comment_required'] . "</div>";
        }
        ?>
        <!-- Button Filed -->
        <div class="form-group my-3">
            <label for=""></label>
            <div class="col-offset-2 col-sm-9 col-12">
                <input type="submit" value="Update" name="edite" class="btn btn-primary d-block w-100">
            </div>
        </div>
    </form>
</div>
<?php
include_once('../includes/templates/footer.php');
?>