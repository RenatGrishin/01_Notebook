<?php
session_start();
require 'src/modules/db_connect.php';
require 'src/modules/functions.php';

$db_connect = new \src\modules\db_connect('localhost', 'spisok_del', 'Admin', '123');
$addList = new \src\modules\functions($db_connect->db_con(), $_SESSION['userID']);

?>
<html>
<header>
</header>
<body>
<?php
if($_POST['user_name'] && $_POST['user_password']){
    $logIn = $addList->LogIn($_POST['user_name'], $_POST['user_password']);
}

if(!$_SESSION['userID']){
    ?>
    <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
        <input type="text" name="user_name">
        <input type="password" name="user_password">
        <input type="submit" value="LogIn">
    </form><br>
    <a href="src/pages/Registration.php">Registration</a>
<?php

}else{
    print "Вы вошли как: ". $_SESSION['fio'] . " - <a href='src/pages/ExitLog.php'>Exit</a>";
?>

<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <input type="text" name="list">
    <input type="date" name="date">
    <input type="submit" value="Add List">
</form>

<?php
if($_POST['DeleteList']){
    $addList->deleteList($_POST['DeleteList']);
}
?>

<?php
    if($_POST['list'] OR $_POST['date']){
        if(!$_POST['list']){
            print "<p>Поле с заданием пустое</p>";
        }
        if(!$_POST['date']){
            print "<p>Поле с датой пустое</p>";
        }
        if($_POST['list'] && $_POST['date']){
            $addList->addList($_POST['list'], $_POST['date']);
        }
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
<?php
}
    ?>