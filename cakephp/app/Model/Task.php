<?php

class Task extends AppModel{
	
		/* public $belongsTo = array(
        'Todolist' => array(
            'className' => 'Todolist',
            'foreignKey' => 'id'
        )
    );

*/
		public $validate = array(
			'name' => array(
				'rule' => 'alphanumeric',
				'required' => true,
				'allowEmpty' =>false,
				'message' => "Veuillez compléter ce champ.",
				));
}
