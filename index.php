<?php
require 'src/modules/db_connect.php';
require 'src/modules/functions.php';

$db_connect = new \src\modules\db_connect('localhost', 'spisok_del', 'Admin', '123');

$addList = new \src\modules\functions($db_connect->db_con(), 1);


?>
<html>
<header>
</header>
<body>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <input type="text" name="list">
    <input type="date" name="date">
    <input type="submit" value="Add List">
</form>

<?php
if($_POST['DeleteList']){
    $addList->deleteList($_POST['DeleteList']);
}if($_POST['action'] == 'Edit'){
    print 111;
}

?>

<?php
    if($_POST['list'] && $_POST['date']){
        $addList->addList($_POST['list'], $_POST['date']);
    }
?>
<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
    <?php
    $addList->viewList();
    ?>
    <input type="submit" name="delete" value="Delete">
</form>
</body>
</html>
