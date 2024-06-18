<?php

App::uses('AppModel', 'Model');

class Users extends AppModel {
    public $validate = array(
        'name' => array(
            'rule' => 'notBlank',
            'required' => true,
            'message' => 'Please enter your name.'
        ),
        'email' => array(
            'rule' => 'email',
            'required' => false,
            'message' => 'Please enter a valid email address.'
        ),
        'password' => array(
            'rule' => array('minLength', 6),
            'required' => false,
            'message' => 'Password must be at least 6 characters long.'
        ),
        'confirm_password' => array(
            'comparePasswords' => array(
                'rule' => array('comparePasswords'),
                'required' => false,
                'message' => 'Passwords do not match.'
            )
        ),
        'picture' => array(
            'validateFile' => array(
            'rule' => /*array('validateFile', array('jpg', 'jpeg', 'png', 'gif'))*/ 'notBlank',
                'message' => 'Please upload a valid image file (jpg, jpeg, png, gif).'
            )
        ),
        'birthday' => array(
            'rule' => 'date',
            'message' => 'Please enter a valid date.'
        ),
        'gender' => array(
            'rule' => array('inList', array('male', 'female')),
            'message' => 'Please select a valid gender.'
        ),
        'hobby' => array(
            'rule' => 'notBlank',
            'message' => 'Hobby is required.'
        )
    );

    public function comparePasswords($data) {
        $password = isset($this->data[$this->alias]['password']) ? $this->data[$this->alias]['password'] : '';
        $confirmPassword = isset($this->data[$this->alias]['confirm_password']) ? $this->data[$this->alias]['confirm_password'] : '';
        return $password === $confirmPassword;
    }

    public function validateFile($check, $extensions) {
        $file = array_shift($check);
        if (is_array($file) && isset($file['name']) && $file['error'] == 0) {
            $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            return in_array($extension, $extensions);
        }
        return false;
    }
}

?>
