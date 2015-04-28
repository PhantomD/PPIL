<?php
class Todolist_user extends AppModel{
    public $actsAs = array('Containable');
	  public $hasOne = array(

          'User' => array(
              'foreignKey'=>false,
              'conditions' => array(' Todolist_user.user_id = User.id'),
              'dependent' => true
          ),
          'Todolist' => array(
              'foreignKey'=>false,
              'conditions' => array(' Todolist_user.todolist_id = Todolist.id'),
              'dependent' => true
          )
    );
}