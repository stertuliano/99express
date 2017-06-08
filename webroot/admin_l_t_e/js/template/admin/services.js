var lineAggregateModel = $("#model-line").html();
lineAggregateModel = "<tr>" + lineAggregateModel.replace("display: none;", "") + "</tr>";

// Adiciona agregato
function addAggregate(name, description, price){
	var line = lineAggregateModel;
	line = line.replace("{{name}}", name).replace("{{name}}", name);
	line = line.replace("{{description}}", description).replace("{{description}}", description);
	line = line.replace("{{price}}", price).replace("{{price}}", price);
	
	$("#model-line").parent().append(line);
}

// Quando clica no botao adicionar
$("#btn-add-aggregato").on("click", function(){
	var name = $("#add_aggregate_name").val();
	var description = $("#add_aggregate_description").val();
	var price = $("#add_aggregate_price").val();
	
	addAggregate(name, description, price);

	$("#add_aggregate_name").val("");
	$("#add_aggregate_description").val("");
	$("#add_aggregate_price").val("");		
});

// Remover linha de agregado
function removeLine(el){
	$(el).parent().parent().remove();
}