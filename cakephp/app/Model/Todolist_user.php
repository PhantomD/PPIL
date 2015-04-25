<?php
class Todolist_user extends AppModel{

	  public $hasOne = array(
        'Todolist' => array(
        	'foreignKey'=>false,
        	'conditions' => array(' Todolist_user.todolist_id = Todolist.id'),
            'dependent' => true
        )
    );
}