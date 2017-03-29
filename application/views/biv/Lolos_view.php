<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>X to 100</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link href="<?php echo base_url('bt4/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('bt4/css/mdb.min.css')?>" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('bt4/radio/build.css')?>"/>
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url('bt4/css/styletable.css')?>" rel="stylesheet">
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
     #loading { background: #fff; position:fixed; width:100%; height:100%; z-index:9999; top:100px; }
 </style>
 <div class="container-fluid">
     <span>100 > 50</span>
     <br />
     <br />
     <br />
     <h1 class="big" style="text-align: center">X to 100</h1>

     <div class="table-responsive">
        <table id="table" class="table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr >
                <th>No.</th>
                    <th>Nama</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>File</th>
                    <th>Deskripsi</th>
                    <th>Acc</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody >  
                <?php $c = 1; foreach ($userss as $users) {?>
                <tr> 
                <td></td>
                  <td><?php echo  $users['first_name'] ; ?></td> 
                  <td> <?php echo  $users['ideatitle'] ; ?></td>
                  <td> <?php echo  $users['ideatype'] ; ?></td>
                  <td> <?php echo  $users['ideafile'] ; ?></td>
                  <td> <?php echo  substr($users['ideadesc'],0,20) ; ?></td>
                  <td> <?php echo  $users['nama'] ; ?>
                  <h6><?php echo  $users['creat'] ; ?></h6></td>
                  <td><button onclick="pindah('<?php echo  $users['id'] ; ?>')" cob="<?php echo $users['ideatype']; ?>" gantip="<?php echo $users['id']; ?>" class="status_checks btn <?php echo ($users['status'])? 'btn-success' : 'btn-danger'?>"><?php echo ($users['status'])? 'Bagikan' : 'Done'?></button></td>       
                  <?php } ?>
              </tbody>
          </table>
      </div>
  </div>
  <script type="text/javascript" src="<?php echo base_url('bt4/js/jquery-2.2.3.min.js')?>"></script>
  <script type="text/javascript" src="<?php echo base_url('bt4/js/tether.min.js')?>"></script>
  <script type="text/javascript" src="<?php echo base_url('bt4/js/mdb.min.js')?>"></script>
  <script src="<?php echo base_url('bt4/js/bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
  <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
  <script type="text/javascript">
    $(document).ready(function(){
        $('.status_checks').click(function()
        {
            thisButton = $(this);
        });      
    });
</script>
<script type="text/javascript">
    var save_method;
    var table;

    var thisButton;
    $(document).ready(function() {
                        var t = $('#table').DataTable( {
                            "columnDefs": [ {
                                "searchable": false,
                                "orderable": false,
                                
                                "targets": 0
                            } ],
                            "aaSorting": [[5, "desc"]],
                            "pageLength":100,
                            "lengthMenu": [[20, 10, 50, 100, 300, -1], [20, 10, 50, 100, 300, "All"]],
                        } );
                        
                        t.on( 'order.dt search.dt', function () {
                            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                                cell.innerHTML = i+1;
                            } );
                        } ).draw();
                    } );
    // $(document).ready(function() {
    //     $('#table').hide();
    //     var image = "<?php echo base_url(). 'assets/load/loading2.gif'; ?>";
    //     $('#loading').html("<center><img src='"+image+"' /></center>");
    //     setTimeout(function()
    //     {
    //         $('#loading').fadeOut('slow',function(){
    //             $('#table').show();
    //             $('#table').DataTable({
    //                 "pageLength":20,
    //                 "lengthMenu": [[20, 10, 50, 100, 300, -1], [20, 10, 50, 100, 300, "All"]] 
    //             });
    //         });
    //     },300);

    // });
    function pindah(id)
    {

        $('#form')[0].reset();
        $.ajax({
            url: "<?php echo site_url('lolos_contr/ajax_edit/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data,response)
            {
                console.log(data);
                // return false;
                // name="rusim"
                var status = (thisButton.hasClass("btn-success")) ? '0' : '1';
                if(status == '0')
                {
                    $('[name="rubah"]').toggle(false);
                    $('[name="rusim"]').toggle(true);
                }else
                {
                    $('[name="rubah"]').toggle(true);
                    $('[name="rusim"]').toggle(false);
                }
                //$('[name="rubah"]').toggle(false);
                $('[name="id"]').val(id);
                var dataidea = data[0].ideatype;
                var skrin = data.idscreener;

                $.each(data,function(key,value){
                    $('#checkbox' + value.idscreener).prop("checked", true);
                    //console.log(key);
                });
                
                dataidea = dataidea.replace(" ","");
                dataidea = dataidea.replace(" ","");
                dataidea = dataidea.replace(",","");
                dataidea = dataidea.toLowerCase();

                if(dataidea=='iotproductdesign')
                {
                    $('#'+dataidea).children().show();
                    $('#modal_form').modal('show');
                }
                else if(dataidea=='iot')
                {
                    $('#'+dataidea).show();
                    $('#modal_form').modal('show');
                }
                else if(dataidea=='productdesign')
                {
                    $('#'+dataidea).show();
                    $('#modal_form').modal('show');
                }
                else
                { 
                    alert('Data Tidak Lengkap');
                }

                $('[name="judul"]').val(data[0].ideatype);
                $('[name="status"]').val(data.status);
                $('[name="spes"]');
                $('[name="spe"]');
                $('.modal-title').text(data[0].ideatype);  
                
            },
        });
    }

    function update()
    {
        url = "<?php echo site_url('lolos_contr/updatecntr')?>";
        $.ajax({
            type:"POST",
            url: url,
            data: $('#form').serialize(),
                    //data : {id:$(current_element).attr('gantip'),status : status},
                    //dataType: "JSON",
                    success: function(response)
                    {
                        location.reload();
                        console.log(response);
                    },
                    error : function()
                    {
                        alert("Gagal Menyimpan");
                    }
                });
    }

    function save()
    {
        var status = (thisButton.hasClass("btn-success")) ? '0' : '1';
        {
            var current_element = $(this);
            url = "<?php echo site_url('lolos_contr/updatestatus')?>";
            $.ajax({
                type:"POST",
                url: url,
                data: $('#form').serialize() + '&status=' + status,
                    //data : {id:$(current_element).attr('gantip'),status : status},
                    //dataType: "JSON",
                    success: function(response)
                    {
                        location.reload();
                        console.log(response);
                    },
                    error : function()
                    {
                        alert("Gagal Menyimpan");
                    }
                });
        }
    }
</script>
<div class="modal fade" id="modal_form" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Pilih Screener</h3>
            </div>
            <div class="modal-body form">
              <form id="form" role="form" method="post" class="form-horizontal formclass">
                  <input type="hidden" id="hiddenid" value="" name="id">
                  <input type="hidden" id="hiddenid" value="" name="status">
                  <input type="hidden" id="hiddenid" value="9" name="spes">
                  <input type="hidden" id="hiddenid" value="4" name="spe">
                  <input type="hidden" class="judul" name="judul[]" value="">
                  <input type="hidden" class="judul" name="judul" value="">
                  <input type="hidden" id="hiddenid" value="<?=$user['idscreen'];?>" name="scren">
                  <div id="iotproductdesign" class="row">
                    <?php if($user['level'] == '2' || $user['level'] == '4'): ?>
                        <div id="iot" style="display:none;" class="col-md-6">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>IOT</th>
                                        <th>
                                            <div class="checkbox checkbox-success checkbox-inline disabled">
                                                <input type="checkbox" checked="checked" value="1" required name="checkboxInline1" disabled>
                                                <label for="checkboxInline1"></label>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody><?php foreach ($iot as $scren) { ?>
                                    <tr>
                                        <td><?php echo  $scren['nama'] ; ?></td>
                                        <!-- <input type="checkbox" name="task_id" value="<?php echo $row->task_id ;?>" <?php echo set_checkbox('task_id', $row->task_id); ?> ><?php echo $row->task_name?> -->
                                        <td>
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                <input type="checkbox" id="checkbox<?php echo  $scren['idscreen'] ; ?>" value="<?php echo  $scren['idscreen'] ; ?>" required name="screener[]">
                                                <label for="checkbox<?php echo  $scren['idscreen'] ; ?>"></label>
                                            </div>
                                        </td>
                                    </tr><?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                    <?php if($user['level'] == '2' || $user['level'] == '4' || $user['level'] == '5'): ?>
                        <div id="productdesign" style="display:none;" class="col-md-6">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product Design</th>
                                        <th>
                                            <div class="checkbox checkbox-success checkbox-inline disabled">
                                                <input type="checkbox" checked="checked" value="1" required name="checkboxInline1" disabled>
                                                <label for="checkboxInline1"></label>
                                            </div>
                                        </th> 
                                    </tr>
                                </thead>
                                <tbody><?php foreach ($prod as $scren) { ?>
                                    <tr>
                                        <td><?php echo  $scren['nama'] ; ?></td>
                                        <td>
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                <input type="checkbox" id="checkbox<?php echo  $scren['idscreen'] ; ?>" value="<?php echo  $scren['idscreen'] ; ?>" required name="screener[]">
                                                <label for="checkbox<?php echo  $scren['idscreen'] ; ?>"></label>
                                            </div>
                                        </td>
                                    </tr><?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button>
                <button name="rusim" type="button" onclick="save()" class="btn btn-success">Save</button>
                <button name="rubah" type="button" onclick="update()" class="btn btn-success" data-dismiss="modal">Eliminasi</button>
            </div>
        </form>
    </div>
</div>
</div>
<footer class="page-footer center-on-small-only">
    <p style="text-align: center;margin: 0;padding-bottom: 15px;">BLACKINNOVATION © COPYRIGHT 2016</p>
</footer>
<div id="lodading"></div>
</body>
</html>