<?php

function __autoload($classname)
{
    include "classes/$classname.php";
}

/*
****************************************
    CHECKS IF USER IS PLAYABLE
****************************************
*/

$playable = new Users;
if (!$playable->isPlayable()) {
    header ("Location: home.php?msg=noMoreAttempt");
    return;
}

/*
****************************************
    QUESTIONS DISPLAYS
****************************************
*/
$quiz = new Quiz;
$questions = $quiz->getQuestions();

    ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Quiz</title>
        <link rel="stylesheet" href="css/quiz.css">
    </head>
    <body onload="timeout()">

        <div class="wrapper">
          <h1>Quiz Mania</h1>
          <div id="count-down" class="count-down"></div>
          <form class="" id="auto-submit" action="answer.php" method="post">
            <?php foreach ($questions as $question) { ?>
            <div class="question">
                <table>
                    <tr>
                        <th colspan="4"><?php echo $question['question']; ?></th>
                    </tr>
                    <tr>
                        <?php if (isset($question['ans1'])) {?>
                        <td>
                            <input type="radio" name="<?php echo $question['quiz_id']; ?>" value="0"><?php echo $question['ans1']; ?>
                        </td>
                        <?php } ?>
                        <?php if (isset($question['ans2'])) {?>
                        <td>
                            <input type="radio" name="<?php echo $question['quiz_id']; ?>" value="1"><?php echo $question['ans2']; ?>
                        </td>
                        <?php } ?>
                        <?php if (isset($question['ans3'])) {?>
                        <td>
                            <input type="radio" name="<?php echo $question['quiz_id']; ?>" value="2"><?php echo $question['ans3']; ?>
                        </td>
                        <?php } ?>
                        <?php if (isset($question['ans4'])) {?>
                        <td>
                            <input type="radio" name="<?php echo $question['quiz_id']; ?>" value="3"><?php echo $question['ans4']; ?>
                        </td>
                        <?php } ?>
                        <td>
                            <input type="radio" name="<?php echo $question['quiz_id']; ?>" value="4" checked=checked style="display:none">
                        </td>
                    </tr>
                </table>
            </div>
        <?php } ?>
            <input type="hidden" id="time" value="" name="time">
            <input type="submit" value="Done" onchange="getResult()">
          </form>
        </div><!--End of wrapper-->



        <script src="js/timer.js"></script>
    </body>
</html>
