<div data-role="page" data-theme="b" id="page_option">
    <div data-role="header" data-position="inline" data-theme="a">
        <h1 style="text-align:left;">
            <?php echo $this->Html->image('icone_entete.png', array('alt' => 'icone_entete', 'style' => 'vertical-align : middle')); ?>
            Mes notifications
        </h1>
        <?php echo $this->element('menu') ?>
    </div>

    <div data-role="content" style="margin-top: 20px;">


        <?php
        echo $this->Html->link("Tout marquer comme lu",
            array('action' => 'readAll'),
            array('data-role' => "button", 'escape' => false, 'data-ajax' => 'false',
                'style' => 'width:25%;margin:auto;font-size:small;padding:5 0 5 0;')
        );
        ?>

        <br/>
        <div class="wrapper" id="notificationWrapper" data-iscroll>
            <ul data-role="listview">

                <?php
                foreach ($notifs as $key => $value) {

                    $user = $value['User']['firstname'] . " " . $value['User']['name'];

                    $corps = "<div style='display:inline'>
                             <p style='margin:0;text-align:left;color:rgba(35, 20, 137, 1)'>" . $value['Notification']['message'] . "</p>
                             <p style='float:right;margin-bottom:0;font-size:80%'>" . $value['Notification']['date'] . "</p>
                              <p style='float:left;margin-bottom:0;font-size:80%'> Par " . $user . " </p>
                             </div>";

                    $class = ($value['Notification']['isReaded'] == 0 ? "newNotif" : "");

                    echo $this->Html->link($corps,
                        array('action' => 'redirection', $value['Notification']['id']),
                        array('class' => $class, 'data-role' => "button", 'data-theme' => 'a', 'escape' => false, 'data-ajax' => 'false',
                            'style' => 'white-space: normal !important;padding:25px',
                        ));
                }
                ?>
            </ul>
        </div>

    </div>
</div>


<script>
    $('#notificationWrapper').css('overflow-y', 'scroll');
    $('#notificationWrapper').css('max-height', 600 + 'px');
</script>

