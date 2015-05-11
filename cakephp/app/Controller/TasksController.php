<?php

class TasksController extends AppController
{

    public $uses = array('Task', 'TodolistUser',);

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

            }
            return $this->redirect($this->Auth->redirect(array('controller' => 'Todolists', 'action' => 'consulterlistdetail', $data['todolist_id'])));
        }

    }


    public function supprimer($id)
    {
        Configure::write('debug', 1);
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

            throw new InternalErrorException("vous n'avez pas/plus accès à la liste");
        }

        if ($this->Task->delete($id)) {

        } else {
            throw new InternalErrorException("la tâche n'à pas été supprimée");
        }
    }


    public function cocher($id, $value)
    {
        Configure::write('debug', 1);
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

            throw new InternalErrorException("vous n'avez pas/plus accès à la liste");
        }


        $date = ($value == 1 ? date("Y-d-m") : NULL);
        $user = ($value == 1 ? $user = AuthComponent::user()['id'] : NULL);


        if ($value == 0) {
            $d = current($this->Task->Find('first', array('recursive' => -1, 'fields' => 'user_id', 'conditions' => array('id' => $id))));

            if ($d['user_id'] != AuthComponent::user()['id']) {
                return false;
            }
        } else if ($value == 1) {
            $d = $this->Task->find('first', array('recursive' => -1, 'conditions' => array('Task.id' => $id)));


            if ($d['Task']['isChecked'] == true) {
                throw new InternalErrorException("quelqu'un à déjà pris cette tâche");
            }

        } else {
            return false;
        }

        $this->Task->updateAll(
            array('Task.isChecked' => "'" . $value . "'",
                'Task.date' => "'" . $date . "'",
                'Task.user_id' => "'" . $user . "'"
            ),
            array('Task.id' => $id));


    }


    public function modifyTask($id, $nom = null)
    {
        Configure::write('debug', 1);
        $this->autoRender = false;
        $this->request->allowMethod(array('ajax'));

        if (empty($nom)) {
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
                throw new InternalErrorException("nom incorrect");

            }

        }

    }


}
