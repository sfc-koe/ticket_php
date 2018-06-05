<?php

    include("load.php")

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="vendor/progressbar.js"></script>
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

    <link href="css/style.css" type="text/css" rel="stylesheet">
    <style>
        #sum_graph {
            margin: 50px;
        }
    </style>

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
                        <h1>Ranking</h1>
                        <span class="subheading">This is what I do</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600,800,900" rel="stylesheet" type="text/css">
                <div id="sum_graph"></div>
                <div class="table">
                    <table class="table table-bordered">
                        <tr>
                            <th>名前</th>
                            <th>枚数</th>
                            <?php
                            arsort($total_count);
                            foreach ($total_count as $key => $value) {
                                echo "<tr>";
                                echo "<td>";
                                echo $key;
                                echo "</td><td>";
                                echo $value;
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                    </table>
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

    <script type="text/javascript">
        var bar = new ProgressBar.SemiCircle("#sum_graph", {
            strokeWidth: 6,
            easing: 'easeInOut',
            duration: 1400,
            color: '#313cff',
            trailColor: '#eee',
            trailWidth: 1,
            svgStyle: null,
            text: {
                value: '',
                alignToBottom: false
            },
            from: {color: '#313cff'},
            to: {color: '#ED6A5A'},
            step: (state, bar) => {
            bar.path.setAttribute('stroke', state.color);
        var value = Math.round(bar.value() * 600);
        if(value === 0) {
            bar.setText('');
        } else {
            bar.setText(value + "/600");
        }

        bar.text.style.color = state.color;
        }
        });

        bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
        bar.text.style.fontSize = '2rem';

        var num = "<?php echo json_encode($count); ?>"
        var percent = num / 600;
        console.log(percent);

        bar.animate(percent);  // Number from 0.0 to 1.0
    </script>
</body>
</html>