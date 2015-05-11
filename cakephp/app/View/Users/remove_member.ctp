<?php
$liste = $id;
?>

<div data-role="page" data-theme="b" id="page_option">
    <div data-role="header" data-position="inline" data-theme="a">
        <h1 style="text-align:left;">
            <?php echo $this->Html->image('icone_entete.png', array('alt' => 'icone_entete', 'style' => 'vertical-align : middle')); ?>
            Supprimer des membres
        </h1>
        <?php echo $this->element('menu') ?>
    </div>

    <div data-role="content" style="margin-top: 20px;">

        <p id="flash" class="flash-message-success"></p>
        <?php

        if (!empty($profil)) {


            echo "<table width = 100% >";

            foreach ($profil as $key => $value) {


                if ($value['User_id'] == AuthComponent::user()['id']) {
                    continue;
                }

                echo "<tr  id=ligne$value[id]>";

                echo "<td style ='color:#ffffff;font-size: 1.1em;text-align:left;text-indent:3em;padding-bottom:10px' >";
                echo $value['name'];
                echo "</td>";

                echo "<td style='padding-bottom:10px'>";
                echo $this->html->link($this->html->image("fleche-droite.png"), array(''), array('id' => $value['id'], 'class' => 'ajax', 'onclick' => 'removeMember(this)', 'data-ajax' => 'false', 'escape' => false));
                echo "</td>";

                echo "</tr>";
            }
            echo "</table>";

        } else {
            echo "personne dans la liste";
        }


        ?>
        <p id="idliste" style="visibility: hidden"><?php echo $liste; ?></p>
        <?php echo $this->Html->script('remove_member'); ?>
    </div>
</div>






