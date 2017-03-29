<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Top Product Design</title>
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
   </style>
   <div class="container-fluid">
    <span>Top 50</span>
    <br />
        <!--<?php
        $view=mysql_query("SELECT nama,xnilai FROM screenrelation xnilai,anggota nama WHERE xnilai.idpeserta='$idpeserta' and xnilai.idscreener=nama.idscreen;");
        $i = 1;
        while($row=mysql_fetch_array($view)){?>
        <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $row['nama'];?></td>
            <td><?php echo $row['nilai'];?></td>
        </tr>
        <?php
        $i++;
        $nilai=$row['nilai'];
        $total=$total+$nilai;}?>-->
        <br />
        <br />
        <h1 class="big" style="text-align: center">Top Product Design</h1>
        <table id="table" class="table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <!-- <th>No. Urut</th> -->
                    <th style="width: 5px;"></th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Judul Ide</th>
                    <th>Phone</th>
                    <th>Kategori</th>
                              <!-- <th>Nilai Ide&Desk</th>
                              <th>Nilai Manfaat</th> -->
                              <th>Nilai Total</th>
                              <th>Aksi</th>
                              <!-- <th>Rata-Rata</th> -->
                          </tr>
                      </thead>
                      <tbody>  

                        <?php  $i=0; foreach ($userss as $users) {?>
                        <tr>
                            <!-- <td><?php echo $c++;?></td> -->
                            <td></td>
                            <td><?php echo  $users['first_name'] ; ?></td>  
                            <td> <?php echo  $users['email'] ; ?></td>  
                            <td> <?php echo  $users['ideatitle'] ; ?></td>   
                            <td> <?php echo  $users['phone'] ; ?></td>
                            <td> <?php echo  $users['ideatype'] ; ?></td>
                            <td> <?php echo  (int)$users['xnilai'] ; ?></td>
                            <?php if($users['top'] == '1'):?>
                            <td> Top 100</td>
                        <?php else:?> 
                            <td><button onclick="pindah('<?php echo  $users['id'] ; ?>')" cob="<?php echo $users['ideatype']; ?>" gantip="<?php echo $users['id']; ?>" class="status_checks btn <?php echo ($users['top'])? 'btn-success' : 'btn-danger'?>"><?php echo ($users['top'])? 'Done' : 'Bagikan'?></button></td>
                            <?php endif;?> </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
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
                            "aaSorting": [[6, "desc"]],
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
    //                 "pageLength":100,
    //                 "aaSorting": [[4, "desc"]],
    //                 "lengthMenu": [[20, 10, 50, 100, 300, -1], [20, 10, 50, 100, 300, "All"]] 
    //             });
    //         });
    //     },300);

    // });
    function pindah(id)
    {

        $('#form')[0].reset();
        $.ajax({
            url: "<?php echo site_url('topsera_contr/ajax_edit/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data,response)
            {
                console.log(data);
                // return false;
                // name="rusim"
                var status = (thisButton.hasClass("btn-success")) ? '1' : '0';
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
                //     alert('Data Tidak Lengkap');
                // }
                $('#modal_form').modal('show');

                $('[name="judul"]').val(data[0].ideatype);
                $('[name="top"]').val(data[0].top);
                $('[name="spes"]');
                $('[name="spe"]');
                $('.modal-title').text(data[0].ideatype);  
                
            },
        });
    }

    function update()
    {
        url = "<?php echo site_url('topsera_contr/updatecntr')?>";
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
            url = "<?php echo site_url('topsera_contr/updatestatus')?>";
            $.ajax({
                type:"POST",
                url: url,
                data: $('#form').serialize() + '&top=' + status,
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
                <h3 class="modal-title">Top 100</h3>
            </div>
            <div class="modal-body form">
              <form id="form" role="form" method="post" class="form-horizontal formclass">
                  <input type="hidden" id="hiddenid" value="" name="id">
                  <input type="hidden" id="hiddenid" value="" name="top">
                  <input type="hidden" id="hiddenid" value="9" name="spes">
                  <input type="hidden" id="hiddenid" value="4" name="spe">
                  <input type="hidden" class="judul" name="judul[]" value="">
                  <input type="hidden" class="judul" name="judul" value="">
                  <input type="hidden" id="hiddenid" value="<?=$user['idscreen'];?>" name="scren">
                  
                  <?php if($user['level'] == '2' || $user['level'] == '4' || $user['level'] == '5'): ?>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Screener</th>
                                <th>
                                    <div class="checkbox checkbox-success checkbox-inline disabled">
                                        <input type="checkbox" checked="checked" value="1" required name="checkboxInline1" disabled>
                                        <label for="checkboxInline1"></label>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody><?php foreach ($level as $scren) { ?>
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
                    
                <?php endif; ?>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button>
                <button name="rusim" type="button" onclick="save()" class="btn btn-success">Save</button>
                <button name="rubah" type="button" onclick="update()" class="btn btn-success" data-dismiss="modal">Nilai</button>
            </div>
        </form>
    </div>
</div>
</div>
<footer class="page-footer center-on-small-only">
    <p style="text-align: center;margin: 0;padding-bottom: 15px;">BLACKINNOVATION © COPYRIGHT 2016</p>
</footer>
<div id="loading"></div>
</body>
</html>