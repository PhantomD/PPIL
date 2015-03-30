<div data-role="page" data-theme="b" id="page_consulterlistdetail">

	<div>
			<h1>Todolist <?php echo $name[0]['Todolist']['name'] ?></h1>
		</div>
		<?php

		echo "Description : ".$text[0]['Todolist']['text'];
		?> <br><br> <?php
		echo "Date de début : ".$dateBegin[0]['Todolist']['dateBegin'];
		?> <br><br> <?php
		echo "Date de fin : ".$dateEnd[0]['Todolist']['dateEnd'];
		?> <br><br> <?php
		echo "Fréquence :".$frequency[0]['Todolist']['frequency'];
		?> <br><br> <?php
		echo $this->form->button("Modifier List", array('type' => 'button','name' => 'aa','id'=>'name', 'value'=>'','onclick' => ''));