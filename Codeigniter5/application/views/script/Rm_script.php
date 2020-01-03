<script>
    $(document).ready(function(){
        
        $('#myRM').DataTable({
            "bprocessing": true,
            "bserverSide": true,
            "bJQueryUI":true,
            "bSort":false,
            "sDom": "lfrti",
            "iDisplayLength": 10,
            "ajax": tampil_data(),
            "orderMulti": false});  
        $('#customername').change(function(){ 
                debugger;
                var cid=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('Rm/getDataCID');?>",
                    type : "POST",
                    data : {cid: cid},
                    cache: false,
                    dataType : 'json',
                    success: function(data){
                        debugger;
                        $.each(data,function(cid, grup, flag, segmen){
                            if (data.flag == 0){
                            flag = "Tidak";
                        } else {
                            flag = "Ya";
                        }
                            $('#cid').val(data.cid);
                            $('#grup').val(data.grup);
                            $('#flag').val(flag);
                            $('#segmen').val(data.segmen);
                        });
                    }
                });
                return false;
            });
            $('#rmname').change(function(){ 
                debugger;
                var rm=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('Rm/getDataRM');?>",
                    type : "POST",
                    data : {rm: rm},
                    cache: false,
                    dataType : 'json',
                    success: function(data){
                        debugger;
                        $.each(data,function(DIVISI){
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
                url   : '<?php echo base_url()?>Rm/data_list',
                async : false,
                dataType : 'json',
                success : function(data){
                    debugger;
                    var html = '';
                    var i=1;
                    $.each(data, function (index, val){
                        html += '<tr>';
					html += '<td style="text-align:center">' + i + '</td>';
					html += '<td>' +val.CUSTOMER_ID+ '</td>';
					html += '<td>' +val.CUSTOMER_NAME+ '</td>';
					html += '<td>' +val.grup+ '</td>';
					html += '<td>' +val.DIVISI+ '</td>';
                    html += '<td>' +val.RM_NAME+ '</td>';
					html += '<td  style="text-align:center" width="15%">';
					html += ' <a href="#formrm" data-toggle="modal" class="btn btn-green btn-sm" onclick="submit(\''+val.CUSTOMER_ID+'\',\''+val.tgl_mulai+'\')"><i class="fas fa-edit"></i> Edit</a>';
					html += ' <a href="javascript:void(0);" class="btn btn-orange btn-sm" onclick="deleteConfirm(\''+val.CUSTOMER_ID+'\',\''+val.tgl_mulai+'\')"><i class="fas fa-trash"></i>Delete</a></td>';
					html += '</tr>';
					i++;
                    });
                    $('#show_data').html(html);
                }
 
            });
        }
    function ResetTable(){
        $('#myRM').DataTable().destroy();
        $('#myRM').DataTable({
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
    function ValidateInsert() {
        debugger;
        if ($('#customername').val() == 0) {
		    Swal.fire('Error', 'Pilih Nama Inisial', 'error');
        } else if ($('#rmname').val() == 0) {
		    Swal.fire('Error', 'Pilih Nama RM', 'error');
        } else if ($('#tgl_mulai').val() == 0) {
		    Swal.fire('Error', 'Input Tanggal Masuk', 'error');
	    } else {
		    Save();
	    }
    }
    function ValidateUpdate() {
        debugger;
        if ($('#customername').val() == 0) {
		    Swal.fire('Error', 'Pilih Nama Inisial', 'error');
        } else if ($('#rmname').val() == 0) {
		    Swal.fire('Error', 'Pilih Nama RM', 'error');
        } else if ($('#tgl_mulai').val() == 0) {
		    Swal.fire('Error', 'Input Tanggal Masuk', 'error');
	    } else {
		    Edit();
	    }
    }
    function Clearscreen(){
        $('#cid').val('');
	    $('#customername').val(0);
	    $('#grup').val('');
        $('#flag').val('');
        $('#segmen').val('');
        $('#rmname').val(0);
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
                url : "<?php echo site_url()?>/Rm/getbyId",
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
                    $('#id').val(data.CUSTOMER_ID);
                    $('#cid').val(data.CUSTOMER_ID);
	                $('#customername').val(data.CUSTOMER_ID);
	                $('#grup').val(data.grup);
                    $('#flag').val(flag);
                    $('#segmen').val(data.segmen);
	                $('#rmname').val(data.INITIAL_RM);
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
			    url: "<?php echo site_url()?>/Rm/getCustomer",
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
		$ele.append($('<option/>').val(val.cid).text(val.nama));
            }
	})
    }
    loadCustomer($('#customername'));

    var Rm = [];
    function loadRm(element){
        debugger;
        if(Rm.length == 0) {
            $.ajax({
                type: "GET",
			    url: "<?php echo site_url()?>/Rm/getRM",
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
	    $ele.append($('<option/>').val('0').text('Pilih Nama RM'));
	    $.each(Rm, function (i, val) {
            if (val.tgl_akhir.substr(0,10) == '9999-12-31'){
		$ele.append($('<option/>').val(val.INITIAL_RM).text(val.RM_NAME));
            }
	})
    }
    loadRm($('#rmname'));

	function Save(){
        debugger;
		var npp = $('#rmname').val();
		var cid = $('#customername').val();
		var tgl_mulai = $('#tgl_mulai').val();
		$.ajax({
                type : "POST",
                url  : "<?php echo site_url()?>/Rm/save",
                dataType : "JSON",
                data : {npp:npp , cid:cid, tgl_mulai:tgl_mulai},
                success: function(data){
                    debugger;
                    Swal.fire({ position: 'center', type: 'success',title: 'Insert Successfully'});
                    Clearscreen();
                    ResetTable();
                    setTimeout(function(){ 
                        $("#formrm").modal('hide');
                        }, 3000);
                        
                }
            });
            return false;
    }
    function Edit(){
        var id = $('#id').val();
        var tgl = $('#tgl').val();
		var npp = $('#rmname').val();
		var cid = $('#customername').val();
		var tgl_mulai = $('#tgl_mulai').val();
        var tgl_akhir = $('#tgl_akhir').val();
		$.ajax({
                type : "POST",
                url  : "<?php echo site_url()?>/Rm/edit",
                dataType : "JSON",
                data : {id:id, tgl:tgl ,npp:npp, cid:cid, tgl_mulai:tgl_mulai, tgl_akhir:tgl_akhir},
                success: function(data){
                    Swal.fire({ position: 'center', type: 'success',title: 'Update Successfully'});
                    ResetTable();
                    setTimeout(function(){ 
                        $("#formrm").modal('hide');
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
				    url:"<?php echo site_url()?>/Rm/delete",  
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