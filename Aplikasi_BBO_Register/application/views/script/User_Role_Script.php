<script>
    $(document).ready(function(){
 
        $('#myUserRole').DataTable({
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
                url   : '<?php echo base_url()?>User_Role/data_list',
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
					html += '<td style="text-align:left">' + i + '</td>';
                    html += '<td style="text-align:left">' +val.npp+ '</td>';
                    html += '<td style="text-align:left">' +val.nama+ '</td>';
                    html += '<td style="text-align:center">' +val.role+ '</td>';
					html += '<td style="text-align:center">' +val.unit+ '</td>';
                    html += '<td style="text-align:center">' +val.update + '</td>';
                    html += '<td style="text-align:center">' +val.expiry + '</td>';
					html += '<td style="text-align:center">';
					html += ' <a href="#formuserRole" data-toggle="modal" class="btn btn-green btn-sm" onclick="submit(\''+val.id+'\',\''+val.role+'\',\''+val.unit+'\')"> Edit</a></td>';
					// html += ' <a href="javascript:void(0);" class="btn btn-orange btn-sm" onclick="ResetPswd(\''+val.user_id+'\',\''+val.nama+'\')"> Reset Password</a>;
					html += '</tr>'; 
					i++;
                    });
                    $('#show_data').html(html);
                }
 
            });
        }
    function ResetTable(){
        $('#myUserRole').DataTable().destroy();
        $('#myUserRole').DataTable({
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
    function ValidateNama(nama){
	var namaReg = /^[A-Z]{1,200}$/i;
	return namaReg.test(nama);
    }
    function ValidateEmail(email){
	var emailReg = /^([a-zA-Z0-9_\-\.]+)@bni.co.id$/i;
	return emailReg.test(email);
    }
    function ValidateSC(sc){
	var scReg = /^[0-9]{1,200}$/i;
	return scReg.test(sc);
    }

    function ValidateInsert() {
        debugger;
	    if ($('#user').val() == 0) { 
		    Swal.fire('Error', 'Anda Belum Memilih Kategori', 'error');  
        } else if ($('#role').val() == 0) { 
		    Swal.fire('Error', 'Anda Belum Memilih Kategori', 'error');    
	    } else if ($('#unit').val() == 0) {
            Swal.fire('Error', 'Anda Belum Mengisi Unit', 'error');
        } else if (!ValidateSC($('#unit').val())) {
		    Swal.fire('Error', 'Format Unit hanya menggunakan angka ', 'error');   
        } else {
		    Save();
	    } 
    }
    function ValidateUpdate() {
        debugger;
        if ($('#user').val() == 0) { 
		    Swal.fire('Error', 'Anda Belum Memilih Kategori', 'error');  
        } else if ($('#role').val() == 0) { 
		    Swal.fire('Error', 'Anda Belum Memilih Kategori', 'error');    
	    } else if ($('#unit').val() == 0) {
            Swal.fire('Error', 'Anda Belum Mengisi Unit', 'error');
        } else if (!ValidateSC($('#unit').val())) {
		    Swal.fire('Error', 'Format Unit hanya menggunakan angka ', 'error');   
        } else {
		    Edit();
	    }
    }
    function Clearscreen(){
        $('#user').val(0);
	    $('#role').val(0);
	    $('#unit').val('');
    }
    
    function submit(x, y, z){
        debugger;
        if (x == 'a', y == 'd', z == 'd'){
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
                url : "<?php echo site_url()?>/User_Role/getbyId",
                dataType : "JSON",
                data : { id: x, role: y, unit:z},
                success : function(data){
                    debugger;
                    $('#HeaderForm').text(" Edit Data");
                    $('#id').val(data.UserID);
                    $('#role_upd').val(data.role);
                    $('#unit_upd').val(data.unit);
                    $('#user').val(data.UserID);
	                $('#role').val(data.role);
	                $('#unit').val(data.unit);
                    $('#tgl_akhir').val(data.expiry_date);
                } 
            });    
        }
    }

    
    var Users = [];
    function loadUser(element){
        debugger;
        if(Users.length == 0) {
            $.ajax({
                type: "GET",
			    url: "<?php echo site_url()?>/User_Role/getUser",
                dataType: "json",
			success: function (data) {
				debugger;
				Users = data;
				renderUser(element);
			}
            })
        } else {
            renderUser(element);
        }
    }
    function renderUser(element){
        var $ele = $(element);
        $ele.empty();
	    $ele.append($('<option/>').val('0').text('Pilih Nama User'));
	    $.each(Users, function (i, val) {
            if(val.Nama != null) {
                $ele.append($('<option/>').val(val.UserID).text(val.Nama));
            }            
	})
    }
    loadUser($('#user'));
    var Roles = [];
    function loadRole(element){
        debugger;
        if(Roles.length == 0) {
            $.ajax({
                type: "GET",
			    url: "<?php echo site_url()?>/User_Role/getRole",
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
    loadRole($('#role'));
	function Save(){
        debugger;
        var id = $('#user').val();
		var role = $('#role').val();
        var unit = $('#unit').val();
		$.ajax({
                type : "POST",
                url  : "<?php echo site_url()?>/User_Role/save",
                dataType : "JSON",
                data : {id:id, role:role, unit:unit},
                success: function(data){
                    debugger;
                    Swal.fire({ position: 'center', type: 'success',title: 'Insert Successfully'});
                    Clearscreen();
                    setTimeout(function(){ 
                        $("#formuserRole").modal('hide');
                        }, 5500);
                        ResetTable();
                }
            });
            return false;
    }
    function Edit(){
        debugger;
        var id = $('#id').val();
        var role_upd = $('#role_upd').val();
        var unit_upd = $('#unit_upd').val();
        var user = $('#user').val();
		var role = $('#role').val();
        var unit = $('#unit').val();
        var expire = $('#tgl_akhir').val(); 
		$.ajax({
                type : "POST", 
                url  : "<?php echo site_url()?>/User_Role/edit",
                dataType : "JSON",
                data : {id:id, role_upd:role_upd, unit_upd:unit_upd, user: user, role:role, unit:unit, expire: expire},
                success: function(data){
                    debugger;
                    Swal.fire({ position: 'center', type: 'success',title: 'Update Successfully'});
                    setTimeout(function(){ 
                        $("#formuserRole").modal('hide');
                        }, 5500);
                        ResetTable();
                }
            });
            return false;
    }
</script>