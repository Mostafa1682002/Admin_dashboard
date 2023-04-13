<?php
$title  = 'Delete Categorie';
$pagename = 'Categories';
include_once('../session.php');
include_once('../connection.php');
include_once('../includes/functions/functions.php');
include_once('../includes/templates/header.php');
include_once('../includes/templates/navbar.php');
if (isset($_GET['id']) && isset($_GET['name_cat'])) {
    $cat_ID = $_GET['id'];
    $name_cat = $_GET['name_cat'];
} else {
    header('Location: categories.php');
    exit();
}

if (user_exist("categories", "ID_cate", $cat_ID, "Name_cate", $name_cat)) {
    $connection->query("DELETE FROM `categories` WHERE `ID_cate`=$cat_ID AND `Name_cate`='$name_cat'");
    echo   "<div class='container py-5'>
                <div class='alert alert-success'>Successed Deleted Categorie Name : $name_cat</div>
            </div>";
    header('Refresh:3;url=categories.php');
    exit();
} else {
    echo "<div class='container py-5'>
                <div class='alert alert-danger'>Categprie Is Not Exist</div>
        </div>";
    header('Refresh:3;url=categories.php');
    exit();
}

?>
<?php
include_once('../includes/templates/footer.php');
?>