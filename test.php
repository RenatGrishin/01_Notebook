<html>
<header>
</header>
<body>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

    Which buildings do you want access to?<br />
    <input type="checkbox" name="formDoor[]" value="A" />Acorn Building<br />
    <input type="checkbox" name="formDoor[]" value="B" />Brown Hall<br />
    <input type="checkbox" name="formDoor[]" value="C" />Carnegie Complex<br />
    <input type="checkbox" name="formDoor[]" value="D" />Drake Commons<br />
    <input type="checkbox" name="formDoor[]" value="E" />Elliot House

    <input type="submit" name="formSubmit" value="Submit" />

</form>

<?php
$aDoor = $_POST['formDoor'];
if(empty($aDoor))
{
    echo("Вы не выбрали ни одного здания.");
}
else
{
    $N = count($aDoor);

    echo("Вы выбрали $N здание(й): ");
    for($i=0; $i < $N; $i++)
    {
        echo($aDoor[$i] . " ");
    }
}
?>
</body>
</html>
