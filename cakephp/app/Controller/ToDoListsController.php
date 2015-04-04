<?php

class TodolistsController extends AppController{

	function beforeFilter(){
		$this->Auth->allow(array('newlist','modifylist','taillelist','consulterlist','consulterlistdetail'));
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

				// On envoie les données à la vue
				$this->Todolist->set($data);

				// On sauvegarde les données dans la BDD
				if ($this->Todolist->validates()){
					/*$this->Todolist->updateAll(array('Todolist.name' => $data['Todolist']['name'],
						'Todolist.text' => $data['Todolist']['text'],
						'Todolist.dateBegin' => $data['Todolist']['dateBegin'],
						'Todolist.dateEnd' => $data['Todolist']['dateEnd']),array('Todolist.name' => $name));*/
					return $this->redirect($this->Auth->redirect(array('controller' => 'Todolists', 'action' => 'consulterlist')));
				}
				else{
					$this->Session->setFlash(__('erreur liste non modifiée'),'default', array('class' => 'flash-message-error'));
				}
			}
	}

	public function taillelist(){
		// retourne le nombre de todolist
		$taille = $this->Todolist->find('count');
		return $taille;

	}

	public function consulterlist(){

		// On récupère le nom des todolists
		$lists = array('name' => $this->Todolist->find('all', array('fields' => array('Todolist.name'))));
		// On envoie les données à la vue
		$this->set($lists);

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