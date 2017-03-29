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
  $this->load->view('home/Menu.php');
  ?>
  <style>
    .big{
      font-size: 40px;
    }
  </style>
  <?php
  $this->load->view('home/Depan.php');
  ?>
  <footer class="page-footer center-on-small-only">
    <p style="text-align: center;margin: 0;padding-bottom: 15px;">BLACKINNOVATION © COPYRIGHT 2016</p>
  </footer>
  <script type="text/javascript" src="<?php echo base_url('bt4/js/jquery-2.2.3.min.js')?>"></script>
  <script type="text/javascript" src="<?php echo base_url('bt4/js/tether.min.js')?>"></script>
  <script type="text/javascript" src="<?php echo base_url('bt4/js/mdb.min.js')?>"></script>
  <script src="<?php echo base_url('bt4/js/bootstrap.min.js')?>"></script>

  <?php if($this->session->flashdata('flash_message')) { ?>
    <script>
      $(document).ready(function() {
        $('#myModal').modal('show')
      });
    </script>
  <?php } ?>
</body>
</html>