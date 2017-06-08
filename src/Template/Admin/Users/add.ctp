<?php
/**
  * @var \App\View\AppView $this
  */
?>

<!-- Bootstrap Datepicker -->
<?php echo $this->Html->css('AdminLTE./plugins/datepicker/datepicker3'); ?>
<!-- JS Datepicker -->
<?php echo $this->Html->script('AdminLTE./plugins/datepicker/bootstrap-datepicker'); ?>

<!-- InputMask -->
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask'); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.date.extensions.js'); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.extensions.js'); ?>

<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Adicionar Usuário</h3>
		</div>
		<div class="box-body">
			<div class="col-xs-12 col-md-6">
				<div class="col-xs-12">
					<?= $this->Form->control('name', ['label' => 'Nome:', 'required' => 'required']);?>
					<?= $this->Form->control('cpf', ['label' => 'CPF:']);?>
					<?= $this->Form->control('rg', ['label' => 'RG:']);?>
					<?= $this->Form->control('bitrh', ['label' => 'Data de Nascimento:', 'id' => 'birth']);?>
					<?= $this->Form->control('email', ['label' => 'Email:']);?>
				</div>
				<div class="col-xs-6">
					<?= $this->Form->control('password', ['label' => 'Senha:', 'value' => '']);?>
				</div>
				<div class="col-xs-6">
					<?= $this->Form->control('confirm_password', ['label' => 'Cornfirmação:', 'type' => 'password']);?>
				</div>
				<div class="col-xs-12">
					<?= $this->Form->control('role_id', ['label' => 'Nível:']); ?>
				</div>
			</div>
			<div class="col-xs-12 col-md-6">
				<div class="col-xs-12 col-md-6">
					<?= $this->Form->control('cep', ['label' => 'CEP:']);?>
				</div>
				<div class="col-xs-12">
					<?= $this->Form->control('address', ['label' => 'Endereco:']);?>
				</div>
				<div class="col-xs-4">
					<?= $this->Form->control('number', ['label' => 'Número:']);?>
				</div>
				<div class="col-xs-8">
					<?= $this->Form->control('complement', ['label' => 'Complemento:']);?>
				</div>
				<div class="col-xs-12">
					<?= $this->Form->control('neighborhood', ['label' => 'Bairro:']);?>
				</div>
				<div class="col-xs-8">
					<?= $this->Form->control('city', ['label' => 'Cidade:']);?>
				</div>
				<div class="col-xs-4">
					<?= $this->Form->control('state', ['label' => 'UF:']);?>
				</div>
				<div class="col-xs-6">
					<?= $this->Form->control('phone', ['label' => 'Telefone:']);?>
				</div>
				<div class="col-xs-6">
					<?= $this->Form->control('cel', ['label' => 'Celular:']);?>
				</div>
				<div class="col-xs-12">
					<?= $this->Form->control('status', ['label' => 'Ativo']); ?>
				</div>
			</div> 
		</div>	
		<div class="box-footer">
			<?= $this->Form->button(__('Cancelar'), ['class' => 'btn btn-danger']) ?>
			<?= $this->Form->button(__('Adicionar'), ['class' => 'btn btn-primary', 'type' => 'submit']) ?>
		</div>
	</div>
	
    <?= $this->Form->end() ?>
</div>

<script>
	$('#birth').datepicker({
		autoclose: true
	});

    $("#cpf").inputmask("999.999.999-99", {"placeholder": "___.___.___-__"});
    $("#birth").inputmask("dd/mm/yyyy", {"placeholder": "__/__/____"});
    $("#phone").inputmask("(99) 99999999", {"placeholder": "(__) ________"});
    $("#cel").inputmask("(99) 999999999", {"placeholder": "(__) _________"});
    $("#cep").inputmask("99999-999", {"placeholder": "_____-___"});

    $("#cep").on('change', function(){
    	preencheCep($("#cep").val());
	})
</script>