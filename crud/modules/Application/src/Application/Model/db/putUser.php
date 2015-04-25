<?php

function putUser($config, $data)
{
    $link = mysqli_connect($config['host'], $config['user'], $config['password']);

    mysqli_select_db($link, $config['database']);

    $cities = array ('scq'=>1, 'vigo'=>2, 'aco'=>3);
    $genders = array ('mujer'=>1, 'hombre'=>2, 'otro'=>3);

    $query = "UPDATE user SET
		name = '".$data['name']."',
        email='".$data['email']."',
		password='".$data['password']."',
        description='".$data['description']."',

        gender_idgender=".$genders[$data['gender']].",
        city_idcity=".$cities[$data['city']]."

        where iduser=".$data['id'];

    $result = mysqli_query($link, $query);

    mysqli_close($link);

    return $result;
}
