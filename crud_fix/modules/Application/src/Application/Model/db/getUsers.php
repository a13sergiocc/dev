<?php

function getUsers($config)
{
    $link = mysqli_connect($config['host'], $config['user'], $config['password']);

    mysqli_select_db($link, $config['database']);

    $query = "SELECT * FROM user";

    $result = mysqli_query($link, $query);

    while($row = mysqli_fetch_assoc($result)) {
        $users[]=$row;
    }

    mysqli_close($link);

    return $users;
}
