<?php
/**
  * @var \App\View\AppView $this
  */
?>

<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask'); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.numeric.extensions.js'); ?>

<style>
	#img-upload{
	    max-width: 100%	;
	    max-height: 180px;
	    padding: 5px;
	}
</style>

<div class="services form large-9 medium-8 columns content">
    <?= $this->Form->create($service, ['enctype' => 'multipart/form-data']) ?>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Adicionar Serviço</h3>
		</div>
		<div class="box-body">
			<div class="col-xs-12 col-md-6">
				<div class="col-xs-12">
<?php
	    	        echo $this->Form->control('name', ['label' => 'Name:']);
	    	        echo $this->Form->control('short_description', ['label' => 'Descrição curta:']);
	    	        echo $this->Form->control('description', ['type' => 'textarea', 'label' => 'Descrição:']);
	    	        echo $this->Form->control('price', ['label' => 'Preço:', 'type' => 'text', 'class' => 'price']);
	    	        echo $this->Form->control('status', ['label' => 'Ativo']);
?>
				</div>
			</div>
			<div class="col-xs-12 col-md-6">
				<div class="col-xs-12">
			        <label>Upload de Imagem</label>
			        <div class="input-group">
			            <span class="input-group-btn">
			                <span class="btn btn-default btn-file">
			                    Procurar… <input type="file" id="imgInp" name="file_service">
			                </span>
			            </span>
			            <input type="text" class="form-control" readonly>
			        </div>
				</div>
				<div class="col-xs-12">
					<img id="img-upload"/>
				</div>
			</div>

			<div class="col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading">Serviços Agregados</div>
					<div class="panel-body">
						<div class="col-xs-12 col-md-4"><?= $this->Form->control('add_aggregate_name', ['label' => false, 'placeholder' => 'Nome', 'id' => 'add_aggregate_name']);?></div>
						<div class="col-xs-12 col-md-4"><?= $this->Form->control('add_aggregate_description', ['label' => false, 'placeholder' => 'Descrição', 'id' => 'add_aggregate_description']);?></div>
						<div class="col-xs-12 col-md-2"><?= $this->Form->control('add_aggregate_price', ['label' => false, 'placeholder' => '000.00', 'id' => 'add_aggregate_price', 'type' => 'text', 'class' => 'price']);?></div>
						<div class="col-xs-12 col-md-2"><button type="button" class="btn btn-primary" id="btn-add-aggregato">Adicionar</button></div>
						<table class="table" id="table-aggregates">
							<thead>
								<tr>
									<th class="col-xs-4">Nome</th>
									<th class="col-xs-5">Descrição</th>
									<th class="col-xs-2">Preço</th>
									<th class="col-xs-1"></th>
								</tr>
							</thead>
							<tbody>
								<tr id="model-line" style="display: none;">
									<td>
										<?= $this->Form->control('aggregates[name][]', ['label' => false, 'value' => '{{name}}'])?>
									</td>
									<td>
										<?= $this->Form->control('aggregates[description][]', ['label' => false, 'value' => '{{description}}'])?>
									</td>
									<td>
										<?= $this->Form->control('aggregates[price][]', ['label' => false, 'value' => '{{price}}', 'type' => 'text', 'class' => 'price'])?>
									</td>
									<td>
										<a href="#" onClick="removeLine(this);">remover</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
		<div class="box-footer">
			<?= $this->Form->button(__('Cancelar'), ['class' => 'btn btn-danger']) ?>
			<?= $this->Form->button(__('Adicionar'), ['class' => 'btn btn-primary', 'type' => 'submit']) ?>
		</div>
	</div>

</div>

<?= $this->Html->script('template/admin/services')?>

<script>
	$(".price").inputmask('decimal', {
	      radixPoint:",",
	      groupSeparator: ".",
	      autoGroup: true,
	      digits: 2,
	      digitsOptional: false,
	      placeholder: '0',
	      rightAlign: false,
	      onBeforeMask: function (value, opts) {
	        return value;
	      }
	});
</script>