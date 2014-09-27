<div class="col-md-10">
	<div class="well well-sm">
		<ol class="breadcrumb">
			<li><?php echo Html::anchor('top/latest', 'トップ'); ?></li>
			<div>
				<br>
				<?php echo Form::open(array('action' => 'systemsprivate/login'))."\n"; ?>
					ユーザネーム<br>
					<?php echo Form::input('username')."\n"; ?>
					<br>
					<br>
					パスワード<br>
					<?php echo Form::password('password')."\n"; ?>
					<br>
					<br>
					<button type="submit" class="btn btn-primary"> 登録・ログインする</button>
				<?php echo Form::close(); ?>
			</div>
		</ol>
	</div>
</div>
