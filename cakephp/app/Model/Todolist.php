<?php

class Todolist extends AppModel{


		public $validate = array(
			'name' => array(
				'rule' => '/^[a-zA-Z0-9 ]*$/',
				'required' => true,
				'allowEmpty' =>false,
				'message' => "le nom de la liste est incorrect",
				),
			'text' => array(
				'rule' => '/^[a-zA-Z0-9 \'\"]*$/',
				'required' => false,
				'allowEmpty' => true,
				'message' => "symbole dans commentaire non autorisé",
				),
			'dateBegin' => array(
				'rule' => '/^[0-9]{4,4}-[0-9]{2,2}-[0-9]{2,2}$/',
				'required' => false,
				'allowEmpty' => true,
				'message' => "date de début invalide. Format JJ/MM/AAAA attendu",
				),
			'dateEnd' => array(
				'rule' => '/^[0-9]{4,4}-[0-9]{2,2}-[0-9]{2,2}$/',
				'required' => false,
				'allowEmpty' => true,
				'message' => "date de fin invalide. Format JJ/MM/AAAA attendu",
				));
	}