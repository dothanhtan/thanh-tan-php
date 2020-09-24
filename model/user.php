<?php
class User{
    var $userID;
    var $userName;
    var $email;
    var $passWord;

    function User($userName, $email, $passWord, $userID)
    {
        $this->userName = $userName;
        $this->passWord = $passWord;
        $this->email = $email;
        $this->userID = $userID;
    }
    static function connectToDB(){
        $conn = new mysqli("localhost:8080","root","","do-thanh-tan");
        
        if($conn->connect_error)
            die("Kết nối thất bại. Chi tiết:" . $conn->connect_error);
        $conn->set_charset("utf8"); 
        return $conn;
    }
    static function authentication($userName , $passWord){
        $conn = User::connectToDB();
        $sql = "SELECT * FROM users WHERE UserName = '$userName' and PassWord = '$passWord' ";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result -> fetch_assoc()){
               return new User($row["UserID"], $row["UserName"],$row["Email"],$row["Password"]);
            }
           
        }
        $conn->close();
        return null;
        
    }

    static function getUserByID($id) {
        $con = User::connectToDB();
        $sql = "SELECT * FROM users WHERE UserID = $id";
        $result = $con->query($sql);
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $user = new User($row["UserID"], $row["UserName"],$row["Email"],$row["Password"]);
                $con->close();
                return $user;
            }
        }
        $con->close();
    }
}
?>