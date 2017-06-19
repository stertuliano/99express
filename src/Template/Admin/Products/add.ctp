<?php
/**
  * @var \App\View\AppView $this
  */
	
echo $this->Html->css('/bootstrap-fileinput-master/css/fileinput.min');
echo $this->Html->script('/bootstrap-fileinput-master/js/plugins/piexif.min.js');
echo $this->Html->script('/bootstrap-fileinput-master/js/plugins/sortable.min.js');
echo $this->Html->script('/bootstrap-fileinput-master/js/plugins/purify.min.js');
echo $this->Html->script('/bootstrap-fileinput-master/js/fileinput.min.js');
echo $this->Html->script('/bootstrap-fileinput-master/themes/fa/theme.js');
echo $this->Html->script('/bootstrap-fileinput-master/js/locales/pt-BR.js');

echo $this->Html->css('AdminLTE./plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min');
echo $this->Html->script('AdminLTE./plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min');
?>

<style>
	#img-upload{
	    max-width: 100%	;
	    max-height: 180px;
	    padding: 5px;
	}
</style>

<div class="products form large-9 medium-8 columns content">
    <?= $this->Form->create($product, ['enctype' => 'multipart/form-data']) ?>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Adicionar Produto</h3>
		</div>
		<div class="box-body">
			<div class="col-xs-12 col-md-6">
				<div class="col-xs-12">
<?php
	    	        echo $this->Form->control('name', ['label' => 'Name:']);
	    	        echo $this->Form->control('short_description', ['label' => 'Descrição curta:']);
	    	        echo $this->Form->control('price', ['label' => 'Preço:']);
	    	        echo $this->Form->control('status', ['label' => 'Ativo']);
?>
				</div>
			</div>
			<div class="col-xs-12 col-md-6">
				<?= $this->Form->control('description', ['type' => 'textarea', 'rows' => '8', 'label' => 'Descrição:']);?>
			</div>
			<div class="col-xs-12 col-md-12">
				<div class="col-xs-12">
					<label class="control-label">Imagens:</label>
					<input id="input-24" name="files_product[]" type="file" multiple class="file-loading">
				</div>
			</div>
		</div>
		<div class="box-footer">
			<?= $this->Form->button(__('Cancelar'), ['class' => 'btn btn-danger']) ?>
			<?= $this->Form->button(__('Adicionar'), ['class' => 'btn btn-primary', 'type' => 'submit']) ?>
		</div>
	</div>
</div>

<script>
	$(document).on('ready', function() {
	    $("#input-24").fileinput({
	        initialPreview: [
	            
	        ],
	        initialPreviewAsData: true,
	        initialPreviewConfig: [
	            {caption: "Moon.jpg", size: 930321, width: "120px", key: 1},
	            {caption: "Earth.jpg", size: 1218822, width: "120px", key: 2}
	        ],
	        deleteUrl: "/site/file-delete",
	        overwriteInitial: false,
	        maxFileSize: 1000,
	        maxImageWidth: 1280,
	        maxImageHeight: 760,
	        
	        showCaption: true,
	        showRemove: false,
	        showUpload: false,

	        allowedFileExtensions: ["jpg", "png", "gif"]
	    });
	});

	$('#description').wysihtml5({
		toolbar: {
			"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
			"emphasis": true, //Italics, bold, etc. Default true
			"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
			"html": false, //Button which allows you to edit the generated HTML. Default false
			"link": false, //Button to insert a link. Default true
			"image": false, //Button to insert an image. Default true,
			"color": false, //Button to change color of font  
			"blockquote": true
		}
	});
</script>