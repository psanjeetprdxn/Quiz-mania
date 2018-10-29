<?php

class Quiz extends Connection
{
    protected $conn;

    public function __construct()
    {
        $connection = new Connection;
        $this->conn = $connection->connect();
    }

    /*
    ****************************************************************************************
         RETURNS QUESTIONS IN MULTIDIMENSIONAL ARRAY (QUIZ_ID, QUESTIONS, OPTIONS, ETC)
    ****************************************************************************************
    */
    public function getQuestions()
    {
        $questions = array();
        $questionQuery = "SELECT * FROM quiz order by FLOOR(RAND() * (7-1)+1) limit 0,7";
        $question = $this->conn->prepare($questionQuery);
        $question->execute();
        $questions = $question->fetchAll();
        return $questions;
    }

    /*
    ***************************************************************
         CHECKS USERS ANSWERS AND VERIFY IT FROM ACTUAL ANSWER
    ***************************************************************
    */
    public function result ($answer)
    {
        $score = 0;
        foreach ($answer as $quiz_id=>$ans) {
            $sql = "SELECT ans FROM quiz where quiz_id = ?";
            $sysAns = $this->conn->prepare($sql);
            $sysAns->execute([$quiz_id]);
            $row = $sysAns->fetch();
            if($row['ans'] == $ans) {
                $score++;
            }
        }
        return $score;
    }

    /*
    ***************************************
        CONVERT SECONDS TO m:s FORMAT
    ***************************************
    */
    public function inMinute (int $seconds)
    {
      $minute = floor($seconds / 60);
      $second = $seconds % 60;
      return $minute.":". $second;
    }

}
