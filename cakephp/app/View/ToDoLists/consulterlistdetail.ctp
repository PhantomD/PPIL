<?php
  $message ="";
  if($this->Session->check('Message.auth')){
    $message = $this->Session->flash('auth');
  }
  ?>

<div data-role="page" data-theme="a" id="page_mainScreen">
  <div data-role="header" data-position="inline" data-theme="a">
    <h1 style="text-align:left;">
      <?php echo $this->Html->image('icone_entete.png', array('alt' => 'icone_entete','style'=>'vertical-align : middle'));?>
      Liste 
    </h1>

    <div data-role="controlgroup" data-type="horizontal" data-mini="true" class="ui-btn-right">
      <a data-role="button" data-inline="true" data-icon="recycle" data-iconpos="notext" data-mini="true" >Rafraichir</a>

      <a href="#popupMenu" data-role="button" data-rel="popup" data-inline="true" data-icon="bars" data-iconpos="notext" data-mini="true" data-transition="slidedown">Menu</a>

      <div data-role="popup" id="popupMenu" data-theme="b">
        <ul data-role="listview" data-inset="true" style="min-width:210px;">
          <li data-role="list-divider">Menu</li>
         

          <li>   <?php echo $this->Html->link('Modifier la liste',array('controller' => 'Todolists','action' => 'modifylist', $liste['id']),array("data-ajax"=> "false")); ?></li>

          <li>   <?php echo $this->Html->link('supprimer la liste',array('controller' => 'Todolists','action' => 'supprimer', $liste['id']),array("data-ajax"=> "false")); ?></li>
          
          <li>   <?php echo $this->Html->link('Deconnexion',array('controller' => 'Users','action' => 'logout'),array("data-ajax"=> "false")); ?></li>
        </ul> 
      </div>

      <!-- ajouter tache -->

      <a href="#popupTache" data-role="button" data-rel="popup" data-inline="true" data-icon="plus" data-iconpos="notext" data-mini="true" >nouvlle tache</a>

      <!-- ***************** -->


      <a href="#popupDisconnect" data-role="button" data-rel="popup" data-inline="true" data-icon="back" data-iconpos="notext" data-mini="true" >Déconnexion</a>
      <div data-role="popup" id="popupDisconnect" data-position-to="window"  data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
        <div data-role="header" data-theme="a"><h1>Déconnexion</h1></div>
        <div role="main" class="ui-content">
          <h3 class="ui-title">Voulez-vous vraiment vous déconnecter ?</h3>
          <a href="#" data-role="button" data-inline="true" data-icon="delete" data-rel="back">Annuler</a>
          <!--  <a href="connexion.html" data-role="button" data-inline="true" data-icon="check">Valider</a> -->
          <?php echo $this->Html->link('Valider',array('controller' => 'Users','action' => 'logout'),array('data-role'=>'button','data-inline'=>true,'data-icon'=>'check')); ?>

        </div>
      </div>
    </div>
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
       </div>


