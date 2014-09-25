<div class="col-md-10">
	<div class="well well-sm">
		<ol class="breadcrumb">
			<li><a href="#">トップ</a></li>
<?php if(!empty($boardname)): ?>
			<li><a href="#"><?php echo $boardname; ?></a></li>
<?php endif; ?>
		</ol>
		<div class="row">
<?php foreach($bulletins as $bulletin): ?>
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<?php echo Html::anchor('image/'.$bulletin->id.'/image', '<img src="http://localhost/HITshareboard/image/thumbnail/'.$bulletin->id.'" alt="...">','')."\n"; ?>
					<div class="caption">
						<span class="glyphicon glyphicon-time"></span> : <?php echo date('Y年n月j日',$bulletin->created_at); ?>
						<br>
						<button class="btn btn-default btn-xs btn-danger" type="button"><span class="glyphicon glyphicon-heart"></span> 1 : ありがとう！</button>
					</div>
				</div>
			</div>
<?php endforeach; ?>

			<div class="text-center">
				<ul class="pagination">
<?php if($part > 1): ?>
					<li><?php echo Html::anchor($url.'?part='.($part - 1),'<span class="glyphicon glyphicon-chevron-left glyphicon glyphicon-"></span>','')."\n"; ?></li>
<?php if($part > 2): ?>
					<li><?php echo Html::anchor($url.'?part='.($part - 2),($part - 2),'')."\n"; ?></li>
<?php endif; ?>
					<li><?php echo Html::anchor($url.'?part='.($part - 1),($part - 1),'')."\n"; ?></li>
<?php endif; ?>
					<li><?php echo Html::anchor($url.'?part='.$part,$part,'')."\n"; ?></li>
<?php if($max_part - $part >= 1): ?>
					<li><?php echo Html::anchor($url.'?part='.($part + 1),($part + 1),'')."\n"; ?></li>
<?php if($max_part - $part >=2): ?>
					<li><?php echo Html::anchor($url.'?part='.($part + 2),($part + 2),'')."\n"; ?></li>
<?php endif; ?>
					<li><?php echo Html::anchor($url.'?part='.($part + 1),'<span class="glyphicon glyphicon-chevron-right glyphicon glyphicon-"></span>','')."\n"; ?></li>
<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>
</div>
