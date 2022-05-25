<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index() {

        $this->template('login/login',[
            'error' => $this->getflashdata('error')
        ]);

    }

    public function logout(){

        if($this->is_logged_in) {

            $this->session->destroy();

        }

        return redirect()->to('/');

    }

    public function dashboard(){

        //check subscription

        $user = $this->user();

        $this->session->set([
            'user' => $user
        ]);

        $this->template('dashboard/index',[
            'user' => $this->user(),
            'calendar' => $this->is_admin ? $this->calendar_model->findAll() : $this->calendar_model->where('user_id',$this->user_id)->findAll()
        ]);



    }

    public function authorize(){


        if(!empty($this->post())) {

            $user = new \App\Models\UsersModel();

            if ($user = $user->where('email', $this->post('email'))->first()) {

                if(password_verify($this->post('password'),$user->password)) {

                    unset($user->password); // dont save user password in the session..

                    $this->session->set([
                        'is_logged_in' => true,
                        'user' => $user,
                        'is_admin' => $user->is_admin
                    ]);

                    return redirect()->to('dashboard');

                } else {

                    $this->setflashdata('error','Wrong username or password');
                    return redirect()->to('/');

                }

            } else {

                $this->setflashdata('error','Wrong username or password');
                return redirect()->to('/');
            }

        } else {
            return redirect()->to('/');
        }

    }

    public function view_event(){

        if($event = $this->calendar_model->where('id',$this->post->id)->first()) {

            success((array)$event);

        } else {

            error();

        }

    }

    public function add_event(){

        if($this->post) {
            if($this->calendar_model->insert($this->post)) {
                success();
            }
        }


    }
}
