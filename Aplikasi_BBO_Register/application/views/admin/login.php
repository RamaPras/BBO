<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('admin/partials/head');?>
</head>

<body class="bg-green">
<div class="container">
<img class="img-profile" src="<?php echo base_url('assets/BNI46.png') ?>"  width="15%" height="15%" style="display: block; margin: auto;">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-header">
            <h3 class="card-title text-center">LOGIN</h3>
          </div>
          <div class="card-body">
           
                  <form class="user">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="Npp" placeholder="NPP">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="Password"  placeholder="Password"/>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                      
                      </div>
                    </div>
                    <a href="#" class="btn btn-orange btn-user btn-block" id="submit" > LOGIN </a>
                  </form>
          </div>
        </div>
      </div>
    </div>
  </div>
 

  <!-- Bootstrap core JavaScript-->
    <?php $this->load->view('admin/partials/js')?>
    <script type="text/javascript">  
        // Ajax post
        function ValidateNPP(npp){
	      var nppReg = /^P0([0-9]{5,5})$/i;
	      return nppReg.test(npp);
    }
 
        $(document).ready(function(){  
        $("#submit").click(function(){  
        let npp = $("#Npp").val();
        var password = $("#Password").val();
        // Returns error message when submitted without req fields.  
        if ($('#Npp').val() == "" || $('#Npp').val() == " ") {
            Swal.fire('Login Gagal','Anda Belum Memasukkan NPP', 'error')
          } else  if (!ValidateNPP(npp)) {
            Swal.fire("Format NPP Salah", "Format NPP Kurang Tepat", "error");
          } else if ($('#Password').val() == "" || $('#Password').val() == " ") {
            Swal.fire("Login Gagal", "Anda Belum Memasukkan Password", "error");
          } else {
        // AJAX Code To Submit Form.  
            $.ajax({  
              type: "POST",  
              url:  "<?php echo site_url()?>/Login/check_login",  
              data: {npp: npp, pwd: password},  
              cache: false,  
              success: function(result){ 
                debugger; 
                if(result!=0){  
                // On success redirect.  
                Swal.fire('Login Berhasil', 'Selamat Datang','success');
                  setTimeout(function(){ 
                    window.location.replace(result);  
                        }, 3000);
                }  else { 
                  Swal.fire('Login Gagal','NPP atau Password anda kurang tepat ','error'); 
                } 
            }  
        });  
      }  
      return false;  
    });  
  }); 
</script>   
</body>

</html>
