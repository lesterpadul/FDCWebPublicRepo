<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout');
    }

    public function login() {
        if ($this->request->is('post')) {
            $username = $this->request->data['username'];
            $password = AuthComponent::password($this->request->data['password']);
            
            // Manually authenticate user
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.username' => $username,
                    'User.password' => $password
                )
            ));
            
            if ($user) {
                $this->Auth->login($user['User']);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Session->setFlash(__('Invalid username or password, try again'), 'default', array(), 'auth');
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            $userData = array(
                'User' => array(
                    'username' => $this->request->data['username'],
                    'password' => Security::hash($this->request->data['user_password'], 'sha256', true)
                )
            );
            if ($this->User->save($userData)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'login'));
            }
            $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
        }
    }

    
}