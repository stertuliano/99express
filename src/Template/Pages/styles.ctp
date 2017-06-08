<?php
/**
 * @var \App\View\AppView $this
 */

$this->extend('../Layout/containner');

$this->assign('pagina', 'Styles');

$this->start('conteudo');
?>
	<div class="row">
		<div class="col-xs-12">
			Da princesa de Mônaco a Kardashian, como você quer seu cabelo hoje?
			Oferecemos 5 diferentes styles inspirados em mulheres que amamos. 
		</div>
		<?php foreach ($styles as $style){ ?>
			<div class="col-xs-12 col-md-2">
				<div>
					<h3><?= h($style->name) ?></h3>
					<?php echo $this->Html->image($this->Main->getImage('styles', $style->id), ['style="width:200px"'])?>
				</div>
			</div>
		<?php } ?>
	</div>
<?php 
$this->end();
?>