<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
//App::import("Vendor", "FacebookAuto", array("file" => "facebook-php-sdk-v4-4.0-dev/autoload.php"));
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package        app.Controller
 * @link        http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::import('Vendor', 'vendor', array('file' => 'vendor' . DS . 'autoload.php'));
App::import('Vendor', 'app', array('file' => 'app' . DS . 'Facebook' . DS . 'FacebookConnect.php'));

class AppController extends Controller
{

    public $components = array(

        'Session',
        'DebugKit.Toolbar',
        'RequestHandler',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'Todolists', 'action' => 'consulterlist'),//lors d'une connexion reussi
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),//lors d'une deconnexion
            'authError' => false,
            'authorize' => array('Controller'),
            'unauthorizedRedirect' => array('controller' => 'Todolists', 'action' => 'consulterlist'),
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'email'), //notre moyen d'identification se base sur le pseudo, par defaut cakephp utilise le champs username
                    'userFields' => array('User.id') // 'Todolist_user.toDoList_id on ne garde que l'id dans la variable session
                )
            )
        )
    );

    protected $appId = '1094282070597277';

    protected $appSecret = 'b851006b79835cd119192ca198dc8dfd';


    public function beforeFilter()
    {
        $this->response->disableCache();
    }

    public function isAuthorized($user)
    {
        return false;
    }

    public function dateFormatBeforeSave($dateString)
    {
        return date('Y-m-d', strtotime($dateString));
    }


    public function getNotifications(&$data, $limit = null)
    {

        if ($limit == null) {
            $data = $this->Notification->find('all', array('conditions' =>
                    array('reciever_id' => AuthComponent::user()['id']),
                    'order' => 'date DESC')
            );

        } else {
            $data = $this->Notification->find('all', array('conditions' =>
                    array('reciever_id' => AuthComponent::user()['id']),
                    'order' => 'date DESC',
                    'limit' => $limit)
            );

        }
    }

}
