<?php
class HomeController extends AppController {
	public $uses = ['User'];
	
	public function beforeFilter (){
		parent::beforeFilter();
		// echo "hello from home beforeFilter";
		$this->Auth->allow();
	}

	public function index (){
		// echo "die";
		// die();
	}

	public function login() {
    if ($this->request->is('post')) {
        $user = $this->User->find('first', array(
            'conditions' => array(
                'email' => $this->request->data['email'],
                'status' => 1
                
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
        unset($currentUser);
        return $this->redirect($this->Auth->logout());
    }


    public function register() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                // $this->Flash->success(__('Account created.'));

                // Retrieve the newly created user
                $user = $this->User->find('first', array(
                    'conditions' => array(
                        'email' => $this->request->data['email']
                    )
                ));

                $didLogin = $this->Auth->login($user['User']);

                // Update last login time
                $this->User->id = $user['User']['id'];
                $this->User->saveField('last_login_time', date('Y-m-d H:i:s'));

                

                if ($didLogin) {
                    return $this->redirect($this->Auth->redirectUrl(array('action' => 'register_success')));
                }
            } else {
                $this->set('errors', $this->User->validationErrors);
                $this->Flash->error(__('Failed to create account. Please, try again.'));
            }
        }
    }

    public function register_success() {
        $this->Flash->success(__('Account created.'));
    
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