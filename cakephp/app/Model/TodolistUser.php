<?php
class TodolistUser extends AppModel{

 
	 public $hasOne = array(
        'Todolist' => array(
        	'foreignKey'=>false,
        	'conditions' => array('TodolistUser.todolist_id=Todolist.id'),
            'dependent' => false
        )
    );




}