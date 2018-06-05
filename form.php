<?php
session_start();

$session_dai = $_POST['dai'];
$session_name = $_POST['name'];
$session_num = $_POST['ticketnum'];
$session_guest = $_POST['guest'];
$concert_name = $_SESSION['concert_name'];

$_SESSION['dai'] = $session_dai;
$_SESSION['name'] = $session_name;
$_SESSION['ticketnum'] = $session_num;
$_SESSION['guest'] = $session_guest;
$_SESSION['concert_name'] = $concert_name;

// POSTデータ受け取り
if($_SERVER['REQUEST_METHOD'] == "POST") {

    $success = true;

    // エラーをここに文字列として入れる
    $errors = array();

    $_POST['name'] = trim($_POST['name']);
    $_POST['ticketnum'] = trim($_POST['ticketnum']);

    if($_POST['dai'] == "none") {
        $errors[] = "所属代を選択して下さい。";
    }

    if($_POST['name'] == "") {
        $errors[] = "氏名が空欄です。";
    }

    if($_POST['ticketnum'] == "none") {
        $errors[] = "チケット枚数が空欄です。";
    }

    if($_POST['guest'] == "none") {
        $errors[] = "お客さんが空欄です。";
    }
}


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
                    <h1>Ticket Form</h1>
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
            <?php if (count($errors) === 0): ?>
                <p>以下のデータで大丈夫でしょうか？</p>
                <hr>
                <div class="container">
                    <p>代: <?= $session_dai ?></p>
                    <p>名前: <?= $session_name ?></p>
                    <p>チケット枚数: <?= $session_num ?></p>
                    <p>お客さん: <?= $session_guest ?></p>
                </div>
                <hr>
                <div>
                    <form action="confirm.php" method="post">
                        <input type="submit" value="申請する" class="btn btn-primary">
                        <input type="button" value="修正する" onClick="history.back()" class="btn btn-primary">
                    </form>
                </div>

            <?php elseif(count($errors) > 0): ?>
                <div>
                    <?php
                    foreach($errors as $value){
                        echo "<h3>".$value."</h3>";
                    }
                    ?>
                </div>
                <hr>
                <div>
                    <input type="button" value="戻る" onClick="location.href='./index.php'" class="btn btn-primary">
                </div>
            <?php endif; ?>
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
