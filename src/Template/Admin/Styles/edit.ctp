<?php
/**
  * @var \App\View\AppView $this
  */
?>

<style>
	#img-upload{
	    max-width: 100%	;
	    max-height: 350px;
	    padding: 5px;
	}
</style>

<div class="styles form large-9 medium-8 columns content">
    <?= $this->Form->create($style, ['enctype' => 'multipart/form-data']) ?>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Adicionar Style</h3>
		</div>
		<div class="box-body">
			<div class="col-xs-12 col-md-6">
				<div class="col-xs-12">
<?php
	    	        echo $this->Form->control('name', ['label' => 'Name:']);
	    	        echo $this->Form->control('short_description', ['label' => 'Descrição curta:']);
	    	        echo $this->Form->control('description', ['label' => 'Descrição:', 'type' => 'textarea', 'rows' => 15]);
?>
				</div>
			</div>
			<div class="col-xs-12 col-md-6">
				<div class="col-xs-12">
			        <label>Upload de Imagem</label>
			        <div class="input-group">
			            <span class="input-group-btn">
			                <span class="btn btn-default btn-file">
			                    Procurar… <input type="file" id="imgInp" name="file_style">
			                </span>
			            </span>
			            <input type="text" class="form-control" readonly>
			        </div>
				</div>
				<div class="col-xs-12">
					<?php echo $this->Html->image($image, ['id' => 'img-upload']);?>
				</div>
			</div>
		</div>
		<div class="box-footer">
			<?= $this->Form->button(__('Cancelar'), ['class' => 'btn btn-danger']) ?>
			<?= $this->Form->button(__('Alterar'), ['class' => 'btn btn-primary', 'type' => 'submit']) ?>
		</div>
	</div>

</div>