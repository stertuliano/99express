<?php
/**
  * @var \App\View\AppView $this
  */
?>

<!-- Bootstrap DataTable -->
<?php echo $this->Html->css('AdminLTE./plugins/datatables/dataTables.bootstrap'); ?>

<!-- JS DataTable -->
<?php echo $this->Html->script('AdminLTE./plugins/datatables/jquery.dataTables.min'); ?>
<?php echo $this->Html->script('AdminLTE./plugins/datatables/dataTables.bootstrap.min'); ?>

<div class="users form large-9 medium-8 columns content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Usuários</h3>
		</div>
		<div class="box-body">
		
			<table id="data-table" class="table table-striped table-bordered">
		        <thead>
		            <tr>
		                <th>Name</th>
		                <th>Email</th>
		                <th>CPF</th>
		                <th>Data de Nascimento</th>
		                <th>Status</th>
		                <th></th>
		            </tr>
		        </thead>
		        <tbody>
		            <?php foreach ($users as $user){ ?>
			            <tr>
			            	<td><?= h($user->name) ?></td>
			                <td><?= h($user->email) ?></td>
			                <td><?= h($user->cpf) ?></td>
			                <td><?= h($user->birth) ?></td>
			                <td><?= h($user->status) ?></td>
			                <td> 
			                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $user->id]) ?>
			                </td>
			            </tr>
		            <?php } ?>
		        </tbody>
		    </table>
		    
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
    $('#data-table').DataTable({
        "language": {
            "url": "http://cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
        }
	});
} );
</script>