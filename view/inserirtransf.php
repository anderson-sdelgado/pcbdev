<?php

$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

require_once('../control/TransfCTR.class.php');

if (isset($info)):

    $transfCTR = new TransfCTR();
    echo $transfCTR->salvarDados($info);

endif;
