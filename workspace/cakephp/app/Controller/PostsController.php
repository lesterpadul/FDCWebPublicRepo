<?php
class PostsController extends AppController {
	//public $uses = array();
    public $helpers = array('Html', 'Form');
	public function index (){
        $posts = $this->Post->find('all');
        $this->set('posts', $posts);
	}
}