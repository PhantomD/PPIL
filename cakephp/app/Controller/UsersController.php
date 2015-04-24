<?php
class UsersController extends AppController{

	public $scaffold;
//	public $uses =...;


	function beforeFilter(){
		parent::beforeFilter();
		//on autorise l'inscription,la connexion 
		$this->Auth->allow(array('inscription','login','logout'));
	}
	
	public function login(){
		//si un utilisateur est deja connecté, on verifie la variable id dans sa session si non null alors on le renvoie vers l'url redirect
		if( !AuthComponent::user('id')==NULL){

			$this->redirect($this->Auth->loginRedirect);
		}


		//si c'est un POST
		if($this->request->is('post')){

			//on essaye de se connecter
			if($this->Auth->login()){

				$this->Session->setFlash(__('Bienvenue'),'default', array('class' => 'flash-message-success'));


				$this->redirect($this->Auth->loginRedirect);

			}else{

				$this->Session->setFlash(__('Les informations transmises n\'ont pas permis de vous authentifier'),'default', array('class' => 'flash-message-error'));
			}
		}
	}




	public function logout(){
	//recupere la variable definie dans Auth ( AppControler)
		return $this->redirect($this->Auth->logout());
	}




	public	function inscription(){


		if( !AuthComponent::user('id')==NULL){
			$this->redirect($this->Auth->redirectUrl());
		}

		if($this->request->is('post')){
			$data = $this->request->data;

			//cryptage mot de passe
			//$data['User']['password'] = $this->Auth->password($data['User']['password']);
			//on met la date d'anniversaire dans le bon format
			//if(count($tableaudateDebut)==3)
			$tableauBirthday = explode("/",$data['User']['birthdate']);

			if(count($tableauBirthday)==3){
				$data['User']['birthdate'] = $tableauBirthday[2]."-".$tableauBirthday[1]."-".$tableauBirthday[0];
			} else if (count($tableauBirthday)!=0){
				$data['User']['birthdate'] = "erreur in coming";
			}

			// on envoie les données au modèle
			$this->User->set($data);
			// on teste si les données sont valides, cf model User validate
			
			if ($this->User->validates(array('fieldList' => array('email','name','firstname','gender','birthdate','password','passwordConfirmation','mailConfirmation')))) {
				$this->User->save($data);
				$this->Session->setFlash(__('nouvel utilisateur inscrit', null), 
					'default', 
					array('class' => 'flash-message-success'));
				$this->redirect('/users/login');

			}
		}

	}




	public	function profil(){
		
		$user = AuthComponent::user();
		$data['profil'] = $this->User->find('first',array('conditions'=> array('User.id'=>$user['id']),
			'fields' =>array('User.name','User.firstname','User.birthdate','User.email')
			));
		$data['profil'] = current($data['profil'] );

		$this->set($data);
	}





	public function modificationProfil($type = null){

		$user = AuthComponent::user();

		if($this->request->is('post')){

			$profil = $this->request->data;

			// modification informations personnelles
			if($type === 'infos'){

				$data = $this->User->find('first',array('conditions'=> array('User.id'=>$user['id']),
					'fields' =>array('User.email')));
				$oldMail = $data['User']['email'];

				$tableauBirthday = explode("/",$profil['User']['birthdate']);
				if(count($tableauBirthday)==3){
					$profil['User']['birthdate'] = $tableauBirthday[2]."-".$tableauBirthday[1]."-".$tableauBirthday[0];
				}

				if($profil['User']['email']=== $oldMail && empty($profil['User']['mailConfirmation'])){
					$profil['User']['mailConfirmation'] = $profil['User']['email'];
				}

				$this->User->set($profil);

				$this->User->validator()->remove('email','estUnique');

				
				if($this->User->validates(array('fieldList' => array('email', 'name','firstname','gender','birthdate')))){

					$profil = current($profil);

					$this->User->updateAll(
						array('User.name' => "'".$profil['name']."'",
							'User.firstname'=> "'".$profil['firstname']."'",
							'User.gender'=> "'".$profil['gender']."'",
							'User.email'=> "'".$profil['email']."'",
							'User.birthdate'=> "'".$profil['birthdate']."'"),
						array('User.id' => $user['id'])
						);

					$this->Session->setFlash(__('les informations personnelles ont été mises à jour', null), 
						'default', 
						array('class' => 'flash-message-success'));

					$this->redirect(array('action'=>'profil'));
				}

			// modification mdp
			} elseif ($type==="mdp"){
				$profil = current($profil);
				//debug($profil);

				$passwordHasher = new SimplePasswordHasher();
				$oldpassword = $passwordHasher->hash($profil['oldpassword']);

				$data = $this->User->find('first',array('conditions'=> array('User.id'=>$user['id']),
					'fields' =>array('User.password')));
				$mdpCourant = $data['User']['password'];

				$profil['mdpCourant'] = $mdpCourant; //mot de passe d'origine
				$profil['oldpassword'] = $oldpassword; //mot de passe saisie par l'utilisateur

				$this->User->set($profil);

				if($this->User->validates(array('fieldList' => array('oldpassword','password','passwordConfirmation')))){ // si ancien mdp correct

					$nouveauMdp = $passwordHasher->hash($profil['password']);

					$this->User->updateAll(
						array('User.password' => "'".$nouveauMdp."'"),
						array('User.id' => $user['id'])
						);

					$this->Session->setFlash(__('le mot de passe a été changé', null), 
						'default', 
						array('class' => 'flash-message-success'));
					$this->redirect(array('action'=>'profil'));
				}	
			}

		} 
			// non post
		$user = AuthComponent::user();
		$data['profil'] = $this->User->find('first',array('conditions'=> array('User.id'=>$user['id'])));
		$data['profil'] = current($data['profil'] );
		$this->set($data);
		
	}




	public function desinscription(){

		$this->autoRender = false;

		$user = AuthComponent::user();
		$data = $this->User->find('first',array('conditions'=> array('User.id'=>$user['id']),
			'fields' =>array('User.password')));


		$mdpCourant = $data['User']['password'];

		$mdpSaisie = $this->request->data['User']['password'];
		
		$passwordHasher = new SimplePasswordHasher();
		$mdpSaisie = $passwordHasher->hash($mdpSaisie);


		if($mdpSaisie === $mdpCourant){


			if ($this->User->delete($user['id'])){
				
				$this->Session->setFlash(__('utilisateur supprimé', null), 
					'default', 
					array('class' => 'flash-message-success'));

				return $this->redirect(array('controller' => 'Users', 'action' => 'logout'));
			}
		} else {
			$this->Session->setFlash(__('le mot de passe saisie est incorrect', null), 
				'default', 
				array('class' => 'flash-message-error'));
			debug($test);
			return $this->redirect(array('controller' => 'Users', 'action' => 'modificationProfil'));
		}
	}
}