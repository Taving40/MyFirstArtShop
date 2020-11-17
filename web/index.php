<html>

<form method="post" action="index.php">
    <input type="text" name="studentname">
    <input type="submit" value="click" name="submit"> <!-- assign a name for the button -->
</form>

<?php

$key = rand();

function display()
{
    echo "hello ".$_POST["studentname"];
    echo "\nrand is ";
    echo $key;
}
if(isset($_POST['submit']))
{
   display();
} 
?>

</html>