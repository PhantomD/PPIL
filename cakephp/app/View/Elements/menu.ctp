<div data-role="controlgroup" data-type="horizontal" data-mini="true" class="ui-btn-right">


    <!-- retour arrière d

    if ($this->action != "consulterlist") {
        $url = ($this->request->referer() === '/' ? '/PPILFINAL/PPIL/cakephp/Todolists/consulterlist' : $this->request->referer());
        echo $this->Html->link('retour arrière', $this->Html->url($url),
            array('data-role' => "button", 'data-inline' => "true", 'data-icon' => "back", 'data-iconpos' => 'notext', 'data-mini' => "true", 'data-ajax' => 'false'));
    }
    -->

    <!--HOME -->
    <?php
    if ($this->action != "consulterlist")
        echo $this->Html->link('Page principale', array('controller' => 'Todolists', 'action' => 'consulterlist'),
            array('data-role' => "button", 'data-inline' => "true", 'data-icon' => "home", 'data-iconpos' => 'notext', 'data-mini' => "true", 'data-ajax' => 'false')); ?>

    <!--RAFRAICHIR -->
    <?php
    if (!in_array($this->action, array('modificationProfil', 'profil', 'newlist', 'modifylist', 'consulterlistdetail', 'Friend_profil', 'removeMember', 'add_member', 'FriendProfil'))) {
        echo $this->Html->link('Rafraichir', array('controller' => $this->request->params['controller'], 'action' => $this->action), array('data-role' => 'button', 'data-inline' => true, 'data-icon' => 'recycle', 'data-iconpos' => 'notext', 'data-ajax' => 'false', 'data-mini' => true));
    }

    if ($this->action === 'consulterlist') {
        // bouton ajouter liste
        echo $this->Html->link('Ajouter une liste', array('controller' => 'Todolists', 'action' => 'newlist'), array('data-role' => 'button', 'data-inline' => true, 'data-icon' => 'plus', 'data-iconpos' => 'notext', 'data-mini' => true, "data-ajax" => false));
    } elseif ($this->action === 'consulterlistdetail') {
        ?>
        <!-- POPUP NEW TASK -->
        <a href="#popupTache" data-role="button" data-rel="popup" data-inline="true" data-icon="plus"
           data-iconpos="notext" data-mini="true">nouvlle tache</a>
        <div data-role="popup" id="popupTache" data-position-to="window" data-overlay-theme="b" data-theme="b"
             data-dismissible="false" style="max-width:400px;">
            <div data-role="header" data-theme="a"><h1>Ajouter une tâche</h1></div>
            <div role="main" class="ui-content">

                <?php echo $this->Form->create('newTache', array(
                    'type' => 'post',
                    'url' => array('controller' => 'Tasks', 'action' => 'newtask', $liste['id']),
                    'data-ajax' => 'false',
                    'inputDefaults' => array(
                        'label' => false,
                        'data-clear-btn' => true))); ?>


                <div data-role='content' data-theme='f'>
                    <div style='width:90%;margin:auto;padding-left:15px;padding-bottom:0'>
                        <?php echo $this->Form->input('Task.name', array('type' => 'text', 'required' => true, 'placeholder' => 'intitulé de la tâche')); ?>
                    </div>
                    <fieldset>
                        <legend>Facultatif</legend>

                        <?php
                        echo $this->Form->input('Task.comment', array('type' => 'text', 'required' => false, 'placeholder' => "Commentaire"));
                        echo $this->Form->input('Task.todolist_id', array('type' => 'hidden', 'required' => true, "value" => $liste['id']));
                        ?>
                    </fieldset>

                    <div class="center">
                        <a href="#" data-role="button" data-inline="true" data-icon="delete" data-rel="back">Annuler</a>

                        <?php echo $this->form->end(array('label' => 'Valider', 'data-role' => "button", 'data-inline' => "true", 'data-icon' => "check", 'div' => false)); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- **************** -->
    <?php }

    // menu liste déroulante
    if (!in_array($this->action, array('modificationProfil', 'profil', 'newlist', 'modifylist'))) {


        echo '<a href="#popupMenu" data-role="button" data-rel="popup" data-inline="true" data-icon="bars" data-iconpos="notext" data-mini="true" data-transition="slidedown">Menu</a>';

        echo ' <div data-role="popup" id="popupMenu" data-theme="b">';
        echo ' <ul data-role="listview" data-inset="true" style="min-width:210px;">';
        echo '  <li data-role="list-divider">Menu</li>';

        //afficher profil
    if (!in_array($this->action, array('modificationProfil', 'profil', 'newlist', 'modifylist', 'consulterlistdetail', 'Friend_profil', 'removeMember', 'add_member', 'FriendProfil'))) {
        echo "  <li>" . $this->Html->link('Afficher profil', array('controller' => 'Users', 'action' => 'profil'), array('data-ajax' => 'false')) . "</li>";
    }

        // Supprimer Liste
        if ($this->action === 'consulterlistdetail') {
            echo "<li>" . $this->Html->link('ajouter membre', array('controller' => 'Users', 'action' => 'addMember', $id), array("data-ajax" => "false")) . "</li>";
            echo "<li>" . $this->Html->link('supprimer membre', array('controller' => 'Users', 'action' => 'removeMember', $id), array("data-ajax" => "false")) . "</li>";
            echo "<li>" . $this->Html->link('modifier la liste', array('controller' => 'Todolists', 'action' => 'modifylist', $id), array("data-ajax" => "false")) . "</li>";
            echo "<li>" . $this->Html->link('supprimer la liste', array('controller' => 'Todolists', 'action' => 'supprimer', $id), array("data-ajax" => "false")) . "</li>";
        }

        // deconnexion
        echo " <li>" . $this->Html->link('Deconnexion', array('controller' => 'Users', 'action' => 'logout'), array('data-ajax' => 'false')) . " </li>";
        echo " </ul>";
        echo "</div>";
    }


    if (!in_array($this->action, array('Friend_profil',))) {
        ?>
        <a href="#popupDisconnect" data-role="button" data-rel="popup" data-inline="true" data-icon="delete"
           data-iconpos="notext" data-mini="true">Deconnexion</a>
    <?php } ?>

    <div data-role="popup" id="popupDisconnect" data-position-to="window" data-overlay-theme="b" data-theme="b"
         data-dismissible="true" style="max-width:400px;">
        <div data-role="header" data-theme="a"><h1>Deconnexion</h1></div>
        <div role="main" class="ui-content">
            <h3 class="ui-title">Voulez-vous vraiment vous déconnecter ?</h3>
            <a href="#" data-role="button" data-inline="true" data-icon="delete" data-rel="back">Annuler</a>
            <!--  <a href="connexion.html" data-role="button" data-inline="true" data-icon="check">Valider</a> -->
            <?php echo $this->Html->link('Valider', array('controller' => 'Users', 'action' => 'logout'), array('data-role' => 'button', 'data-inline' => true, 'data-icon' => 'check', "data-ajax" => "false")); ?>
        </div>
    </div>

</div>
