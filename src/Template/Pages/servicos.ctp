<?php
/**
 * @var \App\View\AppView $this
 */

$this->extend('../Layout/containner');

$this->assign('pagina', 'Serviços');

$this->start('conteudo');
?>
	<div class="col-xs-12 col-md-8">
		<?php foreach ($services as $service){ ?>
			<div id="place-servico">
				<h3><?= h($service->name) ?></h3>
				<h4><?= h($service->description) ?></h4>
				<h5><?= $this->Main->moneyBr($service->price); ?></h5>
			</div>
		<?php } ?>
	</div>
	<div class="hidden-sm hidden-xs col-md-4">
		<div style="width: 100%; height: 300px; border:1px solid black;">
			IMAGEM
		</div>
	</div>
<?php 
$this->end();
?>