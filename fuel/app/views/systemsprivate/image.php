<div class="col-md-10">
	<div class="well well-sm">
		<ol class="breadcrumb">
			<li><?php echo Html::anchor('top/latest','トップ'); ?></li>
		</ol>
		<div class="row">
			<?php echo Html::anchor('image/'.$bulletin->id.'/image', '<img src="http://'.$_SERVER['SERVER_NAME'].'/HITshareboard/image/'.$bulletin->id.'/image" alt="...">','')."\n"; ?>
			<div class="caption">
				<span class="glyphicon glyphicon-time"></span> : <?php echo date('Y年n月j日',$bulletin->created_at)."\n"; ?>
			</div>
<?php if($bulletin->state == 3): ?>
			<div>
				<div class="btn btn-primary">許可済みの画像です</div>
			</div>
<?php else: ?>
			<div>
				<?php echo Form::open(array('action' => 'systemsprivate/activate'))."\n"; ?>
				<?php echo Form::hidden('id',$bulletin->id)."\n"; ?>
				<?php echo Form::submit('submit','この画像を許可する',array('class' => 'btn btn-danger'))."\n"; ?>
				<?php echo Form::close()."\n"; ?>
			</div>
<?php endif; ?>
		</div>
	</div>
</div>
