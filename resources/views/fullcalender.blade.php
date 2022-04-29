<!DOCTYPE html>
<html>
<head>
    <title>Laravel Fullcalender Tutorial Tutorial - ItSolutionStuff.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>-->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"-->
    <!--    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
        
  
  
  
    
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    
    <!--<script src='scripts/fullcalendar.js'></script>-->
    <script src="scripts/pt-br.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    

</head>
<body class="hold-transition sidebar-mini layout-fixed">

<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Agendamento</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Calendário</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
	
	<div class="col">
		<div classe="container">

			<div id='calendar'>


			</div>

		</div>
	</div>

<!-- Modal Adicionar Eventos-->
<div class="modal fade" id="evento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Criar Evento</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="addEvent" name="addEvent" method="post" data-postattempt="0">

					<div class="mb-3 row">
						<label for="" class="col-sm-2 col-form-label">Título</label>
						<div class="col-sm-10">
							<input type="text" name="title" class="form-control">
						</div>
					</div>
					<div class="mb-3 row">
						<label for="" class="col-sm-2 col-form-label">Tecnico</label>
						<div class="col-sm-10">
							<select class="form-control" id="tecnico" name="tecnico_id" required>
							    
							    <option>Selecionar Tecnico</option>
								<option value="1">Marcos</option>
								<option value="2">Artur</option>
							
							</select>
						</div>
					</div>
					<input type="hidden" id="tipo" name="add" value="add">
					<div class="mb-3 row">
						<label for="" class="col-sm-2 col-form-label">Cor</label>
						<div class="col-sm-10">
							<select class="form-control" id="evtcolor" name="color" required>
								<option style="color:#fff3cd" value="#fff3cd">Amarelo</option>
								<option style="color:blue" value="blue">Azul</option>
								<option style="color:#40E0D0" value="#40E0D0">Turquesa</option>
								<option style="color:gray" value="gray">Cinza Claro</option>
								<option style="color:#f0f" value="#f0f">Roxo</option>
								<option style="color:#0f0" value="#0f0">Verde</option>
								<option style="color:red" value="red">Vermelho</option>
							</select>
						</div>
					</div>
					<div class="mb-3 row">
						<label for="inputPassword" class="col-sm-2 col-form-label">Começo</label>
						<div class="col-sm-10">
							<input type="text" name="start" class="form-control" id="2" onkeypress="DataHora(event, this)">
						</div>
					</div>
					<div class="mb-3 row">
						<label for="inputPassword" class="col-sm-2 col-form-label">Fim</label>
						<div class="col-sm-10">
							<input type="text" name="end" class="form-control" id="3"  onkeypress="DataHora(event, this)">
						</div>
					</div>
					<div class="mb-3 row">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<div class="col-sm-10">
							<button class="btn btn-primary" class="col-sm-2 col-form-label" type="submit">Adicionar</button>
						</div>
					</div>
				</form>

				<div class="modal-footer"></div>

			</div>
		</div>
	</div>
</div>


<!-- Modal Editar Eventos-->
<div class="modal fade" id="editarEvento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Editar Evento</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="editarForm" name="editarForm" method="post" data-postattempt="0">

					<div class="mb-3 row">
						<label for="" class="col-sm-2 col-form-label">Título</label>
						<div class="col-sm-10">
							<input type="text" name="title" class="title form-control">
						</div>
					</div>
					<div class="mb-3 row">
						<label for="" class="col-sm-2 col-form-label">Tecnico</label>
						<div class="col-sm-10">
							<select class="tecnico form-control" id="tecnico_id" name="tecnico_id" required>
							    
								<option value="2">Artur</option>
								<option value="1">Marcos</option>
							
							</select>
						</div>
					</div>
					<input type="hidden" id="tipo" name="update" value="update">
					<input type="hidden" id="idEvento" name="id" value="">
					<div class="mb-3 row">
						<label for="" class="col-sm-2 col-form-label">Cor</label>
						<div class="col-sm-10">
							<select class="color form-control" id="color-select" name="color" required>
								<option style="color:#fff3cd" value="#fff3cd">Amarelo</option>
								<option style="color:blue" value="blue">Azul</option>
								<option style="color:#40E0D0" value="#40E0D0">Turquesa</option>
								<option style="color:gray" value="gray">Cinza Claro</option>
								<option style="color:#f0f" value="#f0f">Roxo</option>
								<option style="color:#0f0" value="#0f0">Verde</option>
								<option style="color:red" value="red">Vermelho</option>
							</select>
						</div>
					</div>
					<div class="mb-3 row">
						<label for="inputPassword" class="col-sm-2 col-form-label">Começo</label>
						<div class="col-sm-10">
							<input type="text" name="start" class="start form-control" id="2">
						</div>
					</div>
					<div class="mb-3 row">
						<label for="inputPassword" class="col-sm-2 col-form-label">Fim</label>
						<div class="col-sm-10">
							<input type="text" name="end" class="end form-control" id="3">
						</div>
					</div>
					<div class="mb-3 row">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<div class="col-sm-10">
							<button class="btn btn-primary" class="col-sm-2 col-form-label" type="submit">Salvar</button>
						</div>
					</div>
				</form>

				<div class="modal-footer"></div>

			</div>
		</div>
	</div>
</div>





<!-- Modal Detalhes eventos-->
<div class="modal fade" id="detalhes" tabindex="-1" aria-labelledby="detalhesEvento" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="detalhesEvento">Detalhes do Evento</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
                
                <table class="table">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Titulo</th>
                      <th scope="col">Data de Inicio</th>
                      <th scope="col">Data de Fim</th>
                      <th scope="col">Tecnico</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="title"></td>
                      <td class="start">Otto</td>
                      <td class="end"></td>
                      <td class="tecnico"></td>
                    </tr>

                  </tbody>
                </table>
				<div class="modal-footer">
				    <button id="editar" class="btn btn-outline-primary">Editar</button>
				    <button id="eliminarEventoBtn" class="btn btn-outline-warning">Eliminar</button>
				</div>

			</div>
		</div>
	</div>
</div>



<!-- Modal Eliminar eventos-->
<div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="eliminarEvento" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="eliminarEvento">Eliminar evento</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
                <p>Tem a certeza que pretende eliminar esta evento?</p>
				<div class="modal-footer">
				    <button id="editar" class="btn btn-outline-primary btn-close" data-bs-dismiss="modal" aria-label="Close">Nao</button>
				    <button id="confirmarEliminar" class="btn btn-outline-warning">Eliminar</button>
				</div>

			</div>
		</div>
	</div>
</div>




</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" 
integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="{{asset('admTL/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script>
$(document).ready(function () {
    // jq214 = jQuery.noConflict( true );
    // jq214(document.body).append("jq214 object name is version " + jq214.fn.jquery);
    // $(document.body).append("<br/>default $ alias is version " + $.fn.jquery);
        
   
    var SITEURL = "{{ url('/') }}";
      
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      
    var calendar = $('#calendar').fullCalendar({
                        locale: "pt-br",
                        editable: true,
                    header:{
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month, agendaWeek, agendaDay'
                    },
                    events: SITEURL + "/fullcalender",
                    selectable: true,
                    selectHelper: true,
                    select: function (start, end, allDay) {
                        // var title = prompt('Event Title:');
                        // $("#evento .modal-title").text("Criar Evento");
                        // $("#evento form").attr("id", "addEvent");
                        // $("#evento form").attr("name", "addEvent");
                        // $("#evento form #tipo").attr("name", "add");
                        
                        
                        $('#evento').find('input[name=start]').val(
                            start.format('YYYY-MM-DD HH:mm:ss')
                        );
                        $('#evento').find('input[name=end]').val(
                            end.format('YYYY-MM-DD HH:mm:ss')
                        );
                        
                        $('#evento').modal('show');
                        
                        $("#addEvent").on('submit', function(e) {
                            e.preventDefault();
                            
                            let postAttemptCount = $(this).data("postattempt")*1;
                            
                            if (postAttemptCount < 1) {
                                // increment the count
                                // $(this).data("postattempt", postAttemptCount + 1);
                                
                                $.ajax({
                                    url: SITEURL + "/fullcalenderAjax",
                                    type: 'POST',
                                    dataType: 'json',
                                    data: new FormData(this),
                                    async: false,
                                    contentType: false,
                                    processData: false,
                                    cache: false,
                                    success: function(response) {
                                        $("#addEvent")[0].reset();
                                        // if saved, close modal
                                        $("#evento").modal('hide');
                                        displayMessage("Evento criado com sucesso!");
                                        
                                        // refetch event source, so event will be showen in calendar
                                        $("#calendar").fullCalendar( 'refetchEvents' );
                                    }
                                });
                            }
                        });
                        // if (title) {
                        //     var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                        //     var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                        //     $.ajax({
                        //         url: SITEURL + "/fullcalenderAjax",
                        //         data: {
                        //             title: title,
                        //             start: start,
                        //             end: end,
                        //             type: 'add'
                        //         },
                        //         type: "POST",
                        //         success: function (data) {
                        //             console.log(data);
                        //             displayMessage("Event Created Successfully");
  
                        //             calendar.fullCalendar('renderEvent',
                        //                 {
                        //                     id: data.id,
                        //                     title: title,
                        //                     start: start,
                        //                     end: end,
                        //                     allDay: allDay
                        //                 },true);
  
                        //             calendar.fullCalendar('unselect');
                        //         }
                        //     });
                        // }
                    },
                    editable: true,
                    durationEditable: true,
                    eventStartEditable: true,
                    // eventResize: function (event, delta) {
                    //     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    //     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
  
                    // //     // $.ajax({
                    // //     //     url: SITEURL + '/fullcalenderAjax',
                    // //     //     data: {
                    // //     //         title: event.title,
                    // //     //         start: start,
                    // //     //         end: end,
                    // //     //         id: event.id,
                    // //     //         type: 'update'
                    // //     //     },
                    // //     //     type: "POST",
                    // //     //     success: function (response) {
                    // //     //         // calendar.fullCalendar("refecthEvents");
                    // //     //         displayMessage("Event Updated Successfully");
                    // //     //     }
                    // //     // });
                    // },
                    eventDrop: function (event, delta) {
                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
  
                        $.ajax({
                            url: SITEURL + '/fullcalenderAjax',
                            data: {
                                title: event.title,
                                start: start,
                                color: event.color,
                                tecnico_id: event.tecnico_id,
                                end: end,
                                id: event.id,
                                type: 'update'
                            },
                            type: "POST",
                            success: function (response) {
                                displayMessage("Evento atualizado com sucesso!");
                            }
                        });
                    },
                    eventClick: function (event) {
                        $("#detalhes").modal("show");
                        $("#detalhes .title").text(event.title);
                        $("#detalhes .start").text(event.start.format('YYYY-MM-DD HH:mm:ss'));
                        $("#detalhes .end").text(event.end.format('YYYY-MM-DD HH:mm:ss'));
                        $("#detalhes .tecnico").text(event.tecnico_id);
                        
                        $("#editar").on('click', function(e) {
                                $("#detalhes").modal("hide");
                                $("#editarEvento").modal("show");
                                $("#editarEvento form #idEvento").attr("value", event.id);
                                
                                $("#editarEvento form .title").attr("value", event.title);
                                $("#editarEvento form .start").attr("value", event.start.format('YYYY-MM-DD HH:mm:ss'));
                                $("#editarEvento form .end").attr("value", event.end.format('YYYY-MM-DD HH:mm:ss'));
                                
                                $("#editarEvento form .selectedColor").attr("value", event.color);
                                $("#editarEvento form .selectedTecnico").attr("value", event.tecnico_id);
                                
                                $("#tecnico_id").val(event.tecnico_id);
                                $("#color-select").val(event.color);
                                
                               
                                
                               
                               
                               $("#editarForm").on('submit', function(e) {
                                    e.preventDefault();
                            
                                    let postAttemptCount = $(this).data("postattempt")*1;
                                    
                                    if (postAttemptCount < 1) {
                                        $.ajax({
                                            url: SITEURL + "/fullcalenderAjax",
                                            type: 'POST',
                                            dataType: 'json',
                                            data: new FormData(this),
                                            async: false,
                                            contentType: false,
                                            processData: false,
                                            cache: false,
                                            success: function(response) {
                                                // $("#editarEvento")[0].reset();
                                                
                                                // if saved, close modal
                                                displayMessage("Evento editado com sucesso!");
                                                $("#editarEvento").modal('hide');
                                                
                                                setTimeout(()=>{
                                                    location.reload();
                                                    
                                                }, 1000);
                                                
                                                // refetch event source, so event will be showen in calendar
                                                $("#calendar").fullCalendar( 'refetchEvents' );
                                            }
                                        });
                                    }
                               });
                            
                               
                               
                               $("#evento .modal-title").text("Editar Evento");
                        });
                        
                        
                        $("#eliminarEventoBtn").on("click", function(e) {
                            $("#detalhes").modal("hide");
                            $("#eliminar").modal("show");
                            
                            $("#confirmarEliminar").on("click", function(e) {
                                $.ajax({
                                    type: "POST",
                                    async: false,
                                    url: SITEURL + '/fullcalenderAjax',
                                    data: {
                                            id: event.id,
                                            type: 'delete'
                                    },
                                    success: function (response) {
                                        calendar.fullCalendar('removeEvents', event.id);
                                        
                                        displayMessage("Evento eliminado com Sucesso!");
                                        $("#eliminar").modal("hide");
                                    }
                                });
                            });
                        });
                        
                    },
                    eventRender: function (event, element, view) {
                        if (event.allDay === 'true') {
                                event.allDay = true;
                        } else {
                                event.allDay = false;
                        }
                    },
                    // displayEventTime: false,
 
    });
 
});
 
function displayMessage(message) {
    toastr.success(message, 'Event');
} 

//Mascara para o campo data e hora
function DataHora(evento, objeto) {
    var keypress = (window.event) ? event.keyCode : evento.which;
    campo = eval(objeto);
    if (campo.value == '0000/00/00 00:00:00') {
        campo.value = "";
    }

    caracteres = '0123456789';
    separacao1 = '-';
    separacao2 = ' ';
    separacao3 = ':';
    conjunto1 = 4;
    conjunto2 = 7;
    conjunto3 = 10;
    conjunto4 = 13;
    conjunto5 = 16;
    if ((caracteres.search(String.fromCharCode(keypress)) != -1) && campo.value.length < (19)) {
        if (campo.value.length == conjunto1)
            campo.value = campo.value + separacao1;
        else if (campo.value.length == conjunto2)
            campo.value = campo.value + separacao1;
        else if (campo.value.length == conjunto3)
            campo.value = campo.value + separacao2;
        else if (campo.value.length == conjunto4)
            campo.value = campo.value + separacao3;
        else if (campo.value.length == conjunto5)
            campo.value = campo.value + separacao3;
    } else {
        event.returnValue = false;
    }
}
  
</script>
  
</body>
</html>