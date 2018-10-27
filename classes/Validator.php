<?php

class Validator extends Connection {
    protected $conn;

    public function __construct()
    {
        $dbConnection = new Connection();
        $this->conn = $dbConnection->connect();
    }

    /*
    ****************************************
       CHECKS IF USERNAME IS EMPTY OR NOT
    ****************************************
    */
    public function validateUsername($username)
    {
        $isValid = false;
        //$escapedValue = mysqli_real_escape_string($this->conn, $value);
        if (!empty($username)) {
            $isValid = true;
        }
    return $isValid;
    }

    /*
    ****************************************
       CHECKS IF PASSWORD IS EMPTY OR NOT
    ****************************************
    */
    public function validatePassword($password)
    {
        $isValid = false;
        //$escapedValue = mysqli_real_escape_string($this->conn, $value);
        if (!empty($password)) {
            $isValid = true;
        }
        return $isValid;
    }

    /*
    ****************************************
         CHECKS IF NAME IS EMPTY OR NOT
    ****************************************
    */
    public function validateName($name)
    {
        $isValid = false;
        $string = preg_replace('/[^a-z]/i', '', $name);
        //$escapedValue = mysqli_real_escape_string($this->conn, $string);
        if (!empty($name)) {
            $isValid = true;
        }
        return $isValid;
    }

    /*
    ***********************************************
       CHECKS IF EMAIL IS (EMPTY & VALID) OR NOT
    ***********************************************
    */
    public function validateEmail($email)
    {
        $isValid = false;
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $isValid = true;
        }
        return $isValid;
    }

    /*
    ****************************************
      CHECKS IF EMAIL EXISTS IN DATABASE
    ****************************************
    */
    public function isEmailExists(string $email)
    {
        $isEmailExists = false;
        $emailQuery = "SELECT email FROM users WHERE email = ?";
        $fetchEmail = $this->conn->prepare($emailQuery);
        $fetchEmail->execute([$email]);
        if ($fetchEmail->rowCount() > 0) {
            $isEmailExists = true;
        }
        return $isEmailExists;
    }

    /*
    *****************************************
      CHECKS IF USERNAME EXISTS IN DATABASE
    *****************************************
    */
    public function isUsernameExists(string $username)
    {
        $isUsernameExists = false;
        $usernameQuery = "SELECT username FROM users WHERE username = ?";
        $fetchUsername = $this->conn->prepare($usernameQuery);
        $fetchUsername->execute([$username]);
        if ($fetchUsername->rowCount() > 0) {
            $isUsernameExists = true;
        }
        return $isUsernameExists;
    }
}
