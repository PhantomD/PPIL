<?php

class Notification extends AppModel
{
    public $hasOne = array(

        'User' => array(
            'foreignKey'=> false,
            'conditions' => array(' Notification.sender_id = User.id'),
            'fields'  => array('firstname','name'),
            'dependent' => true
        )
    );


}
