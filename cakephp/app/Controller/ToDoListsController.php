<?php


use App\Facebook\FacebookConnect;
use Facebook\FacebookSession;

App::uses('autoload', 'Vendor\vendor\ ');
App::uses('FacebookConnect', 'Vendor');

class TodolistsController extends AppController
{
    public $uses = array('Todolist', 'TodolistUser', 'Commentary', 'Notification');
    public $components = array('Paginator');

    function beforeFilter()
    {
        parent::beforeFilter();
    }


    /**
     * Fonction appelée à chaque appelle d'une fonction du controlleur ToDoLists
     * Elle permet de savoir si un utilisateur est autorisé ou non à accéder à ce contenu
     * Par exemple, seul le propriétaire de la liste peut supprimer la liste
     * @param $user l'utilisateur actuelle
     * @return bool, l'autorisation d'accès
     */
    function isAuthorized($user)
    {


        if (parent::isAuthorized($user)) {
            return true;
        }

        if ($this->action === 'newlist' || $this->action == "consulterlist" || $this->action == "refresh") {
            return true;
        }

        $liste_user = array_keys($this->Session->read('Auth.User.Todolist'));
        $id_liste = $this->request->params['pass'][0];

        if (!in_array($id_liste, $liste_user)) {
            return false;
        }

        if (in_array($this->action, array('supprimer'))) {

            $estProprio = $this->Session->Read('Auth.User.Todolist.' . $id_liste);

            if ($estProprio == 1) {
                return true;

            } else {
                $this->Auth->authError = "Seul le propriétaire de la liste peut  supprimer une liste";
                $this->Auth->unauthorizedRedirect = array('controller' => 'Todolists', 'action' => 'consulterlistdetail', $id_liste);
                return false;
            }
        }
        return true;
    }


    /**
     * Fonction appelée pour ajouter une nouvelle liste
     * Fonction accessible par tous les utilisateurs authentifiés
     */
    public function newlist()
    {

        if ($this->request->is('post')) {
            $data = $this->request->data;

            // 2 array car c'est une association hasmany
            $data['TodolistUser'] = array(array('user_id' => $data['Todolist']['user_id']));


            $data['Todolist']['dateBegin'] = str_replace('/', '-', $data['Todolist']['dateBegin']);
            $data['Todolist']['dateEnd'] = str_replace('/', '-', $data['Todolist']['dateEnd']);

            // On envoie les données à la vue
            $this->Todolist->set($data);


            if ($this->Todolist->validates()) {

                $this->Todolist->saveAssociated($data, array("deep" => true));
                $id = $this->Todolist->getLastInsertId();
                $this->Session->write('Auth.User.Todolist.' . $id, 1);
                $this->Session->setFlash(__('liste ajoutée'), 'default', array('class' => 'flash-message-success'));
                return $this->redirect(array('action' => 'consulterlist'));

            } else {
                $this->Session->setFlash(__('erreur liste non ajoutée'), 'default', array('class' => 'flash-message-error'));
            }
        }
    }


    /**
     * Fonction appelé pour modifier une liste
     * Fonction accessible par tous les utilisateurs qui sont inscris à la liste (l'autorisation est donnée ou non par la fonction isAuthorized
     * @param $id , id de la liste courante
     */
    public function modifylist($id)
    {


        $user = $this->TodolistUser->find('first', array('recursive' => -1, 'fields' => 'id', 'conditions' =>
                array('user_id' => AuthComponent::user()['id'], 'todolist_id' => $id)
            )
        );

        if (empty($user)) {
            $this->redirect(array('action' => 'consulterlist'));
        }

        //AuthComponent::user()['id']

        if ($this->request->is('post')) {
            $data = $this->request->data;


            // Conversion des dates dans le bon format
            $data['Todolist']['dateBegin'] = str_replace('/', '-', $data['Todolist']['dateBegin']);
            $data['Todolist']['dateEnd'] = str_replace('/', '-', $data['Todolist']['dateEnd']);

            // On envoie les données à la vue
            $this->Todolist->set($data['Todolist']);

            // On sauvegarde les données dans la BDD
            if ($this->Todolist->validates()) {

                if (!empty($data['Todolist']['dateBegin']))
                    $data['Todolist']['dateBegin'] = $this->dateFormatBeforeSave($data['Todolist']['dateBegin']);

                if (!empty($data['Todolist']['dateEnd']))
                    $data['Todolist']['dateEnd'] = $this->dateFormatBeforeSave($data['Todolist']['dateEnd']);

                $this->Todolist->updateAll(
                    array('Todolist.name' => "'" . $data['Todolist']['name'] . "'",
                        'Todolist.text' => "'" . $data['Todolist']['text'] . "'",
                        'Todolist.dateBegin' => !empty($data['Todolist']['dateBegin']) ? "'" . $data['Todolist']['dateBegin'] . "'" : NULL,
                        'Todolist.dateEnd' => !empty($data['Todolist']['dateEnd']) ? "'" . $data['Todolist']['dateEnd'] . "'" : NULL
                    ),
                    array('Todolist.id' => $id));
                return $this->redirect($this->Auth->redirect(array('controller' => 'Todolists', 'action' => 'consulterlist')));
            } else {
                $this->Session->setFlash(__('erreur liste non modifiée'), 'default', array('class' => 'flash-message-error'));
            }
        } else {
            // On recupere les données de la liste associées a l'id
            $data['liste'] = $this->Todolist->find('first', array('conditions' => array('Todolist.id' => $id)));
            $data['liste'] = current($data['liste']);

            // On passe les variables à la vues
            $this->set($data);
        }
    }


    /**
     * Fonction appelé pour visusalier toutes les listes de l'utilisateur
     * Fonction accessible par tous les utilisateurs qui sont authentifiés (c'est également par la page d'accueil)
     */
    public function consulterlist()
    {
        /*
            $this->Todolist->unbindModel( array('hasMany' => array('Task','Todolist_user')));
        $d['listes'] = $this->Todolist->find('all', array(
                    'recursive'=>-1,
                    'fields' => array('Todolist.id'),
                    'joins' => array(
                        array(
                            'table' => 'todolist_users',
                            'alias' => 't',
                            'type' => 'INNER',
                            'conditions' => array(
                                't.todolist_id = todolist.id',
                                't.user_id' => $id_user
                            )
                        )
                    )
                ));
        */

        $this->autoRender = true;
        $this->refresh();
        $listes = $this->Session->read('Auth.User.Todolist');
        $id_listes = array_keys($listes);
        $this->Todolist->unbindModel(array('hasMany' => array('Task', 'Todolist_user')));


        $d = $this->Todolist->find('all', array('recursive' => -1,
            'conditions' => array('Todolist.id' => $id_listes),
            'fields' => array('id', 'name', 'dateBegin')));

        $notification = array();
        parent::getNotifications($notification, 10);

        // on sépare les listes en 3 catégories
        $data['notifications'] = $notification;
        $data['today'] = array();
        $data['week'] = array();
        $data['other'] = array();
        $this->separerListes($d, $data['today'], $data['week'], $data['other']);

        $this->set($data);
    }


    /**
     * Fonction appelé pour supprimer une liste
     * Fonction accessible seulement par l'auteur de la liste (l'autorisation est donnée ou non par la fonction isAuthorized)
     * @param $id_liste , id de la liste à supprimer
     */
    public function supprimer($id_liste)
    {

        $this->autoRender = false;

        if ($this->Todolist->delete($id_liste)) {

            $this->Session->setFlash(__('liste supprimée', null),
                'default',
                array('class' => 'flash-message-success'));
        }

        return $this->redirect(array('controller' => 'Todolists', 'action' => 'consulterlist'));
    }


    /**
     * Fonction appelé pour consulter une liste
     * Fonction accessible par tous les utilisateurs qui sont inscris à la liste (l'autorisation est donnée ou non par la fonction isAuthorized)
     * @param $id , id de la liste courante
     */
    public function consulterlistdetail($id)
    {

        $user = $this->TodolistUser->find('first', array('recursive' => -1, 'fields' => 'id', 'conditions' =>
                array('user_id' => AuthComponent::user()['id'], 'todolist_id' => $id)
            )
        );

        if (empty($user)) {
            $this->redirect(array('action' => 'consulterlist'));
        }

        $this->Todolist->unbindModel(array('hasMany' => array('TodolistUser')));

        // On recupere les données de la liste associées au nom
        $d['liste'] = $this->Todolist->find('first', array('recursive' => 3, 'conditions' => array('Todolist.id' => $id)));

        $data['liste'] = $d['liste']['Todolist'];
        $data['id'] = $id;
        $data['taches'] = $d['liste']['Task'];

        $this->set($data);
    }

    public function refresh()
    {
        $user = AuthComponent::user()['id'];


        $data = $this->TodolistUser->find('list', array('recursive' => -1, 'conditions' => array('TodolistUser.user_id' => $user),
            'fields' => array('todolist_id')));

        if (!$this->Session->check('Auth.User.Todolist')) {
            $this->Session->write('Auth.User.Todolist', array());

        }
        $liste_session_user = array_keys($this->Session->read('Auth.User.Todolist'));

        $tab_add = array_diff($data, $liste_session_user);

        $tab_supr = array_diff($liste_session_user, $data);


        foreach ($tab_supr as $value) {
            $this->Session->delete('Auth.User.Todolist.' . $value);
        }
        foreach ($tab_add as $value) {
            $this->Session->write('Auth.User.Todolist.' . $value, '0');
        }

        $d = $this->Todolist->find('all', array('fields' => array('id', 'name', 'dateBegin'), 'conditions' => array('Todolist.id' => $tab_add),
            'recursive' => -1));

        unset($data);
        $data['today'] = array();
        $data['week'] = array();
        $data['other'] = array();

        $this->separerListes($d, $data['today'], $data['week'], $data['other']);

        $toSend['listeAdd'] = $data;
        $toSend['listeRemove'] = $tab_supr;

        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->autoRender = false;
            echo json_encode($toSend);

        }
    }


    public function addListetoUser($id_liste, $id)
    {

        $this->autoRender = false;
        $this->request->allowMethod(array('ajax'));

        $data['todolist_id'] = $id_liste;
        $data['user_id'] = $id;

        $this->TodolistUser->set($data);

        if ($this->TodolistUser->save()) {

            $data = array();
            $sender = AuthComponent::user()['id'];
            $date = date("Y-m-d H:i:s");
            $nomListe = current($this->Todolist->find('first', array('recursive' => -1, 'fields' => 'name', 'conditions' => array('id' => $id_liste))));
            $nomListe = $nomListe['name'];

            $data[] = array('message' => "On vous a ajouté dans la liste " . $nomListe, 'isReaded' => 0, 'sender_id' => $sender,
                'reciever_id' => $id, 'date' => $date, 'todolist_id' => $id_liste);

            $this->Notification->saveMany($data, array('atomic' => false));
        }
    }


    public function  removeMember($id_liste, $id = null)
    {

        if ($this->request->is('ajax')) {

            $this->autoRender = false;


            $this->TodolistUser->set($id);

            $user_id = $this->TodolistUser->find('first', array('condition' => array('id' => '$id')));
            $user_id = $user_id['TodolistUser']['user_id'];

                if ($this->TodolistUser->delete($id, false)) {

                    die();
                    $data = array();
                    $sender = AuthComponent::user()['id'];
                    $date = date("Y-m-d H:i:s");
                    $nomListe = current($this->Todolist->find('first', array('recursive' => -1, 'fields' => 'name', 'conditions' => array('id' => $id_liste))));
                    $nomListe = $nomListe['name'];

                    $data[] = array('message' => "On vous a surpprimé de la liste " . $nomListe, 'isReaded' => 0, 'sender_id' => $sender,
                        'reciever_id' => $user_id, 'date' => $date, 'todolist_id' => $id_liste);

                    $this->Notification->saveMany($data, array('atomic' => false));
                }

        } else {

            $this->TodolistUser->unbindModel(array('hasOne' => array('Todolist')));
            $users = $this->TodolistUser->find("all", array("conditions" => array(
                'todolist_id' => $id_liste, 'id_facebook !=' => '-1'), 'fields' => array('TodolistUser.id', 'User.id', 'User.id_facebook')
            ));


            FacebookSession::enableAppSecretProof(false);

            foreach ($users as $key => $valeurs) {
                //$valeurs = current($valeurs);
                $profil = FacebookConnect::getFriendProfil($valeurs['User']['id_facebook']);

                $data['profil'][$key]['id'] = $valeurs['TodolistUser']['id'];
                $data['profil'][$key]['User_id'] = $valeurs['User']['id'];
                $data['profil'][$key]['name'] = $profil['name'];
            }

            $data['id'] = $id_liste;
            $this->set($data);

        }
    }


    private function separerListes($data, &$today, &$week, &$other)
    {
        $dateCourante = new DateTime("now");

        // $interval = $datetime1->diff($datetime2)
        foreach ($data as $key => $value) {
            $value = current($value);

            if ($value['dateBegin'] == null) {
                $other[] = $value;
                continue;
            }
            $dateListe = new DateTime($value['dateBegin']);
            $dif = date_diff($dateCourante, $dateListe);
            $jour = $dif->format('%R%a ');

            if ($jour <= 0) {

                $today[] = $value;

            } else if ($jour <= 7) {
                $week[] = $value;
            } else {
                $other[] = $value;
            }
        };
    }


}