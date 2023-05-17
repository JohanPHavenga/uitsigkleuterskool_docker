<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request, $session;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [
        'session',
        'form',
        'formulate',
        'filesystem',
        'auth',
        'url',
        'text_format',
        'cookie'
    ];
    protected $data_to_views = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->session = \Config\Services::session();
        if (isset($_SESSION['mail_msg'])) {
            $this->data_to_views['flash_data'] = $this->session->getFlashdata();
        }
    }

    public function send_email($att, $is_admin_email = false)
    {
        // need to always send NAME, EMAIL and MESSAGE
        $email = \Config\Services::email();


        if (isset($att['to'])) {
            $to = $att['to'];
        } else {
            $to = 'johan.havenga@gmail.com';
            // $to = 'bestuurshoof@uitsigkleuterskool.co.za';
        }
        if (isset($att['subject'])) {
            $subject = $att['subject'];
        } else {
            $subject = 'Website Contact: ' . $att['name'];
        }

        $email->setTo($to);

        $email->setCC('johan.havenga@gmail.com');
        $email->setFrom($att['email'], $att['name']);
        $email->setReplyTo($att['email'], $att['name']);

        $email->setSubject($subject);
        $email->setMessage($att['message']);

        if ($email->send()) {
            return true;
        } else {
            $data = $email->printDebugger(['headers']);
            // dd($data);
            return false;
        }
    }
}
