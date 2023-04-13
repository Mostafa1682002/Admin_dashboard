<?php
$pagename = 'Categories';
$title = 'Categories';
include_once('../session.php');
include_once('../connection.php');
include_once('../includes/functions/functions.php');
include_once('../includes/templates/header.php');
include_once('../includes/templates/navbar.php');


if (isset($_POST['addCatrgorie'])) {
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $order = $_POST['order'];
    $visible = $_POST['visible'];
    $allow_comment = $_POST['allow_comment'];
    $allow_adve = $_POST['allow_adve'];
    $Errors = [];

    // Validate Form
    // validate Username
    if (empty($name)) {
        $Errors['name_required'] = "Username Can't Be Empty";
    } else {
        if (check_unique('categories', 'Name_cate', $name) > 0) {
            $Errors['name_exist'] = "$name Already exists,Please Add Anthor Name";
        }
    }

    //validate Description
    if (empty($description)) {
        $Errors['description_required'] = "Description Can't Be Empty";
    }

    //Check If No Errors  Add Catrgorie
    if (empty($Errors)) {
        $connection->query("INSERT INTO `categories` ( `ID_cate`,`Name_cate`,`Description` , `ordering`,`visability`,`allow_comment`,`allow_ads`) VALUES(NULL,'$name','$description','$order','$visible','$allow_comment','$allow_adve')");
    }
}


?>

<h1 class="text-center text-secondary mt-4">Add New Categorie</h1>
<div class="container">
    <form method="POST" class="formEdit" enctype="multipart/form-data">
        <?php
        if (empty($Errors) && isset($_POST['addCatrgorie'])) {
            echo "<div class='alert alert-success'>Successed Added Categorie</div>";
            //Refresh Page To Update Data
            header('Refresh:3;url=categories.php');
            exit();
        }
        ?>
        <!--Name Ctegory Filed -->
        <div class="form-group my-3">
            <label for="name" class="control-label col-sm-2 col-12">Name</label>
            <div class="col-sm-9 col-12 input-required">
                <input type="text" id="name" name="name" class="form-control" value="<?php echo isset($_POST['addCatrgorie']) && !empty($Errors) ? $name : ''; ?>" placeholder="Name of category" autocomplete="off">
            </div>
        </div>
        <?php
        if (isset($Errors['name_required'])) {
            echo "<div class='alert alert-danger col-sm-9 col-12 ml-auto'>" . $Errors['name_required'] . "</div>";
        } elseif (isset($Errors['name_exist'])) {
            echo "<div class='alert alert-danger col-sm-9 col-12 ml-auto'>" . $Errors['name_exist'] . "</div>";
        }
        ?>
        <!-- Description Filed -->
        <div class="form-group my-3">
            <label for="description" class="control-label col-sm-2 col-12">Description</label>
            <div class="col-sm-9 col-12 input-required">
                <input type="text" id="description" name="description" class="form-control" value="<?php echo isset($_POST['addCatrgorie']) && !empty($description) ? $description : ''; ?>" placeholder="Description Of Categorie" autocomplete="off">
            </div>
        </div>
        <?php
        if (isset($Errors['description_required'])) {
            echo "<div class='alert alert-danger col-sm-9 col-12 ml-auto'>" . $Errors['description_required'] . "</div>";
        }
        ?>
        <!-- Order Filed -->
        <div class="form-group my-3">
            <label for="order" class="control-label col-sm-2 col-12">Order</label>
            <div class="col-sm-9 col-12">
                <input type="number" min="0" id="order" name="order" class="form-control" value="<?php echo isset($_POST['addCatrgorie']) && !empty($Errors) ? $order : ''; ?>" placeholder="Number of Order " autocomplete="off">
            </div>
        </div>
        <!-- Visible Filed -->
        <div class="form-group my-3">
            <label for="order" class="control-label col-sm-3 col-12">Visible</label>
            <div class="col-sm-8 col-12 d-flex align-items-center gap-3">
                <div>
                    <input type="radio" name="visible" id="no" value="0" checked>
                    <label for="no">No</label>
                </div>
                <div>
                    <input type="radio" name="visible" id="yes" value="1">
                    <label for="yes">Yes</label>
                </div>
            </div>
        </div>
        <!-- Allow Comment Filed -->
        <div class="form-group my-3">
            <label for="order" class="control-label col-sm-3 col-12">Allow Comment</label>
            <div class="col-sm-8 col-12 d-flex align-items-center gap-3">
                <div>
                    <input type="radio" name="allow_comment" id="no-comm" value="0" checked>
                    <label for="no-comm">No</label>
                </div>
                <div>
                    <input type="radio" name="allow_comment" id="yes-comm" value="1">
                    <label for="yes-comm">Yes</label>
                </div>
            </div>
        </div>
        <!-- Allow advertisement Filed -->
        <div class="form-group my-3">
            <label for="order" class="control-label col-sm-3 col-12">ِAllow advertisement</label>
            <div class="col-sm-8 col-12 d-flex align-items-center gap-3">
                <div>
                    <input type="radio" name="allow_adve" id="no-adve" value="0" checked>
                    <label for="no-adve">No</label>
                </div>
                <div>
                    <input type="radio" name="allow_adve" id="yes-adve" value="1">
                    <label for="yes-adve">Yes</label>
                </div>
            </div>
        </div>
        <!-- Button Filed -->
        <div class="form-group my-3">
            <label for=""></label>
            <div class=" col-sm-9 col-12 ">
                <input type="submit" value="Add Categorie" name="addCatrgorie" class="btn btn-primary d-block w-100">
            </div>
        </div>
    </form>
</div>
<?php
include_once('../../includes/templates/footer.php');
?>