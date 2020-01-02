<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('admin/partials/head');?>
</head>

<body class="bg-green">
<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

  <div class="col-xl-10 col-lg-12 col-md-9">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-6 d-none d-lg-block"><img src="<?php echo base_url('assets/BNI3.jpg') ?>" width="400 px"></div>
          <div class="col-lg-6">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">LOGIN</h1>
              </div>
              <form class="user">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="Npp" placeholder="NPP">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="Password"  placeholder="Password"/>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <!-- <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label> -->
                      </div>
                    </div>
                    <a href="#" class="btn btn-orange btn-user btn-block" id="submit" > LOGIN </a>
                  </form>
             <!-- <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="register.html">Create an Account!</a>
              </div>-->
            </div>
          </div>
        </div>
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
