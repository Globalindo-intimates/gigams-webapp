<?= $this->extend('layouts/page_layout'); ?>
<?= $this->section('content'); ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">

        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="<?= base_url('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">

    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-8">
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
                        <table id="tableMenu" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Menu</th>
                                    <th>Alias</th>
                                    <th>Icon</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Menu</th>
                                    <th>Alias</th>
                                    <th>Icon</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalMenu" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content bg-success">
                <div class="modal-header">
                    <h4 class="modal-title">Data Menu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times</span>
                    </button>
                    <div class="ribbon-wrapper">
                        <div class="ribbon bg-warning" id="theRibbon">
                        </div>
                    </div>
                </div>
                <form id="formMenu" name="formMenu">
                    <input type="hidden" id="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="menu">Menu:</label>
                            <input type="text" id="module" name="module" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="menu">Alias:</label>
                            <input type="text" id="alias" name="alias" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="menu">Icon:</label>
                            <input type="text" id="icon" name="icon" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnSaveMenu" class="btn btn-info"><i class="fa fa-upload"></i>&nbsp;Save</button>
                        <button type="button" id="btnCancelMenu" class="btn btn-danger" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i>&nbsp;Cancel</button>
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
        $.fn.dataTable.ext.errMode = 'none';

        const tableMenu = $('#tableMenu').on('error.dt', function(e, settings,techNote, message){
            console.log(message);
            window.open('<?= base_url("auth/getAuth"); ?>', '_self')
        }).DataTable({
            // "dom": 'rf<"toolbar">tip',
            // dom: 'flrB<"toolbar">tip',
            "dom": 'lrfBtip',
            "buttons": [
                {
                    text: 'Add New',
                    action: function(e, dt, node, config){
                        $('#theRibbon').text('Add New');
                        clearControls();
                        $('#modalMenu').modal('show');                        
                    }
                }
            ],
            "paging": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true, 
            "ajax": {
                url: '<?= base_url("MasterData/daftarMenu") ;?>',
                type: 'GET',
                dataType: 'json',
            },
            "columns": [
                {'data': 'id'},
                {'data': 'module'},
                {'data': 'alias'},
                {'data': 'icon'},
                {'data': null},
            ],
            "columnDefs": [
                {
                    "targets": [0],
                    "visible": false
                },
                {
                    "targets": [4],
                    "render": function(data, type, row, meta) {
							return '<button class="btn btn-success btn-sm mx-1 btnEditMenu"><i class="fas fa-edit"></i>Edit</button>' +
								'<button class="btn btn-danger btn-sm mx-1 btnDeleteMenu"><i class="fas fa-trash"></i>Delete</button>';  
                    }                  
                }
            ],

        });

        $('div.toolbar').html('<button id="btnAddNewMenu" class="btn btn-warning btn-sm"><i class="fas fa-plus"></i>Add New</button>');

        $('#tableMenu tbody').on('click', 'button.btnEditMenu', function() {
            let selectedRow = tableMenu.row($(this).parents('tr')).data();
            console.log('selectedRow: ', selectedRow);
            $('#id').val(selectedRow.id);
            $('#module').val(selectedRow.module);
            $('#alias').val(selectedRow.alias);
            $('#icon').val(selectedRow.icon);
            $('#theRibbon').text('Edit');
            $('#modalMenu').modal('show');
		});

        $('#tableMenu tbody').on('click', 'button.btnDeleteMenu', function() {
            let selectedRow = tableMenu.row($(this).parents('tr')).data();

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
                $.ajax({
                    type: 'DELETE',
                    url: '<?= base_url("MasterData/menu/delete"); ?>/' + selectedRow.id,
                    dataType: 'json'
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
		});        
        
        $('form[id="formMenu"]').validate({
            rules: {
                module: {
                    'required': true
                },
                alias: {
                    'required': true
                },
                icon: {
                    'required': true
                },
            },
            errorClass: 'error fail-alert',
            validClass: 'valid success-alert',
            messages: {
                module: {
                    required: 'Menu harus diisi!'
                },
                alias: {
                    required: 'Alias harus diisi!'
                },
                icon: {
                    required: 'Icon harus diisi!'
                },
            },
            submitHandler: function(form, e) {
                e.preventDefault();

                let data = $(form).serialize();

                const url = $('#theRibbon').text() == 'Add New' ? '<?= base_url("MasterData/menu/create"); ?>' : '<?= base_url("MasterData/menu/update"); ?>/' + $('#id').val();
                const method = $('#theRibbon').text() == 'Add New' ? 'POST' : 'PUT';

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
                            title: 'Data Menu berhasil disimpan.',
                            didClose: () => {
                                $('#module').focus();
                                $('#theRibbon').text() == 'Edit' ? $('#modalMenu').modal('hide') : clearControls();
                                loadTable();
                            }
                        });                            
                    }
                })
            }
        });

        $('#module').blur(function(){
            let moduleVal = $(this).val().toString();
            let newVal = moduleVal.replace(" ","");
            $('#module').val(newVal);
        })
        
        function loadTable(){
            tableMenu.ajax.reload();
        }

        function clearControls(){
            $('#id').val('');
            $('#module').val('');
            $('#alias').val('');
            $('#icon').val('');
        }
    </script>
<?= $this->endSection(); ?>