<?php

class AccountActionType {
    const PASSWORD_CHANGE = 1;
    const PASSWORD_LOST = 3;
    const MAIL_CONFIRM = 4;
    const DETAILS_UPDATE = 6;
}

function form_validate($validate, $post){
    foreach($validate as $key => $val){
        if(empty($post[$val[0]]))
            return $val[1];
        $validate[$key] = $post[$val[0]];
    }
    return $validate;
}

function form_validate2($validate, $post){
    if(isset($validate['email']) && (strlen($post['email']) < 4 || strlen($post['email']) > 99 || !filter_var($post['email'], FILTER_VALIDATE_EMAIL)))
        return $validate['email'];

    if(isset($validate['password']) && (strlen($post['password']) < 4 || strlen($post['password']) > 40))
        return $validate['password'];

    if(isset($validate['password2']) && strcmp($post['password'], $post['password2']) != 0)
        return $validate['password2'];

    if(isset($validate['password_old']) && strcmp($post['password'], $post['password_old']) == 0)
        return $validate['password_old'];

    if(isset($validate['tos']) && empty($post['tos']))
        return $validate['tos'];

    return $post;
}

function form_filter($post){
    if(strpos($post['email'], 'gmail.com') !== false){
        $post['email'] = explode('@', $post['email'].'@');
        $post['email'][0] = explode('+', $post['email'][0].'+');
        $post['email'] = str_replace('.', '', $post['email'][0][0]).'@'.$post['email'][1];
    }
    return $post;
}

function create_session($user_id, $email, $pass = '', $rights = 0, $remember = false){

    session_regenerate_id();
    $_SESSION['user_id'] = $user_id;
    $_SESSION['a_email'] = $email;
    $_SESSION['a_pass'] = $pass;
    $_SESSION['rights'] = $rights;
    if($remember){
        /*$session_name = session_name();
        $session_cookie = session_get_cookie_params();
        setcookie($session_name, $_COOKIE[$session_name], time() + 60*60*24*30,
            $session_cookie["path"], $session_cookie["domain"], $session_cookie["secure"], $session_cookie["httponly"]);*/
    }
    session_write_close();
    //$dbh = dbconn()->prepare("INSERT INTO a_loginhistory (a_index, date, ip) VALUES(:a_index, '".date("Y-m-d H:i:s")."', :ip)");
    //$dbh->bindParam(':a_index', $res['a_index'], PDO::PARAM_STR, 15);
    //$dbh->bindParam(':ip', $GLOBALS['REQUEST_IP'], PDO::PARAM_STR, 40);
    //$dbh->execute();
    $dbh = dbconn()->prepare("UPDATE b_user SET active_date = :date WHERE user_id = :user_id");
    $dbh->bindParam(':user_id', $user_id, PDO::PARAM_INT, 11);
    $date = date("Y-m-d H:i:s");
    $dbh->bindParam(':date', $date, PDO::PARAM_STR, 20);
    $dbh->execute();
}
