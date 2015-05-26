<?php

class TasksController extends AppController
{

    public $uses = array('Task', 'TodolistUser', 'Notification');

    function beforeFilter()
    {
        parent::beforeFilter();

    }

    function isAuthorized($user)
    {

        if (parent::isAuthorized($user)) {
            return true;
        }

        if ($this->action === 'newtask') {
            $id_liste = $this->request->params['pass'][0];

            if ($this->Session->read('Auth.User.Todolist.' . $id_liste) == 1) {
                return true;
            }
            $this->Auth->authError = "Vous n avez pas les autorisations recquis pour ajouter une tâche";
            $this->Auth->unauthorizedRedirect = array('controller' => 'Todolists', 'action' => 'consulterlistdetail', $id_liste);
            return false;
        }
        return true;
    }


    public function newtask()
    {

        $id_liste = $this->request->data['Task']['todolist_id'];
        $user = $this->TodolistUser->find('first', array('recursive' => -1, 'fields' => 'id', 'conditions' =>
                array('user_id' => AuthComponent::user()['id'], 'todolist_id' => $id_liste)
            )
        );

        if (empty($user)) {
            $this->redirect(array('controller' => 'Todolists', 'action' => 'consulterlist'));
        }

        if ($this->request->is('post')) {
            $data = current($this->request->data);

            // On envoie les données à la vue
            $this->Task->set($data);

            if ($this->Task->validates()) {

                // On sauvegarde les données dans la BDD
                $this->Task->save($data);


                $this->Session->setFlash(__('tâche ajoutée', null),
                    'default',
                    array('class' => 'flash-message-success', 'timeout' => 3));


                // partie notification
                $nom_tache = $this->request->data['Task']['name'];

                $this->TodolistUser->unbindModel(array('hasOne' => array('User')));
                $d = $this->TodolistUser->find('all', array('recursive' => 2, 'fields' => array('user_id', 'todolist_id'), 'conditions' =>
                        array('todolist_id' => $id_liste)
                    )
                );

                $data_notif = array();
                $sender = AuthComponent::user()['id'];
                $date = date("Y-m-d H:i:s");

                foreach ($d as $key => $d) {
                    $id_user = $d['TodolistUser']['user_id'];

                    if ($sender == $id_user)
                        continue;

                    $nom_liste = $d['Todolist']['name'];
                    //$
                    $data_notif[] = array('message' => "nouvelle tache \"".$nom_tache."\" dans la liste \"".$nom_liste."\"", 'isReaded' => 0, 'sender_id' => $sender,
                        'reciever_id' => $id_user, 'date' => $date, 'todolist_id' => $id_liste);
                }

                $this->Notification->saveMany($data_notif, array('atomic' => false));



            }
            return $this->redirect($this->Auth->redirect(array('controller' => 'Todolists', 'action' => 'consulterlistdetail', $data['todolist_id'])));
        }

    }


    public function supprimer($id)
    {
        $this->autoRender = false;
        $this->request->allowMethod(array('ajax'));

        $id_liste = $this->Task->find('list', array('fields' => 'todolist_id', 'conditions' =>
                array('id' => $id)
            )
        );
        $user = $this->TodolistUser->find('first', array('recursive' => -1, 'fields' => 'id', 'conditions' =>
                array('user_id' => AuthComponent::user()['id'], 'todolist_id' => $id_liste)
            )
        );

        if (empty($user)) {
            Configure::write('debug', 1);
            throw new InternalErrorException("vous n'avez pas/plus accès à la liste", 502);
        }

        if ($this->Task->delete($id)) {

        } else {
            Configure::write('debug', 1);
            throw new InternalErrorException("la tâche n'à pas été supprimée", 503);
        }
    }


    public function cocher($id, $value)
    {
        $this->autoRender = false;
        $this->request->allowMethod(array('ajax'));


        $id_liste = $this->Task->find('list', array('fields' => 'todolist_id', 'conditions' =>
                array('id' => $id)
            )
        );
        $user = $this->TodolistUser->find('first', array('recursive' => -1, 'fields' => 'id', 'conditions' =>
                array('user_id' => AuthComponent::user()['id'], 'todolist_id' => $id_liste)
            )
        );


        if (empty($user)) {
            Configure::write('debug', 1);
            throw new InternalErrorException("vous n'avez pas/plus accès à la liste", 502);
        }


        $date = ($value == 1 ? date("Y-m-d") : NULL);
        $user = ($value == 1 ? $user = AuthComponent::user()['id'] : NULL);


        if ($value == 0) {
            $d = current($this->Task->Find('first', array('recursive' => -1, 'fields' => 'user_id', 'conditions' => array('id' => $id))));

            if ($d['user_id'] != AuthComponent::user()['id']) {
                return false;
            }
        } else if ($value == 1) {
            $d = $this->Task->find('first', array('recursive' => -1, 'conditions' => array('Task.id' => $id)));


            if ($d['Task']['isChecked'] == true) {
                Configure::write('debug', 1);
                throw new InternalErrorException("quelqu'un à déjà pris cette tâche", 503);
            }

        } else {
            return false;
        }
        $this->Task->FilesFolders->recursive = -1;
        $this->Task->updateAll(
            array('Task.isChecked' => "'" . $value . "'",
                'Task.user_id' => "'" . $user . "'",
                'Task.date' => "'" . $date . "'",
            ),
            array('Task.id' => $id));


        $data_tache = $this->Task->find('first', array('recursive' => -1, 'fields' => array('todolist_id', 'name'),
                'conditions' => array('id' => $id)
            )
        );

        $id_liste = $data_tache['Task']['todolist_id'];
        $nom_tache = $data_tache['Task']['name'];

        $this->TodolistUser->unbindModel(array('hasOne' => array('User')));
        $d = $this->TodolistUser->find('all', array('recursive' => 2, 'fields' => array('user_id', 'todolist_id'), 'conditions' =>
                array('todolist_id' => $id_liste)
            )
        );


        $data = array();
        $sender = AuthComponent::user()['id'];
        $date = date("Y-m-d H:i:s");
        $cocher = ($value == 0 ? "décochée" : "cochée");

        foreach ($d as $key => $d) {
            $id_user = $d['TodolistUser']['user_id'];

            if ($sender == $id_user)
                continue;

            $nom_liste = $d['Todolist']['name'];
            //$
            $data[] = array('message' => "la tâche " . $nom_tache."  a été " . $cocher, 'isReaded' => 0, 'sender_id' => $sender,
                'reciever_id' => $id_user, 'date' => $date, 'todolist_id' => $id_liste);
        }

        $this->Notification->saveMany($data, array('atomic' => false));
    }


    public function modifyTask($id, $nom = null)
    {
        $this->autoRender = false;
        $this->request->allowMethod(array('ajax'));

        if (empty($nom)) {
            Configure::write('debug', 1);
            throw new InternalErrorException("champ vide");
        }

        $data['name'] = $nom;
        $data['id'] = $id;

        if ($this->request->is('ajax')) {

            $this->Task->set($data);

            if ($this->Task->validates()) {

                $this->Task->updateAll(
                    array('Task.name' => "'" . $nom . "'"
                    ),
                    array('Task.id' => $id));

            } else {
                Configure::write('debug', 1);
                throw new InternalErrorException("nom incorrect");

            }

        }

    }


}
