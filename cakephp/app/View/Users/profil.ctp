<?php

$tableauBirthday = explode("-", $profil['birthdate']);
$profil['birthdate'] = $tableauBirthday[2] . "/" . $tableauBirthday[1] . "/" . $tableauBirthday[0];
$profil['firstname'] = ucfirst($profil['firstname']);
$profil['name'] = ucfirst($profil['name']);

?>

<div data-role="page" data-theme="b" id="page_option">
    <div data-role="header" data-theme="a">


        <h1 style="text-align:left;">
            <?php echo $this->Html->image('icone_entete.png', array('alt' => 'icone_entete', 'style' => 'vertical-align : middle')); ?>
            Profil
        </h1>
        <?php echo $this->element('menu') ?>
    </div>


    <div data-role="content">
        <?php echo $this->Session->flash(); ?>
        <?php echo "<h2 style='text-align:left;margin-left:22%';>" . $profil['firstname'] . " " . $profil['name'] . "</h2>"; ?>

        <p style="text-align:left;margin-left:20%;margin-bottom:20%">

            Anniversaire</br>
            <?php echo "<span style='margin-left:20px;line-height:2;'>" . $profil['birthdate'] . "</span><br/>"; ?>
            Adresse e-mail</br>
            <?php echo "<span style='margin-left:20px;line-height:2'>" . $profil['email'] . "</span><br/>";

            ?>

        </p>

        <p>
            <?php echo $this->Html->link('Mes amis', array('controller' => 'Users', 'action' => 'myfriends'), array("data-role" => "button", "data-ajax" => "false")); ?>
            <br/>
            <?php echo $this->Html->link('Éditer le profil', array('controller' => 'Users', 'action' => 'modificationProfil'), array('data-role' => "button")); ?>

        </p>
    </div>

    <?php echo $this->element('popup_erreur') ?>

</div>
