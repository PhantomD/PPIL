
<div data-role="page" data-theme="a" id="page_mainScreen">
  <div data-role="header" data-position="inline" data-theme="a">
    <h1 style="text-align:left;">
      <?php echo $this->Html->image('icone_entete.png', array('alt' => 'icone_entete','style'=>'vertical-align : middle'));?>
      Liste 
    </h1>
    <?php echo $this->element('menu') ?>
  </div>




  <div data-role="content">
     <?php echo $this->Session->flash(); 
     ?>
     
    <h4 class="ui-bar ui-bar-a"><?php echo $liste['name'] ?></h4>
    <?php

    $url = array('controller'=>'Todolists','action'=>'modifylist',$liste['name']);
    echo "Description : ".$liste['text'];
    ?> <br><br> <?php
    echo "Date de début : ".$liste['dateBegin'];
    ?> <br><br> <?php
    echo "Date de fin : ".$liste['dateEnd'];
    ?> 
  </div>




  <!-- popup new tache -->
  <div data-role="popup" id="popupTache" data-position-to="window"  data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
    <div data-role="header" data-theme="a"><h1>Ajouter une tâche</h1></div>
    <div role="main" class="ui-content">

      <?php echo $this->Form->create('newTache',array(
        'type'=>'post',
        'url'=>array('controller'=>'Tasks','action'=>'newtask',$liste['id']),
        'data-ajax' => 'false',
        'inputDefaults' => array(
          'label' => false,
          'data-clear-btn' =>true)));

      echo "<div data-role='content' data-theme='c'>";

          echo "<div style ='width:90%;margin:auto;padding-left:15px;padding-bottom:0'>"; // barbare
          echo $this->Form->input('Task.name', array('type' => 'text','required' => true, 'placeholder'=>'intitulé de la tâche')); 
          echo "</div>";
          ?>
          <fieldset>
            <legend>Facultatif</legend>

            <?php
            echo $this->Form->input('Task.comment', array('type' => 'text','required'=>false, 'placeholder'=>"Commentaire")); 
            echo $this->Form->input('Task.todolist_id', array('type' => 'hidden','required'=>true, "value"=>$liste['id'])); 

            ?>
          </fieldset>

          <div class="center">
            <a href="#" data-role="button" data-inline="true" data-icon="delete" data-rel="back">Annuler</a>

            <?php echo $this->form->end(array('label'=>'Valider','data-role'=>"button",'data-inline'=>"true",'data-icon'=>"check",'div'=>false));?>
          </div>
        </div>
      </div>

<?php 
echo $this->element('popup_erreur') ?>

</div>
