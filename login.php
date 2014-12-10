<?php
session_start();
require_once 'conn.php';

require_once 'openid.php';
header("Content-Type:text/html; charset=utf-8");
try {
    $openid = new LightOpenID('localhost');
    if (!$openid->mode) {

        // 判斷登入類型
        if(isset($_POST['type']) && $_POST['type'] === 'ntpc'){
            // openid login
            $openid->identity = 'http://openid.ntpc.edu.tw/';
            $openid->required = array('namePerson/friendly', 'contact/email', 'namePerson', 'birthDate', 'person/gender', 'contact/postalCode/home', 'contact/country/home', 'pref/language', 'pref/timezone');
            header('Location: ' . $openid->authUrl());

        }else{
            // local login
            $sql = sprintf("SELECT * FROM `users` WHERE `uname`='%s' and `passwd`='%s' limit 1", $_POST['uname'], $_POST['passwd']);

            $result =  mysql_query( $sql, $conn );

            if( mysql_num_rows($result) ){

                $user = mysql_fetch_row($result, MYSQL_BOTH);

                $_SESSION['id'] = $user['id'];
                $_SESSION['cname'] = $user['cname'];

            }

            header('Location: index.php');
            
        }

    } elseif ($openid->mode == 'cancel') {
        echo '使用者取消';
        //header('Location: index.php');
    } else {
        if ($openid->validate()) {
            $attr = $openid->getAttributes();

            echo '<table border="1" cellspacing="0" cellpadding="10">';
            echo '<tr><td>帳號</td><td>' . end(array_values(explode('/', $openid->identity))) . '</td></tr>';
            echo '<tr><td>識別碼</td><td>' . $attr['contact/postalCode/home'] . '</td></tr>';
            echo '<tr><td>姓名</td><td>' . $attr['namePerson'] . '</td></tr>';
            echo '<tr><td>暱稱</td><td>' . $attr['namePerson/friendly'] . '</td></tr>';
            echo '<tr><td>性別</td><td>' . ($attr['person/gender'] == 'M' ? '男' : '女') . '</td></tr>';
            echo '<tr><td>出生年月日</td><td>' . $attr['birthDate'] . '</td></tr>';
            echo '<tr><td>公務信箱</td><td>' . $attr['contact/email'] . '</td></tr>';
            echo '<tr><td>單位</td><td>' . $attr['contact/country/home'] . '</td></tr>';
            echo '<tr><td>年級</td><td>' . substr($attr['pref/language'], 0, 2) . '</td></tr>';
            echo '<tr><td>班級</td><td>' . substr($attr['pref/language'], 2, 2) . '</td></tr>';
            echo '<tr><td>座號</td><td>' . substr($attr['pref/language'], 4, 2) . '</td></tr>';
            echo '</table>';
            echo '<p />';
            echo '<table border="1" cellspacing="0" cellpadding="10">';
            echo '<tr><td>單位代碼</td><td>單位名稱</td><td>身分別</td><td>職務別</td><td>職稱別</td></tr>';
            foreach (json_decode($attr['pref/timezone']) as $item) {
                echo '<tr>';
                echo '<td>' . $item->id . '</td>';
                echo '<td>' . $item->name . '</td>';
                echo '<td>' . $item->role . '</td>';
                echo '<td>' . $item->title . '</td>';
                echo '<td>' . implode('、', $item->groups) . '</td>';
                echo '</tr>';
            }
            echo '</table>';

            // 以下取出資料
            // 自訂帳號
            $uname = end( array_values( explode('/', $openid->identity) ) );
            // 姓名
            $cname = $attr['namePerson'];
            // 年級
            $s_grade = substr($attr['pref/language'], 0, 2);
            // 班級
            $s_class = substr($attr['pref/language'], 2, 2);
            // 座號
            $s_number = substr($attr['pref/language'], 4, 2);
            // 身份
            $role = json_decode($attr['pref/timezone'])[0]->role;

            // 密碼，可改用亂數產生，或加密
            $passwd = '123456';


            // 查詢資料庫是否已有紀錄
            // 有　　　則更新
            // 沒有　　則新增
            $sql = sprintf("SELECT * FROM `users` WHERE `uname`='%s' limit 1", $uname);

            $result =  mysql_query( $sql, $conn );

            if( mysql_num_rows($result) ){
                // 已登入過，更新資料
                $user = mysql_fetch_row($result, MYSQL_BOTH); //取出舊資料

                $sql = sprintf("UPDATE `users` 
                                SET `s_grade` = '%s', `s_class` = '%s', `s_number` = '%s', `cname` = '%s', `role` = '%s' 
                                WHERE `uname` = '%s'",
                                $s_grade, $s_class, $s_number, $cname, $role, $uname);

                mysql_query( $sql, $conn );

                $_SESSION['id'] = $user['id'];
                $_SESSION['cname'] = $cname;

            }else{
                // 第一次登入，新增資料
                $sql = sprintf("INSERT INTO `users` 
                                (`uname`, `passwd`, `s_grade`, `s_class`, `s_number`, `cname`, `role`) 
                                VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')", 
                                $uname, $passwd, $s_grade, $s_class, $s_number, $cname, $role);

                mysql_query( $sql, $conn );

                $_SESSION['id'] = mysql_insert_id();
                $_SESSION['cname'] = $cname;
                
            }

            echo $sql;

            //header('Location: index.php');
        }
    }
} catch (ErrorException $e) {
    echo $e->getMessage();
}
		        
?>