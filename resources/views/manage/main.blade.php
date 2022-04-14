@extends('layouts.master')

@section('header')
{!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css') !!}
{!! Html::style('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css') !!}
{!! Html::style('https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css') !!}

{!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.1/daterangepicker.css') !!}

    <style type="text/css">
    .paginate_button:hover {
        background: transparent !important;
        border: none !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0px;
        margin-left: 0px;
        display: inline;
        border: 0px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        border: 0px;
    }
    .icon-pencil:before {
    content: "\f040" !important;
}
.icon-trash:before {
    content: "\f1f8" !important;
}
    </style>

@stop
<?php $page_name = "Início" ?>

            
            @section('content')
                
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Início</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Gerenciamento de Check-in's</p>
                        </div>
                        <div class="card-body">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-info alert-block">
                            <button type="button" class="close" data-bs-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif

                        @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-bs-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                        <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                        </div>
                        @endif
                            <div class="row">




                                <div class="form-group">
                                    <label>Período:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datefilter"
                                            name="datefilter">

                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" id="range"><i
                                                    class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </div>


                                <div class="table-responsive table mt-2 " id="dataTable" role="grid"
                                    aria-describedby="dataTable_info">
                                    <table class="table my-0 table-bordered data-table" id="dataTable">

                                        <thead>

                                            <tr>
                                                <th>Nº</th>
                                                <th>Nome</th>
                                                <th>CPF</th>
                                                <th>Criado em</th>
                                                <th>Atualizado em</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><strong>Nº</strong></td>
                                                <td><strong>Name</strong></td>
                                                <td><strong>CPF</strong></td>
                                                <td><strong>Criado em</strong></td>
                                                <td><strong>Atualizado em</strong></td>
                                                <td><strong>Ações</strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    @stop


    @section('scriptlogged')    
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js') !!}
    {!! Html::script('https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js') !!}

    {!! Html::script('https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js') !!}

    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js') !!}
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.1/daterangepicker.js') !!}

    <script type="text/javascript">
    $(function() {



        var startDate = moment().clone().startOf('month').format('YYYY/MM/DD');
        var endDate = moment().clone().endOf('month').format('YYYY/MM/DD');

        var myDataTable = $('.data-table').DataTable({
            dom: 'Bfrtip',
            "oSearch": {
                "bSmart": true
            },
            processing: true,
            serverSide: false,

            stateSave: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json'
            },

            ajax: {
                url: "{{ route('checkin.datatable') }}",
                type: 'GET',
                data: function(d) {
                    // read start date from the element
                    d.from = startDate;
                    // read end date from the element
                    d.to = endDate;

                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'funcionario',
                    name: 'nome',
                    searchable: true
                },
                {
                    data: 'func_cpf',
                    name: 'cpf',
                    render: function(data, type, row, meta) {
                        return (data+"").replace(/^(\d{3})(\d{3})(\d{3})(\d{2}).*/, "$1.$2.$3-$4");
                    },
                    searchable: true
                },
                {
                    data: 'created_at',
                    name: 'data',
                    render: function(data, type, row, meta) {
                        return moment(new Date(data)).format("DD/MM/YYYY H:mm");
                    },
                },
                {
                    data: 'updated_at',
                    name: 'updated',
                    render: function(data, type, row, meta) {
                        return moment(new Date(data)).format("DD/MM/YYYY H:mm");
                    },
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('input[name="datefilter"]').daterangepicker({
            autoUpdateInput: true,
            locale: {
                format: 'DD/MM/YYYY',
                cancelLabel: 'Limpar',
                applyLabel: 'Aplicar'
            },
            //startDate: new Date().toLocaleDateString('en-GB'), //dd/mm/yyyy
            startDate: moment().clone().startOf('month').format('DD/MM/YYYY'),
            endDate: moment().clone().endOf('month').format('DD/MM/YYYY'),
            "locale": {
                "format": "DD/MM/YYYY",
                "separator": " - ",
                "applyLabel": "Aplicar",
                "cancelLabel": "Cancelar",
                "fromLabel": "De",
                "toLabel": "Até",
                "customRangeLabel": "Custom",
                "daysOfWeek": [
                    "Dom",
                    "Seg",
                    "Ter",
                    "Qua",
                    "Qui",
                    "Sex",
                    "Sáb"
                ],
                "monthNames": [
                    "Janeiro",
                    "Fevereiro",
                    "Março",
                    "Abril",
                    "Maio",
                    "Junho",
                    "Julho",
                    "Agosto",
                    "Setembro",
                    "Outubro",
                    "Novembro",
                    "Dezembro"
                ],
                "firstDay": 0
            }
        });

        //set on change date picker
        $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format(
                'DD/MM/YYYY'));
            startDate = picker.startDate.format('YYYY/MM/DD');
            endDate = picker.endDate.format('YYYY/MM/DD');
            //myDataTable.draw(); Parou de funcionar sem o server side
            myDataTable.ajax.reload();
        });

        $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            $('input[name="datefilter"]').data('daterangepicker').setStartDate(moment().clone().startOf(
                'month'));
            $('input[name="datefilter"]').data('daterangepicker').setEndDate(moment().clone().endOf(
                'month'));
            $('input[name="startDate"]').val('');
            $('input[name="endDate"]').val('');
            myDataTable.draw();
        });




    });
    </script>
@endsection