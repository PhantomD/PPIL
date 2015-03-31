<?php

class Todolist extends AppModel{

		public $validate = array(
			'name' => array(
				'rule' => 'alphanumeric',
				'required' => true,
				'allowEmpty' =>false,
				'message' => "le nom de la liste est incorrect",
				),
			'text' => array(
				'rule' => 'alphanumeric',
				'required' => false,
				'allowEmpty' =>true,
				'message ' => "commentaire de la liste incorect",
				),
			'dateBegin' => array(
				'rule' => '/^[0-9]{4,4}-[0-9]{2,2}-[0-9]{2,2}$/',
				'required' => false,
				'allowEmpty' => true,
				'message' => "date de début invalide",
				),
			'dateEnd' => array(
				'rule' => '/^[0-9]{4,4}-[0-9]{2,2}-[0-9]{2,2}$/',
				'required' => false,
				'allowEmpty' => true,
				'message' => "date de fin invalide",
				));
	}