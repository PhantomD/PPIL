<?php

class ToDoListsController extends AppController{



	public function newToDoList(){
			if(isset($_POST['new']) and !empty($_POST['name']) and !empty($_POST['description']) and !empty($_POST['datebegin']) and !empty($_POST['dateend']) and !empty($_POST['frequency'])){
				$this->todolist->save(array(
					'name' => $_POST['name'],
					'text'=> $_POST['description'],
					'dateBegin'=>$_POST['datebegin'],
					'dateEnd' => $_POST['dateend'],
					'frequency' => $_POST['frequency']));
			}
			$this->Session->setFlash("ToDoList créee !");
	}


}