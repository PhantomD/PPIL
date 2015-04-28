<?php
class TodolistUser extends AppModel{


    public $hasOne = array(

        'User' => array(
            'foreignKey'=>false,
            'conditions' => array(' TodolistUser.user_id = User.id'),
            'dependent' => false
        ),
        'Todolist' => array(
            'foreignKey'=>false,
            'conditions' => array(' TodolistUser.todolist_id = Todolist.id'),
            'dependent' => false
        )
    );




}