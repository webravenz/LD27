<?php

include(dirname(__FILE__).'/includes/init.php');

$req = new WZInsertRequest('draw');

$req->setValues(array(
    'draw_pseudo' => $_POST['pseudo'],
    'draw_name' => $_POST['name'],
    'draw_path' => $_POST['path'],
    'theme_id' => $_POST['theme_id']
));
$req->setValuesNoBind(array(
    'draw_date' => 'NOW()'
));

$req->exec();

echo $req->getInsertId();

?>
