<?php
$title = 'Add Item';
$pagename = 'Items';
include_once('../session.php');
include_once('../connection.php');
include_once('../includes/functions/functions.php');
include_once('../includes/templates/header.php');
include_once('../includes/templates/navbar.php');

$allStatus = array('Select Status', 'New', 'Like New', 'Used', 'Very Old');
$allMembers = getAllData('users');
$allCategories = getAllData('categories');

if (isset($_POST['additem'])) {
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $price = validate($_POST['price']);
    $country = validate($_POST['country']);
    $status = validate($_POST['status']);
    $imge = isset($_FILES['photo']) ? $_FILES['photo']['name'] : '';
    $member = validate($_POST['member']);
    $categorie = validate($_POST['categorie']);
    $Errors = [];

    // Validate Form
    // validate Name
    if (empty($name)) {
        $Errors['name_required'] = "Name Can't Be Empty";
    } else {
        if (check_unique('items', 'item_name', $name) > 0) {
            $Errors['name_exist'] = "$name Already exists,Please Add Anthor item";
        }
    }

    //validate Email
    if (empty($description)) {
        $Errors['description_required'] = "Description Can't Be Empty";
    }
    //validate Price
    if (empty($price)) {
        $Errors['price_required'] = "Price Can't Be Empty";
    }
    //validate Country
    if (empty($country)) {
        $Errors['country_required'] = "Country Can't Be Empty";
    }
    //validate Status
    if ($status == 0) {
        $Errors['status_required'] = "Status Can't Be Empty";
    }
    //validate Member
    if ($member == 0) {
        $Errors['member_required'] = "Member Can't Be Empty";
    }
    //validate Status
    if ($categorie == 0) {
        $Errors['categorie_required'] = "Categorie Can't Be Empty";
    }

    //Validate Photo
    if (empty($imge)) {
        $Errors['image_required'] = "Photo Can't Be Empty";
    } else {
        if (check_unique('items', 'item_image', $imge) > 0) {
            $Errors['image_exist'] = "$imge Already exists,Please Add Anthor Photo";
        }
    }
    //Check If No Errors Update Profile
    if (empty($Errors)) {
        $from = $_FILES['photo']['tmp_name'];
        $to = "../includes/uploads/imges_items/$imge";
        move_uploaded_file($from, $to);
        $connection->query("INSERT INTO `items` (`item_ID`, `item_name`, `item_description`,`item_price` , `item_date`,`item_countryMade`,`item_image`,`item_status`,`user_ID`,`cate_ID`)VALUES(NULL,'$name','$description','$price',now(),'$country','$imge','$status',$member,$categorie)");
    }
}


?>
<h1 class="text-center text-secondary mt-4">Add New Item</h1>
<div class="container">
    <form method="POST" class="formEdit" enctype="multipart/form-data">
        <?php
        if (empty($Errors) && isset($_POST['additem'])) {
            echo "<div class='alert alert-success'>Successed Added Item</div>";
            //Refresh Page To Update Data
            header('Refresh:3;url=items.php');
            exit();
        }
        ?>
        <!--name Filed -->
        <div class="form-group my-3">
            <label for="name" class="control-label col-sm-2 col-12">Name</label>
            <div class="col-sm-9 col-12 input-required">
                <input type="text" id="name" name="name" class="form-control" value="<?php echo isset($_POST['additem']) && !empty($Errors) ? $name : ''; ?>" placeholder="Name Of Item" autocomplete="off">
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
                <input type="text" id="description" name="description" class="form-control" value="<?php echo isset($_POST['additem']) && !empty($Errors) ? $description : ''; ?>" placeholder="Description Of Item" autocomplete="off">
            </div>
        </div>
        <?php
        if (isset($Errors['description_required'])) {
            echo "<div class='alert alert-danger col-sm-9 col-12 ml-auto'>" . $Errors['description_required'] . "</div>";
        }
        ?>
        <!-- Price Filed -->
        <div class="form-group my-3">
            <label for="price" class="control-label col-sm-2 col-12">Price</label>
            <div class="col-sm-9 col-12 input-required">
                <input type="text" id="price" name="price" class="form-control" value="<?php echo isset($_POST['additem']) && !empty($Errors) ? $price : ''; ?>" placeholder="Price Of Item in Egyptian Pounds" autocomplete="off">
            </div>
        </div>
        <?php
        if (isset($Errors['price_required'])) {
            echo "<div class='alert alert-danger col-sm-9 col-12 ml-auto'>" . $Errors['price_required'] . "</div>";
        }
        ?>
        <!-- Country Filed -->
        <div class="form-group my-3">
            <label for="country" class="control-label col-sm-2 col-12">Country</label>
            <div class="col-sm-9 col-12 input-required">
                <input type="text" id="country" name="country" class="form-control" value="<?php echo isset($_POST['additem']) && !empty($Errors) ? $country : ''; ?>" placeholder="Country Of Made" autocomplete="off">
            </div>
        </div>
        <?php
        if (isset($Errors['country_required'])) {
            echo "<div class='alert alert-danger col-sm-9 col-12 ml-auto'>" . $Errors['country_required'] . "</div>";
        }
        ?>
        <!-- Status Filed -->
        <div class="form-group my-3">
            <label for="status" class="control-label col-sm-2 col-12">Status</label>
            <div class="col-sm-9 col-12 ">
                <select name="status" id="status" class="form-select">
                    <?php foreach ($allStatus as $index => $statu) : ?>
                        <option value="<?php echo $index ?>" <?php echo isset($_POST['additem']) && !empty($Errors)  ? check_Selected_Box($index, $status) : ''; ?>>
                            <?php echo $statu ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <?php
        if (isset($Errors['status_required'])) {
            echo "<div class='alert alert-danger col-sm-9 col-12 ml-auto'>" . $Errors['status_required'] . "</div>";
        }
        ?>
        <!-- Member Filed -->
        <div class="form-group my-3">
            <label for="member" class="control-label col-sm-2 col-12">Member</label>
            <div class="col-sm-9 col-12 ">
                <select name="member" id="member" class="form-select">
                    <option value="0">Select Member</option>
                    <?php foreach ($allMembers as $Member) : ?>
                        <option value="<?php echo $Member['UserID'] ?>" <?php echo isset($_POST['additem']) && !empty($Errors)  ? check_Selected_Box($Member['UserID'], $member) : ''; ?>>
                            <?php echo $Member['Username'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <?php
        if (isset($Errors['member_required'])) {
            echo "<div class='alert alert-danger col-sm-9 col-12 ml-auto'>" . $Errors['member_required'] . "</div>";
        }
        ?>
        <!-- Categoire Filed -->
        <div class="form-group my-3">
            <label for="categorie" class="control-label col-sm-2 col-12">Categorie</label>
            <div class="col-sm-9 col-12 ">
                <select name="categorie" id="categorie" class="form-select">
                    <option value="0">Select Categorie</option>
                    <?php foreach ($allCategories as $cate) : ?>
                        <option value="<?php echo $cate['ID_cate'] ?>" <?php echo isset($_POST['additem']) && !empty($Errors)  ? check_Selected_Box($cate['ID_cate'], $categorie) : ''; ?>>
                            <?php echo $cate['Name_cate'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <?php
        if (isset($Errors['categorie_required'])) {
            echo "<div class='alert alert-danger col-sm-9 col-12 ml-auto'>" . $Errors['categorie_required'] . "</div>";
        }
        ?>
        <!-- Image Filed -->
        <div class="form-group my-3">
            <label for="userPhoto" class="control-label col-sm-2 col-12">Image</label>
            <div class="col-sm-9 col-12 file input-required">
                <input type="file" name="photo" id="userPhoto" class="form-control input-file" accept="image/*">
                <span class="span-file">Select Image</span>
            </div>
        </div>
        <?php
        if (isset($Errors['image_required'])) {
            echo "<div class='alert alert-danger col-sm-9 col-12 ml-auto'>" . $Errors['image_required'] . "</div>";
        } elseif (isset($Errors['image_exist'])) {
            echo "<div class='alert alert-danger col-sm-9 col-12 ml-auto'>" . $Errors['image_exist'] . "</div>";
        }
        ?>
        <img src="" id="photo" class="photo" alt="">
        <!-- Button Filed -->
        <div class="form-group my-3">
            <label for=""></label>
            <div class=" col-sm-9 col-12 ">
                <input type="submit" value="Add Item" name="additem" class="btn btn-primary d-block w-100">
            </div>
        </div>
    </form>
</div>
<?php
include_once('../includes/templates/footer.php');
?>