<?php


namespace src\modules;


use http\Header;

class functions
{
    private $db_con;
    private $userID;
    private $works;
    private $last_data;
    private $delListArray;
    private $strDelList;
    private $listID;
    private $listUpdateWork;
    private $listUpdateDate;
    private $user_login;
    private $user_pass;
    private $fio;

    public function __construct($db_con, $userID='false')
    {
        $this->db_con = $db_con;
        $this->userID = $userID;
    }

    //add task
    public function addList($works, $last_data)
    {
        $db_con = $this->db_con;
        $userID = $this->userID;
        $works = $this->works = $works;
        $last_data = $this->last_data = $last_data;

        $dbAddList = $db_con->prepare("INSERT INTO dela (user_id, works, last_date) VALUES (?, ?, ?)");
        $dbAddList->execute([$userID, $works, $last_data]);
        print "<b>Добавлено:</b> ". $works .' '. $last_data;
    }

    //show task
    public function viewList(){
        $db_con = $this->db_con;
        $userID = $this->userID;

        $viewList = $db_con->query("SELECT * FROM dela WHERE user_id=". $userID);
        while($row = $viewList->fetch()){
            print '<input type="checkbox" name="DeleteList[]" value="'. $row['id'] .'">'. $row['works'] .' - ('. $row['last_date'] .') <a href="/src/pages/EditList.php?EditListNum='. $row['id'] .'">Edit</a><br>';
        }
    }

    //Delete task
    public function deleteList($delListArray){
        $db_con = $this->db_con;
        $strDelList = $this->strDelList;
        $this->delListArray = $delListArray;

        $couArray = count($delListArray);
        for($i=0; $i<$couArray; $i++){
            $strDelList = $strDelList. ','. $delListArray[$i];
        }
        $strDelList = substr($strDelList, 1);

        $db_con->query("DELETE FROM dela WHERE id IN (". $strDelList .")");
    }

    //Show a specific task for the page EditList.php
    public function listForUPD($listID){
        $db_con = $this->db_con;
        $this->listID = $listID;

        $listFUPD = $db_con->query("SELECT * FROM dela WHERE id=". $listID);
        while($row = $listFUPD->fetch()){
            return [$row['id'], $row['user_id'], $row['works'], $row['last_date']];
        }
    }

    //Update task
    public function listUpdate($listID, $updateWork, $updateDate){
    $db_con = $this->db_con;
    $this->listID = $listID;
    $this->listUpdateWork = $updateWork;
    $this->listUpdateDate = $updateDate;

    $db_con->query("UPDATE `dela` SET `works` = '". $updateWork ."', `last_date` = '". $updateDate ."' WHERE `dela`.`id` = ". $listID);
    }

    //Login panel
    public function LogIn($login, $password){
        $db_con = $this->db_con;
        $this->user_login = $login;
        $this->user_pass = $password;

        $selUser = $db_con->query("SELECT * FROM `user` WHERE `login`='". $login ."' AND `pass`='". $password ."'");
        while($row = $selUser->fetch()){
            if($row['id']){
                $_SESSION['userID'] = $row['id'];
                $_SESSION['fio'] = $row['fio'];
            }
        }
    }

    //Registration
    public function RegistrationUser($login, $password, $fio){
        $db_con = $this->db_con;
        $this->user_login = $login;
        $this->user_pass = $password;
        $this->fio = $fio;

        $selUser = $db_con->query("SELECT * FROM `user` WHERE `login`='". $login ."'");
        while($row = $selUser->fetch()){
            $userExists = $row['id'];
        }
        if(!$userExists){
            $addUser = $db_con->prepare("INSERT INTO `user` (fio, login, pass) VALUES (?, ?, ?)");
            $addUser->execute([$fio, $login, $password]);
            print "<br>Вы зарегестрировались. <a href='http://testbd/'>LogIn</a>";
        }else{
            print "Пользователь с таким логином существует";
        }

    }
}