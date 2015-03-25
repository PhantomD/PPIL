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

		if($this->request->is('post')){
			$data = $this->request->data;



			//cryptage mot de passe
			$data['User']['password'] = $this->Auth->password($data['User']['password']);

			//on met la date d'anniversaire dans le bon format
			$tableauBirthday = explode("/",$data['User']['birthdate']);
			$data['User']['birthdate'] = $tableauBirthday[2]."-".$tableauBirthday[1]."-".$tableauBirthday[0];

			// on envoie les données au modèle
			$this->User->set($data);

			// on teste si les données sont valides, cf model User validate
			if ($this->User->validates()) {
				$this->User->save($data);
				$this->Session->setFlash("nouveau utilisateur inscris");
			} else {
				$data['erreurs'] = $this->User->validationErrors;
				$this->set($data);
			}
		}
	}








}