<script>
    $(document).ready(function(){

        $('#myUser').DataTable({
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
                url   : '<?php echo base_url()?>User/data_list',
                async : false,
                dataType : 'json',
                success : function(data){
                    debugger;
                    var html = '';
                    var i=1;
                    var status = '';
                    $.each(data, function (index, val){
                        if (val.status == 0){
                            status = "Nonaktif";
                        } else {
                            status = "Aktif";
                        }
                        html += '<tr>';
					html += '<td style="text-align:center">' + i + '</td>';
                    html += '<td>' +val.npp+ '</td>';
                    html += '<td>' +val.nama+ '</td>';
                    html += '<td>' +val.email+ '</td>';
					html += '<td style="text-align:center">' +val.kategori+ '</td>';
                    html += '<td style="text-align:center" >' +status+ '</td>';
                    html += '<td style="text-align:center">' +val.Update + '</td>';
                    html += '<td style="text-align:center">' +val.Expire + '</td>';
					html += '<td>';
					html += ' <a href="#formuser" data-toggle="modal" class="btn btn-green btn-sm" onclick="submit(\''+val.user_id+'\')"> Edit</a>';
					// html += ' <a href="javascript:void(0);" class="btn btn-orange btn-sm" onclick="ResetPswd(\''+val.user_id+'\',\''+val.nama+'\')"> Reset Password</a></td>';
					html += '</tr>';
					i++;
                    });
                    $('#show_data').html(html);
                }
 
            });
        }
    function ResetTable(){
        $('#myUser').DataTable().destroy();
        $('#myUser').DataTable({
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

    function ValidateID(id){
	var idReg = /^[0-9]{5,5}$/i;
	return idReg.test(id);
    }
    function ValidateNPP(npp){
	var nppReg = /^P0([0-9]{5,5})$/i;
	return nppReg.test(npp);
    }
    function ValidateEmail(email){
	var emailReg = /^([a-zA-Z0-9_\-\.]+)@bni.co.id$/i;
	return emailReg.test(email);
    }
    function ValidateSC(sc){
	var scReg = /^[0-9]$/i;
	return scReg.test(sc);
    }

    function ValidateInsert() {
        debugger;
        if ($('#npp').val() == 0) {
		    Swal.fire('Error', 'Anda Belum Mengisi NPP', 'error');
        } else if (!ValidateNPP($('#npp').val())) {
		    Swal.fire('Error', 'Format NPP Salah', 'error');
         } else if ($('#nama').val() == 0) {
            Swal.fire('Error', 'Anda Belum Mengisi Nama User', 'error');
        } else if ($('#email').val() == 0) {
            Swal.fire('Error', 'Anda Belum Mengisi Email BNI', 'error');
        } else if (!ValidateEmail($('#email').val())) {
		    Swal.fire('Error', 'Format Email Salah', 'error');
	    } else if ($('#kategori').val() == 0) { 
		    Swal.fire('Error', 'Anda Belum Memilih Kategori', 'error');  
        } else if ($('#sc').val() == 0) {
            Swal.fire('Error', 'Anda Belum Mengisi Sentra Code', 'error');
        } else if (!ValidateSC($('#sc').val())) {
		    Swal.fire('Error', 'Format Sentra Code hanya menggunakan angka ', 'error');     
	    } else if ($('#hc').val() == 0) {
            Swal.fire('Error', 'Anda Belum Mengisi Handling Code', 'error');
        } else if (!ValidateSC($('#hc').val())) {
		    Swal.fire('Error', 'Format Handling Code hanya menggunakan angka ', 'error'); 
        } else if ($('#HakAdm').val() == null) { 
		    Swal.fire('Error', 'Anda Belum Memilih Hak Admin', 'error');  
        } else if ($('#HakUpd').val() == null) { 
		    Swal.fire('Error', 'Anda Belum Memilih Hak Update', 'error');  
        } else {
		    ValidNPP();
	    } 
    }
    function ValidateUpdate() {
        debugger;
        if ($('#npp').val() == 0) {
		    Swal.fire('Error', 'Anda Belum Mengisi User Id', 'error');
        } else if (!ValidateNPP($('#npp').val())) {
		    Swal.fire('Error', 'Format NPP Salah', 'error');
        } else if ($('#nama').val() == 0) {
		    Swal.fire('Error', 'Anda Belum Mengisi Nama User', 'error');
	    } else if ($('#category').val() == null) { 
		    Swal.fire('Error', 'Anda Belum Memilih Kategori', 'error');       
	    } else {
		    Edit();
	    }
    }
    function Clearscreen(){
        $('#npp').val('');
	    $('#nama').val('');
	    $('#category').val('');
        $('#tgl_akhir').val('');
    }
    
    function submit(x){
        debugger;
        if (x == 'add'){
            Clearscreen();
            $('#tgl_exp').hide();
            $('#add').show();
            $('#edit').hide();
            $('#form_id').hide();  
        } else {
            $('#add').hide();
            $('#edit').show();
            $('#tgl_exp').show();
            $('#form_id').show();
            $.ajax({
                type : "POST",
                url : "<?php echo site_url()?>/User/getbyId",
                dataType : "JSON",
                data : { id: x},
                success : function(data){
                    var status = '';
                    var category = '';
                    debugger;
                    if(data.category == 'ADM'){
                            category = "Admin";
                        } else {
                            category = "User";
                        }
                        if (data.status == 0){
                            status = "Nonaktif";
                        } else {
                            status = "Aktif";
                        }
                    $('#HeaderForm').text(" Edit Data");
                    $('#id').val(data.user_id);
                    $('#nama').val(data.nama);
	                $('#npp').val(data.npp);
	                $('#category').val(category);
                    $('#tgl_akhir').val(data.expire_date.substr(0,10));
                } 
            });    
        }
    }

    function ValidNPP(){
        debugger;
        var npp = $('#npp').val();
        $.ajax({
                type : "POST",
                url  : "<?php echo site_url()?>/User/validnpp",
                dataType : "JSON",
                data : {npp:npp},
                success: function(data){
                    debugger;
                    if (data > 0){
                        Swal.fire('Error', 'NPP Telah terdaftar', 'error');
                    } else {
                        Save();
                    } 
                }
            });
            return false;
    }
    var Roles = [];
    function loadRole(element){
        debugger;
        if(Roles.length == 0) {
            $.ajax({
                type: "GET",
			    url: "<?php echo site_url()?>/User/getRole",
                dataType: "json",
			success: function (data) {
				debugger;
				Roles = data;
				renderRole(element);
			}
            })
        } else {
            renderRole(element);
        }
    }
    function renderRole(element){
        var $ele = $(element);
        $ele.empty();
	    $ele.append($('<option/>').val('0').text('Pilih Kategori'));
	    $.each(Roles, function (i, val) {
		$ele.append($('<option/>').val(val.role).text(val.role));
            
	})
    }
    loadRole($('#kategori'));

	function Save(){
        debugger;
        var npp = $('#npp').val();
		var nama = $('#nama').val();
        var email = $('#email').val();
	    var kategori = $('#kategori').val();
        var sc = $('#sc').val();
        var hc = $('#hc').val();
        var HakAdm = $('#HakAdm').val();
        var HakUpd = $('#HakUpd').val();
		$.ajax({
                type : "POST",
                url  : "<?php echo site_url()?>/User/save",
                dataType : "JSON",
                data : {npp:npp, nama:nama , email:email, kategori:kategori, sc:sc, hc:hc, HakAdm:HakAdm, HakUpd:HakUpd},
                success: function(data){
                    debugger;
                    Swal.fire({ position: 'center', type: 'success',title: 'Insert Successfully'});
                    Clearscreen();
                    setTimeout(function(){ 
                        $("#formuser").modal('hide');
                        }, 3000);
                        ResetTable();
                }
            });
            return false;
    }
    function Edit(){
        debugger;
        var id = $('#id').val();
        var npp = $('#npp').val();
        var nama = $('#nama').val();
	    var category = $('#category').val();
        var expire = $('#tgl_akhir').val(); 
		$.ajax({
                type : "POST",
                url  : "<?php echo site_url()?>/User/edit",
                dataType : "JSON",
                data : {id: id, npp:npp, nama:nama , category:category, expire: expire},
                success: function(data){
                    debugger;
                    Swal.fire({ position: 'center', type: 'success',title: 'Update Successfully'});
                    setTimeout(function(){ 
                        $("#formuser").modal('hide');
                        }, 3000);
                        ResetTable();
                }
            });
            return false;
    }
    function ResetPswd(id, nama){
		Swal.fire({
				title: 'Konfirmasi',
                text: "Anda ingin Reset Password ",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Reset',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Tidak',
                reverseButtons: true
	}).then((result) => {
		if (result.value) {
			$.ajax({
				    url:"<?php echo site_url()?>/User/reset_password",  
                    method:"post",    
                    data:{id :id, nama: nama},
                    success:function(){
						debugger;
                        Swal.fire({ position: 'center', type: 'success',title: 'Reset Password Succesfully'});
                      ResetTable(); 
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        Swal.fire({ position: 'center', type: 'error',title: 'Reset Password Failed'});
                }
                  });
		}
	})
    }
</script>