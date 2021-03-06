<!DOCTYPE html>
<?php ob_start(); @session_start(); include "sql/sql.inc.php"; date_default_timezone_set("Asia/Taipei"); ?>
<html>
<head>
    <title>程式語言檢視器</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Cache-Control" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/main.js"></script>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/github-card.css">
    <link rel="stylesheet" href="assets/js/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="assets/js/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="assets/js/jquery-ui.min.css">
    <link rel="shortcut icon" href="assets/images/airplay.ico" type="image/ico" />
</head>

<body>
    <nav class="nav-menu">
        <div class="user-profile">
            <div class="user-image">
                <?php 
                    if(@$_SESSION['nick'] == null){
                        echo '
                            <img class="user-image-src" src="assets/images/profile.png">
                            <b id="user-name">　匿名　</b>
                        ';
                    }else{
                        if(@$_SESSION['user_no'] == null){
                            $images = "user.svg";
                        }
                        echo '
                            <img class="user-image-src" src="assets/images/'.$images.'">
                            <b id="user-name" class="enter">　<a href="index.php?auth=logout">'.@$_SESSION['nick'].'</a></b>
                        ';
                        $user = @$_SESSION['user'];
                        $sql1 = "SELECT * FROM `crash-log` WHERE `user` = '$user'";
                        $result1 = mysqli_query($conn,$sql1);
                        @$num1=mysqli_num_rows($result1);
                        $num_c = $num1 / 10 + 1;
                    }
                ?>
            </div>
            <div class="menu">
                <?php   
                        $user = @$_SESSION['user'];
                        $project = @$_GET['project'];
                    if(@$_GET["mode"] == null and @$_GET["view"] != null and @$_GET['project'] == null){
                        echo '
                            <a class="a" href="index.php?view='.$user.'">
                                <div class="link link-action">
                                    <img width="20" height="20" src="assets/images/users.svg">
                                    <span id="link-text">　個人檔案
                                    </span>
                                </div>
                            </a>
                            <hr>
                        ';
                        echo '
                            <a class="a" href="index.php?mode=user">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/user.svg">
                                    <span id="link-text">　會員資料 </span>
                                </div>
                            </a>
                        ';
                        $user = @$_SESSION['user'];
                        $sqla = "SELECT * FROM `project` WHERE `user` = '$user'";
                        $result = mysqli_query($conn,$sqla);
                        @$num=mysqli_num_rows($result);
                        echo '
                            <a class="a" href="index.php?mode=manager">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/folder.svg">
                                    <span id="link-text">　程式管理　　<span id="count" class="badge badge-light float-right">'.@$num.'</span></span>
                                </div>
                            </a>
                        ';
                        $user = @$_SESSION['user'];
                        $sql = "SELECT * FROM `crash-log` WHERE `user` = '$user'";
                        $result = mysqli_query($conn,$sql);
                        @$num=mysqli_num_rows($result);
                        echo '
                            <a class="a" href="index.php?mode=notification&page=1">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/bell.svg">
                                    <span id="link-text">　警告通知　　<span id="count" class="badge badge-light float-right">'.$num.'</span></span>
                                </div>
                            </a>
                        ';
                        echo '
                            <a class="a" href="index.php?mode=debug">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/book.svg">
                                    <span id="link-text">　問題排解 </span>
                                </div>
                            </a>
                        ';
                    }elseif(@$_GET["mode"] == null and @$_GET["view"] != null and @$_GET['project'] != null){
                        echo '
                            <a class="a" href="index.php?view='.$user.'&project='.$project.'">
                                <div class="link link-action">
                                    <img width="20" height="20" src="assets/images/edit.svg">
                                    <span id="link-text">　專案編輯器
                                    </span>
                                </div>
                            </a>
                            <hr>
                        ';
                        echo '
                            <a class="a" href="index.php?mode=user">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/user.svg">
                                    <span id="link-text">　會員資料 </span>
                                </div>
                            </a>
                        ';
                        $user = @$_SESSION['user'];
                        $sqla = "SELECT * FROM `project` WHERE `user` = '$user'";
                        $result = mysqli_query($conn,$sqla);
                        @$num=mysqli_num_rows($result);
                        echo '
                            <a class="a" href="index.php?mode=manager">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/folder.svg">
                                    <span id="link-text">　程式管理　　<span id="count" class="badge badge-light float-right">'.@$num.'</span></span>
                                </div>
                            </a>
                        ';
                        $user = @$_SESSION['user'];
                        $sql = "SELECT * FROM `crash-log` WHERE `user` = '$user'";
                        $result = mysqli_query($conn,$sql);
                        @$num=mysqli_num_rows($result);
                        echo '
                            <a class="a" href="index.php?mode=notification&page=1">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/bell.svg">
                                    <span id="link-text">　警告通知　　<span id="count" class="badge badge-light float-right">'.$num.'</span></span>
                                </div>
                            </a>
                        ';
                        echo '
                            <a class="a" href="index.php?mode=debug">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/book.svg">
                                    <span id="link-text">　問題排解 </span>
                                </div>
                            </a>
                        ';
                    }elseif(@$_GET["mode"] == null){
                        echo '
                            <a class="a" href="index.php?mode=user">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/user.svg">
                                    <span id="link-text">　會員資料 </span>
                                </div>
                            </a>
                        ';
                        @$user = @$_SESSION['user'];
                        $sqla = "SELECT * FROM `project` WHERE `user` = '$user'";
                        $result = mysqli_query($conn,$sqla);
                        @$num=mysqli_num_rows($result);
                        echo '
                            <a class="a" href="index.php?mode=manager">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/folder.svg">
                                    <span id="link-text">　程式管理　　<span id="count" class="badge badge-light float-right">'.@$num.'</span></span>
                                </div>
                            </a>
                        ';
                        @$user = @$_SESSION['user'];
                        $sql = "SELECT * FROM `crash-log` WHERE `user` = '$user'";
                        $result = mysqli_query($conn,$sql);
                        @$num=mysqli_num_rows($result);
                        echo '
                            <a class="a" href="index.php?mode=notification&page=1">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/bell.svg">
                                    <span id="link-text">　警告通知　　<span id="count" class="badge badge-light float-right">'.$num.'</span></span>
                                </div>
                            </a>
                        ';
                        echo '
                            <a class="a" href="index.php?mode=debug">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/book.svg">
                                    <span id="link-text">　問題排解 </span>
                                </div>
                            </a>
                        ';
                    }elseif(@$_GET["mode"] == "user"){
                        echo '
                            <a class="a" href="index.php?mode=user">
                                <div class="link link-action">
                                    <img width="20" height="20" src="assets/images/user.svg">
                                    <span id="link-text">　會員資料 </span>
                                </div>
                            </a>
                        ';
                        $user = @$_SESSION['user'];
                        $sqla = "SELECT * FROM `project` WHERE `user` = '$user'";
                        $result = mysqli_query($conn,$sqla);
                        @$num=mysqli_num_rows($result);
                        echo '
                            <a class="a" href="index.php?mode=manager">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/folder.svg">
                                    <span id="link-text">　程式管理　　<span id="count" class="badge badge-light float-right">'.@$num.'</span></span>
                                </div>
                            </a>
                        ';
                        $user = @$_SESSION['user'];
                        $sql = "SELECT * FROM `crash-log` WHERE `user` = '$user'";
                        $result = mysqli_query($conn,$sql);
                        @$num=mysqli_num_rows($result);
                        echo '
                            <a class="a" href="index.php?mode=notification&page=1">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/bell.svg">
                                    <span id="link-text">　警告通知　　<span id="count" class="badge badge-light float-right">'.$num.'</span></span>
                                </div>
                            </a>
                        ';
                        echo '
                            <a class="a" href="index.php?mode=debug">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/book.svg">
                                    <span id="link-text">　問題排解 </span>
                                </div>
                            </a>
                        ';
                    }elseif(@$_GET["mode"] == "manager"){
                        echo '
                            <a class="a" href="index.php?mode=user">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/user.svg">
                                    <span id="link-text">　會員資料 </span>
                                </div>
                            </a>
                        ';
                        $user = @$_SESSION['user'];
                        $sqla = "SELECT * FROM `project` WHERE `user` = '$user'";
                        $result = mysqli_query($conn,$sqla);
                        @$num=mysqli_num_rows($result);
                        echo '
                            <a class="a" href="index.php?mode=manager">
                                <div class="link link-action">
                                    <img width="20" height="20" src="assets/images/folder.svg">
                                    <span id="link-text">　程式管理　　<span id="count" class="badge badge-light float-right">'.@$num.'</span></span>
                                </div>
                            </a>
                        ';
                        $user = @$_SESSION['user'];
                        $sql = "SELECT * FROM `crash-log` WHERE `user` = '$user'";
                        $result = mysqli_query($conn,$sql);
                        @$num=mysqli_num_rows($result);
                        echo '
                            <a class="a" href="index.php?mode=notification&page=1">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/bell.svg">
                                    <span id="link-text">　警告通知　　<span id="count" class="badge badge-light float-right">'.$num.'</span></span>
                                </div>
                            </a>
                        ';
                        echo '
                            <a class="a" href="index.php?mode=debug">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/book.svg">
                                    <span id="link-text">　問題排解 </span>
                                </div>
                            </a>
                        ';
                    }elseif(@$_GET["mode"] == "notification"){
                        echo '
                            <a class="a" href="index.php?mode=user">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/user.svg">
                                    <span id="link-text">　會員資料 </span>
                                </div>
                            </a>
                        ';
                        $user = @$_SESSION['user'];
                        $sqla = "SELECT * FROM `project` WHERE `user` = '$user'";
                        $result = mysqli_query($conn,$sqla);
                        @$num=mysqli_num_rows($result);
                        echo '
                            <a class="a" href="index.php?mode=manager">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/folder.svg">
                                    <span id="link-text">　程式管理　　<span id="count" class="badge badge-light float-right">'.@$num.'</span></span>
                                </div>
                            </a>
                        ';
                        $user = @$_SESSION['user'];
                        $sql = "SELECT * FROM `crash-log` WHERE `user` = '$user'";
                        $result = mysqli_query($conn,$sql);
                        @$num=mysqli_num_rows($result);
                        echo '
                            <a class="a" href="index.php?mode=notification&page=1">
                                <div class="link link-action">
                                    <img width="20" height="20" src="assets/images/bell.svg">
                                    <span id="link-text">　警告通知　　<span id="count" class="badge badge-light float-right">'.$num.'</span></span>
                                </div>
                            </a>
                        ';
                        echo '
                            <a class="a" href="index.php?mode=debug">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/book.svg">
                                    <span id="link-text">　問題排解 </span>
                                </div>
                            </a>
                        ';
                    }elseif(@$_GET["mode"] == "debug"){
                        echo '
                            <a class="a" href="index.php?mode=user">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/user.svg">
                                    <span id="link-text">　會員資料 </span>
                                </div>
                            </a>
                        ';
                        $user = @$_SESSION['user'];
                        $sqla = "SELECT * FROM `project` WHERE `user` = '$user'";
                        $result = mysqli_query($conn,$sqla);
                        @$num=mysqli_num_rows($result);
                        echo '
                            <a class="a" href="index.php?mode=manager">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/folder.svg">
                                    <span id="link-text">　程式管理　　<span id="count" class="badge badge-light float-right">'.@$num.'</span></span>
                                </div>
                            </a>
                        ';
                        $user = @$_SESSION['user'];
                        $sql = "SELECT * FROM `crash-log` WHERE `user` = '$user'";
                        $result = mysqli_query($conn,$sql);
                        @$num=mysqli_num_rows($result);
                        echo '
                            <a class="a" href="index.php?mode=notification&page=1">
                                <div class="link">
                                    <img width="20" height="20" src="assets/images/bell.svg">
                                    <span id="link-text">　警告通知　　<span id="count" class="badge badge-light float-right">'.$num.'</span></span>
                                </div>
                            </a>
                        ';
                        echo '
                            <a class="a" href="index.php?mode=debug">
                                <div class="link link-action">
                                    <img width="20" height="20" src="assets/images/book.svg">
                                    <span id="link-text">　問題排解 </span>
                                </div>
                            </a>
                        ';
                    }elseif(@$_GET["mode"] == "remove" and @$_GET['project'] != null){
                        echo '
                            <a class="a" href="index.php?mode=remove&project='.@$_GET['project'].'">
                                <div class="link link-action">
                                    <img width="20" height="20" src="assets/images/slash.svg">
                                    <span id="link-text">　刪除專案　　　</span>
                                </div>
                            </a>
                        ';
                    }else{

                    }
                ?>
            </div>
        </div>
    </nav>
    <section>
        <div class="body">
            <h3 class="body-title">
                <form id="search" class="form-inline my-2 my-lg-0 jua">PHP之動態網頁實作淺談</form>
            </h3>
            <ul class="body-text">
                <?php 
                    @$email = $_POST["email"];
                    @$user = $_POST["user"];
                    @$ps = $_POST["ps"];
                    @$nick = $_POST["nick"];
                    @$url = $_POST["user"];
                    @$rps = $_POST["rps"];
                        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
                           $myip = $_SERVER['HTTP_CLIENT_IP'];
                        }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                           $myip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                        }else{
                           $myip= $_SERVER['REMOTE_ADDR'];
                        }
                        if($myip == "::1"){
                            $myip = "127.0.0.1";
                        }
                    $today = date("Y-m-d H:i:s"); 
                    if(@$_POST["auth"] == "register"){
                        if(@$email != null AND $user != null AND $ps == $rps AND $ps != null AND $rps != null AND $nick != null AND $url != null){
                            @$sql = "INSERT INTO `username`(`user`, `nick`, `password`, `email`, `profile_url`, `Record`, `GM`, `reg_ip`, `reg_date`) VALUES ('$user', '$nick', '$ps', '$email', '$url', '0', 'false', '$myip', '$today')";
                            if ($conn->query($sql) === TRUE) {
                                echo "<h1>建立帳號成功</h1>";
                                $html = 'user/'.@$_SESSION['user'].'.json';
                                $file = fopen($html,'w');
                                fwrite($file,'{'."\n");
                                fwrite($file,'  "user":"'.@$_SESSION['user'].'",'."\n");
                                fwrite($file,'  "email":"'.@$_SESSION['email'].'",'."\n");
                                fwrite($file,'  "nick":"'.@$_SESSION['nick'].'",'."\n");
                                fwrite($file,'  "profile_url":"'.@$_SESSION['url'].'",'."\n");
                                fwrite($file,'  "reg_date":"'.@$_SESSION['reg_date'].'",'."\n");
                                fwrite($file,'  "update_date":"'.@$_SESSION['update_date'].'"'."\n");
                                fwrite($file,'}'."\n");
                                fclose($file);
                                unset($sql);
                                @$sql = "INSERT INTO `crash-log`(`user`, `message`, `source`, `backup`, `GM`, `reg_ip`, `reg_date`) VALUES ('$user','成功註冊會員:[$user]','Register','false','false','$myip','$today')";
                                $conn->query($sql);
                                $conn->close();
                                header('refresh:0;url="index.php"');
                            }else{
                                echo "Error: " . $sql . "<br>" . $conn->error;
                                echo "<h1>錯誤</h1>";
                                unset($_POST["email"]);
                                unset($_POST["nick"]);
                                unset($_POST["user"]);
                                unset($_POST["ps"]);
                                unset($_POST["rps"]);
                                unset($_POST["url"]);
                                unset($_POST["auth"]);
                                header('refresh:2;url="index.php"');
                            }
                        }else{
                            echo "<h1>資料錯誤</h1>";
                            if($email == null){
                                echo "信箱:錯誤<br>";
                            }
                            if($user == null){
                                echo "帳號:錯誤<br>";
                            }
                            if($ps == null){
                                echo "密碼:錯誤<br>";
                            }
                            if($rps == null){
                                echo "重複密碼:錯誤<br>";
                            }
                            if($nick == null){
                                echo "名稱:錯誤<br>";
                            }
                            if($url == null){
                                echo "個人網址:錯誤<br>";
                            }
                            header('refresh:2;url="index.php"');
                        }
                    }elseif(@$_POST["auth"] == "login"){
                        $sqls = "SELECT * FROM username where user = '$user'";
                        $result = mysqli_query($conn,$sqls);
                        @$row = mysqli_fetch_row($result);
                        $_SESSION['user'] = $row[1];
                        if($user != $row[1] AND $ps === $row[3]){
                            echo "<h1>登入失敗</h1>";
                            header('refresh:2;url="index.php"');
                        }elseif($user === $row[1] AND $ps != $row[3]){
                            echo "<h1>登入失敗</h1>";
                            header('refresh:2;url="index.php"');
                        }elseif($user != null AND $user === $row[1] AND $ps === $row[3]){
                            echo "<h1>登入成功</h1>";
                            $_SESSION['user'] = $row[1];
                            $_SESSION['nick'] = $row[2];
                            $_SESSION['email'] = $row[4];
                            $_SESSION['url'] = $row[5];
                            $_SESSION['Record'] = $row[6];
                            $_SESSION['GM'] = $row[7];
                            $_SESSION['reg_ip'] = $row[8];
                            $_SESSION['reg_date'] = $row[9];
                            $_SESSION['update_date'] = $row[10];
                            $html = 'user/'.@$_SESSION['user'].'.json';
                            $file = fopen($html,'w');
                            fwrite($file,'{'."\n");
                            fwrite($file,'  "user":"'.@$_SESSION['user'].'",'."\n");
                            fwrite($file,'  "email":"'.@$_SESSION['email'].'",'."\n");
                            fwrite($file,'  "nick":"'.@$_SESSION['nick'].'",'."\n");
                            fwrite($file,'  "profile_url":"'.@$_SESSION['url'].'",'."\n");
                            fwrite($file,'  "reg_date":"'.@$_SESSION['reg_date'].'",'."\n");
                            fwrite($file,'  "update_date":"'.@$_SESSION['update_date'].'"'."\n");
                            fwrite($file,'}'."\n");
                            fclose($file);
                            $user = @$_SESSION['user'];
                            @$sql = "INSERT INTO `crash-log`(`user`, `message`, `source`, `backup`, `GM`, `reg_ip`, `reg_date`) VALUES ('$user','登入成功','Login','false','false','$myip','$today')";
                            $conn->query($sql);
                            $conn->close();
                            header('refresh:0;url="index.php"');
                        }else{
                            echo "<h1>登入失敗</h1>";
                            header('refresh:2;url="index.php"');
                        }
                    }elseif(@$_POST['project'] == "true"){
                        function UID($length = 10) {
                            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $randomString = '';
                            for ($i = 0; $i < $length; $i++) {
                                $randomString .= $characters[rand(0, strlen($characters) - 1)];
                            }
                            return $randomString;
                        }
                        $user = @$_SESSION['user'];
                        $p_name = $_POST['p-name'];
                        $p_dec = $_POST['p-dec'];
                        $p_lang = $_POST['p-lang'];
                        $p_public = $_POST['p-public'];
                        $today = date("Y-m-d H:i:s"); 
                        $UID = UID(50);
                        unset($sqls);
                        $sqls = "SELECT * FROM `project` where `project_name` = '$p_name'";
                        $result = mysqli_query($conn,$sqls);
                        @$row = mysqli_fetch_row($result);
                        if($p_name != null and $p_lang != null and $p_name != $row[2]){
                             @$sql = "INSERT INTO `project`(`user`, `project_name`, `project_dec`, `project_lang`, `public`, `url`, `star`, `UID`, `follower`, `reg_date`) VALUES ('$user','$p_name','$p_dec','$p_lang','$p_public','$p_name','0','$UID','0','$today')";
                            if ($conn->query($sql) === TRUE){
                                echo '<a href="index.php" class="btn btn-secondary"><img src="assets/images/chevron-left.svg"> 返回 </a>&nbsp;&nbsp;';
                                echo '<a href="index.php?view=creamgod45&project='.$p_name.'" class="btn btn-secondary"><img src="assets/images/chevron-right.svg"> 檢視專案 </a>';
                                echo '
                                    <div class="bg-white border-s radius width-100 padding-16 margin-16">
                                        <h2>預覽專案</h2>
                                        <div class="form-group row">
                                          <label for="staticEmail" class="col-sm-2 col-form-label">User</label>
                                          <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.$user.'">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label for="staticEmail" class="col-sm-2 col-form-label">Project Name</label>
                                          <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.$p_name.'">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label for="staticEmail" class="col-sm-2 col-form-label">Project Description</label>
                                          <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.$p_dec.'">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label for="staticEmail" class="col-sm-2 col-form-label">Project Language</label>
                                          <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.$p_lang.'">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label for="staticEmail" class="col-sm-2 col-form-label">Public</label>
                                          <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.$p_public.'">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label for="staticEmail" class="col-sm-2 col-form-label">URL</label>
                                          <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.$user.'">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label for="staticEmail" class="col-sm-2 col-form-label">Register Date</label>
                                          <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.$today.'">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label for="staticEmail" class="col-sm-2 col-form-label">Update Date</label>
                                          <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.$today.'">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label for="staticEmail" class="col-sm-2 col-form-label">Project UID</label>
                                          <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.$UID.'">
                                          </div>
                                        </div>
                                    </div>
                                ';
                                $html = 'project/'.$p_name.'.json';
                                $file = fopen($html,'w');   
                                fwrite($file,'{'."\n");
                                fwrite($file,'  "user":"'.@$_SESSION['user'].'",'."\n");
                                fwrite($file,'  "Project Name":"'.@$p_name.'",'."\n");
                                fwrite($file,'  "Project Description":"'.@$p_dec.'",'."\n");
                                fwrite($file,'  "Project Language":"'.@$p_lang.'",'."\n");
                                fwrite($file,'  "public":"'.$p_public.'",'."\n");
                                fwrite($file,'  "url":"'.@$p_name.'",'."\n");
                                fwrite($file,'  "register_date":"'.$today.'",'."\n");
                                fwrite($file,'  "update_date":"'.$today.'",'."\n");
                                fwrite($file,'  "Project-UID":"'.$UID.'"'."\n");
                                fwrite($file,'}'."\n");
                                fclose($file); 
                                $user = @$_SESSION['user'];
                                @$sql = "INSERT INTO `crash-log`(`user`, `message`, `source`, `backup`, `GM`, `reg_ip`, `reg_date`) VALUES ('$user','建立專案文件:[$p_name] | 語言:$p_lang','Create_Project','false','false','$myip','$today')";
                                $conn->query($sql);
                                $conn->close();
                            }else{
                                echo '<a href="index.php" class="btn btn-secondary"><img src="assets/images/chevron-left.svg"> 返回 </a>';
                                echo "Error: " . $sql . "<br>" . $conn->error;
                            }
                        }else{
                            echo '<a href="index.php" class="btn btn-secondary"><img src="assets/images/chevron-left.svg"> 返回 </a>';
                                echo "<hr><h2>無法建立專案</h2>";
                                if($p_name == null){
                                    echo "專案名稱:尚未填寫";
                                }elseif($p_name == $row[2]){
                                    echo "專案名稱:已經有人命名";
                                }
                                if($p_lang == null){
                                    echo "程式語言:尚未填寫";
                                }
                                if($p_public == null){
                                    echo "公開:尚未填寫";
                                }
                        }
                    }elseif(@$_SESSION['nick'] == null AND @$_POST["auth"] != "register" AND @$_POST["auth"] != "login"){
                        echo '
                            <h2 class="MJ"> 你尚未擁有足夠權限瀏覽此頁面。</h2>
                            <br>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login">登入</button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#register">註冊</button>
                        ';
                    }else{
                        if(@$_GET["view"] == null){
                            if(@$_GET["mode"] == null){
                                echo '
                                    <h2>Updata <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script><button type="button" class="btn btn-secondary" data-toggle="tooltip" data-html="true" title="提醒:可以點點旁邊的選單進行瀏覽喔">嗨囉!!第一次使用嗎?</button></h2>
                                    <hr>
                                    <ul class="update">
                                      <li>【2018/06/09】》「<span class="badge badge-warning">警告</span> 網路系統建置中」</li>
                                      <li>【2018/06/09】》「<span class="badge badge-success">成功</span> 網頁建構完成」</li>
                                      <li>【2018/06/01】》「<span class="badge badge-dark">測試</span> 伺服器建構中」</li>
                                    </ul>
                                                                      </ul>
                                ';
                            }elseif(@$_GET["mode"] == "user"){
                                echo '<a href="index.php" class="btn btn-secondary"><img src="assets/images/chevron-left.svg"> 返回 </a>';
                                echo '<div class="border-s radius bg-white padding-16 margin-16">
                                        <h1 class="MJ"> 會員資料 </h1>
                                        <hr>
                                      <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                          <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.@$_SESSION['email'].'">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Nick</label>
                                        <div class="col-sm-10">
                                          <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.@$_SESSION['nick'].'">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-10">
                                          <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.@$_SESSION['user'].'">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Profile_URL</label>
                                        <div class="col-sm-10">
                                          <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.@$_SESSION['url'].'">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Register IP</label>
                                        <div class="col-sm-10">
                                          <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.@$_SESSION['reg_ip'].'">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Register Date</label>
                                        <div class="col-sm-10">
                                          <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.@$_SESSION['reg_date'].'">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Update Date</label>
                                        <div class="col-sm-10">
                                          <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.@$_SESSION['update_date'].'">
                                        </div>
                                      </div>
                                      <hr>
                                    </div>
                                    <script>
                                        $.getJSON("user/'.$_SESSION["user"].'.json", function (result) {
                                            $("span#username").append(result.user);
                                            $("a#userurl").attr("href", "index.php?view=" + result.profile_url);
                                            $("a#email").attr("href", "mailto:" + result.email + "?subject=[程式語言檢視器 | v1.0]聯絡我");
                                        });
                                    </script>
                                    <div id="git-cord" class="bg-white black border-s radius padding-16">
                                        <a id="userurl"><span id="username" class="quote display-block align-left questrial bold-bold fsize-20"></span></a></span><a class="MJ float-right bold-bold fsize-18" id="email">聯絡我</a>
                                        <img width="320" height="auto" src="assets/images/banner.png">
                                    </div>
                                    ';
                            }elseif(@$_GET["mode"] == "manager"){
                                function ss($value){
                                    if($value == "PHP"){
                                        $x = '<img class="border" src="assets/images/php.svg">　'.$value;
                                    }elseif($value == "ActionScript"){
                                        $x = '<img class="border" src="assets/images/as.png">　'.$value;
                                    }elseif($value == "AppleScript"){
                                        $x = '<img class="border" src="assets/images/apples.png">　'.$value;
                                    }elseif($value == "Asp"){
                                        $x = '<img class="border" src="assets/images/Asp.png">　'.$value;
                                    }elseif($value == "C"){
                                        $x = '<img class="border" src="assets/images/c.png">　'.$value;
                                    }elseif($value == "C++"){
                                        $x = '<img class="border" src="assets/images/cplus.png">　'.$value;
                                    }elseif($value == "HTML 5"){
                                        $x = '<img class="border" src="assets/images/html5.svg">　'.$value;
                                    }elseif($value == "Java"){
                                        $x = '<img class="border" src="assets/images/java.svg">　'.$value;
                                    }elseif($value == "JavaScript"){
                                        $x = '<img class="border" src="assets/images/javascript_1.svg">　'.$value;
                                    }elseif($value == "JSP"){
                                        $x = '<img class="border" src="assets/images/jsp.png">　'.$value;
                                    }else{
                                        $x = '<img class="border" src="assets/images/file.svg">　'.$value;
                                    }
                                    return $x;
                                }
                                function lock($value){
                                    if($value == "true"){
                                        $x = '　<span class="badge badge-success"><img width="16" src="assets/images/unlock.svg"> 公開</span>';
                                    }else{
                                        $x = '　<span class="badge badge-danger"><img width="16" src="assets/images/lock.svg"> 私人</span>';
                                    }
                                    return $x;
                                }
                                $user = @$_SESSION['user'];
                                $sqlb = "SELECT * FROM `project` WHERE `user` = '$user'";
                                $result = mysqli_query($conn,$sqlb);
                                @$num=mysqli_num_rows($result);
                                echo '<a href="index.php" class="btn btn-secondary"><img src="assets/images/chevron-left.svg"> 返回 </a>';
                                echo '
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#project"> <img src="assets/images/plus.svg"> 新增專案 </button>
                                <br><br>
                                ';
                                if($num == 0){
                                    echo '
                                    <h2>你的專案</h2>
                                    <div class="bg-white border-s width-100 radius padding-16 margin-16 display-block">
                                        <center>你現在尚未擁有專案</center>
                                    </div>';
                                }else{
                                    echo '
                                    <h2>你的專案</h2>
                                    <div class="bg-white border-s width-100 radius padding-16 margin-16 display-block">';
                                    while($row = mysqli_fetch_row($result))
                                    echo '
                                    <div class="border display-block padding-16">
                                        <h4>Project Name : ['.$row[2].'] <sub>by ['.$row[1].']</sub></h4>
                                        <br>
                                        '.ss($row[4]).lock($row[5]).'
                                        <div class="btn-group float-right" role="group" aria-label="Basic example">
                                          <a href="index.php?view='.$user.'&project='.$row[6].'" class="btn btn-outline-primary"><img src="assets/images/code.svg"></a>
                                          <a href="index.php?mode=remove&project='.$row[6].'" class="btn btn-outline-danger"><img src="assets/images/slash.svg"></a>
                                        </div>
                                        <br><br>
                                        <sub>建立時間:'.$row[11].'　更新時間:'.$row[12].'</sub>
                                    </div>
                                    ';
                                    echo '</div>';
                                }
                                echo '<h2>公開專案</h2><div class="bg-white border-s width-100 radius padding-16 margin-16 display-block">';
                                $sql = "SELECT * FROM `project` WHERE `public` = 'true'";
                                $result = mysqli_query($conn,$sql);
                                @$num=mysqli_num_rows($result);
                                if($num == 0){
                                    echo "<center>現在尚未有專案</center>";
                                }else{
                                    while($row = mysqli_fetch_row($result))
                                    echo '
                                    <div class="border display-block padding-16">
                                        <h4>Project Name : ['.$row[2].'] <sub>by ['.$row[1].']</sub></h4>
                                        <br>
                                        '.ss($row[4]).'
                                        <div class="btn-group float-right" role="group" aria-label="Basic example">
                                          <a href="index.php?view='.$user.'&project='.$row[6].'" class="btn btn-outline-primary"><img src="assets/images/code.svg"></a>
                                        </div>
                                        <br><br>
                                        <sub>建立時間:'.$row[11].'　更新時間:'.$row[12].'</sub>
                                    </div>
                                    ';
                                    echo '</div>';
                                    $conn->close();
                                }
                            }elseif(@$_GET["mode"] == "notification" and @$_GET['page'] > 0 and @$_GET['page'] < $num_c){
                                function page(){
                                    $user = @$_SESSION['user'];
                                    $page = @$_GET['page'];
                                    $pages = $page * 10;
                                    $pagess = $pages - 10;
                                    $sql = "SELECT * FROM `crash-log` WHERE `user` = '$user'";
                                    return $sql;
                                }
                                $user = @$_SESSION['user'];
                                $sql = page();
                                $result = mysqli_query($conn,$sql);
                                @$num=mysqli_num_rows($result);
                                echo '<a href="index.php" class="btn btn-secondary"><img src="assets/images/chevron-left.svg"> 返回 </a><br>　<h2>警告通知</h2>
                                <div class="bg-white border-d padding-16 margin-16">';
                                echo '
                                <table class="table table-striped table-bordered table-hover">
                                    <thead class="thead-dark">
                                      <tr>
                                        <th class="width-10 align-center" scope="col">Source</th>
                                        <th class="width-15 align-center" scope="col">Action Time</th>
                                        <th class="width" scope="col">Message</th>
                                        <th class="width-20 align-center" scope="col">本頁面總共 : '.$num.' 筆資料 | 頁數 '.@$_GET['page'].'</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                ';
                                if($num != 0){
                                    while($row = mysqli_fetch_row($result))
                                    echo '
                                        <script>
                                            function myFunction'.$row[0].'() {
                                                window.open("d.php?id='.$row[0].'", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=157,left=211,width=720,height=480");
                                            }
                                        </script>
                                      <tr onclick="myFunction'.$row[0].'()">
                                        <th class="align" scope="row">'.$row[3].'</a></th>
                                        <td class="align-center">'.$row[7].'</td>
                                        <td colspan="2" class="enter">'.$row[2].'</td>
                                      </tr>
                                    ';
                                    echo '</tbody></table></div>';
                                }else{
                                    echo '
                                      <tr>
                                        <th scope="row">null</th>
                                        <th>null</th>
                                        <td>null</td>
                                        <td>null</td>
                                        <td>null</td>
                                        <td colspan="2">null</td>
                                      </tr>
                                    ';
                                    echo '</tbody></table></div>';
                                }
                            }elseif(@$_GET["mode"] == "debug"){
                                echo '<a href="index.php" class="btn btn-secondary"><img src="assets/images/chevron-left.svg"> 返回 </a><hr>';
                                echo '
                                    <div class="container-fluid">
                                      <ul class="list-unstyled">
                                        <li class="media">
                                          <img class="mr-3" src="assets/images/user.svg">
                                          <div class="media-body">
                                            <h5 class="mt-0 mb-1">帳號登入 錯誤 / 失敗</h5>
                                            &nbsp;&nbsp;&nbsp;&nbsp;可能造成之問題：未註冊帳號 、 帳號錯誤 、 密碼不相同 或 會員資料伺服器未接收，而造成註冊失敗之原因。
                                          </div>
                                        </li>
                                      </ul>
                                      <br>
                                      <ul class="list-unstyled">
                                        <li class="media">
                                          <img class="mr-3" src="assets/images/user.svg">
                                          <div class="media-body">
                                            <h5 class="mt-0 mb-1">帳號註冊 錯誤 / 失敗</h5>
                                            &nbsp;&nbsp;&nbsp;&nbsp;可能造成之問題：帳號重複 、 填寫格式錯誤 、 密碼與重複密碼不相同 、 未填寫完整資料 或 會員資料伺服器未接收，而造成註冊失敗之原因。
                                          </div>
                                        </li>
                                      </ul>
                                      <br>
                                      <ul class="list-unstyled">
                                        <li class="media">
                                          <img class="mr-3" src="assets/images/folder.svg">
                                          <div class="media-body">
                                            <h5 class="mt-0 mb-1">專案建立 錯誤 / 失敗</h5>
                                            &nbsp;&nbsp;&nbsp;&nbsp;可能造成之問題：專案名稱重複 、 填寫格式錯誤 、 未填寫完整資料 或 資料伺服器未接收，而造成失敗之原因。
                                          </div>
                                        </li>
                                      </ul>
                                      <br>
                                      <ul class="list-unstyled">
                                        <li class="media">
                                          <img class="mr-3" src="assets/images/folder.svg">
                                          <div class="media-body">
                                            <h5 class="mt-0 mb-1">專案刪除 錯誤 / 失敗</h5>
                                            &nbsp;&nbsp;&nbsp;&nbsp;可能造成之問題：權限不足 、 非屬於你的專案 、 遭網頁管理員鎖定 或 檔案資料已不存在，而造成失敗之原因。
                                          </div>
                                        </li>
                                      </ul>
                                      <br>
                                      <ul class="list-unstyled">
                                        <li class="media">
                                          <img class="mr-3" src="assets/images/box.svg">
                                          <div class="media-body">
                                            <h5 class="mt-0 mb-1">專案外部資料分享 [JSON]</h5>
                                            &nbsp;&nbsp;&nbsp;&nbsp;網址：/project/<專案名稱>.json。
                                          </div>
                                        </li>
                                      </ul>
                                      <br>
                                      <ul class="list-unstyled">
                                        <li class="media">
                                          <img class="mr-3" src="assets/images/box.svg">
                                          <div class="media-body">
                                            <h5 class="mt-0 mb-1">用戶資料分享 [JSON]</h5>
                                            &nbsp;&nbsp;&nbsp;&nbsp;網址：/user/<用戶名稱>.json。
                                          </div>
                                        </li>
                                      </ul>
                                      <br>
                                      <ul class="list-unstyled">
                                        <li class="media">
                                          <img class="mr-3" src="assets/images/bell.svg">
                                          <div class="media-body">
                                            <h5 class="mt-0 mb-1">警告通知 - 查看完整資料</h5>
                                            &nbsp;&nbsp;&nbsp;&nbsp;操作：對者表格點擊即可顯示。
                                          </div>
                                        </li>
                                      </ul>
                                    </div>
                                ';
                            }elseif(@$_GET["mode"] == "remove" and @$_GET["project"] != null){
                                if(!empty($_SERVER['HTTP_CLIENT_IP'])){
                                   $myip = $_SERVER['HTTP_CLIENT_IP'];
                                }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                                   $myip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                                }else{
                                   $myip= $_SERVER['REMOTE_ADDR'];
                                }
                                if($myip == "::1"){
                                    $myip = "127.0.0.1";
                                }
                                $today = date("Y-m-d H:i:s"); 
                                @$user = @$_SESSION['user'];
                                @$project = $_GET["project"];
                                unset($sql,$row,$num);
                                $sql = "SELECT * FROM `project` WHERE `user` = '$user' and `project_name` = '$project'";
                                $result = mysqli_query($conn,$sql);
                                @$row = mysqli_fetch_row($result);
                                @$num = mysqli_num_rows($result);
                                if($project === $row[2] and $num == 1 and @$_GET["action"] === "true"){
                                    @unlink ('project/'.$row[2].'.json');
                                    $sql = "DELETE FROM `project` WHERE `project_name` = '$project'";
                                    $conn->query($sql);
                                    @$sqls = "INSERT INTO `crash-log`(`user`, `message`, `source`, `backup`, `GM`, `reg_ip`, `reg_date`) VALUES ('$user','刪除專案$row[2]','Delete_Project','false','false','$myip','$today')";
                                    if ($conn->query($sqls) === TRUE) {
                                        header('refresh:0;url="index.php?mode=manager"');
                                    }else{
                                        echo "Error: " . $sql . "<br>" . $conn->error;
                                    }
                                }elseif($project === $row[2] and $num == 1){
                                    echo '<a href="index.php" class="btn btn-secondary"><img src="assets/images/chevron-left.svg"> 返回 </a><hr>';
                                    echo '
                                        <div class="jumbotron jumbotron-fluid">
                                          <div class="container">
                                            <h1 class="display-4">你確定想要刪除['.$row[2].']資料?</h1>
                                            <p class="lead">
                                                <a href="index.php?mode=remove&project='.$row[2].'&action=true" class="btn btn-danger">確定</a>
                                                <a href="index.php?mode=manager" class="btn btn-success">取消</a>
                                            </p>
                                          </div>
                                        </div>
                                    ';
                                }else{
                                    header('refresh:0;url="index.php?mode=manager"');  
                                }
                            }else{
                                header('refresh:0;url="index.php"');
                            }
                        }elseif(@$_GET["view"] != null and @$_GET["project"] != null){
                            function ss($value){
                                    if($value == "PHP"){
                                        $x = '<img class="border" src="assets/images/php.svg">　'.$value;
                                    }elseif($value == "ActionScript"){
                                        $x = '<img class="border" src="assets/images/as.png">　'.$value;
                                    }elseif($value == "AppleScript"){
                                        $x = '<img class="border" src="assets/images/apples.png">　'.$value;
                                    }elseif($value == "Asp"){
                                        $x = '<img class="border" src="assets/images/Asp.png">　'.$value;
                                    }elseif($value == "C"){
                                        $x = '<img class="border" src="assets/images/c.png">　'.$value;
                                    }elseif($value == "C++"){
                                        $x = '<img class="border" src="assets/images/cplus.png">　'.$value;
                                    }elseif($value == "HTML 5"){
                                        $x = '<img class="border" src="assets/images/html5.svg">　'.$value;
                                    }elseif($value == "Java"){
                                        $x = '<img class="border" src="assets/images/java.svg">　'.$value;
                                    }elseif($value == "JavaScript"){
                                        $x = '<img class="border" src="assets/images/javascript_1.svg">　'.$value;
                                    }elseif($value == "JSP"){
                                        $x = '<img class="border" src="assets/images/jsp.png">　'.$value;
                                    }else{
                                        $x = '<img class="border" src="assets/images/file.svg">　'.$value;
                                    }
                                    return $x."　";
                                }
                                function lock($value){
                                    if($value == "true"){
                                        $x = '　<span class="badge badge-success"><img width="16" src="assets/images/unlock.svg"> 公開 </span>';
                                    }else{
                                        $x = '　<span class="badge badge-danger"><img width="16" src="assets/images/lock.svg"> 私人 </span>';
                                    }
                                    return $x;
                                }
                            @$user = $_GET["view"];
                            @$url = $_GET["project"];
                            $sqls = "SELECT * FROM `project` where `url` = '$url'";
                            $result = mysqli_query($conn,$sqls);
                            @$row = mysqli_fetch_row($result);
                            if($row[1] == $_SESSION['user'] and @$_POST["edit"] == "true" and @$_POST["code"] != null){
                                $code = @$_POST["code"];
                                @mkdir("project/$row[8]");
                                $name = str_replace(" ","",$row[2]);
                                $html = 'project/'.$row[8].'/'.$name.'.php';
                                $file = fopen($html,'w');
                                fwrite($file,$code."\n\r");
                                fclose($file); 
                                echo '
                                    檔案位置：/'.'project/'.$row[8].'/'.$name.'.php'.'<br>
                                    <iframe src="http://localhost/dissertation-project/'.'project/'.$row[8].'/'.$name.'.php'.'" width="100%" height="100%" class="border-s" frameborder="0" scrolling="no"></iframe>
                                ';
                            }elseif(@$_GET["project"] == $row[6] and $row[5] == "false" and $row[1] == $_SESSION['user']){
                                $path = '/'.'project/'.$row[8].'/'.$row[2].'.php';
                                if(file_exists($path) == true){
                                    echo '<h2 class="MJ">預覽畫面</h2><iframe src="'.'project/'.$row[8].'/'.$row[2].'.php'.'" class="border-s width-100 bg-white margin-16" frameborder="0" scrolling="no"></iframe>';
                                }else{
                                    echo '檔案尚未建立。';
                                }
                                echo '<form action="" method="POST"><a onclick="history.back()" class="btn btn-secondary"><img src="assets/images/chevron-left.svg"> 返回 </a>&nbsp;&nbsp;<input class="btn btn-outline-primary" type="submit" value="送出">';
                                echo '<b class="fsize-24 bold-bold padding-8">選寫程式碼</b><br><textarea name="code" value="'.@fgets($file).'" name="code" class="border-s radius margin-16 width-100 bold-bold questrial disaply-block outline bg-white" rows="30"></textarea><input type="hidden" name="edit" value="true"></form>
                                    <div class="bg-white border-s radius display-block padding-16 margin-16">
                                            <div class="width display-block margin-16 border-d bg-white">
                                                <div id="navs" class="btn-group unradius" role="group" aria-label="Basic example">
                                                  <div class="width-100 diaplay-block unradius outline padding-button"><img src="assets/images/eye.svg"><span class="badge badge-light fsize-20">0</span></div>
                                                </div>
                                                <div id="info" class="bg-black border-d white height-100 questrial bold-bold display-block align-left padding-16 postion-r">
                                                    <h2>'.$row[2].'<span class="float-right black bg-white radius padding">'.ss($row[4]).'</span></h2>
                                                                   <span class="float-right">'.lock($row[5]).'</span>
                                                    <p class="width-90 enter">'.$row[3].'</p>
                                                    <div class="bg-white"><sub class="float-right postion-a object-b">發佈時間 '.$row[11].' | 更新時間'.$row[12].'</sub></div>
                                                </div>
                                            </div>
                                    </div>
                                ';
                                fclose($file);
                            }elseif(@$_GET["project"] == $row[6] and $row[5] == "true"){
                                $path = '/'.'project/'.$row[8].'/'.$row[2].'.php';
                                if(file_exists($path) == true){
                                    echo '<h2 class="MJ">預覽畫面</h2><iframe src="'.'project/'.$row[8].'/'.$row[2].'.php'.'" class="border-s width-100 bg-white margin-16" frameborder="0" scrolling="no"></iframe>';
                                }else{
                                    echo '檔案尚未建立。';
                                }
                                echo '<form action="" method="POST"><a onclick="history.back()" class="btn btn-secondary"><img src="assets/images/chevron-left.svg"> 返回 </a>&nbsp;&nbsp;<input class="btn btn-outline-primary" type="submit" value="送出">';
                                echo '<b class="fsize-24 bold-bold padding-8">選寫程式碼</b><br><textarea name="code" class="border-s radius margin-16 width-100 bold-bold questrial disaply-block outline bg-white" rows="30"></textarea><input type="hidden" name="edit" value="true"></form>
                                    <div class="bg-white border-s radius display-block padding-16 margin-16">
                                            <div class="width display-block margin-16 border-d bg-white">
                                                <div id="navs" class="btn-group unradius" role="group" aria-label="Basic example">
                                                  <div class="width-100 diaplay-block unradius outline padding-button"><img src="assets/images/eye.svg"><span class="badge badge-light fsize-20">0</span></div>
                                                </div>
                                                <div id="info" class="bg-black border-d white height-100 questrial bold-bold display-block align-left padding-16 postion-r">
                                                    <h2>'.$row[2].'<span class="float-right black bg-white radius padding">'.ss($row[4]).'</span></h2>
                                                                   <span class="float-right">'.lock($row[5]).'</span>
                                                    <p class="width-90 enter">'.$row[3].'</p>
                                                    <div class="bg-white"><sub class="float-right postion-a object-b">發佈時間 '.$row[11].' | 更新時間'.$row[12].'</sub></div>
                                                </div>
                                            </div>
                                    </div>
                                ';
                            }else{
                                header('refresh:0;url="index.php"');
                            }
                        }else{
                            $view = @$_GET['view'];
                            $sqls = "SELECT * FROM username where user = '$view'";
                            $result = mysqli_query($conn,$sqls);
                            @$num=mysqli_num_rows($result);
                            @$row = mysqli_fetch_row($result);
                            if($num == 0){
                                header('refresh:0;url="index.php"');
                            }else{
                            echo '<a href="index.php" class="btn btn-secondary"><img src="assets/images/chevron-left.svg"> 返回 </a>';
                            echo '<div class="border-s radius bg-white padding-16 margin-16">
                                    <h1 class="MJ"> 會員資料 </h1>
                                    <hr>
                                  <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                      <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.@$row[4].'">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Nick</label>
                                    <div class="col-sm-10">
                                      <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.@$row[2].'">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                      <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.@$row[1].'">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Profile_URL</label>
                                    <div class="col-sm-10">
                                      <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.@$row[5].'">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Register IP</label>
                                    <div class="col-sm-10">
                                      <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.@$row[8].'">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Register Date</label>
                                    <div class="col-sm-10">
                                      <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.@$row[9].'">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Update Date</label>
                                    <div class="col-sm-10">
                                      <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.@$row[10].'">
                                    </div>
                                  </div>
                                  <hr>
                                </div>
                                <script>
                                    $.getJSON("user/'.@$_GET["view"].'.json", function (result) {
                                        $("span#username").append(result.user);
                                        $("a#userurl").attr("href", "index.php?view=" + result.profile_url);
                                        $("a#email").attr("href", "mailto:" + result.email + "?subject=[Bot Manager | v1.0]聯絡我");
                                    });
                                </script>
                                <div id="git-cord" class="bg-white black border-s radius padding-16">
                                    <a id="userurl"><span id="username" class="quote display-block align-left questrial bold-bold fsize-20"></span></a></span><a class="MJ float-right bold-bold fsize-18" id="email">聯絡我</a>
                                    <img width="320" height="auto" src="assets/images/banner.png">
                                </div>
                                ';
                                $conn->close();
                                }
                            }
                        }
                    ?>
                
        </div>
    </section>
        <?php
            if(@$_SESSION['nick'] == null){
                echo '
                <div class="modal fade" id="login" tabindex.php="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title MJ" id="exampleModalLongTitle"><b>登入面板</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="index.php" method="POST">
                      <div class="modal-body">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text MJ" id="basic-addon1">帳號</span>
                          </div>
                          <input type="text" class="form-control questrial" placeholder="Username" name="user" aria-describedby="basic-addon1" required>
                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text MJ" id="basic-addon1">密碼</span>
                            </div>
                            <input type="password" class="form-control questrial" placeholder="Password" name="ps" aria-describedby="basic-addon1" required>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary questrial" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary questrial" value="Login">
                        <input type="hidden" name="auth" value="login">
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                 <div class="modal fade" id="register" tabindex.php="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                   <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">
                       <div class="modal-header">
                         <h5 class="modal-title MJ" id="exampleModalLongTitle"><b>註冊面板</b></h5>
                         <button type="button" class="close questrial" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                       </div>
                       <form action="index.php" method="POST">
                       <div class="modal-body">
                        <div class="input-group mb-3">
                           <div class="input-group-prepend">
                             <span class="input-group-text MJ" id="basic-addon1">信箱</span>
                           </div>
                           <input type="email" class="form-control questrial" placeholder="Email" name="email" aria-describedby="basic-addon1" required>
                           </div>
                         <div class="input-group mb-3">
                           <div class="input-group-prepend">
                             <span class="input-group-text MJ" id="basic-addon1">帳號</span>
                           </div>
                           <input type="text" class="form-control questrial" placeholder="Username" name="user" aria-describedby="basic-addon1" required>
                           </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text MJ" id="basic-addon1">名稱</span>
                            </div>
                            <input type="text" class="form-control questrial" placeholder="nick" name="nick" aria-describedby="basic-addon1" required>
                          </div> 
                           <div class="input-group mb-3">
                             <div class="input-group-prepend">
                               <span class="input-group-text MJ" id="basic-addon1">密碼</span>
                             </div>
                             <input type="password" class="form-control questrial" placeholder="Password" name="ps" aria-describedby="basic-addon1" required>
                         </div>
                       <div class="input-group mb-3">
                             <div class="input-group-prepend">
                               <span class="input-group-text MJ" id="basic-addon1">重複密碼</span>
                             </div>
                             <input type="password" class="form-control questrial" placeholder="Repassword" name="rps" aria-describedby="basic-addon1" required>
                         </div>
                       <div class="modal-footer">
                         <button type="button" class="btn btn-secondary questrial" data-dismiss="modal">Close</button>
                         <input type="submit" class="btn btn-primary questrial" value="Register">
                         <input type="hidden" name="auth" value="register">
                       </div>
                     </div>
                     </form>
                   </div>
                 </div>
                ';
            }else{
                echo '
                <form action="" method="POST">
                <div class="modal fade" id="project" tabindex.php="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">建立專案面板</h5>
                        <button type="button" class="close outline hover" data-dismiss="modal" aria-label="Close">
                          <spanaria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">名稱</span>
                          </div>
                          <input type="text" class="form-control" placeholder="Project Name" name="p-name" aria-describedby="basic-addon1" required>
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">簡介</span>
                          </div>
                          <input type="text" class="form-control" placeholder="Project Description" name="p-dec" aria-describedby="basic-addon1" required>
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" for="tags" id="basic-addon1">程式語言</span>
                          </div>
                            <input type="text" class="form-control" placeholder="Program Language" id="tags" name="p-lang" aria-describedby="basic-addon1" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">公開專案</label>
                            <select class="form-control" name="p-public" id="exampleFormControlSelect1" required>
                              <option value="null" selected disabled hidden>請選擇選項</option>
                              <option value="true">公開</option>
                              <option value="false">私人</option>
                            </select>
                          </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="hidden" name="project" value="true">
                        <input type="submit" class="btn btn-primary" value="Done">
                      </div>
                    </div>
                  </div>
                </div>
                </form>
                ';
            }
            if(@$_GET["auth"] == "logout"){
                $user = @$_SESSION['user'];
                @$sql = "INSERT INTO `crash-log`(`user`, `message`, `source`, `backup`, `GM`, `reg_ip`, `reg_date`) VALUES ('$user','登出成功','Logout','false','false','$myip','$today')";
                $conn->query($sql);
                unset($_SESSION['user']);
                unset($_SESSION['nick']);
                unset($_SESSION['email']);
                unset($_SESSION['url']);
                unset($_SESSION['Record']);
                unset($_SESSION['GM']);
                unset($_SESSION['reg_ip']);
                unset($_SESSION['reg_date']);
                unset($_SESSION['update_date']);
                header('refresh:0;url="index.php"');
            }
        ?>
</body>
</html>