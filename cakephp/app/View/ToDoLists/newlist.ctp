<?php
if(empty($this->request->data)){

	$tableau['name'] = "";
	$tableau['text'] = "";
	$tableau['dateBegin'] = "";
	$tableau['dateEnd'] = "";
	$tableau['frequency'] = "";
}
else{

	$todolist = $this->request->data['Todolist'];
	$tableau['name'] = $todolist['name'];
	$tableau['text'] =  $todolist['text'];
	$tableau['dateBegin'] =  $todolist['dateBegin'];
	$tableau['dateEnd'] =  $todolist['dateEnd'];
	$tableau['frequency'] =  $todolist['frequency'];

}


?>

	<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ajouter liste PPIL</title>
	<link rel="stylesheet" href="css/model.css" />
	<link rel="stylesheet" href="css/PpilBlue.min.css" />
	<link rel="stylesheet" href="css/jquery.mobile.icons.min.css" />
	<link rel="stylesheet" href="css/jquery.mobile.structure-1.4.5.min.css" />
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>
	<div data-role="page" data-theme="b" id="page_option">
		<div data-role="header" data-theme="a">
			<h1>Ajouter une liste</h1>
			<div data-role="controlgroup" data-type="horizontal" data-mini="true" class="ui-btn-right">
				<?php 
				$url = array('controller'=>'Todolists','action'=>'consulterlist');
				echo $this->form->button('', array('type' => 'button','data-inline'=>'true','data-icon'=>'home','data-iconpos'=>'notext', 'data-mini'=>'true','onclick' => "location.href='".$this->Html->url($url)."'")); ?>
				<a data-role="button" data-inline="true" data-icon="bars" data-iconpos="notext" data-mini="true" >Menu</a>
			</div>
		</div>
		<div data-role="content">
			<form action="newlist" method="post">
			<input type="text" data-clear-btn="true" name="data[Todolist][name]" id="name" placeholder="Intitulé de la liste"/>
      <br/>
      <div data-role="content" data-theme="c">
        Facultatif
        <input type="text" data-clear-btn="true" name="data[Todolist][text]" id="text" placeholder="Commentaire"/>
        <input type="text" data-clear-btn="true" name="data[Todolist][dateBegin]" id="dateBegin" placeholder="Date de début(JJ/MM/AAA)"/>
        <input type="text" data-clear-btn="true" name="data[Todolist][dateEnd]" id="dateEnd" placeholder="Date de fin(JJ/MM/AAA)"/>
        <a href="#" data-role="button" data-inline="true">Ajouter un Membre</a>
        
      </div>
      <br/>
      <input type="submit" value="Créer la liste" name="envoyer" />
		</div>
	</div>
</body>
</html>