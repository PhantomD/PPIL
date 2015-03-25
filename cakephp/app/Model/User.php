<?php

class User extends AppModel{


public $validate = array(
	'pseudo' => array(
		array(
			'rule' => 'alphanumeric',
			'required' => true,
			'message' => "Le login n'est pas correct",
			'allowEmpty' =>false,
			),
		array(
			'rule' => 'isUnique',
			'message' => "Le login est déjà pris"
			)
		),
		'email' => array(
		array(
			'rule' => 'email',
			'required' => true,
			'message' => "l'adresse mail n'est pas correct",
			'allowEmpty' =>false,
			),
		array(
			'rule' => 'isUnique',
			'message' => "l'adresse mail est déjà prise"
			)
		),
			'password' => array(
			'rule' => 'notEmpty',
			'allowEmpty' =>false,
			'message ' => "Vous devez entrer un mot de passe"
			),
			'name' => array(
				'rule' => '/^[a-zA-Z]+$/',
				'required' => 'true',
				'message' => "nom non valide"
				),
			'firstname' => array(
				'rule' => '/^[a-zA-Z]+$/',
				'required' => 'true',
				'message' => "prenom non valide"
				),
			'birthdate' => array(
				'rule' => '/^[0-9]{4,4}-[0-9]{2,2}-[0-9]{2,2}$/',
				'required' => 'true',
				'message' => "date anniversaire non valide"
				)


		);

}
?>

