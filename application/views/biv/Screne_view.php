<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lihat Nilai</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link href="<?php echo base_url('bt4/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('bt4/css/font-awesome.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('bt4/css/mdb.min.css') ?>" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('bt4/radio/build.css') ?>"/>
        <!--ss
        https://cdnjs.cloudflare.com/ajax/libs/flat-ui/2.3.0/css/flat-ui.css
        https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css
        https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css
    https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css
    //cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css
    sd-->
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css') ?>" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url('bt4/css/styletable.css') ?>" rel="stylesheet">
    <style>
        #big{
            font-size: 40px;
        }
    </style>
</head>
<body>
    <?php
    $this->load->view('home/Menu.php');
    ?>
    <style>
        table { table-layout: fixed; }
        table th, table td { overflow: hidden; }
    </style>
    <div class="container-fluid">
        <span>Lihat Nilai</span>
        <br />
             <!--<button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Add Person</button>
             <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>-->
             <br />
             <br />
             <h1 class="big" style="text-align: center">Lihat Nilai</h1>
             <div class="table-responsive">
                <table id="table" class="table table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 11px;">No.Urut</th>
                            <th>Nama Screener</th>
                            <th>Judul Ide</th>
                            <th>Nama Peserta</th>
                            <th>Nilai</th>
                            <th>Komentar</th>
                            <th>Time</th>
                            
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>  

                        <?php $c=1; $i=0; foreach ($userss as $users) {?>

                        <tr> 
                            <td></td>
                            <td><?php echo  $users['nama'] ; ?></td>
                            <!-- <td><?php echo  $users['email'] ; ?></td>  -->   
                            <td> <?php echo  $users['ideatitle'] ; ?></td> 
                            <td name="id" value="<?php echo  $users['idpeserta'] ; ?>"> <?php echo  $users['first_name'] ; ?></td>
                            <?php if($users['xnilai'] == 0):?>
                              <td> Belum menilai </td>
                          <?php else:?>   
                              <td> <?php echo  $users['xnilai'] ; ?></td>
                          <?php endif;?>
                          <?php if($users['note'] == ''):?>
                            <td> Tidak ada komentar </td>
                        <?php else:?> 
                          <td><?php echo substr($users['note'],0,20);?><a onclick="pindah('<?php echo  $users['idrelation'] ; ?>')"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                      <?php endif;?>
                      <td><?php echo $users['timecreat'];?></td>

                  </tr>
                  <!-- <td><a class="btn btn-md btn-danger" href="javascript:void(0)" title="Edit" onclick="edit_person('<?php echo  $users['id'] ; ?>')">Nilai</a></td>   -->  
                  <?php $i++;} ?>
              </tbody>
          </table>
      </div>
  </div>

  <script type="text/javascript" src="<?php echo base_url('bt4/js/jquery-2.2.3.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('bt4/js/tether.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('bt4/js/mdb.min.js') ?>"></script>
  <script src="<?php echo base_url('bt4/js/bootstrap.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js') ?>"></script>
  <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>


  <script type="text/javascript">

    var save_method;
    var table;
    $(document).ready(function() {
        var t = $('#table').DataTable( {
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,

                "targets": 0
            } ],
            "aaSorting": [[4, "desc"]],
            "pageLength":100,
            "lengthMenu": [[20, 10, 50, 100, 300, -1], [20, 10, 50, 100, 300, "All"]],
        } );

        t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    } );

function pindah(idrelation)
    {

        $('#form')[0].reset();
        $.ajax({
            url: "<?php echo site_url('screne_contr/ajax_edit/') ?>/" + idrelation,
            type: "GET",
            dataType: "JSON",
            success: function (data,response)
            {
                console.log(data);
                var dataidea = data[0].ideatype;
                var skrin = data.idscreener;

                $.each(data,function(key,value){
                    $('#checkbox' + value.idscreener).prop("checked", true);
                });
                
                // dataidea = dataidea.replace(" ","");
                // dataidea = dataidea.replace(" ","");
                // dataidea = dataidea.replace(",","");
                // dataidea = dataidea.toLowerCase();

                // if(dataidea=='iotproductdesign')
                // {
                //     $('#'+dataidea).children().show();
                //     $('#modal_form').modal('show');
                // }
                // else if(dataidea=='iot')
                // {
                //     $('#'+dataidea).show();
                //     $('#modal_form').modal('show');
                // }
                // else if(dataidea=='productdesign')
                // {
                //     $('#'+dataidea).show();
                //     $('#modal_form').modal('show');
                // }
                // else
                // { 
                //     alert('Data Tidak Dilengkapi Kategori ');
                // }

                $('#imglink').attr("href","http://blackinnovation.blackxperience.com/assets/file/"+data[0].ideafile);
                if(data[0].ideafile!=null){
                    if(data[0].ideafile.includes("jpg") || data[0].ideafile.includes("jpeg") || data[0].ideafile.includes("gif") || data[0].ideafile.includes("png")){
                      $('#ideaimg').attr("src","http://blackinnovation.blackxperience.com/assets/file/"+data[0].ideafile);
                  }else{
                     $('#ideaimg').attr("src","<?php echo base_url('assets/dl.png') ?>");
                 }
             }
             else{
                 $('#ideaimg').attr("src","");
                 $('#imglink').attr("href","");
             }
             $('[name="judul"]').val(data[0].ideatype);
             $('[name="status"]').val(data.status);
             $('[name="descip"]').text(data[0].note);
             $('#modal_form').modal('show');
             $('[name="spes"]');
             $('[name="spe"]');
             $('.modal-title').text(data[0].ideatype);  
             $('.modal-judul').text(data[0].xnilai);  
             
         },
     });
    }

</script>
<div class="modal fade" id="modal_form" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <!-- <h3 class="modal-judul"></h3> -->
            </div>
            <div class="modal-body form">
              <form id="form" role="form" method="post" class="form-horizontal formclass">
                  <input type="hidden" id="hiddenid" value="" name="id">
                  <input type="hidden" id="hiddenid" value="" name="status">
                  <input type="hidden" id="hiddenid" value="9" name="spes">
                  <input type="hidden" id="hiddenid" value="4" name="spe">
                  <input type="hidden" class="judul" name="judul[]" value="">
                  <input type="hidden" class="judul" name="judul" value="">
                  <table>
                      <tbody>
                          <span name="descip"></span>
                      </tbody>
                  </table>
              </div>
              <div class="modal-footer">
                <h3 class="modal-titlse"></h3>
            </div>
        </form>
    </div>
</div>
</div>

    <footer class="page-footer center-on-small-only">
        <p style="text-align: center;margin: 0;padding-bottom: 15px;">BLACKINNOVATION © COPYRIGHT 2016</p>
    </footer>
</body>
</html>