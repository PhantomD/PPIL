<?php

class ToDoListsController extends AppController{

	function beforeFilter(){
		$this->Auth->allow(array('newlist','newlist'));
	}




	public function newlist(){
		debug($this->request->name);
			if(isset($_POST['Valider']) and !empty($_POST['Name']) and !empty($_POST['Description']) and !empty($_POST['Datebegin']) and !empty($_POST['Dateend']) and !empty($_POST['Frequency'])){
				$this->toDoList->save(array(
					'name' => $_POST['name'],
					'text'=> $_POST['description'],
					'dateBegin'=>$_POST['datebegin'],
					'dateEnd' => $_POST['dateend'],
					'frequency' => $_POST['frequency']));
				$this->Session->setFlash("ToDoList créee !");
				return $this->redirect($this->Auth->redirect(array('controller' => 'Users', 'action' => 'inscription')));
			}
	}

	public function modifylist(){

	}

	public function deletelist(){

	}


}