<?php

class TodolistsController extends AppController{

	function beforeFilter(){
	
	}




	public function newlist(){

		if($this->request->is('post')){
			$data = $this->request->data;
			debug($data);

				// Conversion des dates dans le bon format
			$tableaudateDebut = explode("/",$data['Todolist']['dateBegin']);
			if(count($tableaudateDebut)==3)
				$data['Todolist']['dateBegin'] = $tableaudateDebut[2]."-".$tableaudateDebut[1]."-".$tableaudateDebut[0];


			$tableaudateEnd = explode("/",$data['Todolist']['dateEnd']);
			if (count($tableaudateEnd)==3)
				$data['Todolist']['dateEnd'] = $tableaudateEnd[2]."-".$tableaudateEnd[1]."-".$tableaudateEnd[0];
			
				// On envoie les données à la vue
			$this->Todolist->set($data['Todolist']);


			if ($this->Todolist->validates()){

				// On sauvegarde les données dans la BDD
				$this->Todolist->save($data);
				$this->redirect(array('controller'=>'Users', 'action'=>'main'));
			} else {
				$this->Session->setFlash(__('erreur liste non ajouté'),'default', array('class' => 'flash-message-error'));
			}
		}

	}

	public function modifylist($name){
		// On recupere les données de la liste associées au nom
		$list = array('name' => $this->Todolist->find('all', array('fields' => array('Todolist.name'),'conditions' => array('Todolist.name' => $name))),
			'text' => $this->Todolist->find('all', array('fields' => array('Todolist.text'),'conditions' => array('Todolist.name' => $name))),
			'dateBegin' => $this->Todolist->find('all', array('fields' => array('Todolist.dateBegin'),'conditions' => array('Todolist.name' => $name))),
			'dateEnd' => $this->Todolist->find('all', array('fields' => array('Todolist.dateEnd'),'conditions' => array('Todolist.name' => $name))),
			'frequency' => $this->Todolist->find('all', array('fields' => array('Todolist.frequency'),'conditions' => array('Todolist.name' => $name)))  );


			// On passe les variables à la vues 
			$this->set($list);

			if($this->request->is('post')){
				$data = $this->request->data;

				// Conversion des dates dans le bon format
			//	$tableaudateDebut = explode("/",$data['Todolist']['dateBegin']);
			//	$data['Todolist']['dateBegin'] = $tableaudateDebut[2]."-".$tableaudateDebut[1]."-".$tableaudateDebut[0];
			//	$tableaudateEnd = explode("/",$data['Todolist']['dateEnd']);
			//	$data['Todolist']['dateEnd'] = $tableaudateEnd[2]."-".$tableaudateEnd[1]."-".$tableaudateEnd[0];

				// On envoie les données à la vue
				$this->Todolist->set($data);

				// On sauvegarde les données dans la BDD
				$this->Todolist->save($data);

				// On supprimer l'ancienne donnée
				$this->Todolist->deleteAll(array('Todolist.name' => $name), false);

				return $this->redirect($this->Auth->redirect(array('controller' => 'Todolists', 'action' => 'consulterlist')));
			}
	}

	public function taillelist(){
		// retourne le nombre de todolist
		$taille = $this->Todolist->find('count');
		return $taille;

	}

	public function consulterlist($ligne){

		// On récupère le nom des todolists
		$list = $this->Todolist->find('all', array(
			'fields' => array('Todolist.name'),
			'order' => array('dateBegin DESC')	));

			return $list["$ligne"]["Todolist"]["name"];

	}

	public function consulterlistdetail($nom){

		// On recupere les données de la liste associées au nom
		$list = array('name' => $this->Todolist->find('all', array('fields' => array('Todolist.name'),'conditions' => array('Todolist.name' => $nom))),
			'text' => $this->Todolist->find('all', array('fields' => array('Todolist.text'),'conditions' => array('Todolist.name' => $nom))),
			'dateBegin' => $this->Todolist->find('all', array('fields' => array('Todolist.dateBegin'),'conditions' => array('Todolist.name' => $nom))),
			'dateEnd' => $this->Todolist->find('all', array('fields' => array('Todolist.dateEnd'),'conditions' => array('Todolist.name' => $nom))),
			'frequency' => $this->Todolist->find('all', array('fields' => array('Todolist.frequency'),'conditions' => array('Todolist.name' => $nom)))  );


			// On passe les variables à la vues 
			$this->set($list);

	}


}