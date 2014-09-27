<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "login" ); ?>'><?php echo Html::anchor('systemsprivate/login','Login');?></li>
	<li class='<?php echo Arr::get($subnav, "list" ); ?>'><?php echo Html::anchor('systemsprivate/list','List');?></li>
	<li class='<?php echo Arr::get($subnav, "upload" ); ?>'><?php echo Html::anchor('systemsprivate/upload','Upload');?></li>
	<li class='<?php echo Arr::get($subnav, "admin" ); ?>'><?php echo Html::anchor('systemsprivate/admin','Admin');?></li>

</ul>
<p>Admin</p>