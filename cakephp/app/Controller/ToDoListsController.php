<?php

class TodolistsController extends AppController{


	function beforeFilter(){
		parent::beforeFilter();
	}

	function isAuthorized($user){

		if(parent::isAuthorized($user)){
			return true;
		}

		if (in_array($this->action,array('modifylist','supprimer'))){
			$id_liste = $this->request->params['pass'][0];

			$liste_user = $this->Session->read('Auth.User.Todolist');

			if (in_array($id_liste,$liste_user)){
				return true;
			}
			
			$this->Auth->authError ="Seul le propriétaire de la liste peut modifier ou supprimer une liste";
			return false;
		}
		
		return true;
	}


	public function newlist($id_user){

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


	public function consulterlist(){

		// On récupère le nom des todolists
		$d['listes'] = $this->Todolist->find('all', array('recursive'=>-1,'fields' => array('Todolist.name, Todolist.id')));
		// On envoie les données à la vue
		$this->set($d);
	}

	public function supprimer($id_liste){

		$this->autoRender = false;

			if ($this->Todolist->delete($id_liste)){

				$this->Session->setFlash(__('liste supprimée', null), 
					'default', 
					array('class' => 'flash-message-success'));
			}

				return $this->redirect(array('controller'=>'Todolists','action' => 'consulterlist'));

		
	}


	public function consulterlistdetail($id){

		//$id = $this->request->params['id'];

		// On recupere les données de la liste associées au nom
		$d['liste'] = $this->Todolist->find('first', array('conditions' => array('Todolist.id'=>$id)));

		$data['liste'] = $d['liste']['Todolist'];
		$data['taches'] = $d['liste']['Task']; 
		
			// On passe les variables à la vues 
		$this->set($data);

	}

}