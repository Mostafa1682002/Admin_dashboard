<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Data Table  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">
    <!-- font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <!-- BootStarp  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css">
    <!-- CSS File  -->
    <?php
    $arr = ['Members', 'Comments', 'Categories', 'Items'];
    if (in_array($pagename, $arr)) { ?>
        <link rel="stylesheet" href="../layout/css/front.css" />
    <?php } else {   ?>
        <link rel="stylesheet" href="layout/css/front.css" />
    <?php }  ?>
    <title><?php echo getTitle() ?></title>
</head>

<body>