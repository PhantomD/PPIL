<div data-role="page" data-theme="b" id="page_consulterlist">

	<div>
			<h1>Vos Todolist</h1>
		</div>
		<?php

		$ligne = 0;
		for ($ligne = 0; $ligne < $this->requestAction('/Todolists/taillelist'); $ligne++) {
			$name = $this->requestAction('/Todolists/consulterlist/'.($ligne));
			$url = array('controller'=>'Todolists','action'=>'consulterlistdetail',$name);
			echo $this->form->button($name, array('type' => 'button','name' => 'aa','id'=>'name', 'value'=>'','onclick' => "location.href='".$this->Html->url($url)."'"));
		}
		?>
