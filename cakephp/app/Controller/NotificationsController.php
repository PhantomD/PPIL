<?php

class NotificationsController extends AppController
{
    function beforeFilter()
    {
        parent::beforeFilter();

    }

    function isAuthorized($user)
    {
        return true;
    }


    function notification()
    {

        // $this->autoRender = false;
        $id_user = AuthComponent::user()['id'];


        $notifications['notifs'] = $this->Notification->find('all', array('conditions' =>
                array('reciever_id' => $id_user),
                'order' => 'date DESC')
        );

        $this->set($notifications);

    }


    function redirection($id_notif)
    {
        $this->autoRender = false;

        if (empty($id_notif)) {
            $this->redirect(array('controller' => 'Todolists', 'action' => 'consulterlist'));
        }

        $notif = $this->Notification->find('first', array('recursive' => -1, 'conditions' => array('id' => $id_notif)));

        if ($notif['Notification']['reciever_id'] != AuthComponent::user()['id']) {
            $this->redirect(array('controller' => 'Todolists', 'action' => 'consulterlist'));
        }

        $this->Notification->id = $id_notif;

        $this->Notification->saveField('isReaded', '1');

        $this->redirect(array('controller' => 'Todolists', 'action' => 'consulterlistdetail', $notif['Notification']['todolist_id']));
    }


    function readAll()
    {

        $this->autoRender = false;

        $this->Notification->updateAll(
            array('isReaded' => '1'),
            array('reciever_id ' => AuthComponent::user()['id'])
        );


        $this->redirect(array('action' => 'notification'));
    }

}