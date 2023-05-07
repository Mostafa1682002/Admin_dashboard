<?php
$title = 'Dashboard';
$pagename = 'Home';
include_once('session.php');
include_once('connection.php');
include_once('includes/functions/functions.php');
include_once('includes/templates/header.php');
include_once('includes/templates/navbar.php');

//Latest Users
$latestUsers = 5;
$userLasted = getLatest('*', 'users', 'UserID', $latestUsers);
//Latest Items
$latestItems = 5;
$itemLasted = getLatest('*', 'items', 'item_ID', $latestItems);
//Latest Comments
$latestComments = 5;
$commentLasted = $connection->query("SELECT `comments`.*,`users`.`Username` FROM `comments` INNER JOIN `users` ON `comments`.`user_ID`=`users`.`UserID` LIMIT $latestComments ");
$commentLasted = $commentLasted->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="dashboard">
    <h1 class="text-secondary text-center py-3"><?php echo $title ?></h1>
    <div class="container text-center">
        <div class="row">
            <div class="col col-md-6 col-lg-3 col-12">
                <div class="stat total-members">
                    <p><i class="fas fa-users"></i> Total Members</p>
                    <span><a href="/Admin/Members/members.php" class="text-light text-decoration-none"><?php echo countItems("users") ?></a></span>
                </div>
            </div>
            <div class="col  col-md-6 col-lg-3 col-12">
                <div class="stat  pending-members">
                    <p><i class="fas fa-user-plus"></i> Pendning Members</p>
                    <span><a href="/Admin/Members/members.php?page=pending" class="text-light text-decoration-none"><?php echo countItems("users", "RegStatus", "0") ?></a></span>
                </div>
            </div>
            <div class="col  col-md-6 col-lg-3 col-12">
                <div class="stat  total-items">
                    <p><i class="fas fa-tags"></i> Total Items</p>
                    <span><a href="/Admin/items/items.php" class="text-light text-decoration-none"><?php echo countItems("items") ?></a></span>
                </div>
            </div>
            <div class="col  col-md-6 col-lg-3 col-12 ">
                <div class="stat  total-comments">
                    <p><i class="fas fa-comments"></i> Total Comments</p>
                    <span><a href="/Admin/comments/comments.php" class="text-light text-decoration-none"><?php echo countItems("comments") ?></a></span>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-3">
        <div class="row">
            <div class="col col-12 col-md-6 mb-3">
                <div class="panel">
                    <div class="panel-heading">
                        <i class="fas fa-users"></i> Latest <?php echo $latestUsers ?> Registered Users
                    </div>
                    <div class="panel-body p-0">
                        <ul class="latest-user p-1 m-0">
                            <?php
                            foreach ($userLasted as $user) : ?>
                                <li class="p-1 d-flex align-items-center justify-content-between">
                                    <?php echo $user['Username'] ?>
                                    <div class="btns">
                                        <?php if ($user['RegStatus'] == 0) : ?>
                                            <a href="/Admin/Members/activate.php?id=<?php echo $user['UserID'] . "&username=" . $user['Username'] ?>" class="btn btn-primary btn-sm"><i class="fa-sharp fa-solid fa-check"></i>
                                                Activate</a>
                                        <?php
                                        endif
                                        ?>
                                        <a href="/Admin/Members/editeMember.php?id=<?php echo $user['UserID'] . "&username=" . $user['Username'] ?>" class=" btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i>
                                            Edit</a>
                                    </div>
                                </li>
                            <?php
                            endforeach
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col col-12 col-md-6 mb-3">
                <div class="panel">
                    <div class="panel-heading">
                        <i class="fas fa-tag"></i> Latest <?php echo $latestItems ?> Items
                    </div>
                    <div class="panel-body p-0">
                        <ul class="latest-user p-1 m-0">
                            <?php
                            foreach ($itemLasted as $item) : ?>
                                <li class="p-1 d-flex align-items-center justify-content-between">
                                    <?php echo $item['item_name'] ?>
                                    <div class="btns">
                                        <?php
                                        if ($item['approve'] == 0) : ?>
                                            <a href="/Tranining/Admin/items/approveitem.php?id=<?php echo $item['item_ID'] . "&name=" . $item['item_name'] ?>" class="btn btn-primary btn-sm"><i class="fa-sharp fa-solid fa-check"></i>Approve</a>
                                        <?php
                                        endif
                                        ?>
                                        <a href="/Tranining/Admin/items/edititem.php?id=<?php echo $item['item_ID'] . "&name=" . $item['item_name'] ?>" class=" btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i>
                                            Edit</a>
                                    </div>
                                </li>
                            <?php
                            endforeach
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col col-12 col-md-6 mb-3">
                <div class="panel">
                    <div class="panel-heading">
                        <i class="fas fa-comments"></i> Latest <?php echo $latestComments ?> Comments
                    </div>
                    <div class="panel-body p-0">
                        <?php
                        foreach ($commentLasted as $comment) : ?>
                            <div class="p-2 d-flex box-comment">
                                <p class="usrename m-0 p-0 text-primary"><?php echo $comment['Username'] ?></p>
                                <span class="comment"><?php echo $comment['comment_text'] ?></span>
                            </div>
                        <?php
                        endforeach
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once('includes/templates/footer.php');
?>