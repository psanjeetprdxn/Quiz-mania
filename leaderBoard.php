<?php
function __autoload($classname)
{
    include "classes/$classname.php";
}

/*
***********************
    FOR PAGINATION
***********************
*/

$users = new Users;

$rpp = 10; //records per page
$init = 0; //initial record from database

$count = $users->getUsersCount();
$totalPages = ceil($count / $rpp);
if (isset($_GET['page'])) {
    if ($_GET['page'] <= 0) {
        $page = 1;
        $init = ($page - 1) * 10;
    } elseif ($_GET['page'] > $count) {
        $page = $count;
        $init = ($page - 1) * 10;
    } else {
        $page = $_GET['page'];
        $init = ($page - 1) * 10;
    }
}
/*
***********************
    FOR leadboard
***********************
*/

$leaderBoards =  $users->leaderBoard($init, $rpp);
$quiz = new Quiz;

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>LeaderBoard</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
<div class="container">
<!-- Header -->
<?php include "header.html" ?>

 <!--  FOR LeaderBoard AND pagination -->


<!-- START OF LEADERBOARD TABLE -->
<div class="leaderboard">
<table>
    <tr>
        <th>Name</td>
        <th>Score</th>
        <th>Time (in minute)</th>
    </tr>
<?php
foreach ($leaderBoards as $leaders) {
    echo '<tr>';
    echo '<td>'.$leaders['name'].'</td>';
    echo '<td>'.$leaders['score'].'</td>';
    // echo '<td>'.$leaders['time_taken'].'</td>';
    echo '<td>'.$quiz->inMinute($leaders['time_taken']).'</td>';
    echo '</tr>';
}

?>
</table>
<div> <!--end of div class="leaderboard" -->

<!-- END OF LEADERBOARD TABLE -->

<?php

//Displaying pagination
$count = $users->getUsersCount();
$totalPages = ceil($count / $rpp);
?>
<div class="pagination">
<?php
for ($i = 1; $i <= $totalPages; $i++) {
    echo '<a href="leaderBoard.php?page='.$i.'">'.$i.'</a>';
}
?>
<div>

<div><!--End of container  -->
</body>
</html>
