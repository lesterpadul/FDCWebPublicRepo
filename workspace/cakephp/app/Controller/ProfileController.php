<?php
class ProfileController extends AppController {
    
	public $uses = ['User'];

	public function index (){
	}

    public function updateProfile() {
        // Get the current logged-in user's ID
        $userId = $this->Auth->user('id');

        // Fetch the user record
        $user = $this->User->findById($userId);

        if (!$user) {
            $this->Flash->error(__('User not found.'));
            return $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            // Update user fields from form data
            $this->User->id = $userId;
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Your profile has been updated.'));
                
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Unable to update your profile. Please, try again.'));
            }
        } else {
            // If the request is not post or put, populate form data with user data
            $this->request->data = $user;
        }

        $this->set('currentUser', $this->request->data['User']);
        
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


    
    public function beforeFilter(){
        parent::beforeFilter();
        
        // global restriction
        // $this->Auth->allow('index', 'view', 'add');
        // $this->set('currentUser', $this->Auth->user());
        
    }
}