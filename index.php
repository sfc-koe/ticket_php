<?php
    session_start();

    include("load.php");

    $session_dai = '';
    $session_name = '';
    $session_num = '';
    $session_guest = '';

    $_SESSION['concert_name'] = $concert_name;
	$_SESSION['dai_list'] =	 $dai_list;
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
    <header class="masthead" style="background-image: url('img/dog2.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Ticket Form</h1>
                        <span class="subheading">- Love the life you live -</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <p>以下のフォームを埋めて、はけたチケットの枚数をおしえてください。</p>
                <form action="./form.php" method="post" id="forms" class="mt-5">
                    <div class="row">
                        <div class="col-sm-12 control-group">
                            <div class="form-group controls">
                                <select class="form-control" name="dai">
                                    <option value="none">代を選んでください</option>
                                    <?php
                                    for($i=0; $i<count($dai_list); $i++) {
                                        echo '<option value="', $dai_list[$i], '"';
                                        echo ' />', $dai_list[$i], "&nbsp;";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group controls">
                                <input type="text" class="form-control" placeholder="氏名" name="name" />
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group controls">
                                <select name="ticketnum" class="form-control">
                                    <option value="none">はけた枚数を選んでください</option>
                                <?php
                                for($j=1; $j<=17; $j++) {
                                    echo '<option value="', $j, '"';
                                    echo ' />', $j, '</option>';
                                }
                                ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group controls">
                                <select name="guest" class="form-control">
                                    <option value="none">はけた相手を教えてください</option>
                                    <?php
                                    for($k=0; $k<count($guests); $k++) {
                                        echo '<option value="', $guests[$k], '"';
                                        echo ' />', $guests[$k], '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <button class="btn btn-primary">送信</button>
                            </div>
                        </div>
                    </div>
                </form>
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
