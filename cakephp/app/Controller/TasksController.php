<?php

class TasksController extends AppController
{

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

        if ($this->request->is('post')) {
            $data = current($this->request->data);

            // On envoie les données à la vue
            $this->Task->set($data);

            if ($this->Task->validates()) {

                // On sauvegarde les données dans la BDD
                $this->Task->save($data);


                $this->Session->setFlash(__('tâche ajoutée', null),
                    'default',
                    array('class' => 'flash-message-success'));

            }
            return $this->redirect($this->Auth->redirect(array('controller' => 'Todolists', 'action' => 'consulterlistdetail', $data['todolist_id'])));
        }

    }

    public function taillelist()
    {
        // retourne le nombre de l'élément
        $taille = $this->Task->find('count');
        return $taille;

    }


    public function consultertask($ligne)
    {

        // On récupère le nom des éléments
        $task = $this->Task->find('all', array(
            'fields' => array('Task.name'),
            'order' => array('id DESC')));

        return $task["$ligne"]["Task"]["name"];

    }

    public function consultertaskdetail($id)
    {

        // On recupere les données de l'élément associées au nom
        $task = array('name' => $this->Task->find('all', array('fields' => array('Task.name'), 'conditions' => array('Task.name' => $nom)))
        );


        // On passe les variables à la vues
        $this->set($task);

    }

    public function supprimer($id)
    {
        $this->autoRender = false;

        if ($this->request->is('ajax')) {
            if ($this->Task->delete($id)) {

                /*$this->Session->setFlash(__('tâche supprimée', null),
                    'default',
                    array('class' => 'flash-message-success'));
                    */
            }
        } else {
            $this->redirect($this->referer());
        }
//return $this->redirect(array('controller'=>'Todolists','action' => 'consulterlist'));
    }


    public function cocher($id, $value)
    {

        $this->autoRender = false;

        if ($this->request->is('ajax')) {
            $this->Task->id = $id;
            $this->Task->saveField('isChecked', $value);
        } else {
            $this->redirect($this->referer());
        }


    }
}
