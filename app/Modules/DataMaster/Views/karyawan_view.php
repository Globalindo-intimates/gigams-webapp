<?= $this->extend('layouts\page_layout'); ?>
<?= $this->section('content'); ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">

        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="<?= base_url('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">

    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-10">
                <div class="card card-info shadow">
                    <div class="card-header">
                        <h3 class="card-title">Data Master Karyawan</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tableKaryawan" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Bagian</th>
                                    <th>NIK</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Shift</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Bagian</th>
                                    <th>NIK</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Shift</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalKaryawan" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content bg-success">
                <div class="modal-header">
                    <h4 class="modal-title">Data Karyawan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times</span>
                    </button>
                    <div class="ribbon-wrapper">
                        <div class="ribbon bg-warning" id="theRibbon">
                        </div>
                    </div>
                </div>
                <form id="formKaryawan" name="formKaryawan">
                    <input type="hidden" id="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-form-label">
                                <label class="col-form-label">Bagian:</label>
                                <select id="id_bagian" name="id_bagian" class="form-control form-control-sm"></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-form-label">
                                <label class="col-form-label">NIK:</label>
                                <input type="text" id="nik" name="nik" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-form-label">
                                <label class="col-form-label">Nama Lengkap:</label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-form-label">
                                <label class="col-form-label">Jenis Kelamin:</label>
                                <select id="jenis_kelamin" name="jenis_kelamin" class="form-control form-control-sm">
                                    <option value="">--Pilih jenis kelamin--</option>
                                    <option value="0">Laki-laki</option>
                                    <option value="1">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-form-label">
                                <label class="col-form-label">Shift:</label>
                                <div class="col-sm-6 p-1">
                                    <select id="shift" name="shift" class="form-control form-control-sm">
                                        <option value="Non Shift"></option>
                                        <option value="Shift 1">Shift 1</option>
                                        <option value="Shift 2">Shift 2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnSaveKaryawan" class="btn btn-info"><i class="fa fa-upload"></i>&nbsp;Save</button>
                        <button type="button" id="btnCancelKaryawan" class="btn btn-danger" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i>&nbsp;Cancel</button>
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

        const dataBagian = () => {
            $.ajax({
                type: 'GET',
                url: '<?= base_url("MasterData/daftarBagian"); ?>',
                dataType: 'json'    
            }).done(function(dtBagian){
                console.log('dtBagian: ', dtBagian);
                if(dtBagian){
                    $('#id_bagian').append($('<option>', {
                        value: "",
                        text: "--Pilih Bagian--"
                    }));
                    $.each(dtBagian.data, function(i, item){
                        $('#id_bagian').append($('<option>', {
                            value: item.id,
                            text: item.bagian
                        }))
                    })
                }
            })
        }
        dataBagian();

        const tableKaryawan = $('#tableKaryawan').on('error.dt', function(e, settings,techNote, message){
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
                        $('#modalKaryawan').modal('show');                        
                    }
                }
            ],
            "paging": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true, 
            "ajax": {
                url: '<?= base_url("MasterData/daftarKaryawan") ;?>',
                type: 'GET',
                dataType: 'json',
            },
            "columns": [
                {'data': 'id'},
                {'data': 'bagian'},
                {'data': 'nik'},
                {'data': 'nama_lengkap'},
                {'data': 'jenis_kelamin'},
                {'data': 'shift'},
                {'data': null},
            ],
            "columnDefs": [
                {
                    "targets": [0],
                    "visible": false
                },
                {
                    "targets": [4],
                    "render": function(data, type, row, meta){
                        return (data == 0 ? "Laki-laki" : "Perempuan")
                    }
                },
                {
                    "targets": [6],
                    "render": function(data, type, row, meta) {
							return '<button class="btn btn-success btn-sm mx-1 btnEditKaryawan"><i class="fas fa-edit"></i>Edit</button>' +
								'<button class="btn btn-danger btn-sm mx-1 btnDeleteKaryawan"><i class="fas fa-trash"></i>Delete</button>';  
                    }                  
                }
            ],

        });

        $('div.toolbar').html('<button id="btnAddNewKaryawan" class="btn btn-warning btn-sm"><i class="fas fa-plus"></i>Add New</button>');

        $('#tableKaryawan tbody').on('click', 'button.btnEditKaryawan', function() {
            let selectedRow = tableKaryawan.row($(this).parents('tr')).data();
            console.log('selectedRow: ', selectedRow);
            $('#id').val(selectedRow.id);
            $('#id_bagian').val(selectedRow.idBagian);
            $('#nik').val(selectedRow.nik);
            $('#nama_lengkap').val(selectedRow.nama_lengkap);
            $('#jenis_kelamin').val(selectedRow.jenis_kelamin);
            $('#shift').val(selectedRow.shift);
            $('#theRibbon').text('Edit');
            $('#modalKaryawan').modal('show');
		});

        $('#tableKaryawan tbody').on('click', 'button.btnDeleteKaryawan', function() {
            let selectedRow = tableKaryawan.row($(this).parents('tr')).data();

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
                    url: '<?= base_url("MasterData/karyawan/delete"); ?>/' + selectedRow.id,
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
        
        $('form[id="formKaryawan"]').validate({
            rules: {
                id_bagian: {
                    'required': true
                },
                nik: {
                    'required': true
                },
                nama_lengkap: {
                    'required': true
                },
                jenis_kelamin: {
                    'required': true
                },
                shift: {
                    'required': true
                },
            },
            errorClass: 'error fail-alert',
            validClass: 'valid success-alert',
            messages: {
                id_bagian: {
                    required: 'Bagian harus diisi!'
                },
                nik: {
                    required: 'NIK harus diisi!'
                },
                nama_lengkap: {
                    required: 'Nama lengkap harus diisi!'
                },
                jenis_kelamin: {
                    required: 'Jenis kelamin harus diisi!'
                },
                shift: {
                    required: 'shift harus diisi!'
                },
            },
            submitHandler: function(form, e) {
                e.preventDefault();

                let data = $(form).serialize();

                const url = $('#theRibbon').text() == 'Add New' ? '<?= base_url("MasterData/karyawan/create"); ?>' : '<?= base_url("MasterData/karyawan/update"); ?>/' + $('#id').val();
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
                            title: 'Data Karyawan berhasil disimpan.',
                            didClose: () => {
                                $('#bagian').focus();
                                $('#theRibbon').text() == 'Edit' ? $('#modalKaryawan').modal('hide') : clearControls();
                                loadTable();
                            }
                        });                            
                    }
                })
            }
        });
        
        function loadTable(){
            tableKaryawan.ajax.reload();
        }

        function clearControls(){
            $('#id').val('');
            $('#id_bagian').val('');
            $('#nik').val('');
            $('#nama_lengkap').val('');
            $('#jenis_kelamin').val('');
            $('#shift').val('');
        }
    </script>
<?= $this->endSection(); ?>