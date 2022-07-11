<?= $this->extend('layouts/page_layout'); ?>
<?= $this->section('content'); ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-select/css/select.bootstrap4.min.css'); ?>">
    <!-- <link rel="stylesheet" href="<//?= base_url('plugins/jquery-datatables-checkboxes/css/dataTables.checkboxes.css'); ?>"> -->

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
            <div class="col-md-8">
                <div class="card card-info shadow">
                    <div class="card-header">
                        <h3 class="card-title">Data Master Role</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered" id="tableRole">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Bagian</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Bagian</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalRole" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-Info">
                <div class="modal-header">
                    <h4 class="modal-title">Data Module Role</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times</span>
                    </button>
                    <div class="ribbon-wrapper">
                        <div class="ribbon bg-warning" id="theRibbon1">
                        </div>
                    </div>
                </div>
                <form id="formRole" name="formRole">
                    <input type="hidden" id="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="module">Module:</label>
                            <select id="module" name="module" class="form-control"></select>
                        </div>
                        <table class="table table-bordered table-striped" id="tableAppDetail">
                            <thead>
                                <tr>
                                    <!-- <th></th> -->
                                    <th>ID</th>
                                    <th>Route</th>
                                    <th>Caption</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <!-- <th></th> -->
                                    <th>ID</th>
                                    <th>Route</th>
                                    <th>Caption</th>
                                </tr>                                
                            </tfoot>
                        </table>
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
    <script src="<?= base_url('plugins/datatables-select/js/dataTables.select.min.js'); ?>"></script>
    <!-- <script src="<//?= base_url('plugins/jquery-datatables-checkboxes/js/dataTables.checkboxes.min.js'); ?>"></script> -->

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
        var tableAppDetail;
        // $.fn.dataTable.ext.errMode = 'none';
        // .on('error.dt', function(e, settings,techNote, message){
        //     window.open('<?= base_url("auth/getAuth"); ?>', '_self')
        // })

        const tableRole = $('#tableRole').DataTable({
            ajax:{
                type: 'GET',
                url: '<?= base_url("MasterData/daftarBagian"); ?>',
                dataType: 'json'
            },
            columns: [
                {
                    className: 'details-control',
                    data: null,
                    defaultContent: ''
                },
                {data: 'id'},
                {data: 'bagian'},
            ],
            columnDefs: [
                {
                    targets: [1],
                    visible: false
                },
            ]
        });

        $('#tableRole tbody').on('click', 'td.details-control', function(){
            let tr = $(this).closest('tr');
            let row = tableRole.row(tr);
            rowData = row.data();

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
                            text: 'Add New Role',
                            action: function(e, dt, node, config){
                                $('#theRibbon1').text('Add New');
                                clearRoleControls();
                                $('#module').append($('<option>', {
                                    value: "",
                                    text: "--Pilih Module--"
                                }));
                                $.ajax({
                                    type: 'GET',
                                    url: '<?= base_url("MasterData/daftarMenu"); ?>',
                                    dataType: 'json'
                                }).done(function(retData){
                                    console.log('retData: ', retData);
                                    $.each(retData.data, function(i, item){
                                        $('#module').append($('<option>', {
                                            value: item.id,
                                            text: item.module
                                        }));                                        
                                    })                                    
                                })
                                $('#modalRole').modal('show');                        
                            }
                        }
                    ],
                    ajax: {
                        type: 'GET',
                        url: '<?= base_url("MasterData/role/getRole"); ?>/' + rowData.id,
                        dataType: 'json'
                    },
                    columns: [
                        {data: 'id'},
                        {data: 'module'},
                        {data: 'route'},
                        {data: 'caption'},
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
                                return `<button class="btn btn-danger btn-sm btnDeleteRole"><i class="fas fa-Trash"></i> Hapus</button>`;
                            }
                        }                        
                    ]
                });
                tr.addClass('shown');
            }
        });

        $('#tableRole tbody').on('click', 'button.btnDeleteRole', function(){
            let selectedRow = childTable.row($(this).parents('tr')).data();
            console.log('selectedRow: ', selectedRow);
            console.log(rowData.id);

            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Yakin akan menghapus?',
                text: "Data yang sudah dihapus tidak bisa dikembalikan lagi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus saja!',
                cancelButtonText: 'Tidak, batalkan!',
                reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                let deleteParams = {
                    'id_bagian': rowData.id,
                    'id_module_detail': selectedRow.id
                };

                $.ajax({
                    type: 'POST',
                    url: '<?= base_url("MasterData/role/delete"); ?>',
                    data: {data: deleteParams},
                    dataType: 'json',
                }).done(function(dtReturn){
                    if(dtReturn.status == 200){
                        swalWithBootstrapButtons.fire(
                            'sudah dihapus!',
                            'Data sudah dihapus.',
                            'success'
                        );
                        loadTable();
                    }
                })
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ){
                swalWithBootstrapButtons.fire(
                    'Dibatalkan',
                    'Data tidak jadi dihapus :)',
                    'error'
                )
            }
            })            
        })

        function format(rD){
            var childTable = `<table class="table table-striped table-bordered no-wrap" id="cT${rD.id}" width="100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Module</th>
                                        <th>Route</th>
                                        <th>Caption</th>
                                        <th></th>
                                    </tr>
                                </thead>
                             </table>`;
            return $(childTable).toArray();
        }

        function clearRoleControls(){
            $('#id').val('');
            $('#tableAppDetail').empty();
            $('#module').empty('');
        }

        $('form[id="formRole"]').validate({
            rules: {
                module: {
                    'required': true
                },
            },
            errorClass: 'error fail-alert',
            validClass: 'valid success-alert',
            messages: {
                route: {
                    required: 'Route harus diisi!'
                },
            },
            submitHandler: function(form, e) {
                e.preventDefault();

                let selectedRows = tableAppDetail.rows('.selected').data();
                let rowsData = [];
                $.each(selectedRows, function(i, item){
                    rowsData.push(
                        {
                            'id_bagian': rowData.id,
                            'id_module_detail': item.id
                        }
                    )
                });
                const url = '<?= base_url("MasterData/role/create"); ?>';

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {data: rowsData},
                    dataType: 'json'
                }).done(function(returnData) {
                    console.log('returnData: ', returnData);
                    if(returnData > 0){
                        Toast.fire({
                            icon: 'success',
                            title: 'Data Role berhasil disimpan.',
                            didClose: () => {
                                loadTable();
                            }
                        });                        
                    }
                })
            }            
        });

        $('#module').change(function(){
            let idModule = $(this).val();

            tableAppDetail = $('#tableAppDetail').DataTable({
                destroy: true,
                ajax:{
                    type: 'GET',
                    url: '<?= base_url("MasterData/role/getAppDetail"); ?>/' + idModule,
                    dataType: 'json'
                },
                columns: [
                    // {data: null},
                    {data: 'id'},
                    {data: 'route'},
                    {data: 'caption'},
                ],
                columnDefs: [
                    {
                        targets: [0],
                        visible: false,
                    },  
                ],
                select: {
                    style: 'multi',
                }
            });
        });

        function loadTable(){
            tableRole.ajax.reload();
        }

    </script>
<?= $this->endSection(); ?>