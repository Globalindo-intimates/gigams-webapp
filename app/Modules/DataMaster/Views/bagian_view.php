<?= $this->extend('layouts\page_layout'); ?>
<?= $this->section('content'); ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">

        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="<?= base_url('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">
    <style>
    td.details-control {
        background: url(<?= base_url('images/details_open.png'); ?>) no-repeat center center;
        cursor: pointer;
        width: 30px;
        transition: .5s;
    }        
    tr.shown td.details-control {
        background: url(<?= base_url('images/details_close.png'); ?>) no-repeat center center;
        width: 30px;
        transition: .5s;
    }    
    </style>

    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-10">
                <div class="card card-info shadow">
                    <div class="card-header">
                        <h3 class="card-title">Data Master Menu</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered" id="tableApp">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Menu</th>
                                    <th>Icon</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Menu</th>
                                    <th>Icon</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalApp" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content bg-Info">
                <div class="modal-header">
                    <h4 class="modal-title">Data Module App</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times</span>
                    </button>
                    <div class="ribbon-wrapper">
                        <div class="ribbon bg-warning" id="theRibbon1">
                        </div>
                    </div>
                </div>
                <form id="formApp" name="formApp">
                    <input type="hidden" id="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="module">Module:</label>
                            <select id="module" name="module" class="form-control"></select>
                        </div>
                        <div class="form-group">
                            <label for="route">Route:</label>
                            <input type="text" id="route" name="route" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="caption">Caption:</label>
                            <input type="text" id="caption" name="caption" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="alias">Alias:</label>
                            <input type="text" id="alias" name="alias" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnSaveApp" class="btn btn-info"><i class="fa fa-upload"></i>&nbsp;Save</button>
                        <button type="button" id="btnCancelApp" class="btn btn-danger" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i>&nbsp;Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- DataTable -->
    <script src="<?= base_url('plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/dataTables.buttons.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/jszip/jszip.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/pdfmake/pdfmake.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/pdfmake/vfs_fonts.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.html5.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.print.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.colVis.min.js'); ?>"></script>

    <!-- Jquery validation -->
    <script src="<?= base_url('plugins/jquery-validation/jquery.validate.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/jquery-validation/additional-methods.min.js'); ?>"></script>    

    <!-- Sweetalert2 -->
    <script src="<?= base_url('plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>

    <script>
        const Toast = Swal.mixin({
            toast: false,
            position: 'center',
            showConfirmButton: true,
        });
        var childTable;
        var rowData;    
        $.fn.dataTable.ext.errMode = 'none';

        const tableApp = $('#tableApp').on('error.dt', function(e, settings,techNote, message){
            console.log(message);
            window.open('<?= base_url("auth/getAuth"); ?>', '_self')
        }).DataTable({
            ajax:{
                type: 'GET',
                url: '<?= base_url("MasterData/daftarMenu"); ?>',
                dataType: 'json'
            },
            columns: [
                {
                    className: 'details-control',
                    data: null,
                    defaultContent: ''
                },
                {data: 'id'},
                {data: 'module'},
                {data: 'icon'},
            ],
            columnDefs: [
                {
                    targets: [1],
                    visible: false
                },
            ]
        });

        $('#tableApp tbody').on('click', 'td.details-control', function(){
            let tr = $(this).closest('tr');
            let row = tableApp.row(tr);
            rowData = row.data();

            console.log('rowData: ', rowData);

            if(row.child.isShown()){
                row.child.hide();
                tr.removeClass('shown');
                $('#cT' + rowData.clientID).DataTable().destroy();
            }else{
                row.child(format(rowData)).show();
                let id = rowData.id;

                childTable = $(`#cT${id}`). DataTable({
                    "dom": 'lrfBtip',
                    "buttons": [
                        {
                            text: 'Add New App',
                            action: function(e, dt, node, config){
                                $('#theRibbon1').text('Add New');
                                clearAppControls();
                                $('#module').append($('<option>', {
                                    value: rowData.id,
                                    text: rowData.module
                                }));
                                $('#route').val($('#module').text() + "/");
                                // $('#module').val(rowData.id);
                                // $('#module').text(rowData.module);

                                $('#modalApp').modal('show');                        
                            }
                        }
                    ],
                    ajax: {
                        type: 'GET',
                        url: '<?= base_url("MasterData/aplikasi/detailApp"); ?>/' + rowData.id,
                        dataType: 'json'
                    },
                    columns: [
                        {data: 'id'},
                        {data: 'route'},
                        {data: 'caption'},
                        {data: 'alias'},
                        {data: null},
                    ],
                    columnDefs: [
                        {
                            targets: [0],
                            visible: false
                        },
                        {
                            targets: [4],
                            render: function(data, type, row, meta){
                                return `<button class="btn btn-info btn-sm btnEditApp"><i class="fas fa-edit"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm btnDeleteApp"><i class="fas fa-Trash"></i> Hapus</button>`;
                            }
                        }                        
                    ]
                });
                tr.addClass('shown');
            }
        });

        $('#tableApp tbody').on('click', 'button.btnEditMenu', function(){
            let selectedRow = tableApp.row($(this).parents('tr')).data();

            $('#menu').val(selectedRow.module);
            $('#alias').val(selectedRow.alias);
            $('#icon').val(selectedRow.icon);
            $('#theRibbon').text('Edit');
            $('#modalMenu').modal('show');
        })

        function format(rD){
            var childTable = `<table class="table table-striped table-bordered no-wrap" id="cT${rD.id}" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Route</th>
                                        <th>Caption</th>
                                        <th>Alias</th>
                                        <th></th>
                                    </tr>
                                </thead>
                             </table>`;
            return $(childTable).toArray();
        }

        function clearAppControls(){
            $('#id').val('');
            $('#module').empty();
            $('#route').val('');
            $('#caption').val('');
            $('#alias').val('');
        }

        $('form[id="formApp"]').validate({
            rules: {
                route: {
                    'required': true
                },
                caption: {
                    'required': true
                },
                alias: {
                    'required': true
                }
            },
            errorClass: 'error fail-alert',
            validClass: 'valid success-alert',
            messages: {
                route: {
                    required: 'Route harus diisi!'
                },
                caption: {
                    required: 'Caption harus diisi!'
                },
                alias: {
                    required: 'Alias harus diisi!'
                },
            },
            submitHandler: function(form, e) {
                e.preventDefault();

                let data = $(form).serialize();

                const url = $('#theRibbon1').text() == 'Add New' ? '<?= base_url("MasterData/aplikasi/create"); ?>' : '<?= base_url("MasterData/aplikasi/update"); ?>/' + $('#id').val();
                const method = $('#theRibbon1').text() == 'Add New' ? 'POST' : 'PUT';

                $.ajax({
                    type: method,
                    url: url,
                    data: data,
                    dataType: 'json'
                }).done(function(returnData) {
                    console.log('returnData: ', returnData);
                    if(returnData.status == 400){
                        Toast.fire({
                            icon: 'warning',
                            title: returnData.message
                        });
                    }else{
                        Toast.fire({
                            icon: 'success',
                            title: 'Data App berhasil disimpan.',
                            didClose: () => {
                                $('#bagian').focus();
                                $('#theRibbon').text() == 'Edit' ? $('#modalApp').modal('hide') : clearAppControls();
                                loadTable();
                            }
                        });                            
                    }
                })
            }            
        });

        function loadData(){
            tableApp.ajax.reload();
        }

        function clearAppControls(){
            $('#module').val('');
            $('#route').val('');
            $('#caption').val('');
            $('#alias').val('');
        }

    </script>
<?= $this->endSection(); ?>