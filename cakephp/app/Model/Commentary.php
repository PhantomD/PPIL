<?php

class Commentary extends AppModel
{

    public $actsAs = array('Containable');

    public $hasOne = array(

        'Task' => array(
            'foreignKey'=>false,
            'conditions' => array('Commentary.task_id = Task.id'),
            'dependent' => false
        ));


    public $validate = array(
        'text' => array(
            'rule' => '/^[a-zA-Z0-9 ]*$/',
            'required' => true,
            'allowEmpty' => false,
            'message' => "Veuillez compléter ce champ correctement(alphanumeric)",


          ));
}
