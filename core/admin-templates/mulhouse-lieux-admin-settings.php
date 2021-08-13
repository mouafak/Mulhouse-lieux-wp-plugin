<h1> Mulhouse Lieux Settings </h1>

<?php settings_errors(); ?>


<form method="POST" action="options.php" style="margin-top:35px;">

    <?php

        settings_fields('mulhouse_lieux_settings_groupe');

        do_settings_sections('mulhouse-lieux-settings');

        submit_button();

    ?>

</form>