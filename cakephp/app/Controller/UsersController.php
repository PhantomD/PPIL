<?php
class UsersController extends AppController{

	public $scaffold;
//	public $uses =...;



	function beforeFilter(){
		$this->Auth->allow(array('inscription'));
	}

	function profil(){

	}


	public	function inscription(){
	//	$this->Session->setFlash('<strong>Felicitation</strong>', 'flash_info');
		$data = $this->request->data;
		$users = $this->User->find('all');

		if(! empty($data)){
		$data = $this->request->data;	
			debug($data);
			die();
		}



	}


}