<?php

//Get Title
function getTitle()
{
    global $title;
    if (isset($title) && !empty($title)) {
        return $title;
    } else {
        return 'E-commerce';
    }
}

//Set Active 
function setActive($name)
{
    global $pagename;
    if (isset($pagename) && $pagename == $name) {
        return "active";
    }
    return false;
}

//Remove Html And Hack
function validate($input)
{
    $input = trim($input);
    $input = htmlspecialchars($input);
    $input = stripslashes($input);
    return $input;
}

// Check User In Database
function user_exist($table, $column1, $input1, $column2, $input2)
{
    global $connection;
    global $member;
    $member = $connection->query("SELECT * FROM `$table` WHERE `$column1`=$input1 AND `$column2`='$input2'");
    if ($member->rowCount() > 0) {
        return true;
    }
    return false;
}

//Check Unique Column;
function check_unique($table, $column, $input)
{
    global $Errors;
    global $connection;
    $input_result = $connection->query("SELECT * from `$table` WHERE `$column`='$input'");
    $input_count = $input_result->rowCount();
    if ($input_count > 0) {
        return $input_count;
    }
    return false;
}

//Count Items From Tables
function countItems($table, $coloumn = '', $value = '')
{
    global $connection;
    $con = '';
    if (!empty($coloumn) && $value != '') {
        $con = "WHERE `$coloumn`=$value";
    }
    $items = $connection->query("SELECT * FROM `$table` $con");
    return $items->rowCount();
}


//Get Latest From Table
function getLatest($selected, $table, $orderCol, $limit = 5)
{
    global $connection;
    $items = $connection->query("SELECT $selected FROM `$table` ORDER BY `$orderCol` DESC LIMIT $limit");
    $items = $items->fetchAll(PDO::FETCH_ASSOC);
    return $items;
}

//Get All Data
function getAllData($table, $order = '', $coloumn = '', $value = '')
{
    global $connection;
    $con = '';
    if ($order != '') {
        $con = "ORDER BY `$order`";
    }
    if (!empty($coloumn) && $value != '') {
        $con = "WHERE `$coloumn`=$value";
    }
    $items = $connection->query("SELECT * FROM `$table` $con ");
    $items = $items->fetchAll(PDO::FETCH_ASSOC);
    return $items;
}

//Check Select  Box
function check_Selected_Box($value1, $value2)
{
    if ($value1 == $value2) {
        return "$value2 selected";
    }
    return false;
}
