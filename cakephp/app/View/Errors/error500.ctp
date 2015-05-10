<?php
if($this->request->is('ajax')):
    // Output for AJAX calls
    echo $name;

else:
    //Standard CakePHP output ?>
    <h2><?php echo $name; ?></h2>
    <p class="error">
        <strong><?php echo __d('cake', 'Error'); ?>: </strong>
        <?php echo __d('cake', 'An Internal Error Has Occurred.'); ?>
    </p>
    <?php
    if (Configure::read('debug') > 0 ):
        echo $this->element('exception_stack_trace');
    endif;

endif; ?>