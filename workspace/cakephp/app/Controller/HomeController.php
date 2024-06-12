<?php
class HomeController extends AppController {
	public $uses = ['User'];
	
	public function beforeFilter (){
		parent::beforeFilter();
		// echo "hello from home beforeFilter";
		$this->Auth->allow("login", "register");
	}

	public function index (){
		// echo "die";
		// die();
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
                return $this->redirect($this->Auth->redirectUrl(array('controller' => 'profile', 'action' => 'index')));
            }
        }

        	$this->Flash->error(__('Invalid email or password, try again'));
 	   }
	}

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }


    public function register() {
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

                // Update last login time
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


	// public function main ($page=''){
	// 	$birthday = "OCTOBER 9, 1994";
	// 	$age = $this->getAge();
	// 	$this->set("user_name", "LESTER AG PADUL");
	// 	$this->set("age", $age);
	// 	$this->set("birthday", $birthday);
	// }

	// public function tab ($tab_item = "", $param2 = "", $param3 = "") {
	// 	// - get parameters
	// 	var_dump($this->request->query);

	// 	// - get post parameters
	// 	var_dump($this->request->data);
	// 	die();
	// }

	// public function getAge () {
	// 	return 111;
	// }
}