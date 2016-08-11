@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading" >Editar Pregunta de Complemento</div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')
		<div class="container-fluid">
			<div class="row">
				<form  class="form-horizontal" action="{{ url('teacher/group/'.$group.'/question/edit/'.$question->id)}}" method ="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				
					<div class="form-group">
						<label for="title" class="col-sm-2">Titulo</label>		
							<div class="col-sm-10">					
								<input class="form-control" type="text" name="title" id="title" value="{{ $question->title }}">
							</div>		
					</div>

					<div class="form-group">
						<label for="title" class="col-sm-2">Enunciado</label>		
						<div class="col-sm-10">					
							
							 <textarea  style="display:none;" class="form-control" rows="4" name="description" id="description">{{ $question->description }}</textarea>
        
						</div>		
					</div>
						<span style="display:none;">{{$i=0}}</span>	
						<div id="container-resp">
						@foreach($complementos as $key => $value)
							<div class="form-group resp" id="resp_{{$key}}">
						 	<div class="col-md-2">	
								<label for="title">Resp {{$i++}} </label>
							</div>
							<div class="col-md-10">		
							<div class="input-group" >					
								<input class="form-control" type="text" name="save[]"  value="{{$value}}">
								<input type="hidden" name="save_id[]"  value="{{$key}}">
								<span class="input-group-addon">
									<button type="button" class="btn btn-xs btn-default bg-red border-red btn-delete" id="{{$key}}">
										<i class="fa fa-times" aria-hidden="true"></i>
									</button>
      							</span>
							</div>		
							</div>
						</div>
						@endforeach
						<input type="hidden" name="count" value="{{$i}}">
						
						</div>
						<div class="form-group">
							<div class="col-md-2">	
								<label for="title"> </label>
							</div>
							<div class="col-md-10">
							<button class="btn btn-default btn-sm bg-green white" type="button" id="add_field"> Insertar Campo </button>
							<!-- <button class="btn btn-default btn-sm bg-red white" type="button" id="rem_field"> Eliminar Campo </button> -->
							</div>
						</div>
					<div id="deletes"></div>
					<div class="form-group ">
						<div class="col-sm-offset-2 col-sm-10">	
							<button class="btn btn-primary" type="submit">	Guardar
							</button>
							<a class="btn btn-primary" href="{{url('teacher/group/'.$question->group_id.'/questions')}}">Volver	</a>
							
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

				</div>
			</div>
		</div>
	</div>
	
@endsection


@section('scripts')
<script>
	var editable = $('<div id="q_complement" contenteditable><p>gato</p></div>').addClass('scroll-personal');
	var textarea = $('#description');
	var add = $('#add_field');
	var rem = $('#rem_field');
	var compl = $('<span class="complement"> ............................. <span>');
	var selection;
	var news_id = 0;
	// var count = parseInt($('input[name="count"]').val());
	var count = 0;
	//console.log("contador: "+count);

	editable.empty().append($.parseHTML(mapEditable(textarea.text())) );
	textarea.after(editable);
	
	function mapEditable(text){
		//var re2 = /(\(x\))(.+?)(\(\/x\))/g;
		//var re1 =/(\(x\).+?\(\/x\))/g;
		var re1 = new RegExp("<compl>(.+?)</compl>","i");
		// var result = re.exec(text);
	//	console.log(text.match(re1)[1]);
		var rep = text ;// text.match(re1);
		var arr = [];
		var cont = [];
		var i = 0;
		 while(re1.test(rep)){
		 	var str = rep.match(re1);
			arr[i] = str[0];
			cont[i] = str[1];
			rep = rep.replace(arr[i],"");
			i++;
		 }
	//	console.log(arr);
	//	console.log(cont);
		for(var i=0; i<arr.length; i++){
			text = text.replace(arr[i],setSpan(cont[i]));
		}		
		//console.log(text);
		return text;
	}

	function setSpan(text){
		var id =text.split('-')[1];
		var tem ='<span class="complement resp" id="'+id+'">comp-'+count+'</span>'
		var complement = $('<span class="complement resp" >comp-'+count+'</span>').attr('id',id);
		//console.log(complement);
		count++;
		return tem;
	}

	

	editable.blur(function(){
		editableToTextarea();
	});

	function editableToTextarea(){
		// clone content editable div
		var content  = $("#q_complement").clone();
		// $("#q_complement span").each(function(index,element){
		// 	var text = $(element).text();
		// 	$(element).replaceWith('(x)'+text+'(/x)');
		// });
		var spans = content.find('span.new');
		spans.each(function(index,element){
			var text = $(element).text();
		 	$(element).replaceWith('<compl>'+text+'</compl>');
		});

		var spans = content.find('span.resp');
		spans.each(function(index,element){
			var id = $(element).attr('id');
		 	$(element).replaceWith('<compl>compl-'+id+'</compl>');
		});
		
		//editable.empty().append(content.html());
		textarea.text(content.html());
	}

	add.click(function(e){
		// editable.append();
		// selection = saveSelection();
		insertTextAtCursor();
		editableToTextarea();
	});

	rem.click(function(e){
		// editable.append();
		restoreSelection(selection);
	});

	function insertTextAtCursor() {
    var sel, range, html;
    if (window.getSelection) {

        sel = window.getSelection();

        if (sel.getRangeAt && sel.rangeCount) {
            range = sel.getRangeAt(0);
            // console.log(range.startOffset);
            // console.log(range.endOffset);
            var texto= window.getSelection();
            // console.log(texto);
            range.deleteContents();
            //range.insertNode( document.createElement('input') );
            
            range.insertNode(document.createTextNode('\u00A0\u00A0'));
            range.insertNode(createComplement());
        }
    } else if (document.selection && document.selection.createRange) {
        document.selection.createRange().text = text;
    }
}

function saveSelection() {
    if (window.getSelection) {
        sel = window.getSelection();
        if (sel.getRangeAt && sel.rangeCount) {
            return sel.getRangeAt(0);
        }
    } else if (document.selection && document.selection.createRange) {
        return document.selection.createRange();
    }
    return null;
}

$('body').on('click',".complement.resp", function(e){
	id = $(this).attr('id');
  
    $("#resp_"+id+" input[type='text']").focus();
});

$('body').on('click',".complement.new", function(e){
	id = $(this).attr('id').split('_')[1];
    
    $("#new_"+id+" input[type='text']").focus();

});

$('body').on('click',".new .btn-delete", function(e){
	var id = $(this).attr('id');
    // console.log(id);
    $("#new_"+id).remove();
    // $('.complement.new#'+id).remove();
    $('.complement#n_'+id).remove();
    console.log(span.length);
    span.text("gato de dos estados");
});


$('body').on('click',".resp .btn-delete", function(e){
	id = $(this).attr('id');
    console.log(id);
    $("#resp_"+id).remove();
    $('.complement#'+id).remove();
    $('#deletes').append($('<input type="hidden" id= "del_'+id+'" name="deletes[]" value="'+id+'">'));
});

function createComplement(){
	var complement = $('<span class="complement new" id ="n_'+count+'" >comp-new_'+count+'</span>');
	
	var label = $('<div class="col-md-2"></div>').append($('<label for="title"></label>').text('Resp '+count));
	// var input = $('<div class="col-md-10"></div>').append()
	var remove = $('<span class="input-group-addon"></span>').append(
						$('<button type="button" class="btn btn-xs btn-default bg-red border--red btn-delete" id="'+count+'"></button>').append($('<i class="fa fa-times" aria-hidden="true"></i>'))
		);
	var input = $('<div class="input-group"></div>')
					.append($('<input class="form-control" type="text" name="news[]"  value="">')).append('<input type="hidden" name="news_index[]" value="'+count+'">');
		input.append(remove);
	var resp = $('<div class="col-md-10"></div>').append(input); 		   
		$('#container-resp').append($('<div class="form-group new" id="new_'+count+'"></div>').append(label).append(resp));
	count++;
	console.log(complement[0]);
	return complement[0];
}


$('body').on('submit','form',function(e){	
	editableToTextarea();
	return true;
});

</script>

@endsection