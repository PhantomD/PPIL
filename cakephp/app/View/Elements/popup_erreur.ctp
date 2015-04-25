
 <?php 
  $message ="";
  if($this->Session->check('Message.auth')){
    $message = $this->Session->flash('auth');
  }

  ?>

<div data-role="popup" id="popupErreur" style="border-radius:0" data-position-to="window"  data-overlay-theme="b" data-theme="b"  data-dismissible="false" style="max-width:400px;">
  <a href="#" data-rel="back" data-role="button" data-theme="b" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
  <div data-role="header" data-theme="a"> <h3 class="ui-title" style="color:#800024;">Vous pensiez vraiment pouvoir faire cette action?</h3></div>
  <div role="main" class="ui-content">
    <?php echo $message ?>

  </div>
</div>


<script>
  $(document).bind('pagecreate', function() {
    setTimeout(function(){
      var msg='<?PHP echo $message;?>';

      if(!(msg === "")){
        $("#popupErreur").popup();
        $("#popupErreur").popup("open");
      }
    }, 100);
  });
</script>