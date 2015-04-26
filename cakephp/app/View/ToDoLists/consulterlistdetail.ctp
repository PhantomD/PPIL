
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
   //debug($liste);
   //debug($taches);
   echo "Description : ".$liste['text'];
   ?> <br><br> <?php
   echo "Date de début : ".$liste['dateBegin'];
   ?> <br><br> <?php
   echo "Date de fin : ".$liste['dateEnd'];
   ?> 
 </div>

 <div data-role="collapsibleset" data-theme="a" data-content-theme="a" data-iconpos="right">

<?php 
//debug($taches);
foreach($taches as $key=>$value) : ?>

  <div data-role="collapsible" data-collapsed-icon="" data-expanded-icon="">
    <h2><?php echo $value['name']; ?> </h2>
    <div>
     <?php echo $this->Form->input("valider",array('type'=>'checkbox', 'id'=>$value['id'],'name'=>$value['id'],'hiddenField' => false,
      'label'=>array("class"=>"ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-checkbox-off"),'data-ajax' => 'false', 'onclick' => 'checkbox(this)')); ?>
   </div>
   </div>

<?php 

endforeach; ?>

</div>
 
 <!-------
      <div data-role="collapsibleset" data-theme="a" data-content-theme="a" data-iconpos="right">
        <div data-role="collapsible" data-collapsed-icon="" data-expanded-icon="">
          <h2>Acheter Champomy</h2>
          <div>
            <input name="checkbox-1" id="checkbox-1" type="checkbox">
            <label for="checkbox-1">Valider</label>
          </div>
          <div class="ui-grid-b center">
            <div class="ui-block-a"><a href="#popupDeleteTask" data-role="button"  data-rel="popup" data-inline="true" data-icon="delete" data-iconpos="notext" data-mini="true" >Supprimet tâche</a></div>
            <div class="ui-block-b"><a href="#popupEditTask" data-role="button"  data-rel="popup" data-inline="true" data-icon="edit" data-iconpos="notext" data-mini="true" >Modifier tâche</a></div>
            <div class="ui-block-c"><a href="#popupAddComment" data-role="button"  data-rel="popup" data-inline="true" data-icon="comment" data-iconpos="notext" data-mini="true" >Ajouter commentaire</a></div>
          </div>
        </div>
        <div data-role="collapsible" data-collapsed-icon="check" data-expanded-icon="check">
          <h3>Réserver gâteau</h3>
          <div>
            <input name="checkbox-2" id="checkbox-2" type="checkbox" checked="checked">
            <label for="checkbox-2">Valider</label>
          </div>
          <div class="ui-grid-b center">
            <div class="ui-block-a"><a href="#popupDeleteTask" data-role="button"  data-rel="popup" data-inline="true" data-icon="delete" data-iconpos="notext" data-mini="true" >Supprimet tâche</a></div>
            <div class="ui-block-b"><a href="#popupEditTask" data-role="button"  data-rel="popup" data-inline="true" data-icon="edit" data-iconpos="notext" data-mini="true" >Modifier tâche</a></div>
            <div class="ui-block-c"><a href="#popupAddComment" data-role="button"  data-rel="popup" data-inline="true" data-icon="comment" data-iconpos="notext" data-mini="true" >Ajouter commentaire</a></div>
          </div>
        </div>
        <div data-role="collapsible" data-collapsed-icon="" data-expanded-icon="">
          <h3>Aller chercher gâteau</h3>
          <p>Gâteau réservé au nom Legrand à la patisserie Ducoin.</p><div id="comment-name">-Clément</div>
          <p>Quel jour ?</p><div id="comment-name">-Arthur</div>
          <p>Bah, le 03/02, ke jour de l'anniv. Tu t'en occupe ?</p><div id="comment-name">-Clément</div>
          <p>Ouais, c'est sur mon chemin pour venir.</p><div id="comment-name">-Arthur</div>
          <div>
            <input name="checkbox-3" id="checkbox-3" type="checkbox" data-inline="false">
            <label for="checkbox-3">Valide</label>
          </div>
          <div class="ui-grid-b center">
            <div class="ui-block-a"><a href="#popupDeleteTask" data-role="button"  data-rel="popup" data-inline="true" data-icon="delete" data-iconpos="notext" data-mini="true" >Supprimet tâche</a></div>
            <div class="ui-block-b"><a href="#popupEditTask" data-role="button"  data-rel="popup" data-inline="true" data-icon="edit" data-iconpos="notext" data-mini="true" >Modifier tâche</a></div>
            <div class="ui-block-c"><a href="#popupAddComment" data-role="button"  data-rel="popup" data-inline="true" data-icon="comment" data-iconpos="notext" data-mini="true" >Ajouter commentaire</a></div>
          </div>
        </div>
        <div data-role="collapsible" data-collapsed-icon="" data-expanded-icon="">
          <h3>Acheter ballons</h3>
          <p>Il m'en reste trois rouge et un bleu.</p><div id="comment-name">-Jean-Charles</div>
          <div>
            <input name="checkbox-4" id="checkbox-4" type="checkbox">
            <label for="checkbox-4">Valider</label>
          </div>
          <div class="ui-grid-b center">
            <div class="ui-block-a"><a href="#popupDeleteTask" data-role="button"  data-rel="popup" data-inline="true" data-icon="delete" data-iconpos="notext" data-mini="true" >Supprimet tâche</a></div>
            <div class="ui-block-b"><a href="#popupEditTask" data-role="button"  data-rel="popup" data-inline="true" data-icon="edit" data-iconpos="notext" data-mini="true" >Modifier tâche</a></div>
            <div class="ui-block-c"><a href="#popupAddComment" data-role="button"  data-rel="popup" data-inline="true" data-icon="comment" data-iconpos="notext" data-mini="true" >Ajouter commentaire</a></div>
          </div>
        </div>
      </div>


-->








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




    <div data-role="popup" id="popupDeleteTask" data-position-to="window" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
      <div role="main" class="ui-content">
        <h3 class="ui-title">Voulez-vous vraiment vous supprimer cette tâche ?</h3>
        <a href="#" data-role="button" data-inline="true" data-icon="delete" data-rel="back">Annuler</a>
        <a href="#" data-role="button" data-inline="true" data-icon="check"  data-rel="back">Valider</a>
      </div>
    </div>
    <div data-role="popup" id="popupEditTask" data-position-to="window" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
      <div role="main" class="ui-content">
        <div data-role="header" data-theme="a"><h1>Ajouter un commentaire</h1></div>
        <textarea name="textarea_comment" id="textarea_comment"></textarea>
        <a href="#" data-role="button" data-inline="true" data-icon="delete" data-rel="back">Annuler</a>
        <a href="#" data-role="button" data-inline="true" data-icon="check"  data-rel="back">Valider</a>
      </div>
    </div>
    <div data-role="popup" id="popupAddComment" data-position-to="window" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
      <div role="main" class="ui-content">
        <h3 class="ui-title">Ajouter un commentaire</h3>
        <textarea name="textarea_comment" id="textarea_comment"></textarea>
        <a href="#" data-role="button" data-inline="true" data-icon="delete" data-rel="back">Annuler</a>
        <a href="#" data-role="button" data-inline="true" data-icon="check"  data-rel="back">Valider</a>
      </div>
    </div>





<?php 
echo $this->element('popup_erreur') ;
echo $this->Html->script('consulterlistdetail');
?>
</div>
