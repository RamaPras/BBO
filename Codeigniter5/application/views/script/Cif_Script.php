<script>
    $(document).ready(function(){
       //datatables 
    var table = $('#mytable').DataTable({ 
        "oLanguage": {
                        "sProcessing": '<i class="fa fa-spinner fa-spin fa-10x text-info"></i><span class="sr-only">Loading...</span>'
                    },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "sDom": "lfrti",  //menghilangkan paging
        "searching" :false,
        // Load data for the table's content from an Ajax source
        "ajax": {
                "url": "<?php echo site_url('Cif/ajax_list')?>",
                "type": "POST",
                "data": function ( data ) {
                debugger;
                data.CIF = $('#filnocif').val();
                data.CUSTOMER_NAME = $('#filnama').val();
                }
            },

            //Set column definition initialisation properties.
            "columnDefs": [ 
                { 
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not orderable
                },
            ],
        });

        $('#btn-search').click(function(){ //button filter event click
            debugger;
            table.ajax.reload();  //just reload table
        });
        
        $('#btn-reset').click(function(){ //button reset event click
        debugger;
            $('#form-search')[0].reset();
            table.ajax.reload();  //just reload table
        });
                $('#mytable').on('click','.edit_record',function(){
                    debugger;
                        var nocif=$(this).data('nocif');
                        var tgl=$(this).data('tgl');
                        submit(nocif,tgl);
                });
                $('#mytable').on('click','.delete_record',function(){
                    debugger;
                        var nocif=$(this).data('nocif');
                        var tgl=$(this).data('tgl');
                        deleteConfirm(nocif, tgl);
                });
        $('#customername').change(function(){ 
                debugger;
                var cid=$(this).val(); 
                $.ajax({
                    url : '<?php echo base_url()?>Cif/getDataCID',
                    type : "POST",
                    data : {cid: cid},
                    cache: false,
                    dataType : 'json',
                    success: function(data){
                        debugger;
                        $.each(data,function(cid, grup, flag, segmen,DIVISI){
                            if (data.flag == 0){
                            flag = "Tidak";
                        } else {
                            flag = "Ya";
                        }
                            $('#grup').val(data.grup);
                            $('#flag').val(flag);
                            $('#segmen').val(data.segmen);
                            $('#divisi').val(data.DIVISI);
                        });
                    }
                });
                return false;
            }); 
    });   
        function tampil_data(){
            debugger;
            $.ajax({
                type  : 'POST',
                url   : '<?php echo base_url()?>Cif/data_list',
                async : false,
                dataType : 'json',
                success : function(data){
                    debugger;
                    var html = '';
                    var i=1;
                    $.each(data, function (index, val){
                        html += '<tr>';
					html += '<td style="text-align:center">' + i + '</td>';
					html += '<td>' +val.NO_CIF+ '</td>';
					html += '<td>' +val.CUSTOMER_NAME+ '</td>';
					html += '<td>' +val.grup+ '</td>';
					html += '<td>' +val.DIVISI+ '</td>';
                    html += '<td>' +val.RM_NAME+ '</td>';
					html += '<td  style="text-align:center">';
					html += ' <a href="#formcif" data-toggle="modal" class="btn btn-green btn-sm" onclick="submit(\''+val.NO_CIF+'\',\''+val.tgl_mulai+'\')"><i class="fas fa-edit"></i> </a> ';
					html += ' <a href="javascript:void(0);" class="btn btn-orange btn-sm" onclick="deleteConfirm(\''+val.NO_CIF+'\',\''+val.tgl_mulai+'\')"><i class="fas fa-trash"></i></a></td>';
					html += '</tr>';
					i++;
                    });
                    $('#show_data').html(html);
                }
 
            });
        }
    function ResetTable(){
        $('#mytable').DataTable().destroy();
        //datatables
        var table = $('#mytable').DataTable({ 
        "oLanguage": {
                        "sProcessing": '<i class="fa fa-spinner fa-spin fa-10x text-info"></i><span class="sr-only">Loading...</span>'
                    },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "sDom": "lfrti", // menghilangkan paging
        "searching" :false,
        // Load data for the table's content from an Ajax source
        "ajax": {
                "url": "<?php echo site_url('Cif/ajax_list')?>",
                "type": "POST",
                "data": function ( data ) {
                debugger;
                data.CIF = $('#filnocif').val();
                data.grup = $('#filgrup').val();
                }
            },

            //Set column definition initialisation properties.
            "columnDefs": [ 
                { 
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not orderable
                },
            ],
        });

    }

    function ValidateNoCIF(nocif){
	var nocifReg = /^[0-9]{10,10}$/i;
	return nocifReg.test(nocif);
    }

    function ValidateInsert() {
        debugger;
	if ($('#no_cif').val() == 0) {
		    Swal.fire('Error', 'Anda Belum Input No CIF', 'error');
        } else if (!ValidateNoCIF($('#no_cif').val())) {
		    Swal.fire('Error', 'Format No CIF Salah (10 Digit Angka)', 'error');
	    } else if ($('#customername').val() == null) {
		    Swal.fire('Error', 'Pilih Customer Name', 'error');
	    } else if ($('#tgl_mulai').val() == 0) {
		    Swal.fire('Error', 'Input Tanggal Masuk', 'error');
	    } else {
		    Save();
	    }
    }
    function ValidateUpdate() {
        debugger;
	if ($('#no_cif').val() == 0) {
		    Swal.fire('Error', 'Anda Belum Input No CIF', 'error');
        } else if (!ValidateNoCIF($('#no_cif').val())) {
		    Swal.fire('Error', 'Input No CIF Menggunakan Angka', 'error');
	    } else if ($('#customername').val() == 0) {
		    Swal.fire('Error', 'Pilih Customer Name', 'error');
	    } else if ($('#tgl_mulai').val() == 0) {
		    Swal.fire('Error', 'Input Tanggal Masuk', 'error');
	    } else if ($('#tgl_akhir').val() == 0) {
		    Swal.fire('Error', 'input Tanggal Keluar', 'error');
	    } else {
		    Edit();
	    }
    }
    function Clearscreen(){
        $('#no_cif').val('');
	    $('#customername').val(0);
	    $('#grup').val('');
        $('#flag').val('');
        $('#segmen').val('');
	    $('#divisi').val('');
	    $('#tgl_mulai').val('');
	    $('#tgl_akhir').val('');
    }
    
    function submit(x,y){
        debugger;
        if (x == 'add'){
            Clearscreen();
            $('#tgl_akh').hide(); 
            $('#add').show();
            $('#edit').hide();
        } else {
            $('#add').hide();
            $('#edit').show();
            $('#tgl_akh').show();
            $.ajax({
                type : "POST",
                url : "<?php echo site_url()?>/Cif/getbyId",
                dataType : "JSON",
                data : { x: x, y: y },
                success : function(data){
                    debugger;
                    if (data.flag == 0){
                            flag = "Tidak";
                        } else {
                            flag = "Ya";
                        }
                    $('#HeaderForm').text(" Edit Data");
                    $('#id').val(data.NO_CIF);
                    $('#no_cif').val(data.NO_CIF);
	                $('#customername').val(data.CUSTOMER_ID);
	                $('#grup').val(data.grup);
                    $('#flag').val(flag);
                    $('#segmen').val(data.segmen);
	                $('#divisi').val(data.DIVISI);
	                $('#tgl_mulai').val(data.tgl_mulai.substr(0,10));
                    $('#tgl').val(data.tgl_mulai);
	                $('#tgl_akhir').val(data.tgl_akhir.substr(0,10));
                } 
            });    
        }
    }

    var Customers = [];
    function loadCustomer(element){
        debugger;
        if(Customers.length == 0) { 
            $.ajax({
                type: "GET",
			    url: "<?php echo site_url()?>/Cif/getCustomer",
                dataType: "json",
			success: function (data) {
				debugger;
				Customers = data;
				renderCustomer(element);
			}
            })
        } else {
            renderCustomer(element);
        }
    }
    function renderCustomer(element){
        var $ele = $(element);
        $ele.empty();
	    $ele.append($('<option/>').val('0').text('Pilih Nama Inisial'));
	    $.each(Customers, function (i, val) {
            if (val.tgl_akhir.substr(0,10) == '9999-12-31'){
		$ele.append($('<option/>').val(val.cid).text(val.CUSTOMER_NAME));
            }
	})
    }
    loadCustomer($('#customername'));

    function Search(){
        var no_cif = $('#filnocif').val();
		var cid = $('#filgrup').val();
        $.ajax({ 
                type : "POST",
                url  : "<?php echo site_url()?>/Cif/Search",
                dataType : "JSON",
                data : {no_cif:no_cif , cid:cid},
                success: function(data){
                    debugger;
                    Swal.fire({ position: 'center', type: 'success',title: 'Insert Successfully'});

                        
                }
        });
    }
	function Save(){
        debugger;
		var no_cif = $('#no_cif').val();
		var cid = $('#customername').val();
		var tgl_mulai = $('#tgl_mulai').val();
		$.ajax({
                type : "POST",
                url  : "<?php echo site_url()?>/Cif/save",
                dataType : "JSON",
                data : {no_cif:no_cif , cid:cid, tgl_mulai:tgl_mulai},
                success: function(data){
                    debugger;
                    Swal.fire({ position: 'center', type: 'success',title: 'Insert Successfully'});
                    Clearscreen();
                    setTimeout(function(){ 
                        $("#formcif").modal('hide');
                        }, 5000);
                    ResetTable();
                        
                }
            });
            return false;
    }
    function Edit(){
        var id = $('#id').val();
        var tgl = $('#tgl').val();
		var no_cif = $('#no_cif').val();
		var cid = $('#customername').val();
		var tgl_mulai = $('#tgl_mulai').val();
		var tgl_akhir = $('#tgl_akhir').val();
		$.ajax({
                type : "POST",
                url  : "<?php echo site_url()?>/Cif/edit",
                dataType : "JSON",
                data : {id:id, tgl:tgl ,no_cif:no_cif, cid:cid, tgl_mulai:tgl_mulai, tgl_akhir:tgl_akhir},
                success: function(data){
                    Swal.fire({ position: 'center', type: 'success',title: 'Update Successfully'});
                    setTimeout(function(){ 
                        $("#formcif").modal('hide');
                        }, 5000);
                    ResetTable();
                }
            });
            return false;
    }
    function deleteConfirm(id, tgl){
		Swal.fire({
				title: 'Konfirmasi',
                text: "Anda ingin menghapus ",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Tidak',
                reverseButtons: true
	}).then((result) => {
		if (result.value) {
			$.ajax({
				    url:"<?php echo site_url()?>/Cif/delete",  
                    method:"post",    
                    data:{id :id, tgl :tgl},
                    success:function(){
						debugger;
                        Swal.fire({ position: 'center', type: 'success',title: 'Delete Succesfully'});
                      ResetTable(); 
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        Swal.fire({ position: 'center', type: 'error',title: 'Delete Error'});
                }
                  });
		}
	})
    }
 
</script>