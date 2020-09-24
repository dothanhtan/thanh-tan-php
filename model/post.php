<?php
class Post{
    var $postID;
    var $title;
    var $content;
    var $description;
    var $userID;

    function Post($title, $content, $description, $userID, $postID)
    {
        $this->title = $title;
        $this->content = $content;
        $this->description = $description;
        $this->userID = $userID;
        $this->postID = $postID;
    }
    static function connectToDB(){
        $conn = new mysqli("localhost:8080","root","","do-thanh-tan");
        
        if($conn->connect_error)
            die("Kết nối thất bại. Chi tiết:" . $conn->connect_error);
        $conn->set_charset("utf8"); 
        return $conn;
    }
    static function getPost($userID = null) {
        $con = Post::connectToDB();
        $sql = "SELECT * FROM posts";
        if($userID != null) {
            $sql = "SELECT * FROM posts WHERE UserID = $userID";
        }
        $result = $con->query($sql);
        $arrPost = [];
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $post = new Post($row["ID"], $row["Title"], $row["Content"], $row["Description"], $row["UserID"]);
                array_push($arrPost, $post);
            }
        }
        $con->close();
        return $arrPost;
    }

}
?>