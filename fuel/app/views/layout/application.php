<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>HIT Shareboard</title>

		<!-- Bootstrap -->
		<?php echo Asset::css('bootstrap.min.css'); ?>
		<!-- GoogleAnalytics -->
		<script>
			// 追加部分
			// analyticsIPタグの読み込み
			<script type="text/javascript" src="//www.analyticsip.net/getIP/public_html/ra/script.php"></script>
			<noscript><p><img src="//www.analyticsip.net/getIP/public_html/ra/track.php" alt="" width="1" height="1" /></p>
			</noscript>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			ga('create', 'UA-32108224-3', 'auto');

			// 追加部分
			// IP,Cookie,AccessTime取得
			ga('set', 'dimension1', trackCommonMethod.getIP());
			ga('set', 'dimension2', trackCommonMethod.getCookie());
			ga('set', 'dimension3', trackCommonMethod.getAccessTime());

			ga('send', 'pageview');
		</script>
	</head>
	<body>


		<!-- ナビゲーションバー -->
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
<!--
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
-->
					<?php echo Html::anchor('top/latest','<span class="glyphicon glyphicon-list-alt"></span> HIT ShareBoard(試行期間中)',array('class'=>'navbar-brand')); ?>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="row">

				<!-- サイドバー -->
				<div class="col-md-2">
					<ul class="nav nav-pills nav-stacked">
						<li class="active">
							<?php echo Html::anchor('top/latest','<span class="badge pull-right">'.$latest_number.'</span>24時間内の新着'); ?>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								学科で絞り込み… <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li role="presentation" class="dropdown-header">工学部</li>
								<li><?php echo Html::anchor('board/depart/1','電子情報工学科'); ?></li>
								<li><?php echo Html::anchor('board/depart/2','電気システム工学科'); ?></li>
								<li><?php echo Html::anchor('board/depart/3','機械システム工学科'); ?></li>
								<li><?php echo Html::anchor('board/depart/4','知能機械工学科'); ?></li>
								<li><?php echo Html::anchor('board/depart/5','都市デザイン工学科'); ?></li>
								<li><?php echo Html::anchor('board/depart/6','建築工学科'); ?></li>
								<li class="divider"></li>
								<li role="presentation" class="dropdown-header">情報学部</li>
								<li><?php echo Html::anchor('board/depart/7','情報工学科'); ?></li>
								<li><?php echo Html::anchor('board/depart/8','知的情報システム学科'); ?></li>
								<li><?php echo Html::anchor('board/depart/9','健康情報学科'); ?></li>
								<li class="divider"></li>
								<li role="presentation" class="dropdown-header">環境学部</li>
								<li><?php echo Html::anchor('board/depart/10','環境デザイン学科'); ?></li>
								<li><?php echo Html::anchor('board/depart/11','地球環境学科'); ?></li>
								<li class="divider"></li>
								<li role="presentation" class="dropdown-header">生命学部</li>
								<li><?php echo Html::anchor('board/depart/12','生体医工学科'); ?></li>
								<li><?php echo Html::anchor('board/depart/13','食品生命科学科'); ?></li>
							</ul>
						</li>
						<li>
							<div class="btn-group btn-group-justified">
								<?php echo Html::anchor('top/info','<button type="button" class="btn"><span class="glyphicon glyphicon-question-sign"></span> 使い方</button>')."\n"; ?>
							</div>
						</li>
					</ul>
					<hr>
					<div class="panel panel-info">
						<div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> お知らせ</div>
						<div class="panel-body">
							<br>・このサイトは平成27年2月末まで運営します。
						</div>
					</div>
					<div class="btn-group btn-group-justified">
						<?php echo Html::anchor('top/upload','<button type="button" class="btn btn-lg btn-danger"><span class="glyphicon glyphicon-upload"></span> 画像を投稿</button>')."\n"; ?>
					</div>
					<hr>
					<div class="text-danger" style="font-family: cursive;">
						<span class="glyphicon glyphicon-heart"></span> Today : <?php echo $today_users; ?> / All : <?php echo $all_users."\n"; ?>
					</div>
					<hr>
				</div>

				<!-- コンテンツ部 -->
<?php echo $contents; ?>

			</div>
		</div>

		<footer>
			<div class="panel panel-default">
				<div class="panel-footer">
					<div class="row">
						<div class="col-md-9">
							<a href="https://sites.google.com/site/hitsolu/">
								<?php echo Asset::img('hitsol_logo.png'); ?>
							</a>
						</div>
						<div class="col-md-3 text-right">
							Copyright (C) 2014 HIT Solution
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<?php echo Asset::js('bootstrap.min.js'); ?>
		<?php echo Asset::js('holder.js'); ?>
	</body>
</html>
