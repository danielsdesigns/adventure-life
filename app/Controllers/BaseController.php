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
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['template','data', 'form', 'url'];
    protected $session;
    protected $db;

    protected $data, $post, $is_logged_in, $is_admin, $user_id, $view;
    protected $users_model, $calendar_model;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();

        $this->is_logged_in = $this->session->get('is_logged_in');
        $this->is_admin = $this->session->get('is_admin');
        $this->user_id = isset($this->user()->id) ? $this->user()->id : false;

        $this->users_model = new \App\Models\UsersModel();
        $this->calendar_model = new \App\Models\CalendarModel();

        $this->check_user();

        //Global Datas..
        $this->data = $this->global_data();
        $this->post = $this->post();

    }

    public function global_data(){

        return [
            'is_logged_in' => $this->session->get('is_logged_in'),
            'is_admin' => $this->session->get('is_admin'),
            'user' => $this->user(),
            'name' => $this->user() ? $this->user()->name : null,
            'user_id' => isset($this->user()->id) ? $this->user()->id : false,
            'view' => isset($this->view) ? $this->view : false,
            'styles' => [],
            'scripts' => []
        ];

    }

    public function template($view,$data = []){

        if(isset($data['scripts']) || isset($this->class_data['scripts'])) {

            $data['scripts'] = empty($data['scripts']) ? [] : $data['scripts'];
            $data['scripts'] = array_merge($this->data['scripts'], $this->class_data['scripts'], $data['scripts']);

        }

        if(isset($data['styles']) || isset($this->class_data['styles'])) {
            $data['styles'] = empty($data['styles']) ? [] : $data['styles'];
            $data['styles'] = array_merge($this->class_data['styles'], $data['styles']);
        }

        $data = array_merge($this->data,$data);

        $view = isset($this->view) ? $this->view.'/'.$view : $view;

        if(strstr($view,'/')) {

            if(empty($data['header_off'])) {
                echo view('templates/header', $data);
            }

            echo view('pages/' . $view, $data);

            if(empty($data['footer_off'])) {
                echo view('templates/footer', $data);
            }

        } else {

            echo view($view, $data);

        }
    }

    public function post($item=null){

        if($this->request->getPost()) {

            if ($item != null) {
                return $this->request->getPost($item);
            } else {
                return (object) $this->sanitize($this->request->getPost());
            }

        } else {

            return false;

        }

    }

    public function sanitize ($value) {

        // sanitize array or string values
        if (is_array($value)) {
            array_walk_recursive($value, function (&$value) {
                $value = trim($value);
            });
        }
        else {
            $value = trim($value);
        }

        return $value;
    }

    public function setflashdata($key,$val){
        return $this->session->setFlashdata($key, $val);
    }

    public function getflashdata($key){
        return $this->session->getFlashdata($key);
    }

    public function user(){

        return $this->session->get('user') ? $this->session->get('user') : false;

    }

    public function check_user(){

        //public pages..
        if(in_array(uri_segment(1),['authorize'])) {
            return;
        }

        if($this->is_logged_in && uri_segment(1)==='') {

            gotopage('dashboard');
        }

        if(!$this->is_logged_in && uri_segment(1)!==''){
            gotopage();
        }


    }

}
