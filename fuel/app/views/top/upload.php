<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "latest" ); ?>'><?php echo Html::anchor('top/latest','Latest');?></li>
	<li class='<?php echo Arr::get($subnav, "info" ); ?>'><?php echo Html::anchor('top/info','Info');?></li>
	<li class='<?php echo Arr::get($subnav, "upload" ); ?>'><?php echo Html::anchor('top/upload','Upload');?></li>

</ul>
<p>Upload</p>