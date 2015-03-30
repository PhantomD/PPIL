<div data-role="page" data-theme="b" id="page_newlist">

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

<div>
			<h1>New Todolist</h1>
		</div>

	<?php
	echo $this->form->create(array('type'=>'post',array('action'=>'newlist')));

	//Nom liste
			?> <h2>Name</h2> <?php
			echo $this->form->input('', array('type' => 'text','name' => 'data[Todolist][name]','id'=>'name', 'value'=>$tableau['name']));

	//Description Liste
			?> <h2>Description</h2><?php
			echo $this->form->input('', array('type' => 'text','name' => 'data[Todolist][text]','id'=>'text','value'=>$tableau['text']));

	//Date début
			?> <h2>Date Début (JJ/MM/AAAA)</h2>  <?php
			echo $this->form->input('', array('type' => 'text','name' => 'data[Todolist][dateBegin]','id'=>'datebegin','value'=>$tableau['dateBegin']));

	// Date Fin
			?> <h2>Date Fin (JJ/MM/AAAA)</h2> <?php
			echo $this->form->input('', array('type' => 'text','name' => 'data[Todolist][dateEnd]','id'=>'dateEnd','value'=>$tableau['dateEnd']));

	// Frequence
			?> <h2>Fréquence</h2> <?php
			echo $this->form->input('', array('type' => 'text','name' => 'data[Todolist][frequency]','id'=>'frequency','value'=>$tableau['frequency']));

	?> <br><br> <?php
	echo $this->form->end('CreerListe',array('id'=>'newlist'));





	?>