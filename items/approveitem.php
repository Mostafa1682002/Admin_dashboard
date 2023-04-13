<?php
$title  = 'Approve Item';
include_once('../session.php');
include_once('../connection.php');
include_once('../includes/functions/functions.php');
include_once('../includes/templates/header.php');
include_once('../includes/templates/navbar.php');

if (isset($_GET['id']) && isset($_GET['name'])) {
    $itemID = $_GET['id'];
    $itemname = $_GET['name'];
} else {
    header('Location: items.php');
    exit();
}
if (user_exist("items", "item_id", $itemID, "item_name", $itemname)) {
    $connection->query("UPDATE `items` SET `approve`=1  WHERE `item_ID`=$id AND `item_name`='$itemname'");
    echo   "<div class='container py-5'>
                <div class='alert alert-success'>Successed Approve Item Name : $itemname</div>
            </div>";
    header('Refresh:3;url=items.php');
    exit();
} else {
    echo "<div class='container py-5'>
                <div class='alert alert-danger'>Item Is Not Exist</div>
        </div>";
    header('Refresh:3;url=items.php');
    exit();
}

?>
<?php
include_once('../includes/templates/footer.php');
?>