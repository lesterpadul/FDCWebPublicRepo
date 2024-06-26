<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    // this will tell cakek to support php files for the view for rendering
    public $ext = '.php';
    

    // include the Post Model
    public $uses = array(
        'Post',
        'User'
    );

    // - include components
    public $components = array(
        'Flash',
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'home',
                'action' => 'login'
            ),
            // if the user is logged in
            'loginRedirect' => array(
                'controller' => 'home',
                'action' => 'index'
            ),

            // if teh user is not logged in AND accesses a forbidden action,
            'logoutRedirect' => array(
                'controller' => 'home',
                'action' => 'login'
            ),
            'authenticate' => array(
                'Form' => array(
                    // 'passwordHasher' => 'Blowfish',
                    // if you want to customize the fields for logging in
                    // 'fields'=>array('username'=>'email','password'=>'password')
                )
            )
        )
    );

    

    
    public function getUserData() {
        $userId = $this->Auth->user('id');
        $user = $this->User->findById($userId);
        return $user;
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $userData = $this->getUserData();

        if (!empty($userData) && isset($userData['User'])){
            $this->set('currentUser', $userData['User']);
        } else {
            $this->set('currentUser', array());
        }
        date_default_timezone_set('Asia/Manila');
    }
    
}
