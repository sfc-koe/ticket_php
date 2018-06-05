<?php

    date_default_timezone_set("Asia/Tokyo");

    $session_dai = '';
    $session_name = '';
    $session_num = '';
    $session_guest = '';
    $concert_fullname = '';
    $concert_name = '';

    session_start();

    $session_dai = $_SESSION['dai'];
    $session_name = $_SESSION['name'];
    $session_num = $_SESSION['ticketnum'];
    $session_guest = $_SESSION['guest'];
    $concert_name = $_SESSION['concert_name'];

    session_unset();
    session_destroy();

    // データを書き込む
    if(!($fp = fopen("data/attend_data.csv", "a"))) {
        echo "データを書き込めませんでした。";
        die("データを書き込めませんでした。もう一度申請してください。");
    }

    if($unix) flock($fp, LOCK_SH);

    $to_write = array();

    $to_write[] = $session_dai;
    $to_write[] = str_replace(",", "、", $session_name);
    $to_write[] = $session_num;
    $to_write[] = str_replace(",", "、", $session_guest);
    $to_write[] = str_replace(",", "、", time());

    // カンマで結合して書き込み(CSVファイル)
    $write_str = join(",", $to_write);
    // $write_str = mb_convert_encoding($write_str, 'SJIS-win', 'UTF-8');
    fwrite($fp, $write_str);
    fwrite($fp, "\n");

    if($unix) flock($fp, LOCK_UN);
    fclose($fp);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css" rel="stylesheet" />

    <link href="css/style.css" rel="stylesheet">

    <title><?= $concert_name ?>チケットページ</title>
</head>

<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="index.php"><?= $concert_name ?></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">フォーム</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rank.php">ランキング</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="history.php">履歴</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Header -->
<header class="masthead" style="background-image: url('img/dog5.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>Ticket Form</h1>
                    <span class="subheading">Thank you</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>以上の内容で、<?= $concert_name ?>へのチケット枚数申請が完了しました</p>
            <hr>
            <div class="container">
                <p>代: <?= $session_dai ?></p>
                <p>名前: <?= $session_name ?></p>
                <p>チケット枚数: <?= $session_num ?></p>
                <p>お客さん: <?= $session_guest ?></p>
            </div>
            <hr>
            <div>
                <input type="button" onclick="location.href='./index.php'" value="トップへ戻る" class="btn btn-primary">
            </div>
        </div>
    </div>
</div>

<hr>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="https://twitter.com/KOE_official">
                      <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                      </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://twitter.com/koe_concert">
                      <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                      </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://www.youtube.com/watch?v=7v3WCLQAapg">
                      <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-youtube fa-stack-1x fa-inverse"></i>
                      </span>
                        </a>
                    </li>
                </ul>
                <p class="copyright text-muted">Hidemaro Fujinami</p>
            </div>
        </div>
    </div>
</footer>


<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Custom scripts for this template -->
<script src="js/clean-blog.min.js"></script>
</body>
</html>