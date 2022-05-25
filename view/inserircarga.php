<?php

$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

require_once('../control/CargaCTR.class.php');

if (isset($info)):

    $cargaCTR = new CargaCTR();
    echo $cargaCTR->salvarDados($info);

endif;
