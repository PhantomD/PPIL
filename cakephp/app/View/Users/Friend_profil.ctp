<?php

$tableauBirthday = explode("/", $birthdate);

$mois = "";
switch ($tableauBirthday[0]) {

    case 1:
        $mois = "Janvier";
        break;
    case 2:
        $mois = "Fevrier";
        break;
    case 3:
        $mois = "Mars";
        break;
    case 4:
        $mois = "Avril";
        break;
    case 5:
        $mois = "Mai";
        break;
    case 6:
        $mois = "Juin";
        break;
    case 7:
        $mois = "Juillet";
        break;
    case 8:
        $mois = "Août";
        break;
    case 9:
        $mois = "Septembre";
        break;
    case 10:
        $mois = "Octobre";
        break;
    case 11:
        $mois = "Novembre";
        break;
    case 12:
        $mois = "Décembre";
        break;
}
$birthdate = $tableauBirthday[1] . " " . $mois . " " . $tableauBirthday[2];


$image = ($gender === "male" ? "male.png" : "femage.png");
?>

<div data-role="page" data-theme="b" id="page_option">
    <div data-role="header" data-theme="a">


        <h1 style="text-align:left;">
            <?php echo $this->Html->image('icone_entete.png', array('alt' => 'icone_entete', 'style' => 'vertical-align : middle')); ?>
            Profil d'un ami
        </h1>
        <?php echo $this->element('menu'); ?>
    </div>


    <div data-role="content" style="font-weight:bold">

        <p style="text-align:left;">
            <?php
            echo $this->Html->image('icone-ami.png', array('alt' => 'icone-ami'));
            echo "<span style ='font-size: 1.5em'> " . $name . " </span>";
            echo $this->Html->image('male.png', array('alt' => 'male'));
            ?>
        </p>

        <p style="text-align:left;margin-left:20px;">
            Anniversaire <br/>
            <span style='margin-left:23px'> <?php echo $birthdate; ?> </span>
        </p>

        <p style="text-align:left;margin-left:20px">
            Adresse e-mail<br/>
            <span style='margin-left:23px'> <?php echo $email; ?> </span>
        </p>

    </div>
</div>
