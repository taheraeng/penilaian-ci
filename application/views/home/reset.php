<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Screening</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
  <link href="<?php echo base_url('bt4/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?php echo base_url('bt4/css/font-awesome.css') ?>" rel="stylesheet">
  <link href="<?php echo base_url('bt4/css/mdb.min.css') ?>" rel="stylesheet">
  <link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('bt4/radio/build.css') ?>"/>
  <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css') ?>" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="<?php echo base_url('bt4/css/style.css') ?>" rel="stylesheet">
  <style rel="stylesheet">
    .view {
      background:url("<?php echo base_url('bt4/img/hitam.jpg')?>")no-repeat center center fixed;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }
  </style>
</head>
<body>
<?php
/*$this->load->view('home/Menu.php');
*/?>
<style>
  .big{
    font-size: 40px;
  }
</style>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="text-center" style="color: #d6d6d6">Reset Password</h4>
        <p style="color: #a1a1a1">
          <?php echo @$this->session->flashdata('flash_message'); ?>
          <?php echo @$flash; ?>
        </p>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url();?>akun/reset" method="post">
          <div class="md-form">
            <i class="fa fa-lock prefix"></i>
            <input type="password" name="new_password" id="form41" class="form-control">
            <label for="form41">New Password</label>
          </div>
          <div class="md-form">
            <i class="fa fa-lock prefix"></i>
            <input type="password" name="confirm_password" id="form42" class="form-control">
            <label for="form42">Confirm Password</label>
          </div>
        </div>
        <div class="modal-footer">
          <div class="text-xs-center">
            <button id="kecil-but" class="btn" type="submit">Reset</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="view hm-black-strong">
  <div class="full-bg-img flex-center">
    <!--<ul class="animated fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <div class="jumbotron text-xs-center wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
            <h1 class="h1-responsive">Total : <?php /*echo $jumlahall; */?> Ideas</h1></li>
            <li>
              <div class="col-md-6">
                <div class="card card-primary text-xs-center">
                  <div class="card-block" id="gede-but">
                    <blockquote class="card-blockquote">
                      <small>Product Design</small>
                      <span><?php /*echo $jumlahpd; */?></span>
                    </blockquote>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card card-primary text-xs-center">
                  <div class="card-block" id="gede-but">
                    <small>Internet of Things</small>
                    <span><?php /*echo $jumlah; */?></span>
                  </div>
                </div>
              </div>
            </li>
          </div>
        </div>
      </div>
    </div>
  </ul>-->
</div>
</div>
 <footer class="page-footer center-on-small-only">
   <p style="text-align: center;margin: 0;padding-bottom: 15px;">BLACKINNOVATION © COPYRIGHT 2016</p>
 </footer>
 <script type="text/javascript" src="<?php echo base_url('bt4/js/jquery-2.2.3.min.js')?>"></script>
 <script type="text/javascript" src="<?php echo base_url('bt4/js/tether.min.js')?>"></script>
 <script type="text/javascript" src="<?php echo base_url('bt4/js/mdb.min.js')?>"></script>
 <script src="<?php echo base_url('bt4/js/bootstrap.min.js')?>"></script>
<script>
  $(document).ready(function() {
    $('#myModal').modal('show')
  });
</script>
 </body>
 </html>