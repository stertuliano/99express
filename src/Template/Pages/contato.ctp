<?php
/**
 * @var \App\View\AppView $this
 */

$this->extend('../Layout/containner');

$this->assign('pagina', 'Contato');

$this->start('conteudo');
?>
	<div class="row">
		<div class="col-md-1 hidden-xs">
		</div>
		<div class="col-xs-12 col-md-7">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3656.592521506816!2d-46.68382188502186!3d-23.58307388467216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce57682c50debf%3A0xf1626177dde2326e!2sRua+Pais+de+Ara%C3%BAjo%2C+171+-+Itaim+Bibi%2C+S%C3%A3o+Paulo+-+SP%2C+04531-090!5e0!3m2!1spt-BR!2sbr!4v1496260674698" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
		<div class="col-xs-12 col-md-3">
			NOSSO TELEFONE:<br/>
			+55 11 xxxxxxx
			<br/><br/>
			
			ENDEREÇO:<br/>
			Rua Pais de Araujo, 171<br/>
			Itaim, São Paulo - SP
			<br/><br/>
			 
			HORÁRIO DE ATENDIMENTO:<br/>
			Segunda a Sexta: 8:00 às 19h<br/>
			Sábado: 8:00 às 18h<br/><br/>
			 
			hello@dryclub.com.br
		</div>
		<div class="col-md-1 hidden-xs">
		</div>
	</div>
<?php 
$this->end();
?>