<?php
	function setImageSize($inLine){
		echo '
			.widget .data a.image:link, .widget .data a.image:visited {
				width: -webkit-calc((100% - (5px + (11px * '.$inLine.'))) / '.$inLine.');
				width: -moz-calc((100% - (5px + (11px * '.$inLine.'))) / '.$inLine.');
				width: -ms-calc((100% - (5px + (11px * '.$inLine.'))) / '.$inLine.');
				width: calc((100% - (5px + (11px * '.$inLine.'))) / '.$inLine.');
			}
		';
	}
	if(!isset($_GET['inline']) AND !isset($_GET['view'])) {
		$inWidget->inline = 5;
		$inWidget->view = 10;
	}
?>
<script type="text/javascript" src="<?= $inWidget->skinPath ?>js/jquery-3.2.1.min.js"></script>

<style type='text/css'>
	<?= setImageSize($inWidget->inline) ?>
	.widget .data .image span {
		width: 100%;
		height: 100%;
	}
	.copyright {
		width: 100%;
	}
	@media (min-width: 400px) {
		.widget .profile {
			display:none;
		}
	}
	<?php if($inWidget->inline > 4): ?>
		@media (max-width: 768px) {
			<?= setImageSize(4) ?>
		}	
	<?php endif;?>
	@media (max-width: 576px) {
		<?= setImageSize(2) ?>
	}
	
	@media (max-width: 320px) {
		<?= setImageSize(1) ?>
	}
</style>
<script type="text/javascript">


	function setImagesDimensions(){
		var images = $('.widget .data .image');
		images.each(function(val){
			$(this).css('height',$(this).width());
		});
	}
	function setParentDimensions(){
		if(window.parent.document){
			var parents = $('iframe[data-inwidget]', window.parent.document);
			parents.each(function(val){
				if(window.frameElement){
					if($(this).attr('src') !== $(window.frameElement).attr('src')){
						return;
					}
				}
				$(this).css({
					'width':'100%',
					'height': $('#widget').outerHeight(true)
				});
			});
		}
	}
	$(document).ready(function(){
		setImagesDimensions();
		setParentDimensions();
		$(window).resize(function(){
			setImagesDimensions();
			setParentDimensions();
		});
	});
</script>