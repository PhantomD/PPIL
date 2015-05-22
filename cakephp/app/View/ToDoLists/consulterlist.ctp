<div data-role="page" data-theme="a" id="page_mainScreen" data-dom-cache="false">


    <div data-role="header" data-position="inline" data-theme="a">
        <h1 style="text-align:left;">
            <?php echo $this->Html->image('icone_entete.png', array('alt' => 'icone_entete', 'style' => 'vertical-align : middle')); ?>
            Accueil

        </h1>
        <?php echo $this->element('menu') ?>
    </div>
    <div data-role="content">
        <?php echo $this->Session->flash();

        echo "<h4 class='ui-bar ui-bar-a'>Aujourd'hui</h4>";


        echo "<table id ='table_tache_listes_today' >";
        echo "<tbody>";
        foreach ($today as $key => $value) {
            $nom = $value['name'];
            $id = $value['id'];
            echo "<tr id='ligneListe" . $id . "' >";
            echo "<td>";
            echo $nom . " ";
            echo "</td>";

            echo "<td class=fleche>";
            echo $this->html->link($this->html->image("fleche-droite-grise.png"), array('controller' => 'Todolists', 'action' => 'consulterlistdetail', $id), array('data-ajax' => 'false', 'escape' => false));
            echo "</td>";
        }
        echo "</tbody>";
        echo "</table>";


        // SEMAINE

        echo "<h4 class='ui-bar ui-bar-a'>Cette semaine</h4>";

        echo "<table id ='table_tache_listes_week' >";
        echo "<tbody>";
        foreach ($week as $key => $value) {
            $nom = $value['name'];
            $id = $value['id'];
            echo "<tr id='ligneListe" . $id . "' >";
            echo "<td>";
            echo $nom . " ";
            echo "</td>";

            echo "<td class=fleche>";
            echo $this->html->link($this->html->image("fleche-droite-grise.png"), array('controller' => 'Todolists', 'action' => 'consulterlistdetail', $id), array('data-ajax' => 'false', 'escape' => false));
            echo "</td>";
        }
        echo "</tbody>";
        echo "</table>";


        echo "<h4 class='ui-bar ui-bar-a'>Autre </h4>";


        echo "<table id ='table_tache_listes_other' >";
        echo "<tbody>";
        foreach ($other as $key => $value) {
            $nom = $value['name'];
            $id = $value['id'];
            echo "<tr id='ligneListe" . $id . "' >";
            echo "<td>";
            echo $nom . " ";
            echo "</td>";

            echo "<td class=fleche>";
            echo $this->html->link($this->html->image("fleche-droite-grise.png"), array('controller' => 'Todolists', 'action' => 'consulterlistdetail', $id), array('data-ajax' => 'false', 'escape' => false));
            echo "</td>";
        }
        echo "</tbody>";
        echo "</table>";


        //   echo $this->Paginator->numbers();
        ?>


        <br/>
    </div>

    <?php echo $this->element('popup_erreur');
    echo $this->Html->script('consulterlist'); ?>

</div>
