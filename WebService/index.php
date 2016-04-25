<?php
/**
 * Created by PhpStorm.
 * User: sanjeev-budha
 * Date: 4/22/16
 * Time: 1:57 PM
 */
require('../Config/databaseConnection.php');
require('../Common/Common.php');

$objCommon = new Common();
if(isset($_REQUEST['action']) && !empty($_REQUEST['action']))
{

    $rs = array();

    $method = $_REQUEST['action'];
    $result = $objCommon->$method($_REQUEST);

    $rs["data"] = $result;
    echo  json_encode($rs);

}
