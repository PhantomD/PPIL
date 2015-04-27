<?php

use App\Facebook\FacebookConnect;

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


    function isAuthorized($user)
    {

        if (parent::isAuthorized($user)) {
            return true;
        }

        return true;
    }


    public function connexionFacebook($data = null)
    {

        if (!AuthComponent::user('id') == NULL) {
            $this->redirect($this->Auth->loginRedirect);
        }

        session_start();
        $this->autoRender = false;

        $connect = new FacebookConnect($this->appId, $this->appSecret);


        try {
            $user = $connect->connect("http://sandbox.com/PPILFINAL/PPIL/cakephp/Users/connexionFacebook/");

            if (is_string($user)) {

                $this->redirect($user);

            } else {

                $idFb = $user->getId();
                $email = $user->getEmail();

                $profil = $this->User->find('first', array('conditions' => array('OR' => array(
                    array('User.id_facebook' => $idFb),
                    array('User.email' => $email)))));


                if (empty($profil)) {
                    debug($user);

                    $profil['id_facebook'] = $idFb;
                    $profil['firstname'] = $user->getFirstName();
                    $profil['name'] = $user->getLastName();
                    $profil['birthdate'] = $user->getBirthday();
                    $profil['birthdate'] = $profil['birthdate']->format('d-m-Y');
                    $profil['gender'] = $user->getGender();
                    $profil['password'] = '00';
                    $profil['email'] = $email;

                    if ($profil['gender'] === 'male') {
                        $profil['gender'] = 1;
                    } else {
                        $profil['gender'] = 0;
                    }

                    $this->User->set($profil);

                    debug($profil);

                    $this->User->validator()->remove("password");
                    if ($this->User->validates(array('fieldList' => array('email', 'name', 'firstname', 'gender', 'birthdate')))) {

                        debug($this->User->save());
                        $id = $this->User->getLastInsertID();;
                        debug($id);
                        debug(rr);
                        $profil = array_merge($profil, array('id' => $id));
                    } else {
                        debug($this->User->validationErrors);
                    }
                    echo "non trouvé";

                }


                $user = $connect->getFriends();
                debug($user);

                die();


                unset($profil['password']);
                $profil=current($profil);
            }

            if ($this->Auth->login($profil)) {
                $this->initialisationSession();
                $this->redirect($this->Auth->loginRedirect);
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


    public function logout()
    {
        $this->Session->destroy();
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

                $this->Session->setFlash(__('utilisateur supprimé', null),
                    'default',
                    array('class' => 'flash-message-success'));

                $this->redirect(array('controller' => 'Users', 'action' => 'logout'));
            }
        } else {
            $this->Session->setFlash(__('le mot de passe saisie est incorrect', null),
                'default',
                array('class' => 'flash-message-error'));

            $this->redirect(array('controller' => 'Users', 'action' => 'modificationProfil'));
        }
    }




    private function initialisationSession(){

        $id_user = AuthComponent::user('id');

        $d = $this->TodolistUser->find("all", array('recursive' => 1, 'fields' => array('Todolist.user_id', 'Todolist.id'), 'conditions' => array('TodolistUser.user_id' => $id_user)));

        foreach ($d as $key => $value) {
            $id_liste = $value['Todolist']['id'];
            $proprietaire = ($value['Todolist']['user_id'] == $id_user ? 1 : 0);
            $this->Session->write('Auth.User.Todolist.' . $id_liste, $proprietaire);
        }

    }





}