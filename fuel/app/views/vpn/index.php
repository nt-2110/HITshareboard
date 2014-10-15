<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>HIT Shareboard</title>

		<!-- Bootstrap -->
		<?php echo Asset::css('bootstrap.min.css'); ?>

	</head>
	<body>

		<!-- ナビゲーションバー -->
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<?php echo Html::anchor('top/latest','<span class="glyphicon glyphicon-list-alt"></span> HIT ShareBoard</a>', array('class'=>'navbar-brand')); ?>
				</div>
			</div>
		</nav>

		<div class="container">

			<!-- コンテンツ部 -->
			<div class="col-md-12">
				<div class="well well-sm">
					<h2><p class="text-danger">&nbsp;すみません。</p></h2>
					<h4>&nbsp;&nbsp;現在の通信環境ではご利用いただけません。</p></h4>
					<ul class="nav nav-tabs" role="tablist" id="myTab">
						<li class="active"><a href="#vpn" role="tab" data-toggle="tab"><span class=" glyphicon glyphicon-phone"></span>&nbsp;学外から利用する</a></li>
						<li><a href="#wlan" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-signal"></span>&nbsp;学内から利用する</a></li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane fade in active" id="vpn">
							<br>
							<p>&nbsp;&nbsp;&nbsp;大学が提供しているVPNサービスを利用することで、どこにいても HITShareboard を利用する事が出来ます。</p>
							&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger" onclick="location.href='https://vpn.hirokoudai.jp/HITshareboard,DanaInfo=hitsol-1.cc.it-hiroshima.ac.jp'"><span class="glyphicon glyphicon-send">&nbsp;HITShareboard をすぐに利用する</span></button>
							<br>
							<br>
							<p>&nbsp;&nbsp;&nbsp;※&nbsp;VPNを利用したアクセスには HITNETユーザ名 と HITNETパスワード の入力が毎回必要です。</p>
						</div>
						<div class="tab-pane fade" id="wlan">
							<br>
							<p>&nbsp;&nbsp;&nbsp;大学内に設置してある、eduroamやHITNETに接続する事によって、HITShareboardを閲覧する事ができます。</p>
							<h3>手順 (iPhoneでの仕方 / 他の環境でもほぼ同じです。)</h3>
							<div>
								1.設定を開いて、Wi-Fiを選択してください。<br>
								<?php echo Asset::img('ios_1.jpg'); ?>
							</div>
							<br>
							<div>
								 2.eduroamもしくは、hitnetをタップしてください。<br>
								<?php echo Asset::img('ios_2.jpg'); ?>
							</div>
							<br>
							<div>
								3.ユーザ名に<a class="text-info">HITNETユーザ名(学籍番号を小文字にしたもの)</a>、パスワードに<a class="text-info">HITNETパスワード</a>を入力してください。<br>
								<?php echo Asset::img('ios_3.jpg'); ?>
							</div>
							<br>
							<div>
								4.詳細を確認して、了解を押してください。これで HITShareboard をご利用いただけます。<br>
								<?php echo Asset::img('ios_4.jpg'); ?>
							</div>
							<hr>
							<p>&nbsp;&nbsp;&nbsp;接続できない等の問題が発生した場合、Nexus3階のISMCサポートセンターで問い合わせください。</p>
						</div>
					</div>
				</div>
			</div>

		</div>

		<footer>
			<div class="panel panel-default">
				<div class="panel-footer">
					<div class="row">
						<div class="col-md-9">
							<a href="https://sites.google.com/site/hitsolu/"><?php echo Asset::img('hitsol_logo.png'); ?></a>
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
		<script> // <- 追加!!!!
			$(function () {
				$('#myTab a:first').tab('show')
			})
		</script>

	</body>
</html>
