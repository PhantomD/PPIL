<?php

class TasksController extends AppController{

	function beforeFilter(){
		parent::beforeFilter();

	}


	public function newtask(){

			if($this->request->is('post')){
				$data = $this->request->data['Task'];

				debug($data);

				// On envoie les données à la vue
				$this->Task->set($data);

				// On sauvegarde les données dans la BDD
				$this->Task->save($data);

				return $this->redirect($this->Auth->redirect(array('action' => 'consultertask')));
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

	public function consultertaskdetail($nom){

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
