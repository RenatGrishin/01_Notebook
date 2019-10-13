<?php
require '../modules/db_connect.php';
require '../modules/functions.php';

$db_connect = new \src\modules\db_connect('localhost', 'spisok_del', 'Admin', '123');
$addList = new \src\modules\functions($db_connect->db_con());

?>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <input type="text" name="user_login">
    <input type="password" name="user_password">
    <input type="text" name="user_fio">
    <input type="submit" value="Registration">
</form>
<?php
if($_POST['user_login'] OR $_POST['user_password'] OR $_POST['user_fio']){
    if(!$_POST['user_login']){
        print "Поле с логином пустое";
    }if(!$_POST['user_password']){
        print "Поле с паролем пустое";
    }if(!$_POST['user_fio']){
        print "Поле Ф.И.О. не заполнено";
    }else{
        $regUser = $addList->RegistrationUser($_POST['user_login'], $_POST['user_password'], $_POST['user_fio']);
    }
}