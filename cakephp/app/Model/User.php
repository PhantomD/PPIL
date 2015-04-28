<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel
{
    public $actsAs = array('Containable');
    public $hasMany = array(
        'TodolistUser' => array(
            'foreignKey' => 'user_id',
            'dependent' => true
        )
    );


    public $validate = array(

        'email' => array(
            array(
                'rule' => 'email',
                'required' => true,
                'message' => "l'adresse mail n'est pas correct",
                'allowEmpty' => false,
            ),
            'estUnique' => array(
                'rule' => 'isUnique',
                'message' => "l'adresse mail est déjà prise")

        ),
        'password' => array(
            array(
                'rule' => 'alphanumeric',
                'required' => true,
                'allowEmpty' => false,
                'message ' => "seuls les chiffres et lettres sont autorisées pour le mot de passe."
            ),
            array(
                'rule' => array('between', 6, 15),
                'message' => "Le mot de passe doit avoir une longueur comprise entre 6 et 15 caractéres."
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
            'rule' => '/^[0-9]{2,2}-[0-9]{2,2}-[0-9]{4,4}$/',
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
            'rule' => array('estEgal', 'password'),
            'message' => 'les 2 mots de passes sont différents.'
        ),
        'mailConfirmation' => array(
            'rule' => array('estEgal', 'email'),
            'message' => 'les 2 mails sont différents.'
        ),
        'oldpassword' => array(
            'rule' => array('estEgal', 'mdpCourant'),
            'message' => 'ancien mot de passe incorrect'
        )

    );


//fonction de hachage du mot de passe avant la sauvegarde des données
    public function beforeSave($options = array())
    {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }

        if (!empty($this->data[$this->alias]['birthdate'])) {

            $this->data[$this->alias]['birthdate'] = $this->dateFormatBeforeSave($this->data[$this->alias]['birthdate']);

        }

        return true;
    }

    public function dateFormatBeforeSave($dateString)
    {
        return date('Y-m-d', strtotime($dateString));
    }

}

?>

