@extends('layouts.appa')
  
@section('content')
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Gestione Utenti') }}
            </h2>
        </div>
    </x-slot>

<div class="btn-toolbar mb-2 mb-md-0">
<a href="javascript:void(0)" onClick="add()" class="btn btn-sm btn-dark d-inline-flex align-items-center">
            <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                </path>
            </svg>
            Aggiungi Utente
        </a>
    
</div>

<div style="margin: 0 auto;">

<h2 class="mb-4"></h2>    

<table class="table table-bordered" id="products">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ruolo</th>
                    <th width="80px;">Modifica</th>
            </tr>
        </thead>
    </table>
</div>
   

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<!-- boostrap product model -->
<div class="modal fade" id="product-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ProductModal"></h4>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="ProductForm" name="ProductForm" class="form-horizontal"
                        method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nome</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Nome" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-10 control-label">Email</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email" maxlength="50" required="">
                                    @error('email') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                                    
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                            <label for="role" class="col-sm-2 control-label">Ruolo</label>
                            <select name="role" class="form-select mb-0" id="role"
                                aria-label="Gender select example">
                                <option value="0">User</option>
                                <option value="1">Admin</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label" id="passl">Password</label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" maxlength="50" >
                            </div>
                            @error('password') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>
                                    <!-- End of Form -->
                        <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-outline-primary" id="btn-save">Salva
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- end bootstrap model -->

    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#products').DataTable({
            processing: true,
            serverSide: true,
            pageLength : 15,
            ajax: "{{ route('usersm.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'type', name: 'type'},
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: true, 
                    searchable: true
                },
            ],
            language: {
	            "sEmptyTable":     "Nessun dato presente nella tabella",
	            "sInfo":           "Vista da _START_ a _END_ di _TOTAL_ elementi",
	            "sInfoEmpty":      "Vista da 0 a 0 di 0 elementi",
	            "sInfoFiltered":   "(filtrati da _MAX_ elementi totali)",
	            "sInfoPostFix":    "",
	            "sInfoThousands":  ".",
	            "sLengthMenu":     "Visualizza _MENU_ elementi",
	            "sLoadingRecords": "Caricamento...",
	            "sProcessing":     "Elaborazione...",
	            "sSearch":         "Cerca:",
	            "sZeroRecords":    "La ricerca non ha portato alcun risultato.",
	            "oPaginate": {
		            "sFirst":      "Inizio",
		            "sPrevious":   "Precedente",
		            "sNext":       "Successivo",
		            "sLast":       "Fine"
	        },
	            "oAria": {
		            "sSortAscending":  ": attiva per ordinare la colonna in ordine crescente",
		            "sSortDescending": ": attiva per ordinare la colonna in ordine decrescente"
	            }
            }

            });

        });

        function add() {
            $('#ProductForm').trigger("reset");
            $('#ProductModal').html("Nuovo record");
            $('#product-modal').modal('show');
            $('#id').val('');
            $("#password").attr("required", true);
            $("#passl").html('Password');
        }

        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ url('edit-usersm') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    if (res.type == "admin") {
                        res.type = "1";
                    } else {
                        res.type = "0";
                    }

                    $('#ProductModal').html("Modifica dati");
                    $('#product-modal').modal('show');
                    $('#id').val(res.id);
                    $('#name').val(res.name);
                    $('#email').val(res.email);
                    $('#role').val(res.type);
                    $('#password').val("");
                    $("#password").attr("required", false);
                    $("#passl").html('Password (lasciare il campo in bianco per non modificare la password).');
                }
            });
        }

        function deleteFunc(id) {
            if (confirm("Elimina record?") == true) {
                var id = id;
                // ajax
                $.ajax({
                    type: "POST",
                    url: "{{ url('delete-user') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        var oTable = $('#products').dataTable();
                        oTable.fnDraw(false);
                        const notyf = new Notyf({
                            position: {
                                x: 'right',
                                y: 'top',
                            },
                            types: [
                                {
                                    type: 'info',
                                    background: 'green',
                                    dismissible: false
                                }
                            ]
                        });
                        notyf.open({
                            type: 'info',
                            message: 'Dati salvati con successo.'
                        });
                    }
                });
            }
        }
        $('#ProductForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ url('store-user') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $("#product-modal").modal('hide');
                    var oTable = $('#products').dataTable();
                    oTable.fnDraw(false);
                    $("#btn-save").html('Submit');
                    $("#btn-save").attr("disabled", false);
                    const notyf = new Notyf({
                        position: {
                            x: 'right',
                            y: 'top',
                        },
                        types: [
                            {
                                type: 'info',
                                background: 'green',
                                dismissible: false
                            }
                        ]
                    });
                    notyf.open({
                        type: 'info',
                        message: 'Dati salvati con successo.'
                    });
                },
                error: function(data) {
                    console.log(data);
                    alert("Email già esistente.");
                }
            });
        });
        
    </script>
@endsection
