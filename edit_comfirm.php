<?php

    session_start();

    $session_edit_dai = $_SESSION['edit_dai'];
    $session_edit_name = $_SESSION['edit_name'];
    $session_edit_num = $_SESSION['edit_ticketnum'];
    $session_edit_guest = $_SESSION['edit_guest'];
	$session_edit_number = $_SESSION['edit_number'];
	$concert_name =	$_SESSION['concert_name'];
    $dai_list = $_SESSION['dai_list'];

	session_unset();
    session_destroy();

    // データを書き込む
    if(!($fp = fopen("data/edit_data.csv", "a"))) {
        echo "データを書き込めませんでした。";
        die("データを書き込めませんでした。もう一度申請してください。");
    }

    if($unix) flock($fp, LOCK_SH);

    $to_write = array();

	$to_write[] = $session_edit_number;
    $to_write[] = $dai_list[$session_edit_dai];
    $to_write[] = str_replace(",", "、", $session_edit_name);
    $to_write[] = $session_edit_num;
    $to_write[] = str_replace(",", "、", $session_edit_guest);

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

    <title><?= $concert_name ?>編集ページ</title>
</head>

<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <p class="navbar-brand"><?= $concert_name ?></p>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fa fa-bars"></i>
        </button>
    </div>
</nav>

<!-- Page Header -->
<header class="masthead" style="background-image: url('img/dog4.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>Edit</h1>
                    <span class="subheading">It always seems impossible until it’s done.</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>完了しました</p>
            <input type="button" onclick="location.href='./index.php'" value="トップへ戻る" class="btn btn-primary">
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
