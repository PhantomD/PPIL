<?php

class CommentaryController extends AppController
{
    public $uses = array('User', 'Commentary');

    function beforeFilter()
    {
        parent::beforeFilter();
    }

    function isAuthorized($user)
    {

        if (parent::isAuthorized($user)) {
            return true;
        }
        /*
                if ($this->action === 'newcommentary') {
                    $id_liste = $this->request->params['pass'][0];

                    if ($this->Session->read('Auth.User.Todolist.' . $id_liste) == 1) {
                        return true;
                    }
                    $this->Auth->authError = "Vous n avez pas les autorisations recquis pour ajouter un commentaire";
                    $this->Auth->unauthorizedRedirect = array('controller' => 'Todolists', 'action' => 'consulterlistdetail', $id_liste);
                    return false;
                }
        */
        return true;
    }


    public function newcommentary($id_tache, $text = null)
    {
        Configure::write('debug', 1);
        $this->autoRender = false;
        $this->request->allowMethod(array('ajax'));

        if (empty($text)) {
            throw new InternalErrorException("champ vide");
        }

        $data['task_id'] = $id_tache;
        $text = str_replace("___", " ", $text);
        $data['text'] = $text;

        if ($this->request->is('ajax')) {
            $data['commentary.task_id'] = $id_tache;
            $data['user_id'] = AuthComponent::user()['id'];

            // On envoie les données à la vue
            $this->Commentary->set($data);

            if ($this->Commentary->validates()) {

                $user = $this->User->Find('first', array('recursive' => -1, 'fields' => array('name', 'firstname'),
                    'conditions' => array('id' => AuthComponent::user()['id'])));

                // On sauvegarde les données dans la BDD
                $this->Commentary->save($data);

                echo json_encode($user);

            } else {
                throw new InternalErrorException("commentaire incorrect");
            }

            //$this->redirect( array('controller' => 'Todolists', 'action' => 'consulterlistdetail', $data['todolist_id']));
        }

    }

}



