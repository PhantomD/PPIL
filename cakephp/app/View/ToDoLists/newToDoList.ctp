<div data-role="page" data-theme="b" id="page_newlist">

<div>
			<h1>New ToDoList</h1>
		</div>

	<?php
	echo $this->form->create(array('type'=>'post','action'=>'newToDoList'));

echo $this->Form->input('', array('type' => 'text','name' => 'name','id'=>'name', 'value'=>'Name'));
echo $this->Form->input('', array('type' => 'text','name' => 'description','id'=>'description','value'=>'Description'));
echo $this->Form->input('', array('type' => 'text','name' => 'datebegin','id'=>'datebegin','value'=>'DateBegin(JJ/MM/AAA)'));
echo $this->Form->input('', array('type' => 'text','name' => 'dateend','id'=>'dateend','value'=>'DateEnd(JJ/MM/AAA)'));
echo $this->Form->input('', array('type' => 'text','name' => 'frenquency','id'=>'frequency','value'=>'frequency'));

	echo $this->form->end('Inscription',array("inscription"));


debug($this->request->data);


	?>