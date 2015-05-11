<?php
if (isset($liste) && !empty($liste)) {

    $tableau['name'] = $liste['name'];
    $tableau['text'] = $liste['text'];
    $tableau['dateBegin'] = $liste['dateBegin'];
    $tableau['dateEnd'] = $liste['dateEnd'];

    $tableaudateBegin = explode("-", $tableau['dateBegin']);
    if (count($tableaudateBegin) == 3) {
        $tableau['dateBegin'] = $tableaudateBegin[2] . "/" . $tableaudateBegin[1] . "/" . $tableaudateBegin[0];
    } else {
        $tableau['dateBegin'] = "";
    }

    $tableaudateEnd = explode("-", $tableau['dateEnd']);
    if (count($tableaudateEnd) == 3) {
        $tableau['dateEnd'] = $tableaudateEnd[2] . "/" . $tableaudateEnd[1] . "/" . $tableaudateEnd[0];
    } else {
        $tableau['dateEnd'] = "";
    }

} else {

    $todolist = $this->request->data['Todolist'];
    $tableau['name'] = $todolist['name'];
    $tableau['text'] = $todolist['text'];
    $tableau['dateBegin'] = $todolist['dateBegin'];
    $tableau['dateEnd'] = $todolist['dateEnd'];
}
?>

<div data-role="page" data-theme="b" id="page_option">
    <div data-role="header" data-position="inline" data-theme="a">
        <h1 style="text-align:left;">
            <?php echo $this->Html->image('icone_entete.png', array('alt' => 'icone_entete', 'style' => 'vertical-align : middle')); ?>
            Modification de la liste <?php echo $tableau['name']; ?>
        </h1>

        <?php echo $this->element('menu') ?>

    </div>
    <div data-role="content">
        <!-- <h4 class="ui-bar ui-bar-a">Détails Todolist : <?php echo $name[0]['Todolist']['name'] ?></h4> -->

        <?php

        echo $this->Form->create('modifylist', array(
            'type' => 'post',
            'data-ajax' => 'false',
            'inputDefaults' => array(
                'label' => false,
            )));


        echo "<div data-role='content' data-theme='c'>";
        echo $this->form->input("Todolist.name", array('type' => 'text', 'maxlength'=>'50', 'label' => false, 'required' => true, 'id' => 'name', 'value' => $tableau['name']));
        ?> <br><br>

        <fieldset>
            <legend>Facultatif</legend>

            <?php
            echo $this->form->input("Todolist.text", array('type' => 'text', 'id' => 'text', 'label' => false, 'value' => $tableau['text'], 'placeholder' => "Commentaire"));

            echo $this->form->input("Todolist.dateBegin", array('type' => 'text', 'id' => 'dateBegin', 'label' => false,'data-role'=>'datebox' ,
                'data-options'=> '{"mode": "calbox","afterToday":"true"}','value' => $tableau['dateBegin'], 'placeholder' => "Date de début"));

            echo $this->form->input("Todolist.dateEnd", array('type' => 'text', 'id' => 'dateEnd', 'label' => false,'data-role'=>'datebox' ,
                'data-options'=> '{"mode": "calbox","afterToday":"true"}','value' => $tableau['dateEnd'], 'placeholder' => "Date de fin"));

            $id_liste = $this->request->params['pass'][0];
            echo $this->Html->link('Ajouter un Membre', array('controller' => 'Users', 'action' => 'addMember', $id_liste), array("data-ajax" => "false", 'data-role' => "button", 'data-inline' => "true")) . "</li>";
            ?>

        </fieldset>
    </div>
    <br/>
    <?php echo $this->form->end('enregistrer les modifications', array('id' => 'modifylist'));

    ?>
</div>
</div>
</html>