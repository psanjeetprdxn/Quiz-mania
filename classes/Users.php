<?php

session_start();

class Users extends Connection
{
    protected $conn;

    public function __construct()
    {
        $connection = new Connection();
        $this->conn = $connection->connect();
    }

    /*
    ****************************************
          REGISTRATION FOR NEW USERS
    ****************************************
    */
    public function register(string $name, string $username, string $email, string $password)
    {
        $isSignup = false;
        $signup_query = "INSERT INTO users(name, username, email, password) values(?, ?, ?, ?)";
        $signup = $this->conn->prepare($signup_query);
        $signup->execute([$name,  $username, $email, md5($password)]);
        if ($signup) {
            $isSignup = true;
        }
        return $isSignup;
    }

    /*
    ****************************************
          LOGIN FOR REGISTERED USERS
    ****************************************
    */
    public function login(string $username, string $password)
    {
        $login_query = "SELECT user_id, username, password FROM users WHERE username = ? AND password = ?";
        $login = $this->conn->prepare($login_query);
        $login->execute([$username, md5($password)]);
        if ($login->rowCount() > 0) {
            $row = $login->fetch();
            $_SESSION['user_id'] = $row['user_id'];
            header("Location:../home.php");
        } else {
            header("Location:../index.php?loginResult=wrong");
        }
    }

    /*
    ****************************************
         ADDING SCORE FOR REGISTER USERS
    ****************************************
    */
    public function score(int $score, int $time)
    {
        $updated = false;
        $attempted = 1;
        $addScoreQuery = "UPDATE users SET score = ? , time_taken = ?, attempted = ? WHERE user_id = ?";
        $addScore = $this->conn->prepare($addScoreQuery);
        $addScore->execute([$score, $time, $attempted, $_SESSION['user_id']]);
        if($addScore){
            $updated = true;
        }
        return $updated;
    }

    /*
    ****************************************
         CHECKS IF USER ALREADY PLAYED
    ****************************************
    */
    public function isPlayable()
    {
        $playable = false;
        $sql = "SELECT attempted FROM users where user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$_SESSION['user_id']]);
        $row = $stmt->fetch();
        if ($row['attempted'] == 0) {
            $playable = true;
        }
        return $playable;
    }

    /*
    ****************************************
        RETURNS TOTAL NUMBER OF USERS
    ****************************************
    */
    public function getUsersCount()
    {
        $usersCount = $this->conn->prepare('SELECT count(*) FROM users');
        $usersCount->execute();
        $count = $usersCount->fetch();
        return $count[0];
    }

    /*
    ******************************************************************************
         RETURNS MULTIDIMENSIONAL ARRAY OF SCORES OF ALL THE REGISTERED USERS
    ******************************************************************************
    */
    public function leaderBoard($init, $rpp)
    {
        $leaderBoards = array();
        $sql = "SELECT * FROM users where score is not null ORDER BY score DESC, time_taken ASC LIMIT ?, ?";
        $leaderBoard = $this->conn->prepare($sql);
        $leaderBoard->execute([$init, $rpp]);
        if ($leaderBoard) {
            $leaderBoards = $leaderBoard->fetchAll();
        }
        return $leaderBoards;
    }

}
