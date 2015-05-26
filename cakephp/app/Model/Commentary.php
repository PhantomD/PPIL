<?php

class Commentary extends AppModel
{

    public $actsAs = array('Containable');

    public $belongsTo = array(
        'Task' => array(
            'className' => 'Task',
            'dependent' => true
        ),
        'User' => array(
            'className' => 'User',
            'fields' => array('name', 'firstname'),
            'foreignKey' => 'user_id',
            'dependent' => false)
    );

    public $validate = array(
        'text' => array(
            'rule' => '/^[\'" ()a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]{1,60}$/',
            'required' => true,
            'allowEmpty' => false,
            'message' => "Veuillez compléter ce champ correctement(alphanumeric)",


        ));
}
