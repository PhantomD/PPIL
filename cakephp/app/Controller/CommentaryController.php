<?php

class CommentaryController extends AppController
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

        if ($this->action === 'newcommentary') {
            $id_liste = $this->request->params['pass'][0];

            if ($this->Session->read('Auth.User.Todolist.' . $id_liste) == 1) {
                return true;
            }
            $this->Auth->authError = "Vous n avez pas les autorisations recquis pour ajouter un commentaire";
            $this->Auth->unauthorizedRedirect = array('controller' => 'Todolists', 'action' => 'consulterlistdetail', $id_liste);
            return false;
        }
        return true;
    }


    public function newcommentary()
    {

        if ($this->request->is('post')) {
            $data = current($this->request->data);

            // On envoie les données à la vue
            $this->Commentary->set($data);

            if ($this->Commentary->validates()) {

                // On sauvegarde les données dans la BDD
                $this->Commentary->save($data);


                $this->Session->setFlash(__('commentaire ajoutée', null),
                    'default',
                    array('class' => 'flash-message-success'));

            }
            return $this->redirect($this->Auth->redirect(array('controller' => 'Todolists', 'action' => 'consulterlistdetail', $data['todolist_id'])));
        }

    }



    public function taillelist()
    {
        // retourne le nombre de l'élément
        $taille = $this->Commentary->find('count');
        return $taille;

    }
    
}
