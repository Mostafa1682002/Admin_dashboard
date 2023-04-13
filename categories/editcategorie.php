<?php
$title = 'Edit Categoie';
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
    $categorie = $member->fetch(PDO::FETCH_ASSOC);
    $oldname = $categorie['Name_cate'];
    $olddescrip = $categorie['Description'];
    $oldorder = $categorie['ordering'];
    $oldvisib = $categorie['visability'];
    $oldcomment = $categorie['allow_comment'];
    $oldadver = $categorie['allow_ads'];
} else {
    echo "<div class='container py-5'>
            <div class='alert alert-danger'>Member Is Not Exist</div>
        </div>";
    header('Refresh:3;url=members.php');
    exit();
}


if (isset($_POST['editcategories'])) {
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
        if (check_unique('categories', 'Name_cate', $name) > 1) {
            $Errors['name_exist'] = "$name Already exists,Please Add Anthor Name";
        }
    }

    //validate Description
    if (empty($description)) {
        $Errors['description_required'] = "Description Can't Be Empty";
    }

    //Check If No Errors  Add Catrgorie
    if (empty($Errors)) {
        $connection->query("UPDATE categories SET `Name_cate`='$name' , `Description`='$description' , `ordering`=$order,`visability`=$visible,`allow_comment`=$allow_comment,`allow_ads`=$allow_adve WHERE `ID_cate`=$cat_ID");
    }
}

?>

<h1 class="text-center text-secondary mt-4">Edit Categorie</h1>
<div class="container">
    <form method="POST" class="formEdit" enctype="multipart/form-data">
        <?php
        if (empty($Errors) && isset($_POST['editcategories'])) {
            echo "<div class='alert alert-success'>Successed Updated Categorie</div>";
            //Refresh Page To Update Data
            header('Refresh:3;url=categories.php');
            exit();
        }
        ?>
        <!--Name Ctegory Filed -->
        <div class="form-group my-3">
            <label for="name" class="control-label col-sm-2 col-12">Name</label>
            <div class="col-sm-9 col-12 input-required">
                <input type="text" id="name" name="name" class="form-control" value="<?php echo $oldname ?>" placeholder="Name of category">
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
                <input type="text" id="description" name="description" class="form-control" value="<?php echo $olddescrip ?>" placeholder="Description Of Categorie">
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
                <input type="number" min="0" id="order" name="order" class="form-control" value="<?php echo $oldorder ?>" placeholder="Number of Order " autocomplete="off">
            </div>
        </div>
        <!-- Visible Filed -->
        <div class="form-group my-3">
            <label for="order" class="control-label col-sm-3 col-12">Visible</label>
            <div class="col-sm-8 col-12 d-flex align-items-center gap-3">
                <div>
                    <input type="radio" name="visible" id="no" value="0" <?php echo $oldvisib == 0 ? "checked" : '' ?>>
                    <label for="no">No</label>
                </div>
                <div>
                    <input type="radio" name="visible" id="yes" value="1" <?php echo $oldvisib == 1 ? "checked" : '' ?>>
                    <label for="yes">Yes</label>
                </div>
            </div>
        </div>
        <!-- Allow Comment Filed -->
        <div class="form-group my-3">
            <label for="order" class="control-label col-sm-3 col-12">Allow Comment</label>
            <div class="col-sm-8 col-12 d-flex align-items-center gap-3">
                <div>
                    <input type="radio" name="allow_comment" id="no-comm" value="0" <?php echo $oldcomment == 0 ? "checked" : '' ?>>
                    <label for="no-comm">No</label>
                </div>
                <div>
                    <input type="radio" name="allow_comment" id="yes-comm" value="1" <?php echo $oldcomment == 1 ? "checked" : '' ?>>
                    <label for="yes-comm">Yes</label>
                </div>
            </div>
        </div>
        <!-- Allow advertisement Filed -->
        <div class="form-group my-3">
            <label for="order" class="control-label col-sm-3 col-12">ِAllow advertisement</label>
            <div class="col-sm-8 col-12 d-flex align-items-center gap-3">
                <div>
                    <input type="radio" name="allow_adve" id="no-adve" value="0" <?php echo $oldadver == 0 ? "checked" : '' ?>>
                    <label for="no-adve">No</label>
                </div>
                <div>
                    <input type="radio" name="allow_adve" id="yes-adve" value="1" <?php echo $oldadver == 1 ? "checked" : '' ?>>
                    <label for="yes-adve">Yes</label>
                </div>
            </div>
        </div>
        <!-- Button Filed -->
        <div class="form-group my-3">
            <label for=""></label>
            <div class=" col-sm-9 col-12 ">
                <input type="submit" value="Update Categorie" name="editcategories" class="btn btn-primary d-block w-100">
            </div>
        </div>
    </form>
</div>
<?php
include_once('../includes/templates/footer.php');
?>