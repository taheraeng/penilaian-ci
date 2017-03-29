<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Top 100</title>
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
        <h1 class="big" style="text-align: center">Top 100</h1>
        <table id="table" class="table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No. Urut</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Judul Ide</th>
                    <th>Kategori</th>
                    <th>Phone</th>
                              <!-- <th>Nilai Ide&Desk</th>
                              <th>Nilai Manfaat</th> -->
                              <th>Nilai Total</th>
                              <th>Aksi</th>
                              <!-- <th>Rata-Rata</th> -->
                          </tr>
                      </thead>
                      <tbody>  

                        <?php $c=0; $i=0; foreach ($userss as $users) {?>
                        <tr>
                            <!-- <td><?php echo $c++;?></td>  -->
                            <td></td>
                            <td><?php echo  $users['first_name'] ; ?></td>  
                            <td> <?php echo  $users['email'] ; ?></td>  
                            <td> <?php echo  $users['ideatitle'] ; ?></td>
                            <td> <?php echo  $users['ideatype'] ; ?></td>   
                            <td> <?php echo  $users['phone'] ; ?></td>
                            <td> <?php echo  (int)$users['xnilai'] ; ?></td>
                            <td><button diu="<?=$user['idscreen'];?>" ganti="<?php echo $users['id']; ?>" class="statusdoang btn <?php echo ($users['tiga'])? 'btn-success' : 'btn-danger'?>"><?php echo ($users['tiga'])? 'Top 30' : 'Take It'?></button></td> </tr>
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
                        $('.statusdoang').click(function()
                        {
                            var status = ($(this).hasClass("btn-success")) ? '0' : '1';
            // var pesan = (status=='0')? 'Non-aktifkan' : 'Aktifkan';
            // if(confirm("Ganti "+ pesan)){
                var current_element = $(this);
                url = "<?php echo site_url('toppd_contr/updatestatus')?>";
                $.ajax({
                    type:"POST",
                    url: url,
                    data: {id:$(current_element).attr('ganti'),stat:$(current_element).attr('diu'),status : status},
                    success: function(response,data)
                    {   
                        location.reload();
                        console.log(response,data);
                    }
                });
            //}
        });      
                    });
                    function simpan()
                    {

                    }
                </script>

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

        //             $(document).ready(function() {

        //               $('#table').DataTable({
        //                 "pageLength":30,
        //                 "lengthMenu": [[20, 30, 50, -1], [20, 30, 50, "All"]] 
        //                 ,  "aaSorting": [[5, "desc"]]
        //             });
        //     table = $('#table').DataTable({ 

        //         "processing": true, 
        //         "serverSide": true,
        //         "pageLength" : 100,
        //         "order": [], 


        //         "ajax": {
        //             "url": " 
        //             "type": "POST"
        //         },


        //         "columnDefs": [
        //         { 
        //             "targets": [ -1 ], 
        //             "orderable": false, 
        //         },
        //         ],

        //     });


        //     $('.datepicker').datepicker({
        //         autoclose: true,
        //         format: "yyyy-mm-dd",
        //         todayHighlight: true,
        //         orientation: "top auto",
        //         todayBtn: true,
        //         todayHighlight: true,  
        //     });

        // });



        function add_person()
        {
            save_method = 'add';
            $('#form')[0].reset(); 
            $('.form-group').removeClass('has-error'); 
            $('.help-block').empty(); 
            $('#modal_form').modal('show'); 
            $('.modal-title').text('Add Person'); 
        }

        function edit_person(id)
        {
            save_method = 'update';
            $('#form')[0].reset(); 
            $('.form-group').removeClass('has-error'); 
            $('.help-block').empty(); 


            $.ajax({
                url : "<?php echo site_url('person/ajax_edit/')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {

                    $('[name="id"]').val(data.id);
                    $('[name="firstName"]').val(data.firstName);
                    $('[name="lastName"]').val(data.lastName);
                    $('[name="gender"]').val(data.gender);
                    $('[name="address"]').val(data.address);
                    $('[name="dob"]').datepicker('update',data.dob);
                    $('#modal_form').modal('show'); 
                    $('.modal-title').text('Edit Person'); 

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function reload_table()
        {
            table.ajax.reload(null,false);  
        }

        function save()
        {
            $('#btnSave').text('saving...'); 
            $('#btnSave').attr('disabled',true);  
            var url;

            if(save_method == 'add') {
                url = "<?php echo site_url('person/ajax_add')?>";
            } else {
                url = "<?php echo site_url('person/ajax_update')?>";
            }


            $.ajax({
                url : url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data)
                {

                    if(data.status) 
                    {
                        $('#modal_form').modal('hide');
                        reload_table();
                    }

                    $('#btnSave').text('save'); 
                    $('#btnSave').attr('disabled',false);  


                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                    $('#btnSave').text('save'); 
                    $('#btnSave').attr('disabled',false);  

                }
            });
        }

        function pindah(id)
        {

            $('#form')[0].reset();
            $.ajax({
                url: "<?php echo site_url('toppd_contr/ajax_edit/') ?>/" + id,
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
                // else if(dataidea=='spesial')
                // {
                //     $('#'+dataidea).show();
                //     $('#modal_form').modal('show');
                // }
                // else
                // { 
                //     alert('Data Tidak Lengkap');
                // }

                $('[name="judul"]').val(data[0].ideatype);
                $('[name="status"]').val(data.status);
                $('[name="spes"]');
                $('[name="spe"]');
                //$('.modal-title').text(data[0].ideatype);  
                
            },
        });
        }

        function delete_person(id)
        {
            //if(confirm('Terima Data Ini..'))
            //{

                $.ajax({
                    url : "<?php echo site_url('ntox_contr/ajax_delete')?>/"+id,
                    type: "POST",
                    dataType: "JSON",
                    //error: function (jqXHR, textStatus, errorThrown)
                    //{
                      //  alert('Terjadi Error.. segera hubungi ambulance');
                    //}
                });

            //}
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
                      <input type="hidden" id="hiddenid" value="" name="status">
                      <input type="hidden" id="hiddenid" value="9" name="spes">
                      <input type="hidden" id="hiddenid" value="4" name="spe">
                      <input type="hidden" class="judul" name="judul[]" value="">
                      <input type="hidden" class="judul" name="judul" value="">
                      <input type="hidden" id="hiddenid" value="<?=$user['idscreen'];?>" name="scren">

                      <?php if($user['level'] == '2'): ?>

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
                    <button name="rubah" type="button" onclick="update()" class="btn btn-success" data-dismiss="modal">Eliminasi</button>
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