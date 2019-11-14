
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Registration</h3>
                    </div>
                    <div class="panel-body">
                        <form action="" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label for="" class="control-label col-md-3">Nama</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="nama" id="nama" 
                                    >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label col-md-3">Email</label>
                                <div class="col-md-7">
                                    <input type="email" class="form-control" name="email" id="email" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label col-md-3">Password</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="password" id="password" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label col-md-3">Alamat</label>
                                <div class="col-md-7">
                                    <textarea name="alamat" class="form-control" id="alamat" ></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label col-md-3">Telepon</label>
                                <div class="col-md-7">
                                    <input type="number"  class="form-control" name="telepon" id="telepon" >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary" name="daftar" id="daftar">Daftar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- <script> 
 $(document).ready(function(){ 
   
   $('#myform').submit(function(){ 
    var nama = $('#nama').val().length; 
    var email = $('#email').val().length; 
    var password = $('#password').val().length; 
    var alamat = $('#alamat').val().length; 
    var telepon = $('#telepon').val().length; 
    $(".error").remove(); 
    if (nama == 0 ) { 
      $('#nama').after('<span class="error" style="color:red">Karakter Tidak Boleh Kosong</span>'); 
      return false; 
    }else if (nama > 50 ) { 
      $('#nama').after('<span class="error" style="color:red"><strong>MAX 50 character</strong></span>'); 
      return false; 
    } 
    else if(email == 0){ 
      $('#email').after('<span class="error" style="color:red">Karakter Tidak Boleh Kosong</span>'); 
      return false; 
    }else if(email > 30){ 
      $('#email').after('<span class="error" style="color:red"><strong>MAX 30 character</strong></span>'); 
      return false; 
    } 
    else if(password == 0){ 
      $('#password').after('<span class="error" style="color:red">Karakter Tidak Boleh Kosong</span>'); 
      return false; 
    }else if(password > 15){ 
      $('#password').after('<span class="error" style="color:red"><strong>MAX 15 character</strong></span>'); 
      return false; 
    }
    else if(alamat == 0){ 
      $('#alamat').after('<span class="error" style="color:red">Karakter Tidak Boleh Kosong</span>'); 
      return false; 
    }else if(alamat > 50){ 
      $('#alamat').after('<span class="error" style="color:red"><strong>MAX 50 character</strong></span>'); 
      return false; 
    }
    else if(telepon == 0){ 
      $('#telepon').after('<span class="error" style="color:red">Karakter Tidak Boleh Kosong</span>'); 
      return false; 
    }
    else{ 
      return true; 
    } 
   }); 
 
 
 }); 
</script> -->