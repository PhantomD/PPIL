<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class User extends AppModel{


	public $validate = array(
		'pseudo' => array(
			array(
				'rule' => 'alphanumeric',
				'required' => true,
				'message' => "seuls les chiffres et lettres sont autorisées pour le speudo.",
				'allowEmpty' =>false,
				),
			array(
				'rule' => 'isUnique',
				'message' => "Le login est déjà pris"
				),
			array(
 		'rule'    => array('between', 5, 15),
        'message' => "Le pseudo doit avoir une longueur comprise entre 5 et 15 caractéres."
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
			array(
			'rule' => 'alphanumeric',
			'required' => true,
			'allowEmpty' =>false,
			'message ' => "seuls les chiffres et lettres sont autorisées pour le mot de passe."
			),
			array(
 		'rule'    => array('between', 5, 15),
        'message' => "Le mot de passe doit avoir une longueur comprise entre 5 et 15 caractéres."
				)

			),
		'name' => array(
			'rule' => '/^[a-zA-Z]+$/',
			'required' => 'true',
			'allowEmpty' => false,
			'message' => "Nom non valide."
			),
		'firstname' => array(
			'rule' => '/^[a-zA-Z]+$/',
			'required' => 'true',
			'allowEmpty' => false,
			'message' => "Prénom non valide."
			),
		'birthdate' => array(
			'rule' => '/^[0-9]{4,4}-[0-9]{2,2}-[0-9]{2,2}$/',
			'required' => true,
			'allowEmpty' => false,
			'message' => "date anniversaire non valide"
			),
		'gender' => array(
			'rule' => '/^[0|1]{1,1}$/',
			'required' => true,
			'allowEmpty' => false,
			'message' => "choississez votre sexe"
			),
		'passwordConfirmation' => array(
			'rule'    => array('estEgal','password'),
			'message' => 'les 2 mots de passes sont différents.'
			),
		'mailConfirmation' => array(
			'rule'    => array('estEgal','email'),
			'message' => 'les 2 mails sont différents.'
			)
		);



//fonction de hachage du mot de passe avant la sauvegarde des données
public function beforeSave($options = array()) {
    if (isset($this->data[$this->alias]['password'])) {
        $passwordHasher = new SimplePasswordHasher();
        $this->data[$this->alias]['password'] = $passwordHasher->hash(
            $this->data[$this->alias]['password']
        );
    }
    return true;
}

}
?>

