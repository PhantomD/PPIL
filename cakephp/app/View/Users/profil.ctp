<div data-role="page" data-theme="b" id="profil">
		<div>
			<?php echo $this->Session->flash(); ?>
			<h1>Bienvenue</h1>
		</div>


	<div>
			<h3>se Deconnecter </h3>

		<?php	echo $this->Html->link(
    'Se deconnecter',
    array( 'controller' => 'Users','action' => 'logout'));

	?> 
</div>



