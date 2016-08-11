
var question_add = null;
var question_rm  = null;

$('body').on('click','#questions .question ', function(e){
	
	e.preventDefault();

	var questions = $("#questions .question");
	var exam_questions = $("#exam .question");
	questions.removeClass('active');
	exam_questions.removeClass('active');
	question_add = $(this).attr('id');

	$(this).addClass('active');	
	// console.log(question_add);
	
});

$('body').on('click','#exam .question', function(e){
	e.preventDefault();
	var cat_questions = $("#questions .question");
	var questions = $("#exam .question");
	questions.removeClass('active');
	cat_questions.removeClass('active');
	question_rm = $(this).attr('id');
	$(this).addClass('active');
	// alert(question_rm);
});

$('body').on('click','#remove',function(e){
	e.preventDefault();
	if(question_rm != null){
		var question = $('#exam .active');
		var id = question.attr('id');
		var href = $('#exam .active a').attr('href');
		var img = $('#exam .active img');
		var src = img.attr('src');
		// var title = $('#exam .active:last-child').text();
		// alert(title);
		// $('input[name^="id_q"]').each(function(){
		// 	console.log($(this).val());
		// });
		var rm_question =  $("<input type='hidden' id=rm_"+id+" name='id_rm[]'>").val(id);
		$("#exam").append(rm_question);
		// // rm_question.val(id);
		var question_old = $("#questions #"+id);
		var title = $("#questions #"+id).text();
		// alert(title);
		var content = $('<a data-remodal-target="modal"></a>').attr('href',href).attr('id',id).append(img); //.text(title);
		question_old.empty().append(content).append(title);
		question_old.removeClass('blocked');
		question_old.addClass('question');
		// question_old.append(title);
		// question.next().remove();
		question.remove();
		question_rm = null;
	}
	renumerate();
});

$('body').on('click',"#add", function(e){
	e.preventDefault();
	var nro_questions = $("#exam .question").length;
	if(question_add != null){
		var question = $('#questions .active');
		var href = $('#questions .active a').attr('href');
		var img = $('#questions .active img');
		var src = $('#questions .active img').attr('src');
		// alert(src);
		var id = question.attr('id');
		var title = question.text();
		$('#questions .active a').replaceWith(img);

		if($("input#rm_"+id).length){
			$("input#rm_"+id).remove();
		}
		question.removeClass('question').removeClass('active').addClass('blocked');
		var new_question = $("<li class='list-group-item question'></li>").attr('id',id);
		var img_question = $("<img class='img-circle' width='20px'></img>").attr('src',src);
		var link_question = $("<a data-remodal-target='modal'></a>")
							.attr('href', href)
							.attr('id', id).append(img_question); //.text(title);
		var span_component = $("<span></span>").attr('id',id)
											   .append($("<strong></strong>").text(nro_questions+1))
											   .append(link_question).append(title);
		span_component = $("<div class='col-sm-9'></div>").append(span_component);

		var text_component = $("<input type='number' class='form-control' min='0' max='100'>").attr('id',id).val(0);
		var hidden_component = $("<input type='hidden' name='id_q[]'>").val(id+"_0");

		var exam = $("#exam");
		var container = $('<div class="row"></div>').append(span_component);
		container.append($('<div class="col-sm-3"></div>').append(text_component).append(hidden_component));
		
		new_question.append(container);
		exam.append(new_question);
		question_add = null;
		
	}
	renumerate();
	
});



// $(" #questions .question > span ").click(function(){
// 	//var that = $('#questions .active');
// 	var id = $(this).attr('id');
// 	alert(id);
// 	// if(that.length){
// 	// 	alert(that.attr('id'));
// 	// }
	
// });

$("body").on("change", "#exam input[type='number']", function(){
	var id = $(this).attr('id');
	var that = $("#exam #"+id+" + input");
	that.val(id+"_"+$(this).val());
});

// $("#show_exam").click(function(e){
// 	e.preventDefault();
// 	alert("vista previa del examen generado");
// });

$("#edit_percent").click(function(e){
	e.preventDefault();
	var questions = $("#exam input[type='number']");
	var score_aprox = Math.floor((100 / questions.length)) ;

	questions.each(function(index,element){
		$(this).val(score_aprox).trigger('change');
	});

	var  complement = 100  - questions.length*score_aprox;
	questions.last().val(score_aprox + complement ).trigger('change');
	// questions.last().val()
	//alert(100/nro_q);

});

$("#random_order").click(function(e){
	e.preventDefault();
	var questions = $("#exam input[type='number']");
	var container =$("<ul class='list-group scroll-personal' id='exam'></ul>");
	// console.log(container);
	var ids = [];
	questions.each(function(index,element){
		ids.push(parseInt($(this).attr('id')));
	});

	// console.log(ids);
	var random_ids = randomArray(ids);
	// $('#exam').empty();
	for(var i=0; i<random_ids.length; i++){
		container.append($("#exam .question#"+random_ids[i]));
		// console.log(random_ids[i]);
	}
	// console.log(container);
	$("#exam").replaceWith(container);
	renumerate();
});
$('#up').click(function(){
	var current = $('#exam .active');
	if(current.length){
		var that = $('#exam .active :text');
		// alert(that.attr('id'));
		var prev = $('#exam .active').prev();
		prev.before(current);
	}
	renumerate();
});

$('#down').click(function(){
	if($('#exam .active ').length){
		var that = $('#exam .active :text');
		// alert(that.attr('id'));
		$('#exam .active').next().after($("#exam .active"));
	}
	renumerate();
});

// $("#exam .question a").click(function(){
// 	alert($(this).attr('href'));
// 	window.location = $(this).attr('href');
// });

function renumerate(){
	console.log($("#exam .question strong").length);
	 $("#exam .question strong ").each(function(indice,elemento){
	 	$(this).text(indice+1);
	 	// console.log($(this).text());
	 });	
}

function randomArray(list){
	// var lista = [1,2,3,4,5,6,7,8,9];
	list = list.sort(function() {return Math.random() - 0.5});
	return list;
}