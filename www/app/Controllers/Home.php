<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function __construct()
    {
        helper('reCaptcha');
        $this->data_to_views['validation'] =  \Config\Services::validation();
        $this->data_to_views['links'] = [
            "inligtingstuk" => base_url('files/Inligtingstuk-2023.pdf'),
            "inskrywings_vorm" => base_url('files/Inskrywingsvorm-Nuwe-Kleuters.pdf'),
        ];
    }

    public function index()
    {
        return view('home', $this->data_to_views);
    }

    public function contact()
    {
        // stuff for contact form
        $this->data_to_views['scripts_to_load'] = [
            "https://www.google.com/recaptcha/api.js",
            "contact.js"
        ];
        // validation rules
        if ($this->request->getPost()) {

            $rules = [
                'kindergarten-contactform-first-name' => ['label'  => 'Name', 'rules'  => 'required',],
                'kindergarten-contactform-last-name' => ['label'  => 'Surname', 'rules'  => 'required',],
                'kindergarten-contactform-email' => ['label'  => 'Email', 'rules'  => 'required|valid_email',],
                'kindergarten-contactform-message' => ['label'  => 'Message', 'rules'  => 'required',],
                // 'reCaptcha3' => ['label'  => 'reCaptcha3', 'rules'  => 'required|reCaptcha3[contactForm,0.9]',],
                // 'g-recaptcha-response' => ['label'  => 'Captcha', 'rules'  => 'recaptcha',],
            ];
            $errors = [
                'kindergarten-contactform-first-name' => [
                    'required' => 'Jou naam word benodig'
                ]
            ];

            if (!$this->validate($rules)) {
                $this->data_to_views['validation'] = $this->validator;
                // return view('templates/header', $this->data_to_views)
                //     . view('templates/title_bar')
                //     . view('contact/form')
                //     . view('templates/footer');
                return view('home', $this->data_to_views);
            } else {
                $name = $this->request->getVar('kindergarten-contactform-first-name') . " " . $this->request->getVar('kindergarten-contactform-last-name');
                // stuur email
                $message = "<h3>Website Contact Form</h3><p>"
                    . "<b>Name:</b> $name<br>"
                    . "<b>Email:</b> " . $this->request->getVar('kindergarten-contactform-email') . "</p>"
                    . "<p style='padding-left: 15px; padding-bottom:0; margin: 20px 0; border-left: 4px solid #ccc;'><b>Message:</b><br>" . nl2br($this->request->getPost('kindergarten-contactform-message')) . "</p>";
                $att = [
                    "name" => $name,
                    "email" => $this->request->getPost('kindergarten-contactform-email'),
                    // "subject" => $this->request->getPost("subject"),
                    "message" => $message
                ];
                $this->send_email($att);
                $this->session->setFlashdata([
                    'mail_msg' => "Thank you. Your message has been send. We will get back to you shortly",
                ]);
                return redirect()->back();
                // return view('home', $this->data_to_views);
            }
        } else {
            die("No post found");
        }
    }

    public function gallery($name)
    {
        $this->data_to_views['gallery'] = $name;
        switch ($name) {
            case "klasse":
                $this->data_to_views['heading'] = "Ons Klasse";
                break;
            case "speelgronde":
                $this->data_to_views['heading'] = "Speelgronde";
                break;
            case "pret":
                $this->data_to_views['heading'] = "Pret en Plesier";
                break;
            default:
                die('invalid gallery');
                break;
        }
        $this->data_to_views['file_map'] = directory_map('./img/gallery/'.$name.'/full', 1);
        return view('gallery', $this->data_to_views);
    }
}
