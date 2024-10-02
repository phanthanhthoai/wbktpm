<?php
session_start();
// $baseUrl = '../';
require_once('../../database/Database.php');
require_once('../../utils/App.php');
require_once('../../database/dbhelper.php');
require_once('../../database/config.php');
// require_once('../../utils/utility.php');
class Login extends App
{
    function __construct()
    {
        parent::__construct();
    }
    public function checkEmail()
    {
        $email = $_POST['email'];
        $userExist = executeResult("select * from user where email='$email'", true);
        if ($userExist == null) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
    public function checkPassword()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashed_password = md5(md5($password) . PRIVATE_KEY);
        $userExist = executeResult("select * from user where email='$email' and password='$hashed_password'", true);
        if ($userExist != null) {
            echo json_encode(0);
        } else {
            echo json_encode(1);
        }
    }
    public function logIn()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql_exist = "SELECT * FROM user WHERE email = '$email'";
        $userExist = executeResult($sql_exist, true);

        if ($userExist) {
            $hashed_password = md5(md5($password) . PRIVATE_KEY);

            // $token = getSecurityMD5($userExist[0]['email'] . time());
            $token = md5(md5($userExist[0]['email'] . time()) . PRIVATE_KEY);

            setcookie('token', $token, time() + 7 * 24 * 60 * 60, '/');
            $created_at = date('Y-m-d H:i:s');

            $_SESSION['user'] = $userExist;

            $userID = $userExist[0]['id'];
            $_SESSION['user'] = $userExist;
            // Phân quyền
            $result = executeResult("SELECT * FROM user WHERE email='$email' AND password = '$hashed_password' AND is_active=1", true);

            if (!$result) {
                // $error = mysqli_error($con);
                echo json_encode(0);
            } else {
                // $user1 =  executeResult("SELECT * FROM user WHERE email='$email' AND password = '$hashed_password' AND is_active=1", true);
                $user1 = Database::getInstance()->execute("SELECT * FROM user WHERE email='$email' AND password = '$hashed_password' AND is_active=1");
                $user = $user1->fetch_assoc();
                $userPrivileges = executeResult("SELECT * FROM `user_role` 
                INNER JOIN `role_con` ON user_role.role_con_id=role_con.id 
                INNER JOIN `user` ON user.role_id=user_role.role_id 
                where user.id='" . $user['id'] . "'");
                // echo "console.log($userPrivileges)";
                if (!empty($userPrivileges)) {
                    $user['privileges'] = array();
                    foreach ($userPrivileges as $privilege) {
                        $user['privileges'][] = $privilege['url_match'];
                    }
                }
                $usercheckrole = $user;
                $_SESSION['current_user'] = $user;
                $_SESSION['user'] = $user;
                // $user = getUserToken();
                // header('Location:../../index.php');
                // $user = getUserToken();
                // echo json_encode($user);
                if ($user['role_id'] == 4) {
                    echo json_encode(4);
                } else if ($user['role_id'] == 3) {
                    echo json_encode(3);
                } else if ($user['role_id'] == 2) {
                    echo json_encode(2);
                } else if ($user['role_id'] == 1) {
                    echo json_encode(1);
                } else if ($user['role_id'] == 5) {
                    echo json_encode(1);
                } else {
                    echo json_encode(0);
                }
            }
            // Kết thúc phân quyền
        } else {
            echo "Email không tồn tại";
        }
    }
}
$login = new Login();
