<?php
$title = 'Manage Comments';
$pagename = 'Comments';
include_once('../session.php');
include_once('../connection.php');
include_once('../includes/functions/functions.php');
include_once('../includes/templates/header.php');
include_once('../includes/templates/navbar.php');

$allComments = $connection->query("SELECT `comments`.*,`users`.`Username`,`items`.`item_name` FROM `comments`
                                    INNER JOIN `users` ON `comments`.`user_ID`=`users`.`UserID`
                                    INNER JOIN `items` ON `comments`.`item_id`=`items`.`item_ID`");
$allComments = $allComments->fetchAll(PDO::FETCH_ASSOC);

?>

<h1 class="text-center text-secondary my-4"><?php echo $title ?></h1>
<div class="px-2 py-3 container">
    <div class="table-responsive pb-4">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr class="bg-dark text-light row-table">
                    <th>#ID</th>
                    <th>Comments</th>
                    <th>Username</th>
                    <th>Item Name</th>
                    <th>Added Date</th>
                    <th>Control</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allComments as $comment) : ?>
                    <tr class='row-table'>
                        <td><?php echo $comment['comment_id'] ?></td>
                        <td><?php echo $comment['comment_text'] ?></td>
                        <td><?php echo $comment['Username'] ?></td>
                        <td><?php echo $comment['item_name'] ?></td>
                        <td><?php echo $comment['comment_date'] ?></td>
                        <td>
                            <?php
                            if ($comment['comment_status'] == 0) : ?>
                                <a href="approvecomment.php?id=<?php echo $comment['comment_id']  ?>" class="btn btn-primary btn-sm"><i class="fa-sharp fa-solid fa-check"></i>
                                    Approve</a>
                            <?php
                            endif
                            ?>
                            <a href="editcomment.php?id=<?php echo $comment['comment_id']  ?>" class=" btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            <a href="deletecomment.php?id=<?php echo $comment['comment_id']  ?>" class="btn btn-danger btn-sm confirm"><i class="fa-sharp fa-solid fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?php
include_once('../includes/templates/footer.php');
?>