<?php
class MessageController extends AppController {
    public $uses = array('Users', 'Message');
    public $components = ['Paginator','Auth'];
    public function beforeFilter() {
            
        parent::beforeFilter();
        $this->Auth->allow(['message','getUsers','combinedMessages','reply','delete']);
    }

    public function message() {
        $user = $this->Session->read('Auth.User');
        $this->set('user', $user);

        if ($this->request->is('post')) {
            $userId = $this->Session->read('Auth.User.id');
            $data = [
                'sender_id' => $userId,
                'recipient_id' => $this->request->data['recipient'],
                'message' => $this->request->data['message']
            ];
            $this->Message->create();

            if ($this->Message->save($data)) {
                $this->Flash->success(__('The message has been sent.'));
            } else {
                $this->Flash->error(__('Unable to send the message. Please try again.'));
            }
        }
    }

    public function getUsers() {
        $this->autoRender = false; 
    
        $term = $this->request->query('q');
        if (!$term) {
            echo json_encode(['items' => []]); 
            return;
        }
    
        $users = $this->Users->find('all', [
            'conditions' => ['Users.name LIKE' => '%' . $term . '%'],
            'fields' => ['Users.id', 'Users.name'],
            'limit' => 10
        ]);
    
        $results = [];
        foreach ($users as $user) {
            $results[] = ['id' => $user['Users']['id'], 'text' => $user['Users']['name']];
        }
    
        echo json_encode(['items' => $results]);
    }

    public function combinedMessages($userId) {
        $this->Message->recursive = 0; 
        $messages = $this->Message->find('all', [
            'conditions' => ['OR' => [
                ['Message.sender_id' => $userId],
                ['Message.recipient_id' => $userId]
            ]],
            'contain' => [
                'Sender' => ['fields' => ['id', 'name', 'picture']],
                'Recipient' => ['fields' => ['id', 'name', 'picture']]
            ],
            'order' => ['Message.created' => 'ASC']
        ]);
    
        $this->set('messages', $messages);
        $this->set('userId', $userId); 
    }
    
    
    public function reply() {
        $this->autoRender = false;
    
        if ($this->request->is('post')) {
            $messageId = $this->request->data('messageId');
            $replyMessage = $this->request->data('replyMessage');
    
            $originalMessage = $this->Message->findById($messageId);
    
            if ($originalMessage) {
                $replyData = [
                    'Message' => [
                        'sender_id' => $this->Auth->user('id'),
                        'recipient_id' => $originalMessage['Message']['sender_id'],
                        'message' => $replyMessage
                    ]
                ];
    
                $this->Message->create();
                if ($this->Message->save($replyData)) {
                    $response = ['status' => 'success', 'message' => 'Reply sent successfully'];
                } else {
                    $response = ['status' => 'error', 'message' => 'Failed to send reply'];
                }
            } else {
                $response = ['status' => 'error', 'message' => 'Original message not found'];
            }
    
            echo json_encode($response);
        }
    }
    


    public function delete() {
        $this->autoRender = false; 
        $this->layout = 'ajax'; 

        $response = array('success' => false, 'message' => 'Invalid request');
        if ($this->request->is('post')) {
            $messageId = $this->request->data['messageId'];
            if ($this->Message->delete($messageId)) {
                $response = array('success' => true, 'message' => 'Message deleted');
            } else {
                $response = array('success' => false, 'message' => 'Failed to delete message');
            }
        }

        $this->response->type('json');
        $this->response->body(json_encode($response));
        return $this->response;
    }
                
}