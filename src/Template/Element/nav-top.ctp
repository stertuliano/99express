<header>
	<nav class="navbar navbar-default">
		<div class="row-fluid" style="text-align: center;">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		    </div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="<?php if($this->fetch('pagina')=='Sobre'){ echo 'active'; } ?>">
						<a href="<?php echo $this->Url->build(['controller' => 'pages', 'action' => 'sobre']); ?>">SOBRE O DRYCLUB</a>
					</li>
					<li class="<?php if($this->fetch('pagina')=='Serviços'){ echo 'active'; } ?>">
						<a href="<?php echo $this->Url->build(['controller' => 'pages', 'action' => 'servicos']); ?>">NOSSOS SERVIÇOS</a>
					</li>
					<li class="<?php if($this->fetch('pagina')=='Styles'){ echo 'active'; } ?>">
						<a href="<?php echo $this->Url->build(['controller' => 'pages', 'action' => 'styles']); ?>">STYLES</a>
					</li>
					<li class="<?php if($this->fetch('pagina')=='Produtos'){ echo 'active'; } ?>">
						<a href="<?php echo $this->Url->build(['controller' => 'pages', 'action' => 'produtos']); ?>">PRODUTOS</a>
					</li>
					<li id="li-agenda">
						<!-- O JS do salao vip insere o botao de agenda online -->
					</li>
					<li class="<?php if($this->fetch('pagina')=='Contato'){ echo 'active'; } ?>">
						<a href="<?php echo $this->Url->build(['controller' => 'pages', 'action' => 'contato']); ?>">CONTATO</a>
					</li>
				</ul>
	    	</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
</header>