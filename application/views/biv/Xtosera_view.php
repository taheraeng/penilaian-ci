<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nilai</title>
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
        <span>X > 50</span>
        <br />
             <!--<button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Add Person</button>
             <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>-->
             <br />
             <br />
             <h1 class="big" style="text-align: center">Nilai</h1>
             <div class="table-responsive">
                <table id="table" class="table table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>File</th>
                            <?php if($user['level'] = '4'): ?>
                            <th>Screener</th>
                            <?php endif; ?>
                            <th>Nilai</th>
                            <?php if($user['level'] != '3'): ?>
                            <th>Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>  

                        <?php foreach ($userss as $users) {?>
                        <tr> 
                          <td><?php echo  $users['first_name'] ; ?></td>  
                          <td> <?php echo  $users['ideatitle'] ; ?></td>  
                          <td> <?php echo  $users['ideatype'] ; ?></td>  
                          <td> <?php echo  $users['ideafile'] ; ?></td>
                            <?php if($user['level'] = '4'): ?>
                                <td> <?php echo  $users['idscreener'] ; ?></td>
                            <?php endif; ?>
                          <td> <?php echo  $users['xnilai'] ; ?></td>
                          <?php if($user['level'] != '3'): ?>    
                              <td><a class="btn btn-md btn-danger" <?php if($user['level'] = '4') { echo 'data-screener="' . $users["idscreener"] . '"'; } ?> href="javascript:void(0)" title="Edit" onclick="edit_person('<?php echo  $users['id'] ; ?>')">Nilai</a></td>
                          <?php endif; ?>
                          <?php } ?>
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
            var tmpScreener;

            $(document).ready(function () {
                $(document).on('click', '[data-screener]', function () {
                    tmpScreener = $(this).data('screener');

                    $('#modal_form').on('shown.bs.modal', function () {
                        $('#supper').val(tmpScreener);
                    });
                });

              $('#table').DataTable({
                  "lengthMenu": [[20, 10, 50, -1], [20, 10, 50, "All"]] 

              });

              /*  table = $('#table').DataTable({
                      "lengthMenu": [[20, 10, 50, -1], [20, 10, 50, "All"]],
                    "processing": true,
                    "serverSide": true,
                    "order": [],
                    "ajax": {
                        "url": "<?php echo site_url('xtosera_contr/ajax_list') ?>",
                        "type": "POST"
                    },
                    "columnDefs": [
                        {
                            "targets": [-1],
                            "orderable": true
                        }
                    ]
                });
                */

                $('.datepicker').datepicker({
                    autoclose: true,
                    format: "yyyy-mm-dd",
                    todayHighlight: true,
                    orientation: "top auto",
                    todayBtn: true,
                    todayHighlight: true,
                });
                $('#form').submit(function (e) {

                    e.preventDefault();
                    $.ajax({
                        url: "<?php echo site_url('xtosera_contr/save') ?>",
                        type: 'POST',
                        data: $('#form').serialize(),
                        success: function (response) {

                            $('#modal_form').modal('hide');
                            //reload_table();
                            location.reload();
                            //console.log(response);
                        },
                        error: function () {
                        }
                    });

                    return false;

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

                var i;
                for (i = 1; i < 29; i++) {
                    $('#inlineRadio' + i).prop("checked", false);
                }

                $.ajax({
                    url: "<?php echo site_url('xtosera_contr/ajax_edit/') ?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function (data)
                    {
                        console.log(data);

                        $('[name="id"]').val(data.id);
                        $('[name="scren]').val(data.idscreen),
                        $('[name="namaper"]').text(data.first_name);
                        $('[name="deskrip"]').text(data.ideadesc);
                        $('[name="gender"]').val(data.email);
                        $('[name="address"]').val(data.email);
                        $('[name="kategori"]').text(data.ideatype);


                        $('#imglink').attr("href","http://blackinnovation.blackxperience.com/assets/file/"+data.ideafile);
                        if(data.ideafile!=null){
                            if(/\.(jpg|jpeg|gif|png)$/.test(data.ideafile)){
                              $('#ideaimg').attr("src","http://blackinnovation.blackxperience.com/assets/file/"+data.ideafile);
                          }else{
                           $('#ideaimg').attr("src","<?php echo base_url('assets/dl.png') ?>");
                       }
                   }
                   else{
                       $('#ideaimg').attr("src","");
                       $('#imglink').attr("href","");
                   }
                        $('#form')[0].reset();
                        $('#modal_form').modal('show');
                        $('.modal-title').text(data.ideatitle);

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });
}

function reload_table()
{
    table.ajax.reload(null, false);
}

function save()
{
    $('#btnSave').text('saving...');
    $('#btnSave').attr('disabled', true);
    var url;

                /*  if(save_method == 'add') {
                 url = "";
                 } else {
                 url = "";
             }*/
             url = "<?php echo site_url('xtosera_contr/save') ?>";

             $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function (data)
                {
                    console.log(data);

                    if (data.status)
                    {
                        //$('#modal_form').modal('hide');
                        //reload_table();
                    }

                    $('#btnSave').text('save');
                    $('#btnSave').attr('disabled', false);


                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                    $('#btnSave').text('save');
                    $('#btnSave').attr('disabled', false);

                }
            });
         }

         function delete_person(id)
         {
            if (confirm('Are you sure delete this data?'))
            {

                $.ajax({
                    url: "<?php echo site_url('person/ajax_delete') ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data)
                    {

                        $('#modal_form').modal('hide');
                            // reload_table();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error deleting data');
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
                    <h3 class="modal-title">Form</h3>
                </div>
                <div class="modal-body form">
                    <form id="form" role="form" method="post" class="form-horizontal formclass">
                        <input type="hidden" id="hiddenid" value="" name="id">
                        <input type="hidden" id="hiddenid" value="<?=$user['idscreen'];?>" name="scren">
                        <input type="hidden" id="level" value="<?=$user['level'];?>" name="level">
                        <?php if($user['level'] = '4'): ?>
                            <input type="hidden" id="supper" name="supper">
                        <?php endif; ?>
                        <div class="card card-primary">
                            <div class="white-text">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td width="150px">Peserta</td>
                                            <td width="40px">:</td>
                                            <td><span name="namaper"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Kategori</td>
                                            <td>:</td>
                                            <td><span name="kategori"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Deskripsi</td>
                                            <td>:</td>
                                            <td><span name="deskrip"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><a  href="" id="imglink"  target="_blank" ><img id="ideaimg" src="" height="200px"></a></td>
                                    <!-- <td align="center">Nilai<br><span id="big"></span></td> -->
                                </tr>
                            </tbody>
                        </table>
                        <!--penilaian ide-->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="70%">
                                        Penilaian Ide
                                    </th>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>4</th>
                                    <th>5</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Apakah ide memiliki nilai originalitas?</td>
                                    <td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio1" value="1"   name="radioInline1" required>
                                            <label for="inlineRadio1"></label>
                                        </div></td><td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio2" value="2" name="radioInline1" required>
                                            <label for="inlineRadio2"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio3" value="4" name="radioInline1" required>
                                            <label for="inlineRadio3"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio4" value="5" name="radioInline1" required>
                                            <label for="inlineRadio4"></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Apakah karya tersebut memliliki nilai ke khas/ keunikan?</td>
                                    <td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio5" value="1"   name="radioInline2" required>
                                            <label for="inlineRadio5"></label>
                                        </div></td><td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio6" value="2" name="radioInline2" required>
                                            <label for="inlineRadio6"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio7" value="4" name="radioInline2" required>
                                            <label for="inlineRadio7"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio8" value="5" name="radioInline2" required>
                                            <label for="inlineRadio8"></label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <hr>
                            </tfoot>
                        </table>
                        <!--endpenilaian ide-->
                        <!--penilaian deskripsi-->

                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="70%">
                                        Penilaian Deskripsi
                                    </th>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>4</th>
                                    <th>5</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Apakah proses penjelasan fungsi karya cukup mudah dimengerti dan cukup jelas?</td>
                                    <td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio9" value="1"   name="radioInline3" required>
                                            <label for="inlineRadio9"></label>
                                        </div></td><td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio10" value="2" name="radioInline3" required>
                                            <label for="inlineRadio10"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio11" value="4" name="radioInline3" required>
                                            <label for="inlineRadio11"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio12" value="5" name="radioInline3" required>
                                            <label for="inlineRadio12"></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Apakah deskripsi cukup menjelaskan cara penggunaan?</td>
                                    <td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio13" value="1"   name="radioInline4" required>
                                            <label for="inlineRadio13"></label>
                                        </div></td><td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio14" value="2" name="radioInline4" required>
                                            <label for="inlineRadio14"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio15" value="4" name="radioInline4" required>
                                            <label for="inlineRadio15"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio16" value="5" name="radioInline4" required>
                                            <label for="inlineRadio16"></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Apakah deskripsi menjelaskan solusi?</td>
                                    <td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio17" value="1"   name="radioInline5" required>
                                            <label for="inlineRadio17"></label>
                                        </div></td><td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio18" value="2" name="radioInline5" required>
                                            <label for="inlineRadio18"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio19" value="4" name="radioInline5" required>
                                            <label for="inlineRadio19"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio20" value="5" name="radioInline5" required>
                                            <label for="inlineRadio20"></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Apakah deskripsi dapat menjelaskan fungsi dari ide?</td>
                                    <td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio21" value="1"   name="radioInline6" required>
                                            <label for="inlineRadio21"></label>
                                        </div></td><td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio22" value="2" name="radioInline6" required>
                                            <label for="inlineRadio22"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio23" value="4" name="radioInline6" required>
                                            <label for="inlineRadio23"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio24" value="5" name="radioInline6" required>
                                            <label for="inlineRadio24"></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Apakah deskripsi ide memiliki kesesuaian dengan ide yang di submit?</td>
                                    <td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio25" value="1"   name="radioInline7" required>
                                            <label for="inlineRadio25"></label>
                                        </div></td><td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio26" value="2" name="radioInline7" required>
                                            <label for="inlineRadio26"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio27" value="4" name="radioInline7" required>
                                            <label for="inlineRadio27"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio28" value="5" name="radioInline7" required>
                                            <label for="inlineRadio28"></label>
                                        </div>
                                    </td>
                                </tr>
                                    <!-- <tr>
                                        <td colspan="3">
                                            <div class="md-form">
                                                <textarea  type="text" id="idenote" name="idenote" class="md-textarea"></textarea>
                                                <label for="form76">Note *</label>
                                            </div>
                                        </td>
                                    </tr> -->
                                </tbody>
                                <tfoot>
                                    <hr>
                                </tfoot>
                            </table>
                            <!--endpenilaian deskripsi-->
                            <!--penilaian manfaat-->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="70%">
                                            Manfaat Karya
                                        </th>
                                        <th>
                                            1
                                        </th>
                                        <th>
                                            2
                                        </th>
                                        <th>
                                            4
                                        </th>
                                        <th>
                                            5
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Apakah karya tersebut memiilki nilai tambah?</td>
                                        <td>
                                            <div class="radio radio-danger radio-inline">
                                                <input type="radio" id="inlineRadio29" value="1" required name="radioInline8">
                                                <label for="inlineRadio29"></label>
                                            </div></td><td>
                                            <div class="radio radio-danger radio-inline">
                                                <input type="radio" id="inlineRadio30" value="2" required name="radioInline8">
                                                <label for="inlineRadio30"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="radio radio-danger radio-inline">
                                                <input type="radio" id="inlineRadio31" value="4" required name="radioInline8">
                                                <label for="inlineRadio31"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="radio radio-danger radio-inline">
                                                <input type="radio" id="inlineRadio32" value="5" required name="radioInline8">
                                                <label for="inlineRadio32"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Apakah karya tersebut memiliki nilai jual?</td>
                                        <td>
                                            <div class="radio radio-danger radio-inline">
                                                <input type="radio" id="inlineRadio33" value="1" required name="radioInline9">
                                                <label for="inlineRadio33"></label>
                                            </div></td><td>
                                            <div class="radio radio-danger radio-inline">
                                                <input type="radio" id="inlineRadio34" value="2" required name="radioInline9">
                                                <label for="inlineRadio34"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="radio radio-danger radio-inline">
                                                <input type="radio" id="inlineRadio35" value="4" required name="radioInline9">
                                                <label for="inlineRadio35"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="radio radio-danger radio-inline">
                                                <input type="radio" id="inlineRadio36" value="5" required name="radioInline9">
                                                <label for="inlineRadio36"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Apakah karya tersebut dapat di produksi secara masal?</td>
                                        <td>
                                            <div class="radio radio-danger radio-inline">
                                                <input type="radio" id="inlineRadio37" value="1" required name="radioInline10">
                                                <label for="inlineRadio37"></label>
                                            </div></td><td>
                                            <div class="radio radio-danger radio-inline">
                                                <input type="radio" id="inlineRadio38" value="2" required name="radioInline10">
                                                <label for="inlineRadio38"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="radio radio-danger radio-inline">
                                                <input type="radio" id="inlineRadio39" value="4" required name="radioInline10">
                                                <label for="inlineRadio39"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="radio radio-danger radio-inline">
                                                <input type="radio" id="inlineRadio40" value="5" required name="radioInline10">
                                                <label for="inlineRadio40"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Apakah karya tersebut memiliki dampak terhadap lingkungan sekitar?</td>
                                        <td>
                                            <div class="radio radio-danger radio-inline">
                                                <input type="radio" id="inlineRadio41" value="1" required name="radioInline11">
                                                <label for="inlineRadio41"></label>
                                            </div></td><td>
                                            <div class="radio radio-danger radio-inline">
                                                <input type="radio" id="inlineRadio42" value="2" required name="radioInline11">
                                                <label for="inlineRadio42"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="radio radio-danger radio-inline">
                                                <input type="radio" id="inlineRadio43" value="4" required name="radioInline11">
                                                <label for="inlineRadio43"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="radio radio-danger radio-inline">
                                                <input type="radio" id="inlineRadio44" value="5" required name="radioInline11">
                                                <label for="inlineRadio44"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Apakah karya tersebut memberikan solusi untuk masalah yang dijelaskan?</td>
                                        <td>
                                            <div class="radio radio-danger radio-inline">
                                                <input type="radio" id="inlineRadio45" value="1" required name="radioInline12">
                                                <label for="inlineRadio45"></label>
                                            </div></td><td>
                                            <div class="radio radio-danger radio-inline">
                                                <input type="radio" id="inlineRadio46" value="2" required name="radioInline12">
                                                <label for="inlineRadio46"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="radio radio-danger radio-inline">
                                                <input type="radio" id="inlineRadio47" value="4" required name="radioInline12">
                                                <label for="inlineRadio47"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="radio radio-danger radio-inline">
                                                <input type="radio" id="inlineRadio48" value="5" required name="radioInline12">
                                                <label for="inlineRadio48"></label>
                                            </div>
                                        </td>
                                    </tr>
                                <!-- <tr>
                                    <td colspan="3" rowspan="5">
                                        <div class="md-form">
                                            <textarea  type="text" id="manfnote"  name="manfnote" class="md-textarea"></textarea>
                                            <label for="form76">Note *</label>
                                        </div>
                                    </td>
                                </tr> -->
                                <tr>
                                    <td colspan="3">
                                        <div class="md-form">
                                            <textarea  type="text" id="idenote" name="idenote" class="md-textarea"></textarea>
                                            <label for="form76">Note *</label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <hr>
                            </tfoot>
                        </table>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" id="btnSave"  class="btn btn-success" name="save" value="<?=$user['idscreen'];?>">Save
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <footer class="page-footer center-on-small-only">
        <p style="text-align: center;margin: 0;padding-bottom: 15px;">BLACKINNOVATION © COPYRIGHT 2016</p>
    </footer>
</body>
</html>