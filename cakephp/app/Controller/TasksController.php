<?php

class TasksController extends AppController{

	function beforeFilter(){
		parent::beforeFilter();
	}

	function isAuthorized($user){

		if(parent::isAuthorized($user)){
			return true;
		}

		if ($this->action ==='newtask'){
			$id_liste = $this->request->params['pass'][0];
			$liste_user = $this->Session->read('Auth.User.Todolist');

			if (in_array($id_liste,$liste_user)){
				return true;
			}
			$this->Auth->authError ="Vous n avez pas les autorisations recquis pour ajouter une tâche";
			return false;
		}
		
		return true;
	}


	public function newtask(){

			if($this->request->is('post')){
				$data = current($this->request->data);

				// On envoie les données à la vue
				$this->Task->set($data);
				
				if($this->Task->validates()){

				// On sauvegarde les données dans la BDD
				$this->Task->save($data);

				$this->Session->setFlash(__('tache ajoutée', null), 
				'default', 
				array('class' => 'flash-message-success'));

				}
				return $this->redirect($this->Auth->redirect(array('controller'=>'Todolists','action' => 'consulterlistdetail', 'id'=>$data['todolist_id'])));
			}

	}

	public function taillelist(){
		// retourne le nombre de l'élément
		$taille = $this->Task->find('count');
		return $taille;

	}


	public function consultertask($ligne){

		// On récupère le nom des éléments
		$task = $this->Task->find('all', array(
			'fields' => array('Task.name'),
			'order' => array('id DESC')	));

			return $task["$ligne"]["Task"]["name"];

	}

	public function consultertaskdetail($id){

		// On recupere les données de l'élément associées au nom
		$task = array('name' => $this->Task->find('all', array('fields' => array('Task.name'),'conditions' => array('Task.name' => $nom)))
			);


			// On passe les variables à la vues 
			$this->set($task);

	}

	public function supprimer($nom){
		$this->autoRender = false;
		if(!empty($nom)){
			if ($this->Tasks->deleteAll(array('Tasks.name'=>$nom))){
				$this->Session->setFlash(__('élément supprimé', null), 
					'default', 
					array('class' => 'flash-message-success'));
				return $this->redirect(array('controller'=>'Tasks','action' => 'consultertask'));
			}
		}
	}


}
