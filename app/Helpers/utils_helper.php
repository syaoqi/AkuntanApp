<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use function PHPUnit\Framework\returnSelf;

if(!function_exists('sendemail')){
    function sendemail($email_tujuan, $pesan = null, $subject = null, $nama_pengirim = 'Keuangan BQN', $html = false, $email_pengirim = 'kamscode@kamscodelab.tech', $param = [])
    {
        $mail = new PHPMailer(TRUE);
        // require 'vendor/autoload.php';
        try {
            /* Set the mail sender. */
            $mail->IsSMTP();
            $mail->Host = "EMAIL HOST";
            $mail->isHTML($html);
            // optional
            // used only when SMTP requires authentication  
            $mail->SMTPAuth = true;
            $mail->Username = 'SMTP username';
            $mail->Password = 'SMTP password';
            $email_tujuan = strtolower($email_tujuan);
            $mail->setFrom($email_pengirim, $nama_pengirim);

            /* Add a recipient. */
            $mail->addAddress($email_tujuan);

            /* Set the subject. */
            $mail->Subject = $subject;

            /* Set the mail message body. */
            if($html){
                ob_start();
                include_view($pesan, $param);
                $pesan = ob_get_clean();
            }
            $mail->Body = $pesan;

            $mail->send();
            return ['message' => 'Berhasil mengirim email', 'sts' => true];
        } catch (Exception $e) {
            return ['message' => $e->errorMessage(), 'sts' => false];
            echo $e->errorMessage();
        } catch (\Exception $e) {
            return ['message' => $e->getMessage(), 'sts' => false];
        }
    }

    if(!function_exists('iclude_view')){
        function include_view($path, $data = null)
        {
            if (is_array($data))
                extract($data);
            include ROOTPATH . 'app/views/' . $path . '.php';
        }
    }

    if(!function_exists('isLogin')){
        function isLogin($username = null, $role = null){
            $session = session();
            $loginInfo = (array) $session->get('user_info');
            $isLogin = !empty($loginInfo);

            if(!$isLogin)
                return $isLogin;
            else{
                if(!empty($username) && empty($role))
                    return $loginInfo['username'] == $username;
                elseif(empty($username) && !empty($role))
                    return is_numeric($role) ? $loginInfo['role'] == $role : $loginInfo['role_name'] == $role;
                elseif(!empty($username) && !empty($role))
                    return $loginInfo['username'] == $username && is_numeric($role) ? $loginInfo['role'] == $role :  $loginInfo['role_name'] == $role;
                elseif(empty($username) && empty($role))
                    return $isLogin;
            }
        }
    }
}