<?php

session_start();

include_once(dirname(__FILE__).'/WZConfig.php');
WZConfig::init();

include_once(dirname(__FILE__).'/DB/WZDB.php');
include_once(dirname(__FILE__).'/DB/WZRequest.php');
include_once(dirname(__FILE__).'/DB/WZSelectRequest.php');
include_once(dirname(__FILE__).'/DB/WZInsertRequest.php');
include_once(dirname(__FILE__).'/DB/WZUpdateRequest.php');
include_once(dirname(__FILE__).'/DB/WZDeleteRequest.php');
include_once(dirname(__FILE__).'/DB/WZWhereParam.php');

include_once(dirname(__FILE__).'/WZDate.php');
include_once(dirname(__FILE__).'/WZLog.php');

WZDB::login();

?>
