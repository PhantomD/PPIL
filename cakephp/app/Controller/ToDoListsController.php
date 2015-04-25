<?php

class TodolistsController extends AppController{


	function beforeFilter(){
		parent::beforeFilter();
	}

	function isAuthorized($user){

		if(parent::isAuthorized($user)){
			return true;
		}

		$id_liste = $this->request->params['pass'][0];
		$liste_user = array_keys($this->Session->read('Auth.User.Todolist'));


		if ($this->action ==='consulterlistdetail'){
			if(!in_array($id_liste, $liste_user))
				return false;
		}

		if (in_array($this->action,array('modifylist','supprimer'))){

			$estProprio = $this->Session->Read('Auth.User.Todolist.'.$id_liste);

			if ($estProprio==1){
				return true;
			}
			$this->Auth->authError ="Seul le propriétaire de la liste peut modifier ou supprimer une liste";
			$this->Auth->unauthorizedRedirect= array('controller' => 'Todolists', 'action' => 'consulterlistdetail',$id_liste);
			///$this->redirect(array('action'=>'consulterlistdetail',$id_liste));
			return false;
		}
		
		return true;
	}


	public function newlist(){

//$this->Menu->getLastInsertId();
		if($this->request->is('post')){
			$data = $this->request->data;

			// 2 array car c'est une association hasmany
			$data['Todolist_user']=array(array('user_id'=>$data['Todolist']['user_id']));

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
				$this->Todolist->saveAssociated($data,array('deep'=>true,'atomic'=>true));

				$id = $this->Todolist->getLastInsertId();
				$this->Session->write('Auth.User.Todolist.'.$id, 1);

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


		$id_user = AuthComponent::user('id');
/*
    $this->Todolist->unbindModel( array('hasMany' => array('Task','Todolist_user')));
$d['listes'] = $this->Todolist->find('all', array(
            'recursive'=>-1,
            'fields' => array('Todolist.id'),
            'joins' => array(
                array(
                    'table' => 'todolist_users',
                    'alias' => 't',
                    'type' => 'INNER',
                    'conditions' => array(
                        't.todolist_id = todolist.id',
                        't.user_id' => $id_user
                    )
                )
            )
        ));
*/
$listes = $this->Session->read('Auth.User.Todolist');
$id_listes = array_keys($listes);
$this->Todolist->unbindModel( array('hasMany' => array('Task','Todolist_user')));
$d['listes'] = $this->Todolist->find('all',array('fields'=>array('id','name'),'conditions'=> array ('Todolist.id'=> $id_listes)));

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