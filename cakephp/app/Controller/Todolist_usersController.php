<?php
class Todolist_usersController extends AppController {

	public function isAuthorized($user){
		return true;
	}

}