  <div data-role="page" data-theme="a" id="page_mainScreen">
    <div data-role="header" data-position="inline" data-theme="a">
      <h1>Consultation tâche</h1>
      <div data-role="controlgroup" data-type="horizontal" data-mini="true" class="ui-btn-right">

     
        <?php echo $this->Html->link('Rafraichir',array('controller' => 'Tasks','action' => 'consultertask'), array('data-role'=>'button','data-inline'=>true,'data-icon'=>'recycle', 'data-iconpos'=>'notext', 'data-mini'=>true)); ?>


         <?php echo $this->Html->link('Ajouter un élément',array('controller' => 'Tasks','action' => 'newtask'), array('data-role'=>'button','data-inline'=>true,'data-icon'=>'plus', 'data-iconpos'=>'notext', 'data-mini'=>true)); ?>

        <a href="#popupMenu" data-role="button" data-rel="popup" data-inline="true" data-icon="bars" data-iconpos="notext" data-mini="true" data-transition="slidedown">Menu</a>

          <div data-role="popup" id="popupMenu" data-theme="b">
            <ul data-role="listview" data-inset="true" style="min-width:210px;">
              <li data-role="list-divider">Menu</li>
              <li><a href="afficherProfil.html">Afficher profil</a></li>
    
          <li>   <?php echo $this->Html->link('Deconnexion',array('controller' => 'Users','action' => 'logout')); ?></li>
            </ul> 
          </div>
        <a href="#popupDisconnect" data-role="button" data-rel="popup" data-inline="true" data-icon="back" data-iconpos="notext" data-mini="true" >Deconnexion</a>
          <div data-role="popup" id="popupDisconnect" data-position-to="window"  data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
            <div data-role="header" data-theme="a"><h1>Deconnexion</h1></div>
            <div role="main" class="ui-content">
              <h3 class="ui-title">Voulez-vous vraiment vous déconnecter ?</h3>
              <a href="#" data-role="button" data-inline="true" data-icon="delete" data-rel="back">Annuler</a>

             <?php echo $this->Html->link('Valider',array('controller' => 'Users','action' => 'logout'),array('data-role'=>'button','data-inline'=>true,'data-icon'=>'check')); ?>
             
            </div>
          </div>
        </div>
    </div>
		<div data-role="content">
      <h4 class="ui-bar ui-bar-a">Nom de la liste</h4>
      <?php


     

		$ligne = 0;
		for ($ligne = 0; $ligne < $this->requestAction('/Tasks/taillelist'); $ligne++) {
		
			$name = $this->requestAction('/Tasks/consultertask/'.($ligne));
		
			$url = array('controller'=>'Tasks','action'=>'consultertaskdetail',$name);
			echo $name;
			echo $this->form->button('f', array('type' => 'button','name' => 'aa','id'=>'name', 'value'=>'','data-inline'=>'true','data-icon'=>'carat-r','data-iconpos'=>'notext', 'data-mini'=>'true','onclick' => "location.href='".$this->Html->url($url)."'")); ?> <br> <?php
		}
		?>
 <br/>
      
   <br/>
		</div>
	</div>
	

