<div class="col-md-10">
	<div class="well well-sm">
		<ol class="breadcrumb">
			<li><?php echo Html::anchor('top/latest', 'トップ'); ?></li>
			<li>画像の投稿</li>
			<div>
				<br>
<?php if(Session::get_flash('error')): ?>
				<div class="alert alert-danger" role="alert">画像を投稿する事が出来ませんでした。内容を確認の上、もう一度試してみてください。</div>
<?php endif; ?>
<?php if(Session::get_flash('success')): ?>
				<div class="alert alert-info" role="alert">画像を投稿しました。また審査に最大3日かかりますので、掲載までしばらくお待ちください。</div>
<?php endif; ?>
				掲示板画像を投稿する際は、必ず<?php echo Html::anchor('top/terms','利用規約'); ?>を読んで、投稿してください。また、投稿の際に利用規約に同意したものとします。
				<br>
				以下に示す条件に合致する画像は掲載されませんのでご注意ください。
				<br>
				<ul>
					<li>撮影時間とアップロード時間に大きく差がある画像</li>
					<li>大学外で撮影した画像</li>
					<li>内容を読み取ることが出来ない画像</li>
					<li>他人を誹謗・中傷する内容の画像</li>
					<li>公序良俗に反する内容の画像</li>
					<li>学生の氏名が載っている画像</li>
				</ul>
				<br>
<?php echo Form::open(array('action' => 'image/upload', 'enctype' => 'multipart/form-data')) ?>
					掲示画像の学部を選択…
					<br>
					<select name="id" class="form-control">
<?php foreach($faculties as $faculty): ?>
						<option value="<?php echo $faculty->id; ?>00">---<?php echo $faculty->faculty_name; ?>---</option>
<?php 	foreach($departs as $depart): ?>
<?php 		if($faculty->id == $depart->faculty_id): ?>
						<option value="<?php echo $depart->id; ?>"><?php echo $depart->depart_name; ?></option>
<?php 		endif; ?>
<?php 	endforeach; ?>
<?php endforeach; ?>
					</select>
<?php /*
					<li class="dropdown">
						<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
							掲示画像の学部を選択…
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li role="presentation" class="dropdown-header">工学部</li>
							<li><a href="#">電子情報工学科</a></li>
							<li><a href="#">電気システム工学科</a></li>
							<li><a href="#">機械システム工学科</a></li>
							<li><a href="#">知能機械工学科</a></li>
							<li><a href="#">都市デザイン工学科</a></li>
							<li><a href="#">建築工学科</a></li>
							<li class="divider"></li>
							<li role="presentation" class="dropdown-header">情報学部</li>
							<li><a href="#">情報工学科</a></li>
							<li><a href="#">知的情報システム学科</a></li>
							<li><a href="#">健康情報学科</a></li>
							<li class="divider"></li>
							<li role="presentation" class="dropdown-header">環境学部</li>
							<li><a href="#">環境デザイン学科</a></li>
							<li><a href="#">地球環境学科</a></li>
							<li class="divider"></li>
							<li role="presentation" class="dropdown-header">生命学部</li>
							<li><a href="#">生体医工学科</a></li>
							<li><a href="#">食品生命科学科</a></li>
						</ul>
					</li>
*/ ?>
					<br>
<?php /*
					<li class="dropdown">
						<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
							建物を指定…
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">新4号館 4階</a></li>
							<li><a href="#">新4号館 3階</a></li>
							<li><a href="#">Nexus 4階 エレベータ前</a></li>
							<li><a href="#">Nexus 就職部前</a></li>
						</ul>
					</li>
*/ ?>
					<br>

					<span class="glyphicon glyphicon-folder-open"></span> 掲示板画像を選択してください。
					<?php echo Form::file('input-1', array('name' => 'file', 'class' => 'file')); ?>
					<?php echo Form::file('input-2', array('name' => 'file', 'class' => 'file')); ?>
					<?php echo Form::file('input-3', array('name' => 'file', 'class' => 'file')); ?>
					<?php echo Form::file('input-4', array('name' => 'file', 'class' => 'file')); ?>
					<?php echo Form::file('input-5', array('name' => 'file', 'class' => 'file')); ?>
					<br>
					<br>
					<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-cloud-upload"></span> 画像を投稿する</button>
				<?php echo Form::close(); ?>
			</div>
		</ol>
	</div>
</div>
