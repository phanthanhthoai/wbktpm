<?php 
class LoginController {
    function form(){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $hpassword=md5(md5($password).PRIVATE_KEY);
        // $hpassword = password_hash($password, PASSWORD_BCRYPT);
        // var_dump($password);
        // exit;
        $customerRepository =  new CustomerRepository();
        $customer = $customerRepository -> findEmail($email);
        if($customer){
            if ($customer->getRoleID() == 5){
                $encodePassword = $customer->getPassword();
                if($hpassword == $encodePassword){
                // if(password_verify($password,$encodePassword)){
                    if($customer->getIsActive()){
                        $_SESSION["success"]= "Đăng nhập thành công";
                        $_SESSION["email"]= $email;
                        $_SESSION["fullname"]= $customer->getName();
                    }
                    else{
                        $_SESSION["error"]= "Tài khoản của bạn đã bị vô hiệu hóa. Xin vui lòng liên hệ Admin";
                    }
                }    
                header("location:index.php"); 
                exit; 
            }
            else{
                header("Location: ../admin/dashboard.php");
                exit;
            }
            
    }
        $_SESSION["error"]= "Vui lòng nhập lại email hoặc mật khẩu";
        header("location:index.php");
    }
    function google() {

    }

    function facebook() {
        
    }

    function logout() {
        // session_unset();
        session_destroy();
        header("location: index.php");
    }

}
?>