<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Top 30</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link href="<?php echo base_url('bt4/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('bt4/css/mdb.min.css')?>" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css" rel="stylesheet">
    <!--ss
    https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css
    https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css
https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css
//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css
sd-->
<link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="<?php echo base_url('bt4/css/styletable.css')?>" rel="stylesheet">
</head> 
<style>
    #big{
        font-size: 40px;
    }
</style>
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
        <h1 class="big" style="text-align: center">Top 30</h1>
        <table id="table" class="table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr>
                <!-- <th>No. Urut</th> -->
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Judul Ide</th>
                    <th>Phone</th>
                              <!-- <th>Nilai Ide&Desk</th>
                              <th>Nilai Manfaat</th> -->
                              <th>Nilai Total</th>
                              <!-- <th>Rata-Rata</th> -->
                          </tr>
                      </thead>
                      <tbody>  

                        <?php $c=0; $i=0; foreach ($userss as $users) {?>
                        <tr>
                        <!-- <td><?php echo $c++;?></td>  -->
                          <td><?php echo  $users['first_name'] ; ?></td>  
                          <td> <?php echo  $users['email'] ; ?></td>  
                          <td> <?php echo  $users['ideatitle'] ; ?></td>   
                          <td> <?php echo  $users['phone'] ; ?></td>
         <td> <?php echo  (int)$users['xnilai'] ; ?></td>    </tr>
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

    var save_method;
    var table;

    $(document).ready(function() {

      $('#table').DataTable({
        "pageLength":30,
          "lengthMenu": [[20, 30, 50, -1], [20, 30, 50, "All"]] 
          ,  "aaSorting": [[4, "desc"]]
      });
         /*   table = $('#table').DataTable({ 

                "processing": true, 
                "serverSide": true,
                "pageLength" : 100,
                "order": [], 


                "ajax": {
                    "url": " 
                    "type": "POST"
                },


                "columnDefs": [
                { 
                    "targets": [ -1 ], 
                    "orderable": false, 
                },
                ],

            });*/


            $('.datepicker').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd",
                todayHighlight: true,
                orientation: "top auto",
                todayBtn: true,
                todayHighlight: true,  
            });

        });



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
    <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Person Form</h3>
                </div>
                <div class="modal-body form">
                    <form action="#" id="form" class="form-horizontal">
                        <input type="hidden" value="" name="id"/> 
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">First Name</label>
                                <div class="col-md-9">
                                    <input name="firstName" placeholder="First Name" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Last Name</label>
                                <div class="col-md-9">
                                    <input name="lastName" placeholder="Last Name" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Gender</label>
                                <div class="col-md-9">
                                    <select name="gender" class="form-control">
                                        <option value="">--Select Gender--</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Address</label>
                                <div class="col-md-9">
                                    <textarea name="address" placeholder="Address" class="form-control"></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Date of Birth</label>
                                <div class="col-md-9">
                                    <input name="dob" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="page-footer center-on-small-only">
        <p style="text-align: center;margin: 0;padding-bottom: 15px;">BLACKINNOVATION © COPYRIGHT 2016</p>
    </footer>
</body>
</html>