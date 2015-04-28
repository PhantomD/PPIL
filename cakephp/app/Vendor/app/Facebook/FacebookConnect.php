<?php
/**
 * Created by PhpStorm.
 * User: geogeo
 * Date: 27/04/2015
 * Time: 14:06
 */

namespace App\Facebook;


use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSession;
use Facebook\FacebookRequestException;
use Facebook\FacebookRequest;


class FacebookConnect
{
    private $appId;
    private $appSecret;

    function __construct($appId, $appSecret)
    {

        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }

    function connect($redirect_url)
    {
        FacebookSession::setDefaultApplication($this->appId, $this->appSecret);

        $helper = new FacebookRedirectLoginHelper($redirect_url);

        if (isset($_SESSION) && isset($_SESSION['fb_token'])) {

            $session = new FacebookSession($_SESSION['fb_token']);
        } else {

                $session = $helper->getSessionFromRedirect();

        }

        if ($session) {

            try {
                $_SESSION['fb_token'] = $session->getToken();

                $request = new FacebookRequest($session, 'GET', '/me');

                $profile = $request->execute()->getGraphObject('Facebook\GraphUser');

                if ($profile->getEmail() == null) {

                    throw new \Exception("L'email n'est pas disponible");
                }

                return $profile;

            } catch (\Exception $e) {

                unset($_SESSION['fb_token']);

                return $helper->getReRequestUrl((['email','user_birthday','user_friends']));
            }

        } else {

            return $helper->getLoginUrl(['email','user_birthday','user_friends']);

        }
    }


   public static function getFriends(){

        $session = new FacebookSession($_SESSION['fb_token']);
        $request = new FacebookRequest($session, 'GET','/me/friends/');
        $response = $request->execute();
        $graphObject = $response->getGraphObject()->asArray();

        return $graphObject;
    }

    public static function getFriendProfil($id){
        $session = new FacebookSession($_SESSION['fb_token']);
        $request = new FacebookRequest ($session, 'GET', "/$id"
        );
        $response = $request->execute();
        $graphObject = $response->getGraphObject()->asArray();

        return $graphObject;


    }
}