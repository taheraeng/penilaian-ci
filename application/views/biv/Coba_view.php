<?php
$this->load->view('nilai/Head.php');
?>
<?php
$this->load->view('home/Menu.php');
?>
<style>
   table { table-layout: fixed; }
   table th, table td { overflow: hidden; }
   #loading { background: #fff; position:fixed; width:100%; height:100%; z-index:9999; top:100px; }
</style>
<div class="container-fluid">
   <br />
   <br />
   <br />
   <h1 class="big" style="text-align: center">N to X</h1>

   <div class="table-responsive">

    <table id="table" class="table table-striped" cellspacing="0" width="100%">
        <thead>
            <tr >
                <th style="width: 11px;">No. Urut</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>File</th>
                <th>Deskripsi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody >  
            <?php $c = 1; foreach ($userss as $users) {?>
            <input type="hidden" value="<?=$user['idscreen'];?>" name="skrin">
            <tr> 
                <td><?php echo $c++;?></td>
                <td><?php echo  $users['first_name'] ; ?></td>  
                <td> <?php echo  $users['email'] ; ?></td>  
                <td> <?php echo  $users['phone'] ; ?></td>  
                <td> <?php echo  $users['ideatitle'] ; ?></td>
                <td> <?php echo  $users['ideatype'] ; ?></td>
                <td> <?php echo  $users['ideafile'] ; ?></td>
                <td> <?php echo  substr($users['ideadesc'],0,20) ; ?><a onclick="pindah('<?php echo  $users['id'] ; ?>')" cob="<?php echo $users['ideatype']; ?>" gantip="<?php echo $users['id']; ?>" class="status_checks"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                <?php if($users['accep'] == '1'):?>
                    <td> Ditolak </td>
                <?php elseif($users['status'] == '1'):?>
                    <td> Diterima </td>
                <?php else:?> 
                    <td class="<?php echo $users['id']; ?>">
                        <button diu="<?=$user['idscreen'];?>" ganti="<?php echo $users['id']; ?>" class="statusdoang btn <?php echo ($users['status'])? 'btn-success' : 'btn-danger'?>"><?php echo ($users['status'])? 'Diterima' : 'Terima'?></button>
                        <button diuip="<?=$user['idscreen'];?>" gantip="<?php echo $users['id']; ?>" class="ttrim btn <?php echo ($users['accep'])? 'btn-success' : 'btn-danger'?>"><?php echo ($users['accep'])? 'Ditolak' : 'Tolak'?></button>
                    </td>
                <?php endif;?> 

                

                <?php } ?>
            </tr>
        </tbody>
    </table>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url('bt4/js/jquery-2.2.3.min.js')?>"></script>


/*** realtime ***/
<script src="<?php base_url(); ?>/biv/screening/assets/js/ratchet/connection.js"></script>
<script>
    var BASE_URL = "<?php echo base_url(); ?>";
    var Broadcast = {
        POST : "<?php echo constant('POST') ?>",
        BROADCAST_URL : "<?php echo constant('BROADCAST_URL') ?>",
        BROADCAST_PORT : "<?php echo constant('BROADCAST_PORT') ?>"
    };

    var conn = new Connection(Broadcast.BROADCAST_URL+":"+Broadcast.BROADCAST_PORT);
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.ttrim').click(function()
        {
            var idea = $(this).attr('gantip');
            var user = $(this).attr('diuip');

            var status = ($(this).hasClass("btn-success")) ? '0' : '1';
            var pesan = (status=='0')? 'Non-aktifkan' : 'Tolak';
            if(confirm("Yakin "+ pesan)){
                $.ajax({
                    type : "POST",
                    url : "<?php echo site_url('coba_contr/screened') ?>",
                    dataType : "json",
                    data : { user: user, idea: idea, status: 'ditolak' }
                }).done(function(data) {
                    var typeData = { broadType : Broadcast.POST, data : data.postData};

                    //console.log(data);
                    conn.sendMsg(typeData);
                });

                var current_element = $(this);
                url = "<?php echo site_url('coba_contr/tolakin')?>";
                $.ajax({
                    type:"POST",
                    url: url,
                    data: {id:$(current_element).attr('gantip'),status : status},
                    success: function(response,data)
                    {   
                        location.reload();
                        //console.log(response,data);
                    }
                });
            } else {
                $.ajax({
                    type : "POST",
                    url : "<?php echo site_url('coba_contr/screened') ?>",
                    dataType : "json",
                    data : { user: user, idea: idea, status: 'batal' }
                }).done(function(data) {
                    var typeData = { broadType : Broadcast.POST, data : data.postData};

                    //console.log(data);
                    conn.sendMsg(typeData);
                });
            }
        });      
    });
    function simpan()
    {

    }
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.statusdoang').click(function()
        {
            var idea = $(this).attr('ganti');
            var user = $(this).attr('diu');

            $.ajax({
                type : "POST",
                url : "<?php echo site_url('coba_contr/screened') ?>",
                dataType : "json",
                data : { user: user, idea: idea, status: 'diterima' }
            }).done(function(data) {
                var typeData = { broadType : Broadcast.POST, data : data.postData};

                //console.log(data);
                conn.sendMsg(typeData);
            });

            var status = ($(this).hasClass("btn-success")) ? '0' : '1';
            // var pesan = (status=='0')? 'Non-aktifkan' : 'Aktifkan';
            // if(confirm("Ganti "+ pesan)){
                var current_element = $(this);
                url = "<?php echo site_url('coba_contr/updatestatus')?>";
                $.ajax({
                    type:"POST",
                    url: url,
                    data: {id:$(current_element).attr('ganti'),stat:$(current_element).attr('diu'),status : status},
                    success: function(response,data)
                    {   
                        location.reload();
                        //console.log(response,data);
                    }
                });
            //}
        });      
    });
    function simpan()
    {

    }
</script>
<script type="text/javascript" src="<?php echo base_url('bt4/js/tether.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('bt4/js/mdb.min.js')?>"></script>
<script src="<?php echo base_url('bt4/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
<script src="https://cdn.datatables.net/fixedheader/3.0.0/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
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
            "fixedHeader": {
                "header": true,
                "headerOffset": 80
            },
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "processing": true,
                "serverSide": true,
                "targets": 0
            } ],
            "aaSorting": [[8, "desc"]],
            "pageLength":100,
            "lengthMenu": [[20, 10, 50, 100, 300, -1], [20, 10, 50, 100, 300, "All"]],
        } );



        t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    } );
    
    function pindah(id)
    {

        $('#form')[0].reset();
        $.ajax({
            url: "<?php echo site_url('coba_contr/ajax_edit/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data,response)
            {
                //console.log(data);
                var status = (thisButton.hasClass("btn-success")) ? '0' : '1';
                if(status == '1')
                {
                    $('[name="rubah"]').toggle(false);
                    $('[name="rusim"]').toggle(true);
                }else
                {
                    $('[name="rubah"]').toggle(true);
                    $('[name="rusim"]').toggle(false);
                }
                $('[name="id"]').val(id);
                var dataidea = data[0].ideatype;
                var skrin = data.idscreener;

                $.each(data,function(key,value){
                    $('#checkbox' + value.idscreener).prop("checked", true);
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
                    alert('Data Tidak Dilengkapi Kategori ');
                }

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
           $('[name="descip"]').text(data[0].ideadesc);
           $('[name="spes"]');
           $('[name="spe"]');
           $('.modal-title').text(data[0].ideatype);  
           $('.modal-judul').text(data[0].ideatitle);  

       },
   });
    }

    function update()
    {
        url = "<?php echo site_url('coba_contr/updatecntr')?>";
        $.ajax({
            type:"POST",
            url: url,
            data: $('#form').serialize(),
            success: function(response)
            {
                location.reload();
                //console.log(response);
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
            url = "<?php echo site_url('coba_contr/updatestatus')?>";
            $.ajax({
                type:"POST",
                url: url,
                data: $('#form').serialize() + '&status=' + status,
                success: function(response)
                {
                    location.reload();
                    //console.log(response);
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
                <h3 class="modal-judul"></h3>
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
                  <table class="table">
                    <tbody>
                        <tr>
                            <td><a  href="" id="imglink"  target="_blank" ><img id="ideaimg" src="" height="200px"></a></td>
                            <!-- <td align="center">Nilai<br><span id="big"></span></td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <h3 class="modal-title">Pilih Screener</h3>
            </div>
        </form>
    </div>
</div>
</div>
<footer class="page-footer center-on-small-only">
    <p style="text-align: center;margin: 0;padding-bottom: 15px;">BLACKINNOVATION © COPYRIGHT 2016</p>
</footer>
<div id="loadging"></div>
</body>
</html>