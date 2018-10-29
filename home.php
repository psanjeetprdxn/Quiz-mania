<?php
session_start();
if(isset($_SESSION['user_id'])){
    function __autoload($classname)
    {
        include "classes/$classname.php";
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>HOME</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="wrapper">
            <!--INCLUDING HEADER-->
            <?php include "header.html" ?>
            <form action="show_question.php">
                <input type="submit" value="Start Quiz" >
                <label for="msg">
                <?php
                    if (isset($_GET['msg'])) {
                        if ($_GET['msg'] == 'noMoreAttempt') {
                            echo "No more attempt";
                        }
                        if ($_GET['msg'] == 'scoreNotUpdated') {
                            echo "No more attempt";
                        }
                    }
                ?>
                </label>
                <label for="score">
                <?php
                    if (isset($_GET['score']) && isset($_GET['time'])) {
                        $quiz = new Quiz;
                        echo 'Score: '.$_GET['score'].'<br>';
                        //echo 'Time: '.$user->inMinute($_GET['time']).' Seconds';
                        echo 'Time: '.$quiz->inMinute($_GET['time']).' Minutes';
                    }
                ?>
                </label>
            </form>
        </div>

    </body>
</html>




<?php
}else{
  header("Location: index.php?error=notLogin");
}

?>
