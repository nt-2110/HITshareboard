<div class="col-md-10">
	<div class="well well-sm">
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
<?php 	if($labels[$bulletin->depart_id] == 100 || $labels[$bulletin->depart_id] == 200): ?>
						<span class="label label-danger"><span class="glyphicon glyphicon-wrench"></span>工学部</span>
<?php 	endif; ?>
<?php 	if($labels[$bulletin->depart_id] == 100 || $labels[$bulletin->depart_id]  == 300): ?>
						<span class="label label-info"><span class="glyphicon glyphicon-phone"></span>情報学部</span>
<?php 	endif; ?>
<?php 	if($labels[$bulletin->depart_id] == 100 || $labels[$bulletin->depart_id]  == 400): ?>
						<span class="label label-success"><span class="glyphicon glyphicon-globe"></span>環境学部</span>
<?php 	endif; ?>
<?php 	if($labels[$bulletin->depart_id] == 100 || $labels[$bulletin->depart_id]  == 500): ?>
						<span class="label label-warning"><span class="glyphicon glyphicon-plus"></span>生命学部</span>
<?php 	endif; ?>
<?php endif; ?>
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
