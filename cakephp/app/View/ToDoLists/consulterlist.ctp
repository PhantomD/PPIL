
  <div data-role="page" data-theme="a" id="page_mainScreen" data-dom-cache="false">
    <div data-role="header" data-position="inline" data-theme="a">

          <h1 style="text-align:left;">
      <?php echo $this->Html->image('icone_entete.png', array('alt' => 'icone_entete','style'=>'vertical-align : middle'));?>
      Accueil
    </h1>


      <div data-role="controlgroup" data-type="horizontal" data-mini="true" class="ui-btn-right">

      <!--
        <a data-role="button" data-inline="true" data-icon="recycle" data-iconpos="notext" data-mini="true" >Rafraichir</a>
      -->
        <?php echo $this->Html->link('Rafraichir',array('controller' => 'Todolists','action' => 'consulterlist'), array('data-role'=>'button','data-inline'=>true,'data-icon'=>'recycle', 'data-iconpos'=>'notext', 'data-mini'=>true)); ?>
<!--
        <a href="addList.html" data-role="button" data-inline="true" data-icon="plus" data-iconpos="notext" data-mini="true" >Ajouter une liste</a> -->

         <?php echo $this->Html->link('Ajouter une liste',array('controller' => 'Todolists','action' => 'newlist'), array('data-role'=>'button','data-inline'=>true,'data-icon'=>'plus', 'data-iconpos'=>'notext', 'data-mini'=>true)); ?>

        <a href="#popupMenu" data-role="button" data-rel="popup" data-inline="true" data-icon="bars" data-iconpos="notext" data-mini="true" data-transition="slidedown">Menu</a>

          <div data-role="popup" id="popupMenu" data-theme="b">
            <ul data-role="listview" data-inset="true" style="min-width:210px;">
              <li data-role="list-divider">Menu</li>
                         <!--  <li><a href="afficherProfil.html">Afficher profil</a></li> -->
                 <li>   <?php echo $this->Html->link('Afficher profil',array('controller' => 'Users','action' => 'profil')); ?></li>
            <!--  <li><a href="#popupDisconnect" data-rel="popup" data-transition="flow">Déconnexion</a></li> -->
          <li>   <?php echo $this->Html->link('Deconnexion',array('controller' => 'Users','action' => 'logout'),array("data-ajax"=> "false")); ?></li>
            </ul> 
          </div>
        <a href="#popupDisconnect" data-role="button" data-rel="popup" data-inline="true" data-icon="back" data-iconpos="notext" data-mini="true" >Deconnexion</a>
          <div data-role="popup" id="popupDisconnect" data-position-to="window"  data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
            <div data-role="header" data-theme="a"><h1>Deconnexion</h1></div>
            <div role="main" class="ui-content">
              <h3 class="ui-title">Voulez-vous vraiment vous déconnecter ?</h3>
              <a href="#" data-role="button" data-inline="true" data-icon="delete" data-rel="back">Annuler</a>
            <!--  <a href="connexion.html" data-role="button" data-inline="true" data-icon="check">Valider</a> -->
             <?php echo $this->Html->link('Valider',array('controller' => 'Users','action' => 'logout'),array('data-role'=>'button','data-inline'=>true,'data-icon'=>'check',"data-ajax"=>"false")); ?>
             
            </div>
          </div>
        </div>
    </div>
		<div data-role="content">
      <h4 class="ui-bar ui-bar-a">Aujourd'hui</h4>
      <?php


		$ligne = 0;
		for ($ligne = 0; $ligne < $this->requestAction('/Todolists/taillelist'); $ligne++) {
      echo $name[$ligne]['Todolist']['name'];
			$url = array('controller'=>'Todolists','action'=>'consulterlistdetail',$name[$ligne]['Todolist']['name']);
			echo $this->form->button('f', array('type' => 'button','name' => 'aa','id'=>'name', 'value'=>'','data-inline'=>'true','data-icon'=>'carat-r','data-iconpos'=>'notext', 'data-mini'=>'true','onclick' => "location.href='".$this->Html->url($url)."'")); ?> <br> <?php
		}
		?>
 <br/>
      <h4 class="ui-bar ui-bar-a">Demain</h4>
   <br/>
		</div>
	</div>
</html>


 <!--function estEgal($field=array(), $compare_field=null){
        foreach( $field as $key => $value ){
            $v1 = $value;
            $v2 = $this->data[$this->name][ $compare_field ];                 
            if($v1 !== $v2) {
                return false;
            }
        }
        return true;
    }
    -->
