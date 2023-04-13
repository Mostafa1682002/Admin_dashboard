<?php
$title = 'Add Member';
$pagename = 'Members';
include_once('../session.php');
include_once('../connection.php');
include_once('../includes/functions/functions.php');
include_once('../includes/templates/header.php');
include_once('../includes/templates/navbar.php');

if (isset($_POST['addmember'])) {
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $hashpassword = sha1($password);
    $email = validate($_POST['email']);
    $fullname = ucwords(strtolower(validate($_POST['fullname'])));
    $photo = isset($_FILES['photo']) ? $_FILES['photo']['name'] : '';
    $Errors = [];

    // Validate Form
    // validate Username
    if (empty($username)) {
        $Errors['username_required'] = "Username Can't Be Empty";
    } elseif (strlen($username) < 5) {
        $Errors['username_less'] = "Username Can't Be less Than 5 char";
    } else {
        if (check_unique('users', 'Username', $username) > 0) {
            $Errors['username_exist'] = "$username Already exists,Please Add Anthor Username";
        }
    }



    //validate Email
    if (empty($email)) {
        $Errors['email_required'] = "Email Can't Be Empty";
    }
    //validate Full Name
    if (empty($fullname)) {
        $Errors['fullname_required'] = "Full Name Can't Be Empty";
    } elseif (strlen($fullname) < 5) {
        $Errors['fullname_less'] = "Full Name Can't Be less Than 5 char";
    }
    //Validate Password
    if (empty($password)) {
        $Errors['password_required'] = "Password Can't Be Empty";
    } elseif (strlen($password) < 5) {
        $Errors['password_less'] = "Password Can't Be less Than 5 char";
    }
    //Validate Photo
    if (empty($photo)) {
        $Errors['photo_required'] = "Photo Can't Be Empty";
    } else {
        if (check_unique('users', 'ImgeUser', $photo) > 0) {
            $Errors['photo_exist'] = "$photo Already exists,Please Add Anthor Photo";
        }
    }
    //Check If No Errors Update Profile
    if (empty($Errors)) {
        $from = $_FILES['photo']['tmp_name'];
        $to = "../includes/uploads/images_members/$photo";
        move_uploaded_file($from, $to);
        $connection->query("INSERT INTO `users` ( `UserID`,`Username`, `Email`,`Password` , `FullName`,`Date`,`RegStatus`,`ImgeUser`) VALUES(NULL,'$username','$email','$hashpassword','$fullname',now(),1,'$photo')");
    }
}


?>
<h1 class="text-center text-secondary mt-4">Add New Member</h1>
<div class="container">
    <form method="POST" class="formEdit" enctype="multipart/form-data">
        <?php
        if (empty($Errors) && isset($_POST['addmember'])) {
            echo "<div class='alert alert-success'>Successed Added Member</div>";
            //Refresh Page To Update Data
            header('Refresh:3;url=members.php');
            exit();
        }
        ?>
        <!-- User name Filed -->
        <div class="form-group my-3">
            <label for="username" class="control-label col-sm-2 col-12">Username</label>
            <div class="col-sm-9 col-12 input-required">
                <input type="text" id="username" name="username" class="form-control" value="<?php echo isset($_POST['addmember']) && !empty($Errors) ? $username : ''; ?>" placeholder="Username To Login" autocomplete="off">
            </div>
        </div>
        <?php
        if (isset($Errors['username_required'])) {
            echo "<div class='alert alert-danger col-sm-9 col-12 ml-auto'>" . $Errors['username_required'] . "</div>";
        } elseif (isset($Errors['username_less'])) {
            echo "<div class='alert alert-danger col-sm-9 col-12 ml-auto'>" . $Errors['username_less'] . "</div>";
        } elseif (isset($Errors['username_exist'])) {
            echo "<div class='alert alert-danger col-sm-9 col-12 ml-auto'>" . $Errors['username_exist'] . "</div>";
        }
        ?>
        <!-- Email Filed -->
        <div class="form-group my-3">
            <label for="email" class="control-label col-sm-2 col-12">Email</label>
            <div class="col-sm-9 col-12 input-required">
                <input type="email" id="email" name="email" class="form-control" value="<?php echo isset($_POST['addmember']) && !empty($Errors) ? $email : ''; ?>" placeholder="Email" autocomplete="off">
            </div>
        </div>
        <?php
        if (isset($Errors['email_required'])) {
            echo "<div class='alert alert-danger col-sm-9 col-12 ml-auto'>" . $Errors['email_required'] . "</div>";
        }
        ?>
        <!-- FullName Filed -->
        <div class="form-group my-3">
            <label for="fullname" class="control-label col-sm-2 col-12">Full Name</label>
            <div class="col-sm-9 col-12 input-required">
                <input type="text" id="fullname" name="fullname" class="form-control" value="<?php echo isset($_POST['addmember']) && !empty($Errors) ? $fullname : ''; ?>" placeholder="Full Name " autocomplete="off">
            </div>
        </div>
        <?php
        if (isset($Errors['fullname_required'])) {
            echo "<div class='alert alert-danger col-sm-9 col-12 ml-auto'>" . $Errors['fullname_required'] . "</div>";
        } elseif (isset($Errors['fullname_less'])) {
            echo "<div class='alert alert-danger col-sm-9 col-12 ml-auto'>" . $Errors['fullname_less'] . "</div>";
        }
        ?>
        <!-- Password Filed -->
        <div class="form-group my-3">
            <label for="password" class="control-label col-sm-2 col-12">Password</label>
            <div class="col-sm-9 col-12 input-required">
                <input type="password" id="password" name="password" class="form-control input-pass" value="<?php echo isset($_POST['addmember']) && !empty($Errors) ? $password : ''; ?>" placeholder="Password" autocomplete="new-password">
                <i class="fas fa-eye show-pass"></i>
            </div>
        </div>
        <?php
        if (isset($Errors['password_required'])) {
            echo "<div class='alert alert-danger col-sm-9 col-12 ml-auto'>" . $Errors['password_required'] . "</div>";
        } elseif (isset($Errors['password_less'])) {
            echo "<div class='alert alert-danger col-sm-9 col-12 ml-auto'>" . $Errors['password_less'] . "</div>";
        }
        ?>
        <!-- Photo Filed -->
        <div class="form-group my-3">
            <label for="userPhoto" class="control-label col-sm-2 col-12">Photo </label>
            <div class="col-sm-9 col-12 file input-required">
                <input type="file" name="photo" id="userPhoto" class="form-control input-file" accept="image/*">
                <span class="span-file">Select Photo</span>
            </div>
        </div>
        <?php
        if (isset($Errors['photo_required'])) {
            echo "<div class='alert alert-danger col-sm-9 col-12 ml-auto'>" . $Errors['photo_required'] . "</div>";
        } elseif (isset($Errors['photo_exist'])) {
            echo "<div class='alert alert-danger col-sm-9 col-12 ml-auto'>" . $Errors['photo_exist'] . "</div>";
        }
        ?>
        <img src="" id="photo" class="photo" alt="">
        <!-- Button Filed -->
        <div class="form-group my-3">
            <label for=""></label>
            <div class=" col-sm-9 col-12 ">
                <input type="submit" value="Add Member" name="addmember" class="btn btn-primary d-block w-100">
            </div>
        </div>
    </form>
</div>
<?php
include_once('../includes/templates/footer.php');
?>