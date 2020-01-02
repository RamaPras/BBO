<script>
    $(document).ready(function(){
        
        $('#myUnit').DataTable({
            "bprocessing": true, 
            "bserverSide": true,
            "bJQueryUI":true,
            "bSort":false,
            "sDom": "lfrti",
            "iDisplayLength": 10,
            "ajax": tampil_data(),
            "orderMulti": false
        });   
});   
        function tampil_data(){
            debugger;
            $.ajax({
                type  : 'POST',
                url   : '<?php echo base_url()?>Unit/data_list',
                async : false,
                dataType : 'json',
                success : function(data){
                    debugger;
                    var html = '';
                    var i=1;
                    $.each(data, function (index, val){
                        html += '<tr>';
					html += '<td style="text-align:center">' + i + '</td>';
					html += '<td>' +val.INITIAL_RM+ '</td>';
					html += '<td>' +val.RM_NAME+ '</td>';
					html += '<td>' +val.DIVISI+ '</td>';
                    html += '<td>' +val.tgl_mulai.substr(0,10)+ '</td>';
                    html += '<td>' +val.tgl_akhir.substr(0,10)+ '</td>';
					html += '<td  style="text-align:center">';
					html += ' <a href="#formunit" data-toggle="modal" class="btn btn-green btn-sm" onclick="submit(\''+val.INITIAL_RM+'\',\''+val.tgl_mulai+'\')"><i class="fas fa-edit"></i> Edit</a>';
					html += ' <a href="javascript:void(0);" class="btn btn-orange btn-sm" onclick="deleteConfirm(\''+val.INITIAL_RM+'\',\''+val.tgl_mulai+'\')"><i class="fas fa-trash"></i> Delete</a></td>';
					html += '</tr>';
					i++;
                    });
                    $('#show_data').html(html);
                }
 
            });
        }
    function ResetTable(){
        $('#myUnit').DataTable().destroy();
        $('#myUnit').DataTable({
            "bprocessing": true,
            "bserverSide": true,
            "bJQueryUI":true,
            "bSort":false,
            "sDom": "lfrti",
            "sPaginationType":"full_numbers",
            "iDisplayLength": 10,
            "ajax": tampil_data(),
            "orderMulti": false});  
    }
    function ValidateNPP(npp){
	var nppReg = /^[0-9]{5,5}$/i;
	return nppReg.test(npp);
    }
    function ValidateRM(){
        if ($('#norm').val() == 0) {
		    Swal.fire('Error', 'Anda Belum Input NPP', 'error');
        } else if (!ValidateNPP($('#norm').val())) {
		    Swal.fire('Error', 'Format NPP Salah (5 Digit Angka)', 'error');
        } else if($('#namarmbaru').val() == '') {
		    Swal.fire('Error', 'Anda Belum Input Nama RM', 'error');
        } else {
            ValidNPP();
        }
    }
    function ValidateInsert() {
        debugger;
        if ($('#npprm').val() == 0) {
		    Swal.fire('Error', 'Anda Belum Memilih Nama RM', 'error');
        } else if ($('#divisi').val() == 0) {
		    Swal.fire('Error', 'Anda Belum Memilih Divisi', 'error');
        } else if ($('#tgl_mulai').val() == 0) {
		    Swal.fire('Error', 'Input Tanggal Masuk', 'error');
	    } else {
            Save();
	    }
    }
    function ValidateUpdate() {
        debugger;
        if ($('#npp').val() == 0) {
		    Swal.fire('Error', 'Anda Belum Input NPP', 'error');
        } else if (!ValidateNPP($('#npp').val())) {
		    Swal.fire('Error', 'Format NPP Salah (5 Digit Angka)', 'error');
        } else if($('#namarm').val() == '') {
		    Swal.fire('Error', 'Anda Belum Input Nama RM', 'error');
        } else if ($('#divisi').val() == 0) {
		    Swal.fire('Error', 'Anda Belum Memilih Divisi', 'error');
        } else if ($('#tgl_mulai').val() == 0) {
		    Swal.fire('Error', 'Input Tanggal Masuk', 'error');
	    } else {
		    Edit();
	    }
    }

    function Clearscreen(){
        $('#npprm').val(0);
        $('#npp').val('');
        $('#namarm').val('');
	    $('#divisi').val(0);
	    $('#tgl_mulai').val('');
	    $('#tgl_akhir').val('');
    }

    function addrm(){
        $("#formunit").modal('hide');
        $('#norm').val('');
        $('#namarmbaru').val('');
    }
    function ValidNPP(){
        var npp = $('#norm').val();
        $.ajax({
                type : "POST",
                url  : "<?php echo site_url()?>/Unit/validrm",
                dataType : "JSON",
                data : {npp:npp},
                success: function(data){
                    debugger;
                    if (data > 0){
                        Swal.fire('Error', 'NPP Telah terdaftar', 'error');
                    } else {
                        Saverm();
                    }
                }
            });
            return false;
    }
    function Saverm(){
        debugger;
		var npp = $('#norm').val();
        var namarm = $('#namarmbaru').val();
		$.ajax({
                type : "POST",
                url  : "<?php echo site_url()?>/Unit/saverm",
                dataType : "JSON",
                data : {npp:npp, namarm:namarm},
                success: function(data){
                    debugger;
                    Swal.fire({ position: 'center', type: 'success',title: 'Insert Successfully'});
                    Clearscreen();
                    ResetTable();
                    setTimeout(function(){ 
                        location.reload(); 
                        }, 1000);
                    
                }
            });
            return false;
    }
    
    function submit(x,y){
        debugger;
        if (x == 'add'){
            Clearscreen();
            $('#info').show();
            $('#addnpp').show();
            $('#nppid').hide();
            $('#nama').hide();
            $('#unit').show();
            $('#tgl_awl').show();
            $('#tgl_akh').hide(); 
            $('#add').show();
            $('#edit').hide();
        } else {
            $('#info').hide();
            $('#addnpp').hide();
            $('#nppid').show();
            $('#nama').show();
            $('#unit').show();
            $('#tgl_awl').show();
            $('#tgl_akh').show(); 
            $('#add').hide();
            $('#edit').show();
            $.ajax({
                type : "POST",
                url : "<?php echo site_url()?>/Unit/getbyId",
                dataType : "JSON",
                data : { npp: x, tgl: y },
                success : function(data){
                    debugger;
                    $('#HeaderForm').text(" Edit Data");
                    $('#id').val(data.INITIAL_RM);
                    $('#npp').val(data.INITIAL_RM);
	                $('#namarm').val(data.RM_NAME);
                    $('#divisi').val(data.KODE_DIVISI);
	                $('#tgl_mulai').val(data.tgl_mulai.substr(0,10));
                    $('#tgl').val(data.tgl_mulai);
	                $('#tgl_akhir').val(data.tgl_akhir.substr(0,10));
                } 
            });    
        }
    }

    var Divisi = [];
    function loadDivisi(element){
        debugger;
        if(Divisi.length == 0) {
            $.ajax({
                type: "GET",
			    url: "<?php echo site_url()?>/Unit/getDivisi",
                dataType: "json",
			success: function (data) {
				debugger;
				Divisi = data;
				renderDivisi(element);
			}
            })
        } else {
            renderDivisi(element);
        }
    }
    function renderDivisi(element){
        var $ele = $(element);
        $ele.empty();
	    $ele.append($('<option/>').val('0').text('Pilih Divisi'));
	    $.each(Divisi, function (i, val) {
            if((val.kode_unit == 1030) || (val.kode_unit == 1040) || (val.kode_unit == 1060)){
		$ele.append($('<option/>').val(val.kode_unit).text(val.nama_unit));
            }
    })
    }
    loadDivisi($('#divisi'));

    var Rm = [];
    function loadRm(element){
        debugger;
        if(Rm.length == 0) {
            $.ajax({
                type: "GET",
			    url: "<?php echo site_url()?>/Unit/getRM",
                dataType: "json",
			success: function (data) {
				debugger;
				Rm = data;
				renderRm(element);
			}
            })
        } else {
            renderRm(element);
        }
    }
    function renderRm(element){
        var $ele = $(element);
        $ele.empty();
	    $ele.append($('<option/>').val('0').text('Pilih RM'));
	    $.each(Rm, function (i, val) {
		$ele.append($('<option/>').val(val.npp).text(val.nama));
	})
    }
    loadRm($('#npprm'));

	function Save(){
        debugger;
		var npp = $('#npprm').val();
		var kode_unit = $('#divisi').val();
		var tgl_mulai = $('#tgl_mulai').val();
		$.ajax({
                type : "POST",
                url  : "<?php echo site_url()?>/Unit/save",
                dataType : "JSON",
                data : {npp:npp, kode_unit:kode_unit, tgl_mulai:tgl_mulai},
                success: function(data){
                    debugger;
                    Swal.fire({ position: 'center', type: 'success',title: 'Insert Successfully'});
                    Clearscreen();
                    ResetTable();
                    setTimeout(function(){ 
                        $("#formunit").modal('hide');
                        }, 3000);
                        
                }
            });
            return false;
    }
    function Edit(){
        debugger;
        var id = $('#id').val();
        var tgl = $('#tgl').val();
		var npp = $('#npp').val();
        var namarm = $('#namarm').val();
		var kode_unit = $('#divisi').val();
		var tgl_mulai = $('#tgl_mulai').val();
        var tgl_akhir = $('#tgl_akhir').val();
		$.ajax({
                type : "POST",
                url  : "<?php echo site_url()?>/Unit/edit",
                dataType : "JSON",
                data : {id:id, tgl:tgl ,npp:npp, namarm:namarm, kode_unit:kode_unit, tgl_mulai:tgl_mulai, tgl_akhir:tgl_akhir},
                success: function(data){
                    debugger;
                    Swal.fire({ position: 'center', type: 'success',title: 'Update Successfully'});
                    ResetTable();
                    setTimeout(function(){ 
                        $("#formunit").modal('hide');
                        }, 3000);
                    
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
				    url:"<?php echo site_url()?>/Unit/delete",  
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