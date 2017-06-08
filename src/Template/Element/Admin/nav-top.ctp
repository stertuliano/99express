<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="hidden-xs"><?php echo $this->request->session()->read('Auth.User.name'); ?></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="user-header">
                    	<div class="col-xs-4 text-center">
                    		Email:
                   		</div>
						<div class="col-xs-8 text-left">
                   			<?php echo $this->request->session()->read('Auth.User.email'); ?>
                   		</div>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="<?php echo $this->Url->Build(['controller' => 'Users', 'action' => 'edit', $this->request->session()->read('Auth.User.id')]); ?>" class="btn btn-default btn-flat">Editar</a>
                        </div>
                        <div class="pull-right">
                            <a href="<?php echo $this->Url->Build(['controller' => 'Users', 'action' => 'logout']); ?>" class="btn btn-default btn-flat">Sair</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>