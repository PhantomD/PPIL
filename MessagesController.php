function nombre_message(){
  $this->autoRender = false;
    $user_id = $this->Auth->user('id');
      $nbr= $this->Message->find('count',array('conditions'=>array('read'=>'0','to_id'=>$user_id)));
    echo $nbr;
 
  }
