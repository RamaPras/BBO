<script>
    $(document).ready(function(){

        $('#myCid').DataTable({
            "bprocessing": true,
            "bserverSide": true,
            "bJQueryUI":true,
            "bSort":false,
            "sDom": "lfrti",
            "sPaginationType":"full_numbers",
            "iDisplayLength": 10,
            "ajax": tampil_data(),
            "orderMulti": false}); 
              
    }); 
        function tampil_data(){
            debugger;
            $.ajax({
                type  : 'POST',
                url   : '<?php echo base_url()?>Cid/data_list',
                async : false,
                dataType : 'json',
                success : function(data){
                    debugger;
                    var html = '';
                    var i=1;
                    var flag = '';
                    $.each(data, function (index, val){
                        if (val.flag == 0){
                            flag = "Tidak";
                        } else {
                            flag = "Ya";
                        }
                        html += '<tr>';
					html += '<td style="text-align:center">' + i + '</td>';
					html += '<td style="text-align:center">' +val.cid+ '</td>';
                    html += '<td>' +val.nama+ '</td>';
					html += '<td style="text-align:center" >' +flag+ '</td>';
					html += '<td>' +val.grup+ '</td>';
                    html += '<td>' +val.segmen+ '</td>';
                    html += '<td>' +val.tgl_mulai.substring(0, 10) + '</td>';
                    html += '<td>' +val.tgl_akhir.substring(0, 10) + '</td>';
					html += '<td  style="text-align:center">';
					html += ' <a href="#formcid" data-toggle="modal" class="btn btn-green btn-sm" onclick="submit(\''+val.cid+'\',\''+val.tgl_mulai+'\')"><i class="fas fa-edit"></i> Edit</a></td> ';
					//html += ' <a href="#formtgl" data-toggle="modal" class="btn btn-orange fas fa-calendar" onclick="tgl_akhir(\''+val.cid+'\',\''+val.tgl_mulai+'\')"></a></td>';
					html += '</tr>';
					i++;
                    });
                    $('#show_data').html(html);
                }
 
            });
        }
    function ResetTable(){
        $('#myCid').DataTable().destroy();
        $('#myCid').DataTable({
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

    function ValidateNoCIF(nocif){
	var nocifReg = /^[0-9]{10,10}$/i;
	return nocifReg.test(nocif);
    }

    function ValidateInsert() {
        debugger;
	if ($('#nama').val() == 0) {
		    Swal.fire('Error', 'Anda Belum Mengisi Nama Inisial', 'error');
         } else if ($('#flag').val() == null) {
		     Swal.fire('Error', 'Anda Belum Menentukan Kementerian', 'error');
	    } else if ($('#grup').val() == 0) { 
		    Swal.fire('Error', 'Anda Belum Mengisi Nama Grup', 'error');       
        } else if ($('#tgl_mulai').val() == 0) {
		    Swal.fire('Error', 'Input Tanggal Masuk', 'error');
	    } else {
		    Save();
	    } 
    }
    function ValidateUpdate() {
        debugger;
        if ($('#nama').val() == 0) {
		    Swal.fire('Error', 'Anda Belum Mengisi Nama Inisial', 'error');
	    } else if ($('#grup').val() == null) {
		    Swal.fire('Error', 'Anda Belum Mengisi Nama Grup', 'error');   
        } else if ($('#tgl_mulai').val() == 0) {
		    Swal.fire('Error', 'Input Tanggal Mulai', 'error');
	    } else {
		    Edit();
	    }
    }
    function Clearscreen(){
        $('#cid').val('');
	    $('#nama').val('');
	    $('#grup').val('');
        $('#flag').val('');
        $('#segmen').val('');
	    $('#tgl_mulai').val('');
	    $('#tgl_akhir').val('');
    }
    
    function submit(x,y){
        debugger;
        if (x == 'add'){
            Clearscreen();
            $('#form_id').hide();
            $('#tgl_akh').hide();
            $('#add').show();
            $('#edit').hide();
            $.ajax({
                type : "POST",
                url : "<?php echo site_url()?>/Cid/getcid",
                dataType : "JSON",
                success : function(data){
                    debugger;
                    $('#HeaderForm').text(" ADD Data");
                    $('#cid').val(data.cid);
                } 
            }); 
        } else {
            $('#form_id').show();
            $('#add').hide();
            $('#edit').show();
            $('#tgl_akh').show();
            $.ajax({
                type : "POST",
                url : "<?php echo site_url()?>/Cid/getbyId",
                dataType : "JSON",
                data : { cid: x, tgl: y },
                success : function(data){
                    debugger;
                    if (data.flag == 0){
                            flag = "Tidak";
                        } else {
                            flag = "Ya";
                        }
                    $('#HeaderForm').text(" Edit Data");
                    $('#cid').val(data.cid);
                    $('#nama').val(data.nama);
	                $('#flag').val(flag);
	                $('#grup').val(data.grup);
                    $('#segmen').val(data.segmen);
	                $('#tgl_mulai').val(data.tgl_mulai.substr(0,10));
                    $('#tgl').val(data.tgl_mulai);
                    $('#tgl_akhir').val(data.tgl_akhir.substr(0,10));
                } 
            });    
        }
    }

    function tgl_akhir(x,y){
        debugger;
        $.ajax({
                type : "POST",
                url : "<?php echo site_url()?>/Cid/getbyId",
                dataType : "JSON",
                data : { cid: x, tgl: y },
                success : function(data){
                    debugger;
                    $('#cid2').val(data.cid);
	                $('#tgl_mulai2').val(data.tgl_mulai.substr(0,10));
                    $('#tgl2').val(data.tgl_mulai);
                    $('#tgl_akhir').val(data.tgl_akhir.substr(0,10));
                } 
            });    
    }
    function save_tgl(){
        debugger;
        var id = $('#cid2').val();
        var tgl = $('#tgl2').val();
	    var tgl_akhir= $('#tgl_akhir').val();
		$.ajax({
                type : "POST",
                url  : "<?php echo site_url()?>/Cid/tgl_akhir",
                dataType : "JSON",
                data : {id: id, tgl:tgl, tgl_akhir:tgl_akhir},
                success: function(data){
                    debugger;
                    Swal.fire({ position: 'center', type: 'success',title: 'Confirm Successfully'});
                    setTimeout(function(){ 
                        $("#form").modal('hide');
                        }, 3000);
                        ResetTable();
                }
            });
            return false;
    }

	function Save(){
        debugger;
        var cid = $('#cid').val();
		var nama = $('#nama').val();
	    var grup = $('#grup').val();
        var flag = $('#flag').val();
        var segmen = $('#segmen').val();
	    var tgl_mulai= $('#tgl_mulai').val();
		$.ajax({
                type : "POST",
                url  : "<?php echo site_url()?>/Cid/save",
                dataType : "JSON",
                data : {cid:cid, nama:nama , grup:grup, flag:flag, segmen:segmen, tgl_mulai:tgl_mulai},
                success: function(data){
                    debugger;
                    Swal.fire({ position: 'center', type: 'success',title: 'Insert Successfully'});
                    Clearscreen();
                    setTimeout(function(){ 
                        $("#formcid").modal('hide');
                        }, 3000);
                        ResetTable();
                }
            });
            return false;
    }
    function Edit(){
        debugger;
        var id = $('#cid').val();
        var tgl = $('#tgl').val();
        var nama = $('#nama').val();
	    var grup = $('#grup').val();
        var flag = $('#flag').val();
        var segmen = $('#segmen').val();
	    var tgl_mulai= $('#tgl_mulai').val();
        var tgl_akhir= $('#tgl_akhir').val();
		$.ajax({
                type : "POST",
                url  : "<?php echo site_url()?>/Cid/edit",
                dataType : "JSON",
                data : {id: id, tgl:tgl, nama:nama , grup:grup, flag:flag, segmen:segmen, tgl_mulai:tgl_mulai, tgl_akhir:tgl_akhir},
                success: function(data){
                    debugger;
                    Swal.fire({ position: 'center', type: 'success',title: 'Update Successfully'});
                    setTimeout(function(){ 
                        $("#formcid").modal('hide');
                        }, 3000);
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
				    url:"<?php echo site_url()?>/Cid/delete",  
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