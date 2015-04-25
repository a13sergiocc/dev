<?php

include (VENDOR_PATH."/acl/Core/src/Core/View/renderView.php");

include (APPLICATION_PATH."/src/Application/Model/db/getUsers.php");
include (APPLICATION_PATH."/src/Application/Model/db/getUser.php");
include (APPLICATION_PATH."/src/Application/Model/db/setUser.php");
include (APPLICATION_PATH."/src/Application/Model/db/deleteUser.php");
include (APPLICATION_PATH."/src/Application/Model/db/patchUser.php");
include (APPLICATION_PATH."/src/Application/Model/db/putUser.php");

switch($request['action'])
{
    case 'index':
    case 'select':
        $users = getUsers($config['database']);
        $content = renderView("../modules/Application/views/crud/select.phtml", array('users'=>$users));
    break;

    case 'insert':
        if($_POST) {
            $user = setUser($config['database'], $_POST);
            header("Location: /crud/select");
        }
        else {
            $content = renderView("../modules/Application/views/crud/insert.phtml");
        }
    break;

    case 'update':
        if ($_POST) {
            $user = putUser($config['database'], $_POST);
            header("Location: /crud/select");
        }
        else  {
            $genders = array (1=>'mujer', 2=>'hombre', 3=>'otro');
            $cities = array (1=>'scq', 2=>'vigo', 3=>'aco');

            $user = getUser($config['database'], $request['params']['id']);

            // Change values to renderForm
            $user["city"] = $cities[$user["city_idcity"]];
            $user['gender'] = $genders[$user["gender_idgender"]];
            $user['id'] = $user["iduser"];
            $user['transport'] = "";

            $content = renderView("../modules/Application/views/crud/update.phtml", array('user'=>$user));
        }
    break;

    case 'delete':
        if ($_POST) {
            if ($_POST['borrar'] === "SI") {
                deleteUser($config['database'], $_POST['id']);
            }
            header("Location: /crud/select");
        }
        else {
            $user = getUser($config['database'], $request['params']['id']);
            $content = renderView("../modules/Application/views/crud/delete.phtml", array('user'=>$user));
        }
    break;
}

include ("../modules/Application/views/layouts/dashboard.phtml");
