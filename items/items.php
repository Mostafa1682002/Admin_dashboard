<?php
$title = 'Manage Items';
$pagename = 'Items';
include_once('../session.php');
include_once('../connection.php');
include_once('../includes/functions/functions.php');
include_once('../includes/templates/header.php');
include_once('../includes/templates/navbar.php');

$allitems = $connection->query("SELECT items.*,categories.Name_cate,users.Username FROM `items` INNER JOIN categories ON items.cate_ID=categories.ID_cate INNER JOIN users ON items.user_ID=users.UserID;");
$allitems = $allitems->fetchAll(PDO::FETCH_ASSOC);

?>
<h1 class="text-center text-secondary my-4"><?php echo $title ?></h1>
<div class="px-2 py-3 container">
    <div class="table-responsive pb-4">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr class="bg-dark text-light row-table">
                    <th>#ID</th>
                    <th>Item Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Add Date</th>
                    <th>Country</th>
                    <th>Image</th>
                    <th>Categorie</th>
                    <th>Username</th>
                    <th>Control</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allitems as $item) : ?>
                    <tr class='row-table'>
                        <td><?php echo $item['item_ID'] ?></td>
                        <td><?php echo $item['item_name'] ?></td>
                        <td><?php echo $item['item_description'] ?></td>
                        <td><?php echo $item['item_price'] ?></td>
                        <td><?php echo $item['item_date'] ?></td>
                        <td><?php echo $item['item_countryMade'] ?></td>
                        <td>
                            <img src="../includes/uploads/imges_items/<?php echo $item['item_image'] ?>" alt="" class="img-table">
                        </td>
                        <td><?php echo $item['Name_cate'] ?></td>
                        <td><?php echo $item['Username'] ?></td>
                        <td>
                            <?php
                            if ($item['approve'] == 0) : ?>
                                <a href="approveitem.php?id=<?php echo $item['item_ID'] . "&name=" . $item['item_name'] ?>" class="btn btn-primary btn-sm"><i class="fa-sharp fa-solid fa-check"></i>Approve</a>
                            <?php
                            endif
                            ?>
                            <a href="edititem.php?id=<?php echo $item['item_ID'] . "&name=" . $item['item_name'] ?>" class=" btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            <a href="deleteitem.php?id=<?php echo $item['item_ID'] . "&name=" . $item['item_name'] . "&imge=" . $item['item_image'] ?>" class="btn btn-danger btn-sm confirm"><i class="fa-sharp fa-solid fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <a href="additem.php" class="btn btn-primary my-4 btn-sm"><i class="fa-solid fa-plus"></i> New Item</a>
</div>
<?php
include_once('../includes/templates/footer.php');
?>