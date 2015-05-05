<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model
{


    /**
     * Retourne TRUE si les deux champs ont la même valeur.
     */
    function estEgal($field = array(), $compare_field = null)
    {
        foreach ($field as $key => $value) {
            $v1 = $value;
            $v2 = $this->data[$this->name][$compare_field];
            if ($v1 !== $v2) {
                return false;
            }
        }
        return true;
    }

    /**
     * Permet de convertir une date dans le format anglais
     * @param la date à convertir
     * @return la date convertie
     */
    public function dateFormatBeforeSave($dateString)
    {
        return date('Y-m-d', strtotime($dateString));
    }


    /**
     * Fonction qui vérifie que la date saisie est correct  ( = une date grégorienne)
     * @param $date date à tester de la forme JJ/MM/AAAA
     * @return bool true si la date est valide
     */
    public function ValidationDate($date)
    {

        $tableau = explode("-", current($date));

        if (count($tableau) == 3) {
            $jour = $tableau[0];
            $mois = $tableau[1];
            $an = $tableau[2];

            if($an > 2200) return false; // ~~

            return checkdate($mois, $jour, $an);
        }

        return false;
    }

}
