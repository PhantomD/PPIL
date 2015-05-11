<?php

use App\Facebook\FacebookConnect;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;

App::uses('autoload', 'Vendor\vendor\ ');
App::uses('FacebookConnect', 'Vendor');


class UsersController extends AppController
{

    public $uses = array('User', 'TodolistUser');

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('inscription', 'login', 'connexionFacebook'));
    }


    /**
     * Fonction appelée à chaque appelle d'une fonction du controlleur Users
     * Elle permet de savoir si un utilisateur est autorisé ou non à accéder à ce contenu
     * @param $user l'utilisateur actuelle
     * @return bool, l'autorisation d'accès
     */
    function isAuthorized($user)
    {

        if ($this->action == "connexionFacebook" && AuthComponent::user('id') != NULL) {
            $this->redirect($this->Auth->loginRedirect);
        }

        // seul les personnes connecté via facebook peuvent effectuer ces actions
        if (in_array($this->action, array('myfriends', 'addMember', 'removeMember'))) {

            if (!$this->Session->check('fb_token')) {
                $this->Auth->authError = "Vous devez vous connecter avec facebook pour accèder à cette fonctionnalitée";

                if ($this->action === "myfriends") {
                    $this->Auth->unauthorizedRedirect = array('controller' => 'Users', 'action' => 'profil');
                } else {
                    $id_liste = $this->request->params['pass'][0];
                    $this->Auth->unauthorizedRedirect = array('controller' => 'Todolists', 'action' => 'consulterlistdetail', $id_liste);
                }

                return false;
            }
        }

        if (parent::isAuthorized($user)) {
            return true;
        }

        return true;
    }


    /**
     * Fonction appelée à lorsque l'utilisateur veut se connecter via facebook
     * Si l'zuthentification facebook est réussi : Soit c'est ça première connecion et on l'ajoute dans la bdd, soit on le connecte directement
     */
    public function connexionFacebook()
    {

        $this->autoRender = false;

        if (!AuthComponent::user('id') == NULL) {
            $this->redirect($this->Auth->loginRedirect);
        }

        if (!$this->Session->check('fb_token')) {
            session_start();
        }

        $connect = new FacebookConnect($this->appId, $this->appSecret);


        try {
            $user = $connect->connect("http://sandbox.com/PPIL/cakephp/Users/connexionFacebook");

            if (is_string($user)) {

                $this->redirect($user);

            } else {


                $idFb = $user->getId();
                $email = $user->getEmail();

                $profil = $this->User->find('first', array('conditions' => array('OR' => array(
                    array('User.id_facebook' => $idFb),
                    array('User.email' => $email)))));


                if (empty($profil)) {


                    $profil['id_facebook'] = $idFb;
                    $profil['firstname'] = $user->getFirstName();
                    $profil['name'] = $user->getLastName();
                    $profil['birthdate'] = $user->getBirthday();
                    $profil['birthdate'] = $profil['birthdate']->format('d-m-Y');
                    $profil['gender'] = $user->getGender();
                    $profil['password'] = "aa";
                    $profil['email'] = $email;

                    if ($profil['gender'] === 'male') {
                        $profil['gender'] = 1;
                    } else {
                        $profil['gender'] = 0;
                    }

                    $this->User->set($profil);

                    $this->User->validator()->remove("password");
                    if ($this->User->validates(array('fieldList' => array('email', 'name', 'firstname', 'gender', 'birthdate')))) {

                        $this->User->save();
                        $id = $this->User->getLastInsertID();;
                        $profil = array_merge($profil, array('id' => $id));
                    }

                }

                unset($profil['password']);
                $profil = current($profil);
            }

            if ($this->Auth->login($profil)) {
                $this->initialisationSession();
                $this->redirect($this->Auth->loginRedirect);

            } else {
                echo "ou pas";
            }

        } catch (Exception $e) {
            debug($e);
        }

    }


    public function login()
    {

        //si un utilisateur est deja connecté, on verifie la variable id dans sa session si non null alors on le renvoie vers l'url redirect
        if (!AuthComponent::user('id') == NULL) {

            $this->redirect($this->Auth->loginRedirect);
        }

        //si c'est un POST
        if ($this->request->is('post')) {

            //on essaye de se connecter
            if ($this->Auth->login()) {

                $this->Session->setFlash(__('Bienvenue'), 'default', array('class' => 'flash-message-success'));

                $this->initialisationSession();

                $this->redirect($this->Auth->loginRedirect);

            } else {

                $this->Session->setFlash(__('Les informations transmises n\'ont pas permis de vous authentifier'), 'default', array('class' => 'flash-message-error'));
            }
        }
    }


    public
    function logout($desinscription = null)
    {
        $this->Session->destroy();

        if ($desinscription) {
            $this->Session->setFlash(__('Désinscription réussie', null),
                'default',
                array('class' => 'flash-message-success'));
        } else {
            $this->Session->setFlash(__('Déconnexion réussie', null),
                'default',
                array('class' => 'flash-message-success'));
        }

        $this->redirect($this->Auth->logout());
    }


    public function inscription()
    {

        if (!AuthComponent::user('id') == NULL) {
            $this->redirect($this->Auth->redirectUrl());
        }

        if ($this->request->is('post')) {
            $data = $this->request->data;

            $data['User']['birthdate'] = str_replace('/', '-', $data['User']['birthdate']);

            // on envoie les données au modèle
            $this->User->set($data);
            // on teste si les données sont valides, cf model User validate

            if ($this->User->validates(array('fieldList' => array('email', 'name', 'firstname', 'gender', 'birthdate', 'password', 'passwordConfirmation', 'mailConfirmation')))) {
                $this->User->save($data);
                $this->Session->setFlash(__('nouvel utilisateur inscrit', null),
                    'default',
                    array('class' => 'flash-message-success'));
                $this->redirect('/users/login');

            }
        }

    }


    public function profil()
    {

        $user = AuthComponent::user();
        $data['profil'] = $this->User->find('first', array('conditions' => array('User.id' => $user['id']),
            'fields' => array('User.name', 'User.firstname', 'User.birthdate', 'User.email')
        ));
        $data['profil'] = current($data['profil']);

        $this->set($data);
    }


    public function modificationProfil($type = null)
    {

        $user = AuthComponent::user();

        if ($this->request->is('post')) {

            $profil = $this->request->data;

            // modification informations personnelles
            if ($type === 'infos') {

                $data = $this->User->find('first', array('conditions' => array('User.id' => $user['id']),
                    'fields' => array('User.email')));
                $oldMail = $data['User']['email'];

                $profil['User']['birthdate'] = str_replace('/', '-', $profil['User']['birthdate']);

                if ($profil['User']['email'] === $oldMail && empty($profil['User']['mailConfirmation'])) {
                    $profil['User']['mailConfirmation'] = $profil['User']['email'];
                }

                $this->User->set($profil);

                $this->User->validator()->remove('email', 'estUnique');


                if ($this->User->validates(array('fieldList' => array('email', 'name', 'firstname', 'gender', 'birthdate', 'mailConfirmation')))) {

                    $profil = current($profil);


                    $profil['birthdate'] = $this->dateFormatBeforeSave($profil['birthdate']);

                    debug($profil['birthdate']);

                    $this->User->updateAll(
                        array('User.name' => "'" . $profil['name'] . "'",
                            'User.firstname' => "'" . $profil['firstname'] . "'",
                            'User.gender' => "'" . $profil['gender'] . "'",
                            'User.email' => "'" . $profil['email'] . "'",
                            'User.birthdate' => "'" . $profil['birthdate'] . "'"),
                        array('User.id' => $user['id'])
                    );

                    $this->Session->setFlash(__('les informations personnelles ont été mises à jour', null),
                        'default',
                        array('class' => 'flash-message-success'));

                    $this->redirect(array('action' => 'profil'));
                }

                // modification mdp
            } elseif ($type === "mdp") {
                $profil = current($profil);
                //debug($profil);

                $passwordHasher = new SimplePasswordHasher();
                $oldpassword = $passwordHasher->hash($profil['oldpassword']);

                $data = $this->User->find('first', array('conditions' => array('User.id' => $user['id']),
                    'fields' => array('User.password')));
                $mdpCourant = $data['User']['password'];

                $profil['mdpCourant'] = $mdpCourant; //mot de passe d'origine
                $profil['oldpassword'] = $oldpassword; //mot de passe saisie par l'utilisateur

                $this->User->set($profil);

                if ($this->User->validates(array('fieldList' => array('oldpassword', 'password', 'passwordConfirmation')))) { // si ancien mdp correct

                    $nouveauMdp = $passwordHasher->hash($profil['password']);

                    $this->User->updateAll(
                        array('User.password' => "'" . $nouveauMdp . "'"),
                        array('User.id' => $user['id'])
                    );

                    $this->Session->setFlash(__('le mot de passe a été changé', null),
                        'default',
                        array('class' => 'flash-message-success'));
                    $this->redirect(array('action' => 'profil'));
                }
            }

        }
        // non post
        $user = AuthComponent::user();
        $data['profil'] = $this->User->find('first', array('conditions' => array('User.id' => $user['id'])));
        $data['profil'] = current($data['profil']);
        $this->set($data);

    }


    public function desinscription()
    {

        $this->autoRender = false;

        $user = AuthComponent::user();
        $data = $this->User->find('first', array('conditions' => array('User.id' => $user['id']),
            'fields' => array('User.password')));


        $mdpCourant = $data['User']['password'];

        $mdpSaisie = $this->request->data['User']['password'];

        $passwordHasher = new SimplePasswordHasher();
        $mdpSaisie = $passwordHasher->hash($mdpSaisie);


        if ($mdpSaisie === $mdpCourant) {


            if ($this->User->delete($user['id'])) {

                $this->logout(true);

                //  $this->redirect(array('controller' => 'Users', 'action' => 'logout'));
            }
        } else {
            $this->Session->setFlash(__('le mot de passe saisie est incorrect', null),
                'default',
                array('class' => 'flash-message-error'));

            $this->redirect(array('controller' => 'Users', 'action' => 'modificationProfil'));
        }
    }


    public function myfriends()
    {

        FacebookSession::enableAppSecretProof(false);
        $friends = FacebookConnect::getFriends();

        $friends['amis'] = $friends['data'];

        $this->set($friends);
    }


    public function Friend_profil($id)
    {


        if ($id == null && empty($id) && is_int($id)) {
            $this->redirect($this->referer());
        }

        FacebookSession::enableAppSecretProof(false);
        $friends = FacebookConnect::getFriendProfil($id);

        //  $profil['firstname'] = $friends->getFirstName();
        $profil['name'] = $friends['name'];
        $profil['birthdate'] = $friends['birthday'];
        $profil['gender'] = $friends['gender'];
        $dataBD = current($this->User->find('first', array('recursive' => '-1', 'conditions' => array('id_facebook' => $id),
            'fields' => array('User.email', 'User.birthdate'))));


        $profil['email'] =  $dataBD['email'];

        if ($profil['birthdate'] == ""){
            $tab = explode("-", $dataBD['birthdate']);
            if(count($tab)==3)
            $profil['birthdate'] = $tab[1]."/".$tab[2]."/".$tab[0];

        }

        $this->set($profil);
    }


    public function addListetoUser($id, $id_liste)
    {
        $this->autoRender = false;

        if ($this->request->is('ajax')) {

            $this->User->unbindModel(array('hasMany' => array('Todolist_user')));
            $data['todolist_id'] = $id_liste;
            $data['user_id'] = $id;

            $this->TodolistUser->set($data);
            $this->TodolistUser->save();

        }
    }


    public function addMember($id)
    {
        FacebookSession::enableAppSecretProof(false);
        $friends = FacebookConnect::getFriends();

        $friends['id'] = $id;

        foreach ($friends['data'] as $key => $value) {
            $friends['amis'][] = $value->id;
        }


        debug($friends['amis']);


        $this->TodolistUser->unbindModel(array('hasOne' => array('Todolist')));

        $d = $this->User->find("all", array('recursive' => 1, 'fields' => array('User.id', 'id_facebook', 'name', 'firstname'),
            'conditions' => array('id_facebook !=' => '-1'),
            'contain' => array(
                'TodolistUser' => array(
                    'conditions' => array('todolist_id' => $id))
            )
        ));

        foreach ($d as $key => $value) {

            if (empty($value['TodolistUser']) && in_array($value['User']['id_facebook'], $friends['amis'])) {
                $data['amis'][] = $value['User'];
            }

        }

        debug($data);


        $data['id'] = $id;
        $this->set($data);

    }


    public function  removeMember($id, $id_liste)
    {

        if ($this->request->is('ajax')) {

            $this->autoRender = false;


            $this->TodolistUser->set($id);


            if ($id != AuthComponent::user()['id']) {
                $this->TodolistUser->delete($id, false);
            }

        } else {

            $this->TodolistUser->unbindModel(array('hasOne' => array('Todolist')));
            $users = $this->TodolistUser->find("all", array("conditions" => array(
                'todolist_id' => $id, 'id_facebook !=' => '-1'), 'fields' => array('TodolistUser.id', 'User.id', 'User.id_facebook')
            ));


            FacebookSession::enableAppSecretProof(false);

            foreach ($users as $key => $valeurs) {
                //$valeurs = current($valeurs);
                $profil = FacebookConnect::getFriendProfil($valeurs['User']['id_facebook']);

                $data['profil'][$key]['id'] = $valeurs['TodolistUser']['id'];
                $data['profil'][$key]['User_id'] = $valeurs['User']['id'];
                $data['profil'][$key]['name'] = $profil['name'];
            }

            $data['id'] = $id;
            $this->set($data);

        }
    }


    private function initialisationSession()
    {

        $id_user = AuthComponent::user('id');

        $d = $this->TodolistUser->find("all", array('recursive' => 1, 'fields' => array('Todolist.user_id', 'Todolist.id'), 'conditions' => array('TodolistUser.user_id' => $id_user)));


        //  $this->Session->write('Auth.User.Todolist'.NULL);
        foreach ($d as $key => $value) {
            $id_liste = $value['Todolist']['id'];
            $proprietaire = ($value['Todolist']['user_id'] == $id_user ? 1 : 0);
            $this->Session->write('Auth.User.Todolist.' . $id_liste, $proprietaire);
        }
    }


}