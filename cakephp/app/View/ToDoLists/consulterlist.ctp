<div data-role="page" data-theme="a" id="page_mainScreen" data-dom-cache="false">


    <div data-role="header" data-position="inline" data-theme="a">
        <h1 style="text-align:left;">
            <?php echo $this->Html->image('icone_entete.png', array('alt' => 'icone_entete', 'style' => 'vertical-align : middle')); ?>
            Accueil
        </h1>
        <?php echo $this->element('menu') ?>
    </div>


    <div data-role="content">
        <?php echo $this->Session->flash(); ?>
        <h4 class="ui-bar ui-bar-a">Aujourd'hui</h4>

        <?php
        echo "<table width = 100% >";
        foreach ($listes as $key => $value) {
            echo "<tr>";
            $nom = $value['Todolist']['name'];
            $id = $value['Todolist']['id'];
            echo "<td style =text-align:left;text-indent:3em;padding-bottom:10px' >";
            echo $nom . " ";
            echo "</td>";

            echo "<td style='padding-bottom:10px'>";
            echo $this->html->link($this->html->image("fleche-droite-grise.png"), array('controller' => 'Todolists', 'action' => 'consulterlistdetail', $id), array('data-ajax' => 'false', 'escape' => false));
            echo "</td>";
        }

        echo "</table>";
        ?>

        <br/>
        <h4 class="ui-bar ui-bar-a">Demain</h4>

        <br/>
    </div>
    <!--
        <script type="text/javascript">
            if (window.location.hash && window.location.hash == '#_=_') {
                window.location.hash = '';
            }
        </script>
        -->
    <?php echo $this->element('popup_erreur') ?>

</div>
