<div class="col-md-10">
	<div class="well well-sm">
<?php if(empty($boardname)): ?>
	<?php if(!Cookie::get('terms_check',null)&&Cookie::get('terms_alert',null)<5): ?>
		<div class="alert alert-danger" role="danger">本サービスを使用する前に必ず<?php echo Html::anchor('top/terms','利用規約'); ?>を確認してください。</div>
	<?php endif; ?>
<?php endif; ?>
		<div class="alert alert-danger" role="danger">最終的な内容については、必ず掲示板を確認してください。</div>
		<ol class="breadcrumb">
			<li><?php echo Html::anchor('top/latest','トップ'); ?></li>
<?php if(!empty($boardname)): ?>
			<li><?php echo Html::anchor($url,$boardname); ?></li>
<?php endif; ?>
		</ol>
		<div class="row">
<?php foreach($bulletins as $bulletin): ?>
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<?php echo Html::anchor('image/'.$bulletin->id.'/image', '<img src="http://'.$_SERVER['SERVER_NAME'].'/HITshareboard/image/'.$bulletin->id.'/thumbnail" alt="...">','')."\n"; ?>
					<div class="caption">
						<span class="glyphicon glyphicon-time"></span> : <?php echo date('Y年n月j日',$bulletin->created_at); ?><br>
						<?php echo Html::anchor('image/countup/'.$bulletin->id,'<button class="btn btn-default btn-xs btn-danger" type="button"><span class="glyphicon glyphicon-heart"></span> '.$bulletin->cnt.' : ありがとう！</button>')."\n"; ?>
						<br>
<?php if(empty($boardname)): ?>
<?php echo htmlspecialchars_decode($labels[$bulletin->depart_id]); ?>
<?php endif; ?>
					</div>
				</div>
			</div>
<?php endforeach; ?>

		</div>
		<div class="text-center">
			<ul class="pagination">
<?php if($part > 1): ?>
				<li><?php echo Html::anchor($url.'?part='.($part - 1),'<span class="glyphicon glyphicon-chevron-left glyphicon glyphicon-"></span>',''); ?></li>
<?php if($part > 2): ?>
				<li><?php echo Html::anchor($url.'?part='.($part - 2),($part - 2),''); ?></li>
<?php endif; ?>
				<li><?php echo Html::anchor($url.'?part='.($part - 1),($part - 1),''); ?></li>
<?php endif; ?>
				<li><?php echo Html::anchor($url.'?part='.$part,$part,'')."\n"; ?></li>
<?php if($max_part - $part >= 1): ?>
				<li><?php echo Html::anchor($url.'?part='.($part + 1),($part + 1),''); ?></li>
<?php if($max_part - $part >=2): ?>
				<li><?php echo Html::anchor($url.'?part='.($part + 2),($part + 2),''); ?></li>
<?php endif; ?>
				<li><?php echo Html::anchor($url.'?part='.($part + 1),'<span class="glyphicon glyphicon-chevron-right glyphicon glyphicon-"></span>',''); ?></li>
<?php endif; ?>
			</ul>
		</div>
	</div>
</div>
