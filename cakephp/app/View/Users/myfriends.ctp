<div data-role="page" data-theme="b" id="page_option">
    <div data-role="header" data-position="inline" data-theme="a">
        <h1 style="text-align:left;">
            <?php echo $this->Html->image('icone_entete.png', array('alt' => 'icone_entete', 'style' => 'vertical-align : middle')); ?>
            Amis
        </h1>
        <?php echo $this->element('menu') ?>
    </div>

    <div data-role="content" style="margin-top: 20px;">

        <?php

        echo "<table width = 100% >";
        foreach ($amis as $key => $value) {
            echo "<tr>";

            echo "<td style = 'font-size: 1.1em;text-align:left;text-indent:3em;padding-bottom:10px'>";
            echo $value->name;
            echo "</td>";

            echo "<td style='padding-bottom:10px'>";
            echo $this->html->link($this->html->image("fleche-droite.png"), array('action' => 'Friend_profil', $value->id), array('escape' => false));
            echo "</td>";

            echo "</tr>";
        }
        echo "</table>"

        ?>

    </div>
</div>



