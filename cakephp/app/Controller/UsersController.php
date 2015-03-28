<?php
class UsersController extends AppController{

	public $scaffold;
//	public $uses =...;


	function beforeFilter(){
		//on autorise l'inscription,la connexion 
		$this->Auth->allow(array('inscription','login'));
	}


public function login(){

		//si un utilisateur est deja connecter, on verifie la variable id dans sa session si non null alors on le renvoie vers son profil
		if( !AuthComponent::user('id')==NULL){

			$this->redirect($this->Auth->redirectUrl());
		}


		//si c'est un POST
		if($this->request->is('post')){

			//on essaye de se connecter
			if($this->Auth->login()){

				$this->Session->setFlash('<strong>Felicitation</strong>');

				$this->redirect('/users/profil');

			}else{
		
					$this->Session->setFlash('<strong>Erreur de Mot de passe ou de pseudo</strong>');
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
			$tableauBirthday = explode("/",$data['User']['birthdate']);
			$data['User']['birthdate'] = $tableauBirthday[2]."-".$tableauBirthday[1]."-".$tableauBirthday[0];

			// on envoie les données au modèle
			$this->User->set($data);

			// on teste si les données sont valides, cf model User validate
			
			if ($this->User->validates()) {

				$mdp = $data['mdpConfirmation'] == $data['User']['password'];
				$email = $data['mailConfirmation']==$data['User']['email'];

				if($mdp){
					if($email){
					
						$this->User->save($data);
						$this->redirect('/users/login');
						$this->Session->setFlash("nouveau utilisateur inscrit");
					} else {
						$erreur['mailConfirmation']= "les 2 mails sont différents";
						$this->set($erreur);
					}
				} else {
					$erreur['mdpConfirmation'] = "les 2 mots de passes sont différents";
					$this->set($erreur);
				}


			} else {
				$erreur['erreurs'] = $this->User->validationErrors;
				$this->set($erreur);

			}
		}
	}

	public	function profil(){
		
	}



	public function main(){

	}

}