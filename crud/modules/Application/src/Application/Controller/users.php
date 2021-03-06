<?php

include (VENDOR_PATH."/acl/Core/src/Core/View/renderView.php");
include (APPLICATION_PATH."/src/Application/Model/text/getUsers.php");
include (APPLICATION_PATH."/src/Application/Model/text/getUser.php");
include (APPLICATION_PATH."/src/Application/Model/text/setUser.php");
include (APPLICATION_PATH."/src/Application/Model/text/deleteUser.php");
include (APPLICATION_PATH."/src/Application/Model/text/patchUser.php");
include (APPLICATION_PATH."/src/Application/Model/text/putUser.php");

switch($request['action'])
{
    case 'index':
    case 'select':
        $users = getUsers();
        $content = renderView("../modules/Application/views/users/select.phtml", array('users'=>$users));
    break;

    case 'insert':
        if($_POST)
        {
            $user = setUser($_POST);
            header("Location: /users/select");
        }
        else
        {
            $content = renderView("../modules/Application/views/users/insert.phtml");
        }
    break;

    case 'update':
        echo "esto es update";
        if ($_POST)
        {
            $user = putUser($_POST['id'], $_POST);
            header("Location: /users/select");
        }
        else
        {
            $user = getUser($request['params']['id']);
            $content = renderView("../modules/Application/views/users/update.phtml", array('fieldsLine'=>$user));
        }
    break;

    case 'delete':
        echo "esto es delete";
        if ($_POST)
        {
            if ($_POST['borrar'] === "SI")
            {
                deleteUser($_POST['id']);
            }
            header("Location: /users/select");
        }
        else
        {
            $user = getUser($request['params']['id']);
            $content = renderView("../modules/Application/views/users/delete.phtml", array('user'=>$user));
        }
    break;
}

include ("../modules/Application/views/layouts/dashboard.phtml");
