<?php
App::uses('AppModel', 'Model');

class User extends AppModel
{
    public $name = 'User';

    public $validate = [
        'username' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => 'Username is required'
            ],
            'minLength' => [
                'rule' => ['minLength', 6],
                'message' => 'Username must be at least 6 characters.'
            ],
            'maxLength' => [
                'rule' => ['maxLength', 20],
                'message' => 'Username must be at most 20 characters.'
            ],
        ],
        'password' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => 'Password is required'
            ],
            'minLength' => [
                'rule' => ['minLength', 6],
                'message' => 'Password must be at least 6 character long'
            ]
        ]
    ];

    public function beforeSave($options = array())
    {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }
}