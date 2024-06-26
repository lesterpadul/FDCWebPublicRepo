<?php
class MessagesController extends AppController {
	// public $uses = [''];
public function index() {
    $currentUserID = $this->Auth->user('id');

    
	$currentUsersMessageList = $this->Message->query(
		'SELECT messages.*, users.name, users.profile_image, users.id FROM messages
		JOIN (
			SELECT MAX(id) as max_id, 
			CASE WHEN sender_id = ' . $currentUserID . ' THEN receiver_id ELSE sender_id END as other_user_id 
			FROM messages
			WHERE sender_id = ' . $currentUserID . ' OR receiver_id = ' . $currentUserID . ' and status = 1
			GROUP BY CASE WHEN sender_id = ' . $currentUserID . ' THEN receiver_id ELSE sender_id END
		) as mm ON messages.id = mm.max_id
		JOIN users ON messages.sender_id = users.id OR messages.receiver_id = users.id
		WHERE users.id != ' . $currentUserID . ' ORDER BY messages.created_at DESC'
	);

	
	// echo "<pre>";
	// print_r($currentUsersMessageList);
	// die();
	


    $this->set('messages', $currentUsersMessageList);
	$this->set('currentUserID', $currentUserID);
	
}


	public function create() {

		$currentUser = $this->Auth->user('id');

		$users = $this->User->find('all', array(
			'conditions' => array(
				'User.id !=' => $currentUser,
				'User.status' => 1
			)
		));
		$this->set('users', $users);

		if ($this->request->is('post')) {

			
			$recipientID = $this->request->data['recipient'];
			$message = $this->request->data['content'];

			$data = array(
				'sender_id' => $currentUser,
				'receiver_id' => $recipientID,
				'message' => $message,
				'created_at' => date('Y-m-d H:i:s')
			);

			$this->Message->create();
			$this->Message->save($data);

			$this->Flash->success(__('Message sent.'));
			return $this->redirect(array('action' => 'index'));
			
			
		}

		
	}


	public function view($id = null) {
		$currentUserID = $this->Auth->user('id');
		$recipientID = $id;

		$messageDetails = $this->Message->query(
			'SELECT messages.*, sender_users.name as sender_name, sender_users.profile_image, receiver_users.name as receiver_name, receiver_users.profile_image
			FROM messages
			JOIN users as sender_users ON sender_users.id = messages.sender_id
			JOIN users as receiver_users ON receiver_users.id = messages.receiver_id
			WHERE (messages.sender_id = ' . $currentUserID . ' AND messages.receiver_id = ' . $recipientID . ') 
			OR (messages.sender_id = ' . $recipientID . ' AND messages.receiver_id = ' . $currentUserID . ') 
			AND messages.status = 1
			ORDER BY messages.created_at ASC'
		);

		// echo "<pre>";
		// print_r($messageDetails);
		// die();

		$this->set('messageDetails', $messageDetails); 
		$this->set('currentUserID', $currentUserID);
		$this->set('recipientID', $recipientID);
	}

}