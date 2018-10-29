<?php
function __autoload($classname)
{
    include "classes/$classname.php";
}

$total_time = 420;
$answers = $_POST;
$quiz = new Quiz;

$score = $quiz->result($answers);
$time = $total_time - $_POST['time'];

//ADDS SCORE AND TIME FOR REGISTERED USERS
$update = new Users;
if ($update->score($score, $time)) {
    header("Location:home.php?score=$score&time=$time");
    return;
} else {
    header("Location:home.php?msg=scoreNotUpdated");
}
?>
