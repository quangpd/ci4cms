<?php

namespace Blog\Controllers;

class BlogController extends \App\Controllers\BaseController
{
    public function index()
    {
        // send test email
        $email = service('email');

        // $email->setFrom('csdl@thainguyen.edu.vn', 'CSDL GD Thai Nguyen');
        $email->setTo('quangpd7@gmail.com, quangpd@live.com,quangpd2@viettel.com.vn');
        $email->setSubject('Test email from CodeIgniter 4');
        $email->setMessage('This is a test email from CodeIgniter 4. Enjoy it!');
        if ($email->send()) {
            echo 'Email successfully sent' . PHP_EOL;
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }


        echo 'BlogController::index' . PHP_EOL;
    }
}
