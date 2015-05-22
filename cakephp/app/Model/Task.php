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
    public $actsAs = array('Containable');


    public $belongsTo = array(
        'User' => array(
            'fields' => array('name', 'firstname', 'id'),
            'foreignKey' => 'user_id',
            'dependent' => false)
    );


    public $hasMany = array(
        'Commentary' => array(
            'className' => 'Commentary',
            'foreignKey' => 'task_id',
            'dependent' => true,
        ),
    );


    public $validate = array(
        'name' => array(
            'rule' => '/^[\'"a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]{1,60}$/',
            'required' => true,
            'allowEmpty' => false,
            'message' => "Veuillez compléter ce champ correctement(alphanumeric)",


            'Comment' => array(
                'rule' => '/^[\'"a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]{1,60}$/',
                'required' => false,
                'allowEmpty' => true,
                'message' => "Veuillez compléter le commentaire correctement (alphanumeric)",
            )));
}

