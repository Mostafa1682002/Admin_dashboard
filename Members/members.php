<?php
$title = 'Manage Member';
$pagename = 'Members';
include_once('../session.php');
include_once('../connection.php');
include_once('../includes/functions/functions.php');
include_once('../includes/templates/header.php');
include_once('../includes/templates/navbar.php');
if (isset($_GET['page']) && $_GET['page'] == 'pending') {
    $qur = "WHERE `RegStatus`=0";
} else {
    $qur = "";
}
$allMembers = $connection->query("SELECT * FROM `users` $qur");
$allMembers = $allMembers->fetchAll(PDO::FETCH_ASSOC);

?>
<h1 class="text-center text-secondary my-4"><?php echo $title ?></h1>
<div class="px-2 py-3 container">
    <div class="table-responsive pb-4">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr class="bg-dark text-light row-table">
                    <th>#ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Full Name</th>
                    <th>ِAdmin</th>
                    <th>Register Date</th>
                    <th>Image</th>
                    <th>Control</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allMembers as $member) : ?>
                    <tr class='row-table'>
                        <td><?php echo $member['UserID'] ?></td>
                        <td><?php echo $member['Username'] ?></td>
                        <td><?php echo $member['Email'] ?></td>
                        <td><?php echo $member['FullName'] ?></td>
                        <td><?php echo $member['admin'] == 1 ? "YES" : "NO"; ?></td>
                        <td><?php echo $member['Date'] ?></td>
                        <td>
                            <img src="../includes/uploads/images_members/<?php echo $member['ImgeUser'] ?>" alt="" class="img-table">
                        </td>
                        <td>
                            <?php
                            if ($member['RegStatus'] == 0) : ?>
                                <a href="activate.php?id=<?php echo $member['UserID'] . "&username=" . $member['Username'] ?>" class="btn btn-primary btn-sm"><i class="fa-sharp fa-solid fa-check"></i>
                                    Activate</a>
                            <?php
                            endif
                            ?>
                            <a href="editeMember.php?id=<?php echo $member['UserID'] . "&username=" . $member['Username'] ?>" class=" btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            <a href="deleteMember.php?id=<?php echo $member['UserID'] . "&username=" . $member['Username'] . "&imge=" . $member['ImgeUser'] ?>" class="btn btn-danger btn-sm confirm"><i class="fa-sharp fa-solid fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <a href="addMember.php" class="btn btn-primary my-4 btn-sm"><i class="fa-solid fa-plus"></i> New Member</a>
</div>
<?php
include_once('../includes/templates/footer.php');
?>