<?php

$nouveau = false;
foreach ($notifications as $key => $value) {

    $nouveau = false;
    if ($value['Notification']['isReaded'] == 0) {
        $nouveau = true;
        break;
    }
}
?>

<a href="#popupNotification" title="notifications" data-role="button"

   style="<?php if ($nouveau) echo "background:red;"; ?>" data-rel="popup" data-inline="true"
   data-icon="user" data-iconpos="notext" data-mini="true" data-transition="slidedown">Menu</a>

<div data-role="popup" id="popupNotification" style="width:400px;">

    <div class="wrapper" id="notificationWrapper" style='width:100%' ; data-iscroll>
        <ul data-role="listview" data-inset="true">
            <li data-role="list-divider">Notifications</li>

            <?php
            foreach ($notifications as $key => $value) {

                $user = $value['User']['firstname'] . " " . $value['User']['name'];

                $corps = "<div style='display:inline'>
                             <p style='margin:0;text-align:left;color:rgba(35, 20, 137, 1)'>" . $value['Notification']['message'] . "</p>
                             <p style='float:right;margin-bottom:0;font-size:80%'>" . $value['Notification']['date'] . "</p>
                              <p style='float:left;margin-bottom:0;font-size:80%'> Par " . $user . " </p>
                             </div>";

                $class = ($value['Notification']['isReaded'] == 0 ? "newNotif" : "");

                echo $this->Html->link($corps,
                    array('controller'=>'Notifications','action' => 'redirection', $value['Notification']['id']),
                    array('class' => $class, 'data-role' => "button", 'data-theme' => 'a', 'escape' => false, 'data-ajax' => 'false',
                        'style' => 'white-space: normal !important;padding:25px',
                    ));
            }

            echo " <li>" . $this->Html->link("plus", array('controller' => 'Notifications', 'action' => 'notification'),
                    array('data-ajax' => 'false', 'style' => 'white-space: normal !important;text-align:center; ')
                ) . " </li>";
            ?>
        </ul>

    </div>
</div>


<script>
    $("popupNotification").popup({
        theme: "c",
        overlayTheme: null
    });

    $('#popupNotification').css('overflow-y', 'scroll');
    $('#popupNotification').css('max-height', 400 + 'px');
    // ('#popupNotification').css('max-width', 200 + 'px');
</script>
