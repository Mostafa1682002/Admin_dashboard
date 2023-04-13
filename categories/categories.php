<?php
$title = 'Manage Categories';
$pagename = 'Categories';
include_once('../session.php');
include_once('../connection.php');
include_once('../includes/functions/functions.php');
include_once('../includes/templates/header.php');
include_once('../includes/templates/navbar.php');


$sort = '';
$array_sort = array('ASC', 'DESC');
if (isset($_GET['sort']) && in_array($_GET['sort'], $array_sort)) {
    // $sort = $_GET['sort'];
    $sort = "ORDER BY `ordering`" . $_GET['sort'];
} else {
    $sort = "ORDER BY `ordering` DESC";
}

// WHERE GroupID=0 $qur
$allCategories = $connection->query("SELECT * FROM `categories` $sort");
$allCategories = $allCategories->fetchAll(PDO::FETCH_ASSOC);

?>

<h1 class="text-center text-secondary my-4"><?php echo $title ?></h1>
<div class="px-2 py-3 container">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4 class="text-secondary m-0">Manage Categories</h4>
            <div class="ordering">
                <span class="h6">Ordering :</span>
                <?php foreach ($array_sort as $ele) : ?>
                    <a href="categories.php?sort=<?php echo $ele ?>" class="<?php echo isset($_GET['sort']) && $ele == $_GET['sort'] ? 'active' : '' ?>"><?php echo $ele ?></a>
                <?php endforeach ?>
            </div>
        </div>
        <div class=" card-body">
            <?php foreach ($allCategories as $category) : ?>
                <div class="box-category">
                    <h5 class="name-cate"><?php echo $category['Name_cate']; ?></h5>
                    <div class="allow">
                        <p class="description"><?php echo $category['Description'] ?></p>
                        <?php if ($category['visability'] == 0) : ?>
                            <span class='hidden'>Hidden</span>
                        <?php endif ?>
                        <?php if ($category['allow_comment'] == 0) : ?>
                            <span class='comment'>Comment Disabeld</span>
                        <?php endif ?>
                        <?php if ($category['allow_ads'] == 0) : ?>
                            <span class='advert'> Advertisement Disabeld</span>
                        <?php endif ?>
                    </div>
                    <div class="btns">
                        <a href="editcategorie.php?id=<?php echo $category['ID_cate'] . "&name_cat=" . $category['Name_cate'] ?>" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i>
                            Edit</a>
                        <a href=" deletecategorie.php?id=<?php echo $category['ID_cate'] . "&name_cat=" . $category['Name_cate'] ?>" class="btn btn-danger  btn-sm confirm"><i class="fa-sharp fa-solid fa-trash"></i>
                            Delete</a>
                    </div>
                </div>
                <hr>
            <?php endforeach; ?>
        </div>
    </div>
    <a href="addcategorie.php" class="btn btn-primary my-4 btn-sm"><i class="fa-solid fa-plus"></i> Add New
        Categorie</a>
</div>
<?php
include_once('../includes/templates/footer.php');
?>