<?php

class Task extends AppModel{
	public $useTable = 'tasks';
		public $validate = array(
			'name' => array(
				'rule' => 'alphanumeric',
				'required' => true,
				'allowEmpty' =>false,
				'message' => "Veuillez compléter ce champ.",
				));
}
