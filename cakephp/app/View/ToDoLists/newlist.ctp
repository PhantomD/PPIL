<div data-role="page" data-theme="b" id="page_newlist">

<div>
			<h1>New ToDoList</h1>
		</div>

	<?php
	echo $this->form->create(array('type'=>'post',array('action'=>'newlist')));

echo $this->form->input('', array('type' => 'text','name' => 'Name','id'=>'Name', 'value'=>'Name'));
echo $this->form->input('', array('type' => 'text','name' => 'Description','id'=>'Description','value'=>'Description'));
echo $this->form->input('', array('type' => 'text','name' => 'Datebegin','id'=>'Datebegin','value'=>'DateBegin(JJ/MM/AAA)'));
echo $this->form->input('', array('type' => 'text','name' => 'Dateend','id'=>'Dateend','value'=>'DateEnd(JJ/MM/AAA)'));
echo $this->form->input('', array('type' => 'text','name' => 'Frequency','id'=>'Frequency','value'=>'Frequency'));

	echo $this->form->end('Valider',array('name'=>'Valider','id'=>'Valider'));





	?>