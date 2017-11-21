<?php
require_once("moduleDefinitions.php");

$response = new stdClass();
if (array_key_exists('module_details', $_GET)){
    // TODO: details of selected module group
    $module_group_id = $_GET['module_details'];

    $details = $module_details[$module_group_id];
    usleep(1000000);
    if ($details) {

        $response->details = $details;
        $response->status = "okay";
    } else {
        $response->msg = "Could not find details for module group " . $module_group_id;
        $response->status = "error";
    }

} else {
    // return list of module with basic information
    $response = new stdClass();
    usleep(500000);
    $response->groups = overviewModuleGroups();
    $response->status = "okay";
}
/*
 * Return the response in JSON format
 */
echo json_encode($response);
