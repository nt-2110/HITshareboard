<?php echo Asset::js('jquery.min.js'); ?>
<?php echo Asset::js('pgwmodal.min.js'); ?>
<div class="scrollable">
	<?php echo $contents; ?>
</div>
<div class="terms">
	<button class="btn btn-primary btn-lg" onclick="termsagree();">同意する</button>
	<button class="btn btn-danger btn-lg" onclick="window.location.href = 'http://www.google.co.jp';" >同意しない</button>
</div>

<script type="text/javascript">
	function termsagree(){
		var max_age = 3600 * 24 * 365;
		document.cookie = 'terms_check=1;max-age='+max_age;
		$.pgwModal('close');
	}
</script>
