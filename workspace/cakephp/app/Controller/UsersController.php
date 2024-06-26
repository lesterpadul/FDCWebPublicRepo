<?php
class UsersController extends AppController {
    public $uses = ['User'];
	public function beforeFilter() {
        parent::beforeFilter();

        // always restrict your whitelists to a per-controller basis
        $this->Auth->allow("ajaxLogin", "add");
    }

public function login() {
    if ($this->request->is('post')) {
        $user = $this->User->find('first', array(
            'conditions' => array(
                'email' => $this->request->data['email']
            )
        ));

        if ($user && password_verify($this->request->data['password'], $user['User']['password'])) {
            $this->User->id = $user['User']['id'];
            $this->User->saveField('last_login_time', date('Y-m-d H:i:s'));

            $didLogin = $this->Auth->login($user['User']);

            if ($didLogin) {
                return $this->redirect($this->Auth->redirectUrl());
            }
        }

        $this->Flash->error(__('Invalid email or password, try again'));
    }
}

    

// public function ajaxLogin () {
//     $request_data = $this->request->data;
//     $email = $request_data['email'];
//     $password = $request_data['password'];

//     $user = $this->User->find('first', array(
//         'conditions' => array(
//             'email' => $email,
//         )
//     ));

//     if ($user && password_verify($password, $user['User']['password'])) {
//         $this->User->id = $user['User']['id'];
//         $this->User->saveField('last_login_time', date('Y-m-d H:i:s'));

//         $didLogin = $this->Auth->login($user['User']);

//         if ($didLogin) {
//             echo json_encode(array(
//                 "status" => "success",
//                 "user" => $this->Auth->user()
//             ));
//             die();
//         }
//     } else {
//         echo json_encode(array(
//             "status" => "error",
//             "message" => "Invalid email or password",
//         ));
//         die();
//     }
// }





    
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->findById($id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $userData = $this->request->data;

            if ($userData['password'] !== $userData['confirm_password']) {
                $this->Flash->error(__('Passwords do not match.'));
                return;
            }

            // Check if email already exists in the database
            $existingUser = $this->User->find('first', array(
                'conditions' => array(
                    'email' => $userData['email']
                )
            ));
            
            if ($existingUser) {
                $this->Flash->error(__('Email already exists. Choose a different email.'));
                return;
            }
            
            $this->User->create();
            if ($this->User->save($userData)) {
                $this->Flash->success(__('The user has been saved'));

                // Retrieve the newly created user
                // $user = $this->User->findById($this->User->id);
                $user = $this->User->find('first', array(
                    'conditions' => array(
                        'email' => $this->request->data['email']
                    )
                ));

                
                $this->User->id = $user['User']['id'];
                $this->User->saveField('last_login_time', date('Y-m-d H:i:s'));

                $didLogin = $this->Auth->login($user['User']);
                if($didLogin) {
                    return $this->redirect($this->Auth->redirectUrl(array('controller' => 'users', 'action' => 'index')));
                }
                
            }

            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
    }



    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Flash->success(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }

}