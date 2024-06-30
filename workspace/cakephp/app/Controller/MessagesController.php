<?php
class MessagesController extends AppController {
	public $uses = ['Message', 'User'];
	public function index() {
		$currentUserID = $this->Auth->user('id');

		
		$currentUsersMessageList = $this->Message->query(
			'SELECT messages.*, users.name, users.profile_image, users.id FROM messages
			JOIN (
				SELECT MAX(id) as max_id, 
				CASE WHEN sender_id = ' . $currentUserID . ' THEN receiver_id ELSE sender_id END as other_user_id 
				FROM messages
				WHERE (sender_id = ' . $currentUserID . ' OR receiver_id = ' . $currentUserID . ') and (messages.status = 1)
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
			WHERE ((messages.sender_id = ' . $currentUserID . ' AND messages.receiver_id = ' . $recipientID . ') 
			OR (messages.sender_id = ' . $recipientID . ' AND messages.receiver_id = ' . $currentUserID . '))
			AND (messages.status = 1)
			ORDER BY messages.created_at ASC'
		);

		// echo "<pre>";
		// print_r($messageDetails);
		// die();

		$this->set('messageDetails', $messageDetails); 
		$this->set('currentUserID', $currentUserID);
		$this->set('recipientID', $recipientID);

		$this->set('recipientImage', $messageDetails[0]['receiver_users']['profile_image']);
		$this->set('recipientName', $messageDetails[0]['receiver_users']['receiver_name']);
	}

	public function reply($id = null) {
    $currentUser = $this->Auth->user('id');
    $recipientID = $id;

    if ($this->request->is('post')) {
        $message = $this->request->data['reply'];

        if (empty($message)) {
            $this->Flash->error(__('Message cannot be empty.'));
            return $this->redirect(array('action' => 'view', $recipientID));
        }

        $data = array(
            'sender_id' => $currentUser,
            'receiver_id' => $recipientID,
            'message' => $message,
            'created_at' => date('Y-m-d H:i:s')
        );

        $this->Message->create();
        $this->Message->save($data);

        if ($this->Message->save($data)) {
            $response = array(
                'status' => 'success',
                'message' => 'Message sent.',
				'data' => $data
				
            );

            echo json_encode($response);
            die();
        }
    }
}

	public function delete($id = null) {
		$messageID = $id;

		// echo "<pre>";
		// print_r($messageID);
		// die();
		
		if (!$messageID) {
			throw new NotFoundException(__('Invalid message'));
		}
		
		$messageDetail = $this->Message->findById($messageID)['Message'];
		$messageDetail['status'] = 0;

		$this->Message->save($messageDetail);

		if ($this->Message->save($messageDetail)) {
			    $response = array(
                'status' => 'success',
                'message' => 'Message deleted.',
				'data' => $messageDetail
			
            );

            echo json_encode($response);
            die();
		}
		$this->Flash->error(__('Message was not deleted'));
		return $this->redirect(array('action' => 'view', $messageDetail['receiver_id']));

	}

}