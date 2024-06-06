<?php
namespace photos;
use mysqli;

class DB {
    static $host = "localhost";
    static $user = "root";
    static $password = "";
    static $database = 'photo'; // Corrected database name

    public $link; 

    public function __construct() {
        $this->link = new mysqli(DB::$host, DB::$user, DB::$password, DB::$database);
        $this->link->set_charset("utf8");
    }

    public function get_all_photos() {
        $sql_result = $this->link->query("SELECT * FROM `photos` ORDER BY `ID` DESC");
        if($sql_result->num_rows){
            return $sql_result->fetch_all(MYSQLI_ASSOC);
        } 
        return [];
    }

    public function get_user_photos($uid) {
        $sql_result = $this->link->query("SELECT * FROM `photos` WHERE `UID` = $uid ORDER BY `ID` DESC");
        if($sql_result->num_rows){
            return $sql_result->fetch_all(MYSQLI_ASSOC);
        } 
        return [];
    }

    public function check_user($login, $password){
        $sql_result = $this->link->query("SELECT * FROM `user` WHERE `E-mail` = '$login' AND `Password` = '$password'");
        if($sql_result->num_rows){
            $user = $sql_result->fetch_assoc();
            return $user["ID"];
        }
        return false;
    }

    public function check_login($login){
        $sql_result = $this->link->query("SELECT * FROM `user` WHERE `E-mail` = '$login'");
        if($sql_result->num_rows){
            return true;
        }
        return false;
    }

    public function new_user($login, $password){
        $this->link->query("INSERT INTO `user` (`Name`, `Password`, `E-mail`) VALUES ('', '$password', '$login')");
    }

    public function new_photo($uid, $image, $text){
        $this->link->query("INSERT INTO `photos` (`UID`, `Imag`, `Text`, `Tags`) VALUES ('$uid', '$image', '$text', '')");
    }

    public function get_photos_by_id($photo_id) {
        $sql_result = $this->link->query("SELECT p.*, u.Name FROM `photos` p LEFT JOIN `user` u ON u.ID = p.UID WHERE p.ID = '$photo_id'");
        if($sql_result->num_rows){
            return $sql_result->fetch_all(MYSQLI_ASSOC);
        } 
        return false;
    }

    public function get_photos_comments($photo_id) {
        $sql_result = $this->link->query("SELECT c.*, u.Name FROM `comments` c LEFT JOIN `user` u ON u.ID = c.UID WHERE c.PID = '$photo_id' ORDER BY c.ID DESC");
        if($sql_result->num_rows){
            return $sql_result->fetch_all(MYSQLI_ASSOC);
        } 
        return [];
    }

    public function new_comment($uid, $pid, $text) {
        $stmt = $this->link->prepare("INSERT INTO `comments` (`UID`, `PID`, `Text`, `PoS_date`) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iis", $uid, $pid, $text);
        $stmt->execute();
        $last_id = $stmt->insert_id;
        $stmt->close();

        $sql_result = $this->link->query("SELECT c.*, u.Name FROM `comments` c LEFT JOIN `user` u ON u.ID = c.UID WHERE c.ID = '$last_id'");
        if($sql_result->num_rows){
            return $sql_result->fetch_assoc();
        } 
        return false;
    }
}
?>
