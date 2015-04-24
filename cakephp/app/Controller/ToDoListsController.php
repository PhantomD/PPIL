<?php

class TodolistsController extends AppController{

	function beforeFilter(){
		parent::beforeFilter();
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
			$this->Todolist->set($data);	

			if ($this->Todolist->validates()){

				// On sauvegarde les données dans la BDD
				$this->Todolist->save($data);
				$this->Session->setFlash(__('liste ajoutée'),'default', array('class' => 'flash-message-success'));
				$this->redirect(array('action'=>'consulterlist'));
			} else {
				$this->Session->setFlash(__('erreur liste non ajoutée'),'default', array('class' => 'flash-message-error'));
			}
		}

	}

	public function modifylist($name){

		if($this->request->is('post')){
			$data = $this->request->data;

			// Conversion des dates dans le bon format
			$tableaudateDebut = explode("/",$data['Todolist']['dateBegin']);
			if(count($tableaudateDebut)==3)
				$data['Todolist']['dateBegin'] = $tableaudateDebut[2]."-".$tableaudateDebut[1]."-".$tableaudateDebut[0];


			$tableaudateEnd = explode("/",$data['Todolist']['dateEnd']);
			if (count($tableaudateEnd)==3)
				$data['Todolist']['dateEnd'] = $tableaudateEnd[2]."-".$tableaudateEnd[1]."-".$tableaudateEnd[0];


				// On envoie les données à la vue
			$this->Todolist->set($data['Todolist']);

				// On sauvegarde les données dans la BDD
			$nom = $list['name']['0'];
			debug($data['Todolist']);
			
			if ($this->Todolist->validates()){
				debug($data);

				$this->Todolist->updateAll(
					array('Todolist.name' => "'".$data['Todolist']['name']."'",
						'Todolist.text' => "'".$data['Todolist']['text']."'",
						'Todolist.dateBegin' => !empty($data['Todolist']['dateBegin']) ? "'".$data['Todolist']['dateBegin']."'" : NULL ,
						'Todolist.dateEnd' => !empty($data['Todolist']['dateEnd']) ? "'".$data['Todolist']['dateEnd']."'" : NULL
						),
					array('Todolist.name' => $name));
				return $this->redirect($this->Auth->redirect(array('controller' => 'Todolists', 'action' => 'consulterlist')));
			}
			else{
				$this->Session->setFlash(__('erreur liste non modifiée'),'default', array('class' => 'flash-message-error'));
			}
		} else {
			// On recupere les données de la liste associées au nom
			$data['liste'] = $this->Todolist->find('first', array('conditions'=> array('Todolist.name'=>$name)));
			$data['liste'] = current($data['liste']);

		// On passe les variables à la vues 
			$this->set($data);
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