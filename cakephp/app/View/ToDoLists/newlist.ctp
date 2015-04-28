<?php
if (empty($this->request->data)) {

    $tableau['name'] = "";
    $tableau['text'] = "";
    $tableau['dateBegin'] = "";
    $tableau['dateEnd'] = "";
    $tableau['frequency'] = "";
} else {

    $todolist = $this->request->data['Todolist'];
    $tableau['name'] = $todolist['name'];
    $tableau['text'] = $todolist['text'];
    $tableau['dateBegin'] = $todolist['dateBegin'];
    $tableau['dateEnd'] = $todolist['dateEnd'];
    $tableau['frequency'] = $todolist['frequency'];

}
?>

<div data-role="page" data-theme="b" id="page_option" data-dom-cache="false">
    <div data-role="header" data-theme="a">
        <h1 style="text-align:left;">
            <?php echo $this->Html->image('icone_entete.png', array('alt' => 'icone_entete', 'style' => 'vertical-align : middle')); ?>
            Nouvelle liste
        </h1>
        <?php echo $this->element('menu') ?>
    </div>


    <div data-role="content">

        <?php
        echo $this->Form->create('newlist', array(
            'type' => 'post',
            'data-ajax' => 'false',
            'inputDefaults' => array(
                'label' => false,
            )));

        echo "<div data-role='content' data-theme='c'>";
        echo $this->Form->input('Todolist.name', array('type' => 'text', 'required' => true, 'value' => $tableau['name'], 'placeholder' => "Intitulé de la liste"));


        ?>
        <fieldset>
            <legend>Facultatif</legend>

            <?php
            echo $this->Form->input('Todolist.text', array('type' => 'text', 'value' => $tableau['text'], 'placeholder' => "Commentaire"));

            echo $this->Form->input('Todolist.dateBegin', array('type' => 'text', 'required' => false, 'value' => $tableau['dateBegin'], 'placeholder' => "Date de début(JJ/MM/AAA)"));

            echo $this->Form->input('Todolist.dateEnd', array('type' => 'text', 'required' => false, 'value' => $tableau['dateEnd'], 'placeholder' => "Date de fin(JJ/MM/AAA)"));

            //plus tard
            // echo $this->Form->input('User.id', array('type' => 'hidden'));
            echo $this->Form->input('Todolist.user_id', array('type' => 'hidden', 'required' => true, 'value' => $this->Session->read('Auth.User.id')));
            ?>
            <a href="#" data-role="button" data-inline="true" style="margin-top:20px;">Ajouter un Membre</a>
        </fieldset>
    </div>
    <br/>
    <?php echo $this->form->end('Créer la liste'); ?>
</div>
</div>
