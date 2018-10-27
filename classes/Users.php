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
    public function register(string $username, string $password, string $email)
    {
        $isSignup = false;
        $attempted = 0;
        $signup_query = "INSERT INTO users(username, email, password, attempted) values(?, ?, ?, ?)";
        $signup = $this->conn->prepare($signup_query);
        $signup->execute([$username, $email, md5($password), $attempted]);
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

}
