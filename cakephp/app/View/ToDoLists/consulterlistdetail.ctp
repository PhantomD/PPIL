<div data-role="page" data-theme="a" id="page_mainScreen">
    <div data-role="header" data-position="inline" data-theme="a">
        <h1 style="text-align:left;">
            <?php echo $this->Html->image('icone_entete.png', array('alt' => 'icone_entete', 'style' => 'vertical-align : middle')); ?>
            Liste
        </h1>
        <?php echo $this->element('menu', array($liste)) ?>
    </div>


    <div data-role="content">
        <?php echo $this->Session->flash();
        ?>

        <h4 class="ui-bar ui-bar-a"><?php echo $liste['name'] ?></h4>
        <?php
        //debug($liste);
        //debug($taches);
        echo "Description : " . $liste['text'];
        ?> <br><br> <?php
        echo "Date de début : " . $liste['dateBegin'];
        ?> <br><br> <?php
        echo "Date de fin : " . $liste['dateEnd'];
        ?>
    </div>

    <div data-role="collapsibleset" data-theme="a" data-content-theme="a" data-iconpos="right">

        <?php
        //debug($taches);
        foreach ($taches as $key => $value) :
        $icone = ($value['isChecked'] == true ? "check" : "false");

        echo '<div id=div' . $value['id'] . ' data-role="collapsible" data-collapsed-icon=' . $icone . ' data-expanded-icon=' . $icone . " data-iconpos='left' >";


        if(! empty($value['comment'])){
            echo "<p style='text-align:center';> <b>Commentaire </b> : ".$value['comment']."</p>";
        }

        echo "<div id='erreurTask".$value['id']."' ></div>" ;



        echo "<div style='width: 10%;margin: auto;'>";

        $disable = ($value['isChecked'] == false || (AuthComponent::user()['id'] == $value['User']['id']) ? false : true);
        echo $this->Form->input("valider", array('type' => 'checkbox', 'id' =>'validerBouton'.$value['id'], 'name' => $value['id'], "checked" => $value['isChecked'], 'hiddenField' => false, 'disabled' => $disable,
            'label' => array("class" => "ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-checkbox-off"), 'data-ajax' => 'false','data-mini'=>'true', 'onclick' => 'cocher(this)'));
        echo "</div>";

        $value['date'];
        $nom = '';
        $date = '';
        $nomDate = '';
        if ($value['isChecked'] == true) {
            $nom = $value['User']['firstname'] . " " . $value['User']['name'];
            $tab = explode("-", $value['date']);

            if (count($tab) == 3) {
                $date = $tab[2] . "/" . $tab[1] . "/" . $tab[0];
            }
            $nomDate = $nom . " (" . $date . ")";

            //    debug($value);
        }
        ?>
        <h2>
            <span id="nameTask<?php echo $value["id"];?>"
                  style="font-size: 20px; vertical-align:middle; float:left; line-height: 38px"> <?php echo $value['name']; ?> </span>
            <span
                style="font-size: 15px; vertical-align:middle; float:right; line-height: 38px"><?php echo $nomDate; ?> </span>
        </h2>


        <ul id="listeCommentaire<?php echo $value["id"];?>" style="padding-left:20%">
            <?php foreach ($value['Commentary'] as $key => $commentaire) {

                $nom = $commentaire['User']['firstname'] . " " . $commentaire['User']['name'];
                echo "<li style='width:75%'>";//.$this->Html->image('point-noir.png');
                echo $commentaire['text'] . "</li> <div id='comment-name'>-" . $nom . "</div>";
            }
            ?>
        </ul>

        <div class="ui-grid-b center">
            <div class="ui-block-c">
                <?php
                echo "<a href='' id=delete" . $value["id"] . " data-role='button'  data-rel='popup' data-inline='true' data-icon='delete' data-iconpos='notext' data-mini='true' onclick ='deleteTask(" . $value['id'] . ")' >Supprimet tâche <span> </a>";
                ?>
            </div>
            <div class="ui-block-c"><a href="" id="editTask" class="editTask" data-role="button" data-theme='c'
                                       data-rel="popup" name="<?php echo $value["id"]; ?>"
                                       data-inline="true"
                                       data-icon="edit" data-iconpos="notext" data-mini="true">Modifier tâche</a></div>

            <div class="ui-block-c">
                <?php
                //comment
                echo "<a href='' id=delete" . $value["id"] . " name='" . $value["id"] . "' class='comment' data-role='button' data-rel='popup' data-inline='true' data-icon='comment'
             data-iconpos='notext' data-mini='true' > ajouter un commentaire  </a>";
                ?>
            </div>

        </div>

    </div>

    <?php

    endforeach; ?>


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



    <!-- popup delete tache -->
    <div data-role="popup" id="popupDeleteTask" data-position-to="window" data-overlay-theme="b" data-theme="b"
         data-dismissible="false" style="max-width:400px;">
        <div role="main" class="ui-content">
            <h3 class="ui-title">Voulez-vous vraiment vous supprimer cette tâche ?</h3>
            <a href="#" id="DeleteTaskAnnule" data-role="button" data-inline="true" data-icon="delete" data-rel="back">Annuler</a>
            <a href="#" data-role="button" data-inline="true" data-icon="check" data-rel="back">Valider</a>
        </div>
    </div>


    <div data-role="popup" id="popupEditTask" data-position-to="window" data-overlay-theme="b" data-theme="b"
         data-dismissible="false" style="max-width:400px;">
        <div role="main" class="ui-content">
            <div data-role="header" data-theme="a"><h1>Modifier le nom de la tâche</h1></div>
            <p id="erreurEditTask" class="flash-message-error" style="text-align:center"></p>
            <input id="editTaskName"></textarea>
            <a href="#" id="editTaskCancel" data-role="button" data-inline="true" data-icon="delete" data-rel="back">Annuler</a>
            <a href="#" id="editTaskOk" data-role="button" data-inline="true" data-icon="check"
               data-rel="back">Valider</a>
        </div>
    </div>


    <div data-role="popup" id="popupAddComment" data-position-to="window" data-overlay-theme="b" data-theme="b"
         data-dismissible="false" style="max-width:400px;">
        <div role="main" class="ui-content">
            <h3 class="ui-title">Ajouter un commentaire</h3>

            <p id="erreurCommentTask" class="flash-message-error" style="text-align:center"></p>
            <textarea id="inputTextCommment" name="textarea_comment" id="textarea_comment"></textarea>
            <a href="#" id="commentCancel" data-role="button" data-inline="true" data-icon="delete"
               data-rel="back">Annuler</a>
            <a href="#" id="commentOk" data-role="button" data-inline="true" data-icon="check"
               data-rel="back">Valider</a>
        </div>
    </div>




    <?php
    echo $this->element('popup_erreur');
    echo $this->Html->script('consulterlistdetail');
    ?>
</div>