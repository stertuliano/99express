<ul class="sidebar-menu">
    <li class="treeview <?php echo $this->Menu->getIsActive('Home'); ?>">
        <a href="#">
            <i class="fa fa-home"></i><span>Home</span>
        </a>
    </li>
    <li class="treeview <?php echo $this->Menu->getIsActive('Users'); ?>">
        <a href="#">
            <i class="fa fa-user"></i><span>Usuários</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="<?php echo $this->Menu->getIsActive('Users', 'add'); ?>">
            	<a href="<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'add']); ?>"><i class="fa fa-plus"></i> Adicionar</a>
            </li>
            <li class="<?php echo $this->Menu->getIsActive('Users', 'index'); ?>">
            	<a href="<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'index']); ?>"><i class="fa fa-list"></i> Listar</a>
            </li>
        </ul>
    </li>
	<li class="treeview <?php echo $this->Menu->getIsActive('Clients'); ?>">
        <a href="#">
            <i class="fa fa-users"></i><span>Clientes</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="<?php echo $this->Menu->getIsActive('Clients', 'add'); ?>">
            	<a href="<?php echo $this->Url->build(['controller' => 'Clients', 'action' => 'add']); ?>"><i class="fa fa-plus"></i> Adicionar</a>
            </li>
            <li class="<?php echo $this->Menu->getIsActive('Clients', 'index'); ?>">
            	<a href="<?php echo $this->Url->build(['controller' => 'Clients', 'action' => 'index']); ?>"><i class="fa fa-list"></i> Listar</a>
            </li>
        </ul>
    </li>
    <li class="treeview <?php echo $this->Menu->getIsActive('Services'); ?>">
        <a href="#">
            <i class="fa fa-tag"></i><span>Serviços</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="<?php echo $this->Menu->getIsActive('Services', 'add'); ?>">
            	<a href="<?php echo $this->Url->build(['controller' => 'Services', 'action' => 'add']); ?>"><i class="fa fa-plus"></i> Adicionar</a>
            </li>
            <li class="<?php echo $this->Menu->getIsActive('Services', 'index'); ?>">
            	<a href="<?php echo $this->Url->build(['controller' => 'Services', 'action' => 'index']); ?>"><i class="fa fa-list"></i> Listar</a>
            </li>
        </ul>
    </li>
	<li class="treeview <?php echo $this->Menu->getIsActive('Products'); ?>">
        <a href="#">
            <i class="fa fa-cubes"></i><span>Produtos</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="<?php echo $this->Menu->getIsActive('Products', 'add'); ?>">
            	<a href="<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'add']); ?>"><i class="fa fa-plus"></i> Adicionar</a>
            </li>
            <li class="<?php echo $this->Menu->getIsActive('Products', 'index'); ?>">
            	<a href="<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'index']); ?>"><i class="fa fa-list"></i> Listar</a>
            </li>
        </ul>
    </li>
    <li class="treeview <?php echo $this->Menu->getIsActive('Styles'); ?>">
        <a href="#">
            <i class="fa fa-female"></i><span>Styles</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="<?php echo $this->Menu->getIsActive('Styles', 'add'); ?>">
            	<a href="<?php echo $this->Url->build(['controller' => 'Styles', 'action' => 'add']); ?>"><i class="fa fa-plus"></i> Adicionar</a>
            </li>
            <li class="<?php echo $this->Menu->getIsActive('Styles', 'index'); ?>">
            	<a href="<?php echo $this->Url->build(['controller' => 'Styles', 'action' => 'index']); ?>"><i class="fa fa-list"></i> Listar</a>
            </li>
        </ul>
    </li>
    <li class="treeview <?php echo $this->Menu->getIsActive('Banners'); ?>">
        <a href="#">
            <i class="fa fa-minus"></i><span>Banners</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="<?php echo $this->Menu->getIsActive('Banners', 'edit'); ?>">
            	<a href="<?php echo $this->Url->build(['controller' => 'Banners', 'action' => 'edit', 'home']); ?>"><i class="fa fa-edit"></i> Home</a>
            </li>
        </ul>
    </li>
</ul>