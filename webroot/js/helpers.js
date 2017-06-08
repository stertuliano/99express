/**
 * Funcao para exibir o preview de uma imagem antes do upload
 * Se encontrar no form o campo do tipo file com nome (image_upload) quando alterado
 * exibe em div de placeholder (image_upload_holder) o preview da imagem
 */
$(document).on('change', '.btn-file :file', function() {
var input = $(this),
	label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
input.trigger('fileselect', [label]);
});

$('.btn-file :file').on('fileselect', function(event, label) {
    
    var input = $(this).parents('.input-group').find(':text'),
        log = label;
    
    if( input.length ) {
        input.val(log);
    } else {
        if( log ) alert(log);
    }

});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#img-upload').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function(){
    readURL(this);
});

/**
 * Funcao para preencher os 
 */
function preencheCep(cep){
	if(cep.length == 9){
		//Nova variável "cep" somente com dígitos.
        var cep = cep.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
	            $("[name='address']").val("pesquisando...");
	            $("[name='neighborhood']").val("pesquisando...");
	            $("[name='city']").val("pesquisando...");
	            $("[name='state']").val("pesquisando...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("[name='address']").val(dados.logradouro);
                        $("[name='neighborhood']").val(dados.bairro);
                        $("[name='city']").val(dados.localidade);
                        $("[name='state']").val(dados.uf);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        $("[name='address']").val("");
                        $("[name='neighborhood']").val("");
                        $("[name='city']").val("");
                        $("[name='state']").val("");
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
        } //end if.
	}	
}





