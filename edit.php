<?php
	include("load.php");

	session_start();
	header('Expires: -1');
	header('Cache-Control:');
	header('Pragma:');

	$string = array_keys($_POST)[0];
	$length = strlen($string);
	$action = substr($string, 0, 2);
	$num = intval(substr($string, 2, $length-2));

	$dai_num = array_search($record_dai[$num], $dai_list);
	$guest_num = array_search($record_guest[$num], $guests);

	$_SESSION['edit_number'] = $num;
	$_SESSION['delete_number'] = $num;
	$_SESSION['record_dai'] = $record_dai[$num];
	$_SESSION['record_name'] = $record_name[$num];
	$_SESSION['record_num'] = $record_num[$num];
	$_SESSION['record_guest'] = $record_guest[$num];
	$_SESSION['concert_name'] =	$concert_name;
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
            <?php if($action == "ed"): ?>

                <h2>入力し直しをお願いします</h2>

                <hr>

                <form action="edit_form.php" method="post" enctype="application/x-www-form-urlencoded" class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-2">代:</label>
                        <div class="col-sm-3">
                            <select name="edit_dai" class="form-control">
                                <?php
                                for($k=0; $k<count($dai_list); $k++) {
                                    echo '<option value="', $k, '"';

                                    if($k == $dai_num) {
                                        echo " selected";
                                    }

                                    echo ' />', $dai_list[$k], '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">名前:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="edit_name" value="<?php echo $record_name[$num] ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">チケット枚数:</label>
                        <div class="col-sm-3">
                            <select name="edit_ticketnum" class="form-control">
                                <?php
                                for($k=1; $k<=17; $k++) {
                                    echo '<option value="', $k, '"';

                                    if($k == intval($record_num[$num])) {
                                        echo " selected";
                                    }

                                    echo ' />', $k, '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">お客様:</label>
                        <div class="col-sm-3">
                            <select name="edit_guest" class="form-control">
                                <?php
                                for($k=0; $k<count($guests); $k++) {
                                    echo '<option value="', $guests[$k], '"';

                                    if($k == $guest_num) {
                                        echo " selected";
                                    }

                                    echo ' />', $guests[$k], '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" value="編集する" class="btn btn-primary">
                            <input type="button" value="戻る" onClick="history.back()" class="btn btn-primary">
                        </div>
                    </div>
                </form>

            <?php else: ?>
                <h2>削除しますか？</h2>

                <hr>

                <form action="delete_comfirm.php" method="post" enctype="application/x-www-form-urlencoded" class="form-horizontal">

                    <div class="container">
                        <p>時間: <?= $record_time[$num] ?></p>
                        <p>代: <?= $record_dai[$num] ?></p>
                        <p>名前: <?= $record_name[$num] ?></p>
                        <p>チケット枚数: <?= $record_num[$num] ?></p>
                        <p>お客さん: <?= $record_guest[$num] ?></p>
                    </div>

                    <hr>

                    <input type="submit" value="削除する" class="btn btn-primary">
                    <input type="button" value="戻る" onClick="history.back()" class="btn btn-primary">
                </form>

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
