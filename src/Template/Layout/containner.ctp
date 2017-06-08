<?php
/**
 * @var \App\View\AppView $this
 */
?>

<div id="main">
	<!--  HEADER  -->
	<div class="row">
		<div class="hidden-sm hidden-xs col-md-10 col-md-offset-1 text-center">
			LOGO DRYCLUB
		</div>
	</div>
	
	<!--  MENU  -->
	<div class="row">
		<div class="col-xs-12 col-md-10 col-md-offset-1">
			<?=$this->element('nav-top'); ?>
		</div>
	</div>
	
	<!--  BODY  -->	
	<div class="row">
		<div class="col-xs-12 col-md-10 col-md-offset-1">
			<?= $this->fetch('conteudo') ?>
		</div>
	</div>	
	
	<!--  FOOTER  -->
	<div class="row">
		<div class="col-xs-12 col-md-10 col-md-offset-1">
			<?= $this->element('footer') ?>
		</div>
	</div>	
</div>