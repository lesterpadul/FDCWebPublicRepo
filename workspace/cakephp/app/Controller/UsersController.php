<?
    class UsersController extends AppController{

        public $components =['Auth'];
        public function beforeFilter() {
            
            parent::beforeFilter();
            $this->Auth->allow(['index','home','messagesent','logged','register','login','logout','edit','profile']);
        }
        
        public $uses = array('Users', 'Message','');

        public function index(){
            
        }

        public function home(){
            
        }

        public function messagesent(){

        }

        public function logged() {
            $user = $this->Session->read('Auth.User');
            $this->set('user', $user);
        }
        
        public function register(){
            $registrationSuccess = false;

            if ($this->request->is('post')) {
                //$this->Users->create();
                //debug($this->request->data['Users']['password']);

                $hashedPassword = password_hash($this->request->data['Users']['password'], PASSWORD_DEFAULT);
                $this->request->data['Users']['password'] = $hashedPassword;
                $this->request->data['Users']['confirm_password'] = $hashedPassword;
                debug($hashedPassword); 
                debug($this->request->data['Users']['password']);
                debug($this->request->data['Users']['confirm_password']);

                if ($this->Users->save($this->request->data)) {
                    $registrationSuccess = true;
                    $this->Flash->success("Success: Account Created!");
                } else {
                    $this->Flash->error("Error: Could not create account!");
                }
            }

            $this->set(compact('registrationSuccess'));
        }

        public function login() {
            if ($this->request->is('post')) {
                $email = isset($this->request->data['Users']['email']) ? $this->request->data['Users']['email'] : null;
                $password = isset($this->request->data['Users']['password']) ? $this->request->data['Users']['password'] : null;
        
                if ($email && $password) {
                    $user = $this->Users->find('first', [
                        'conditions' => [
                            'Users.email' => $email,
                        ]
                    ]);
        
                    if (!empty($user)) {
                        if (password_verify($password, $user['Users']['password'])) {
                            $this->Session->write('Auth.User', $user['Users']);
                            $this->Flash->success("Success: You are logged in!");
                            $this->redirect(array('controller' => 'Users', 'action' => 'logged'));
                        } else {
                            $this->Flash->error("Error: Invalid password!");
                        }
                    } else {
                        $this->Flash->error("Error: User not found!");
                    }
                } else {
                    $this->Flash->error("Error: Please enter both email and password.");
                }
            }
        }
        

        public function logout() {
            $this->Session->destroy();
            $this->Flash->success("Success: You have logged out!");
            $this->redirect(array('controller' => 'Users', 'action' => 'index','home'));
        }

        public function edit($id = null) {
            $this->Users->id = $id;
            if (!$this->Users->exists()) {
                $this->Flash->error("Invalid User!");
                return $this->redirect(['action' => 'index']);
            }
        
            if ($this->request->is(['post', 'put'])) {
                if (!empty($this->request->data['Users']['picture']['name'])) {
                    $file = $this->request->data['Users']['picture'];
                    $filePath = WWW_ROOT . 'files' . DS . $file['name'];
                    move_uploaded_file($file['tmp_name'], $filePath);
                    $this->request->data['Users']['picture'] = 'files' . DS . $file['name'];
                } else {
                    unset($this->request->data['Users']['picture']);
                }
        
                if (!empty($this->request->data['Users']['birthdate'])) {
                    $this->request->data['Users']['birthdate'] = date('Y-m-d', strtotime($this->request->data['Users']['birthdate']));
                }
        
        
                $fieldsToSave = ['name', 'email', 'gender', 'hobby', 'picture', 'birthdate'];
        
                if ($this->Users->save($this->request->data, ['fieldList' => $fieldsToSave])) {
                    $this->Flash->success("Success: User saved!");
                    return $this->redirect(['action' => 'logged']);
                } else {
                    $this->Flash->error("Error: Could not save User!");
                    $errors = $this->Users->validationErrors;
                }
            } else {
                $this->request->data = $this->Users->findById($id);
            }
        }                

        public function profile() {
            $user = $this->Session->read('Auth.User');
            //debug($this->Session->read('Auth.User'));
            $this->set('user', $user);
        }
    }
                
?>