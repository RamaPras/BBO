<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> KONFIRMASI</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Anda yakin ingin logout ?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
          <a class="btn btn-primary" href="<?php echo site_url('Login/logout') ?>">Ya</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Change Password Modal-->
<div class="modal fade" id="ChangeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ChangePass">Change Password</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="id" id="id" class="form-control" disabled>
            <input type="password" class="form-control form-control-user" id="OldPass" placeholder="Password Lama" data-toggle="password"/>
          </div>
          <div class="form-group">
            <input type="password" class="form-control form-control-user" id="NewPass" placeholder="Password Baru" data-toggle="password"/>
          </div>
          <div class="form-group">
            <input type="password" class="form-control form-control-user" id="PassConfirm" placeholder="Konfirmasi Password Baru" data-toggle="password"/>
          </div>        
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="button" type="submit" id="change" class="btn btn-primary" onclick="ValidatePass();">Change Password</button>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">  
        function ValidatePass(){
        debugger;
        var id = $('#id').val();
        var oldpass = $('#OldPass').val(); 
		$.ajax({
                type : "POST",
                url  : "<?php echo site_url()?>/Admin/oldpass",
                dataType : "JSON",
                data : {id: id, oldpass:oldpass},
                success: function(data){
                    debugger;
                    if (data == 1){
                      ValidateNewPass();
                    } else {
                      Swal.fire('Error', 'Password Lama yang anda masukkan tidak terdaftar', 'error');
                    }
                }
            });
            return false;
    }
    function ValidateNewPass() {
        debugger;
	      if ($('#NewPass').val() == 0) {
		    Swal.fire('Error', 'Anda Belum Input Password Baru', 'error');
	    } else if ($('#PassConfirm').val() == 0) {
		    Swal.fire('Error', 'Mohon Input Konfirmasi Password Baru ', 'error');
	    } else if ($('#NewPass').val() != $('#PassConfirm').val()) {
		    Swal.fire('Error', 'Password Baru Tidak Sinkron', 'error');
	    } else {
		    ChangePass();
	    }
    }
        function ChangePass(){
        debugger;
        var id = $('#id').val();
        var oldpass = $('#OldPass').val();
        var newpass = $('#NewPass').val();
	      var passconf = $('#PassConfirm').val(); 
		$.ajax({
                type : "POST",
                url  : "<?php echo site_url()?>/Admin/Change",
                dataType : "JSON",
                data : {id: id, oldpass:oldpass, newpass:newpass , passconf: passconf},
                success: function(data){
                    debugger;
                    Swal.fire({ position: 'center', type: 'success',title: 'Change Password Successfully'});
                    setTimeout(function(){ 
                        $("#ChangeModal").modal('hide');
                        }, 3000);
                    
                }
            });
            return false;
    }
</script>