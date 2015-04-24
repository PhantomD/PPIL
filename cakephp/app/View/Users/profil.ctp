<?php

$tableauBirthday = explode("-",$profil['birthdate']);
$profil['birthdate'] = $tableauBirthday[2]."/".$tableauBirthday[1]."/".$tableauBirthday[0];
$profil['firstname'] = ucfirst($profil['firstname']);
$profil['name'] = ucfirst($profil['name']);

?>

<div data-role="page" data-theme="b" id="page_option">
	<div data-role="header" data-theme="a">


		<h1 style="text-align:left;">
			<?php echo $this->Html->image('icone_entete.png', array('alt' => 'icone_entete','style'=>'vertical-align : middle'));?>
			Profil
		</h1>

			<div data-role="controlgroup" data-type="horizontal" data-mini="true" class="ui-btn-right">
			    <?php echo $this->Html->link('Page principale',array('controller' => 'Todolists','action' => 'consulterlist'), array('data-role'=>"button",'data-inline'=>"true", 'data-icon'=>"home", 'data-iconpos'=>'notext','data-mini'=>"true" )); ?>

				<a data-role="button" data-inline="true" data-icon="bars" data-iconpos="notext" data-mini="true" >Menu</a>
			</div>
		</div>


		<div data-role="content">
			<?php echo  "<h2 style='text-align:left;margin-left:22%';>". $profil['firstname']." ".$profil['name']."</h2>"; ?>

			<p style="text-align:left;margin-left:20%;margin-bottom:20%">

				Anniversaire</br>
				<?php  echo "<span style='margin-left:20px;line-height:2;'>".$profil['birthdate']."</span><br/>"; ?>
				Adresse e-mail</br>
				<?php  echo   "<span style='margin-left:20px;line-height:2'>".$profil['email']."</span><br/>"; 

				?>

			</p>

			<p style = 'margin-left:auto;margin-right: auto;width:70%;line-height;'>
			<a href="#" data-role="button">Afficher les amis</a>
			<br/>
			 <?php echo $this->Html->link('Éditer le profil',array('controller' => 'Users','action' => 'modificationProfil'), array('data-role'=>"button")); ?>

			</p>
		</div>
	</div>
