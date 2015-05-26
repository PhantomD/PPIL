<?php

class Todolist extends AppModel
{

    public $actsAs = array('Containable');

    public $hasMany = array(
        'Task' => array(
            'className' => 'Task',
            'foreignKey' => 'todolist_id',
            'dependent' => true,
        ),
        'TodolistUser' => array(
            'className' => 'TodolistUser',
            'foreignKey' => 'todolist_id',
            'dependent' => true
        )
    );


    public $validate = array(
        'name' => array(
            'rule' => '/^[\'" \(\)a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]{1,60}$/',
            'required' => true,
            'allowEmpty' => false,
            'message' => "le nom de la liste est incorrect",
        ),
        'text' => array(
            'rule' => '/^[\'" \(\)a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]{1,60}$/',
            'required' => false,
            'allowEmpty' => true,
            'message' => "symbole dans commentaire non autorisé",
        ),
        'dateBegin' => array(
            array(
                'rule' => '/^[0-9]{2,2}-[0-9]{2,2}-[0-9]{4,4}$/',
                'required' => false,
                'allowEmpty' => true,
                'message' => "date de début invalide. Format JJ/MM/AAAA attendu",
            ),
            array(
                'rule' => array('ValidationDate'),
                'message' => 'la date est incorrect (date grégorienne attendue)'
            ),
            array(
                'rule' => array('DatDebVsActuelle'),
                'message' => 'la date debut est déjà dépassée'
            )
        ),
        'dateEnd' => array(
            array(
                'rule' => '/^[0-9]{2,2}-[0-9]{2,2}-[0-9]{4,4}$/',
                'required' => false,
                'allowEmpty' => true,
                'message' => "date de fin invalide. Format JJ/MM/AAAA attendu",
            ),
            array(
                'rule' => array('ValidationDate'),
                'message' => 'la date est incorrect (date grégorienne attendue)'
            ),
            array(
                'rule' => array('ValidationDateFin', 'dateBegin'),
                'message' => 'la date de fin ne peut pas être antérieure à la date de début'
            )
        ),

    );

    public function beforeSave($options = array())
    {


        if (!empty($this->data[$this->alias]['dateBegin']))
            $this->data[$this->alias]['dateBegin'] = $this->dateFormatBeforeSave($this->data[$this->alias]['dateBegin']);

        if (!empty($this->data[$this->alias]['dateEnd']))
            $this->data[$this->alias]['dateEnd'] = $this->dateFormatBeforeSave($this->data[$this->alias]['dateEnd']);


        return true;
    }


    /**
     * Compare si la date de début n'est pas inférieur à la date actuelle du système
     * @param $data dateBegin => 'JJ-MM-AAAA'
     * @return bool
     */
    public function DatDebVsActuelle($data)
    {

        $dateDebut = current($data);
        $dateDebut = $this->dateFormatBeforeSave($dateDebut);
        $dateActuel = date('Y-m-d');

        return $dateDebut >= $dateActuel;
    }

    /**
     * @param $dateFin dateEnd => 'JJ-MM-AAAA'
     * @param $dateDebut
     * @return bool
     */
    public function ValidationDateFin($dateFin, $dateDebut)
    {
        $dateFin = current($dateFin);
        $dateFin = $this->dateFormatBeforeSave($dateFin);

        $dateDebut = $this->data[$this->name][$dateDebut];
        $dateDebut = $this->dateFormatBeforeSave($dateDebut);

        return $dateFin >= $dateDebut;
    }
}