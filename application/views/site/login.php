<!DOCTYPE html>
<html>
<? if($this->session->userdata('USERNAME')){
redirect(site_url().'Dashboard');
    }?>
<head>
    <title>SIPA POLBAN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/css/font-awesome.min.css">
    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/themes/flat-blue.css">
    <style type="text/css">
        body.login-page .login-form input {
            border: 1px solid #CCF;
        }
    </style>
</head>

<body class="flat-blue login-page">
    <div class="container">
        <div class="login-box">
            <div>
                <div class="login-form row">
                    <div class="col-sm-12 text-center login-header">
                        <!-- <i class="login-logo fa fa-connectdevelop fa-5x"></i> -->

                    </div>
                    <div class="col-sm-12">
                        <div class="login-body text-center">


                           <h4 class="login-title" style="margin-top: -5px;">Sistem Informasi Pengadaan Alat</h4>
                           <img src="<?=base_url()?>assets/img/opl.png"  class="login-logo" width="25%">
                           <h4 class="login-title" style="margin-bottom: -5px;">(POLBAN)</h4>

                       </div>
                   </div>
                   <div class="col-sm-12">
                    <div class="login-body">
                        <?php if($this->session->flashdata('data')){ ?>
                        <div class="alert fresh-color alert-danger" role="alert">
                        <strong>Gagal Login !</strong> 
                        </div>
                       <?php } ?>
                        <form method="POST" action="<?=site_url()?>Site/login">
                            <div class="control">
                                <input type="text" class="form-control" placeholder="Username" name="user-name" style="padding: 10px;"/>
                            </div>
                            <div class="control">
                                <input type="password" class="form-control" placeholder="Password" name="pass-word"  style="padding: 10px;" />
                            </div>
                            <div class="login-button text-center">
                                <input type="submit" class="btn btn-primary" value="Login">
                            </div>
                        </form>
                    </div>
                    <div class="login-footer">
                        <span class="text-right"><a href="<?=site_url()?>" class="color-white">Lupa password?</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Javascript Libs -->
</body>

</html>
