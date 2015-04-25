<?php
class Todolist_usersController extends AppController {
	public $scaffold;



	public function isAuthorized($user){
  return true;
    }

}