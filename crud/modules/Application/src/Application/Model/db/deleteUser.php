<?php

function deleteUser($config, $id)
{
    $link = mysqli_connect($config['host'], $config['user'], $config['password']);

    mysqli_select_db($link, $config['database']);


    $query = "DELETE FROM user where iduser=".$id;

    $result = mysqli_query($link, $query);

    mysqli_close($link);

    return $result;
}
