<?php
/**
 * @var \App\View\AppView $this
 */

$this->extend('../Layout/containner');

$this->assign('pagina', 'Produtos');

$this->start('conteudo');
?>
	<div class="row">
		<?php foreach ($products as $product){ ?>
			<div class="col-xs-12 col-md-2">
				<div>
					<?php echo $this->Html->image($this->Main->getImage('products', $product->id), ['style="width:200px"'])?>
					<h3><?= h($product->name) ?></h3>
				</div>
			</div>
		<?php } ?>
	</div>
<?php 
$this->end();
?>