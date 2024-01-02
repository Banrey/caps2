<?php
class ChatUser{

    private $user_id;
    private $user_name;
    private $user_email;
    private $user_password;
    private $user_profile;
    private $user_status;
    private $user_created_on;
    private $user_verification_code;
    private $user_login_status;
    public $conn;

    public function __construct(){
        require_once('connect.php');

        $database_obj = new connect;

        $this->connect = $database_obj->connect();
        
    }
    function setUserID($user_id){
        $this->user_id = $user_id;
    }
    function getUserID($user_id){
        return $this->user_id;
    }
    function setUserName($user_name){
        $this->user_name = $user_name;
    }
    function getUserName($user_name){
        return $this->user_name;
    }
    function setUserEmail($user_email){
        $this->user_email = $user_email;
    }
    function getUserEmail($user_email){
        return $this->user_email;
    }
    function setUserPass($user_password){
        $this->user_password = $user_password;
    }
    function getUserPass($user_password){
        return $this->user_password;
    }
    function setUserProfile($user_profile){
        $this->user_profile = $user_profile;
    }
    function getUserProfile($user_profile){
        return $this->user_profile;
    }
    function setUserStatus($user_status){
        $this->user_status = $user_status;
    }
    function getUserStatus($user_status){
        return $this->user_status;
    }
    function setUserCreatedOn($user_created_on){
        $this->user_created_on = $user_created_on;
    }
    function getUserCreatedOn($user_created_on){
        return $this->user_created_on;
    }
    function setUserVerificationCode($user_verification_code){
        $this->user_verification_code = $user_verification_code;
    }
    function getUserVerificationCode($user_verification_code){
        return $this->user_verification_code;
    }
    function setUserLoginStatus($user_login_status){
        $this->user_login_status = $user_login_status;
    }
    function getUserLoginStatus($user_login_status){
        return $this->user_login_status;
    }

    function make_avatar($character){
        $path = "images/".time().".png";
        $image = imageCreate(200,200);
        $red = rand(0,255);
        $green = rand(0,255);
        $blue = rand(0,255);
        imagecolorallocate($image, $red, $green, $blue);
        $textcolor = imagecolorallocate($image, 255, 255, 255);
        $font = dirname(__FILE__) . '/font/arial.tff';

        imagettftext($image, 100, 0, 55, 150, $textcolor, $font, $character);
        imagepng($image, $path);
        imagedestroy($image);
        return $path;

    }

    function get_user_data_by_email(){
        $query= "
        SELECT * FROM tblchatusers 
        WHERE user_email = :user_email
        ";

        $statement = $this->connect->prepare($query);
        $statement->bindParam(':user_email', $this->user_email);
        if ($statement->execute()) {
            $user_data = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $user_data;
    }
    function save_data() {
        $query = "
        INSERT INTO tblusers (user_name, user_email, user_password, user_profile, user_status, user_created_on, user_verification_code)
        VALUES(:user_name, :user_email, :user_password, :user_profile, :user_status, :user_created_on, :user_verification_code)
        ";
        $statement = $this->connect->prepare($query);
        $statement->bindParam(':user_name', $this->user_name);
        $statement->bindParam(':user_email', $this->user_email);
        $statement->bindParam(':user_password', $this->user_password);
        $statement->bindParam(':user_profile', $this->user_profile);
        $statement->bindParam(':user_status', $this->user_status);
        $statement->bindParam(':user_created_on', $this->user_created_on);
        $statement->bindParam(':user_verification_code', $this->user_verification_code);
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
}

?>