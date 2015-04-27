
<div data-role="page" data-theme="a" id="page_mainScreen" data-dom-cache="false">


  <div data-role="header" data-position="inline" data-theme="a">
    <h1 style="text-align:left;">
      <?php echo $this->Html->image('icone_entete.png', array('alt' => 'icone_entete','style'=>'vertical-align : middle'));?>
      Accueil  
    </h1>
    <?php echo $this->element('menu') ?>
  </div>


  <div data-role="content">
    <?php echo $this->Session->flash(); ?>
    <h4 class="ui-bar ui-bar-a">Aujourd'hui</h4> 

    <?php
    foreach( $listes as $key => $value ){
      $nom = $value['Todolist']['name'];
      $id = $value['Todolist']['id'];

      echo $nom." ";
      echo $this->Html->link('f',array('controller'=>'Todolists','action' => 'consulterlistdetail',$id),array('data-role'=>"button",'data-inline'=>"true",'data-icon'=>"carat-r",'data-ajax' => 'false', 'data-iconpos'=>"notext", 'data-mini'=>"true"));
      echo "<br/>";
    }
    ?>

    <br/>
    <h4 class="ui-bar ui-bar-a">Demain</h4>
    
    <br/>
  </div>
<!--
    <script type="text/javascript">
        if (window.location.hash && window.location.hash == '#_=_') {
            window.location.hash = '';
        }
    </script>
    -->
  <?php echo $this->element('popup_erreur') ?>

</div>
