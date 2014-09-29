<div class="col-md-10">
	<div class="well well-sm">
		<ol class="breadcrumb">
			<li><?php echo Html::anchor('top/latest','トップ'); ?></li>
		</ol>
		<div class="row">
<?php foreach($bulletins as $bulletin): ?>
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<?php echo Html::anchor('systemsprivate/image/'.$bulletin->id, '<img src="http://'.$_SERVER['SERVER_NAME'].'/HITshareboard/image/'.$bulletin->id.'/thumbnail" alt="...">','')."\n"; ?>
					<div class="caption">
						<span class="glyphicon glyphicon-time"></span> : <?php echo date('Y年n月j日',$bulletin->created_at); ?>
					</div>
				</div>
			</div>
<?php endforeach; ?>
		</div>

		<div class="text-center">
			<ul class="pagination">
<?php if($part > 1): ?>
				<li><?php echo Html::anchor('systemsprivate/list?part='.($part - 1),'<span class="glyphicon glyphicon-chevron-left glyphicon glyphicon-"></span>',''); ?></li>
<?php if($part > 2): ?>
				<li><?php echo Html::anchor('systemsprivate/list?part='.($part - 2),($part - 2),''); ?></li>
<?php endif; ?>
				<li><?php echo Html::anchor('systemsprivate/list?part='.($part - 1),($part - 1),''); ?></li>
<?php endif; ?>
				<li><?php echo Html::anchor('systemsprivate/list?part='.$part,$part,'')."\n"; ?></li>
<?php if($max_part - $part >= 1): ?>
				<li><?php echo Html::anchor('systemsprivate/list?part='.($part + 1),($part + 1),''); ?></li>
<?php if($max_part - $part >=2): ?>
				<li><?php echo Html::anchor('systemsprivate/list?part='.($part + 2),($part + 2),''); ?></li>
<?php endif; ?>
				<li><?php echo Html::anchor('systemsprivate/list?part='.($part + 1),'<span class="glyphicon glyphicon-chevron-right glyphicon glyphicon-"></span>',''); ?></li>
<?php endif; ?>
			</ul>
		</div>
	</div>
</div>
