<?php
require '../modules/db_connect.php';
require '../modules/functions.php';

$db_connect = new \src\modules\db_connect('localhost', 'spisok_del', 'Admin', '123');
$addList = new \src\modules\functions($db_connect->db_con(), 1);
$ELN = $addList->listForUPD($_GET['EditListNum']);

if($_POST['list'] && $_POST['date']){
    $addList->listUpdate($_GET['EditListNum'], $_POST['list'], $_POST['date']);
    header("Location: http://testbd");
}


?>
<html>
<header>
</header>
<body>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <input type="text" value="<?php print $ELN[2]; ?>" name="list">
    <input type="date" value="<?php print $ELN[3]; ?>" name="date">
    <input type="submit" value="Update">
</form>

</body>
</html>