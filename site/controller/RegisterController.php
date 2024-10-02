<?php 
require_once __DIR__ . '/../../vendor/autoload.php';
use Firebase\JWT\JWT;
require_once "MailService.php";
class RegisterController {
    function create() {
        // $secret = GOOGLE_RECAPTCHA_SECRET;
        // $remoteIp = "127.0.0.1";
        // $gRecaptchaResponse = $_POST["g-recaptcha-response"];
        // $recaptcha = new \ReCaptcha\ReCaptcha($secret);
        // $resp = $recaptcha->setExpectedHostname(get_host_name())
        //                 ->verify($gRecaptchaResponse, $remoteIp);
        // if (!$resp->isSuccess()) {
        //     // Verified!
        //     $errors = $resp->getErrorCodes();
        //     var_dump($errors);
        //     exit;
        // }
        
        $customerRepository = new CustomerRepository();
        $data = [
            "name" => $_POST["fullname"],
            "password" => $_POST["password"],   
            "mobile" => $_POST["mobile"],
            "email" => $_POST["email"],
            "role_id" => 5,
            "login_by" => "form",
            "is_active" => 0,
            "shipping_name" => "",
            "shipping_mobile" => "",
            "ward_id" => null,
            "housenumber_street" => "",
        ];
        if ($customerRepository->save($data)) {
            $_SESSION["success"] = "Đã tạo tài khoản thành công vui lòng vào email để xác nhận";
            //Gởi email để kích hoạt tài khoản
            $email = $_POST["email"];
            $mailServer = new MailService();

            $key = PRIVATE_KEY;
            $payload = array(
                "email" => $email
            );
            $code = JWT::encode($payload, $key);
            $activeUrl= get_domain_site(). "/index.php?c=register&a=active&code=$code";
            $content = "
                Chào $email, <br>
                Vui lòng click vào click vào link bên dưới để kích hoạt tài khoản <br>
                <a href='$activeUrl'>Active Account</a>
            ";
            $mailServer->send($email, "Active account", $content);

        }
        else {
            $_SESSION["error"] = $customerRepository->getError();
        }
        header("location:index.php");
    }

    function active() {
        $code = $_GET["code"];
        try {
            $decoded = JWT::decode($code, PRIVATE_KEY, array('HS256'));
            $email = $decoded->email;
            $customerRepository = new CustomerRepository();
            $customer = $customerRepository->findEmail($email);
            if (!$customer) {
                $_SESSION["error"] = "Email $email không tồn tại";
                header("location: /");
            }
            $customer->setIsActive(1);
            $customerRepository->update($customer);
            $_SESSION["success"] = "Tài khoản của bạn đã được active";
            //Cho phép login luôn
            $_SESSION["email"] = $email;
            $_SESSION["fullname"] = $customer->getName();
            header("location: index.php");

        }
        catch(Exception $e) {
            echo "You try hack!";
        }
        
    }

    function notExistingEmail() {
        $email = $_GET["email"];
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($email);
        if (!$customer) {
            echo "true";
            return;
        }
        echo "false";
        return;
    }
}
?>