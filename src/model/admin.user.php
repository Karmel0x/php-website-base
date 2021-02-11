<?php

function getUserAll(){
	$dbh = dbconn()->prepare("SELECT * FROM b_user ORDER BY `rights` DESC, `user_id` ASC");
	$dbh->execute();
    return $dbh;
}
function getUserById($user_id, $field){
    $dbh = dbconn()->prepare("SELECT * FROM b_user WHERE `user_id` = :user_id");
	$dbh->bindParam(':user_id', $user_id, PDO::PARAM_INT, 11);
	$dbh->execute();
    $res = $dbh->fetch();
    if(!empty($res))
        return $res[$field];
    return '';
}
function getUserDetailsById($user_id, $detail_name = 'name'){
    global $admin_user_getUserDetailsById;
    if(empty($admin_user_getUserDetailsById[$user_id][$detail_name])){
        $dbh = dbconn()->prepare("SELECT `value` FROM b_user_details WHERE `user_id` = :user_id AND `name` = :name");
        $dbh->bindParam(':user_id', $user_id, PDO::PARAM_INT, 11);
        $dbh->bindParam(':name', $detail_name, PDO::PARAM_STR, 50);
        $dbh->execute();

        $admin_user_getUserDetailsById[$user_id][$detail_name] = $dbh->fetch()['value'] ?? '';
    }
    return $admin_user_getUserDetailsById[$user_id][$detail_name];
}
