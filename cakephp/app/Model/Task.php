<?php

class Task extends AppModel
{

    /* public $belongsTo = array(
    'Todolist' => array(
        'className' => 'Todolist',
        'foreignKey' => 'id'
    )
);

*/
    public $validate = array(
        'name' => array(
            'rule' => '/^[a-zA-Z0-9 ]*$/',
            'required' => true,
            'allowEmpty' => false,
            'message' => "Veuillez compléter ce champ correctement(alphanumeric)",


            'Comment' => array(
                'rule' => '/^[a-zA-Z0-9 ]*$/',
                'required' => false,
                'allowEmpty' => true,
                'message' => "Veuillez compléter ce champ correctement (alphanumeric)",
            )));
}
