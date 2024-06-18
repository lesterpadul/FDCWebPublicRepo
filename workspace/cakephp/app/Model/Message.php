<?
    class Message extends AppModel{
        public $belongsTo = [
            'Sender' => [
                'className' => 'User',
                'foreignKey' => 'sender_id'
            ],
            'Recipient' => [
                'className' => 'User',
                'foreignKey' => 'recipient_id'
            ]
        ];
        
        public function message(){
            
        }
    }
?>