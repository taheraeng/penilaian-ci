 <script>
  function muncul() {
    $('#myModal').modal('show')
  }
</script>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="text-center" style="color: #d6d6d6">Login</h4>
        <p style="color: #a1a1a1"><?php echo @$this->session->flashdata('flash_message'); ?></p>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url();?>akun/login" method="post">
          <div class="md-form">
            <i class="fa fa-user prefix"></i>
            <input type="text" id="form2" name="userid" class="form-control">
            <label for="form2">Username</label>
          </div>
          <div class="md-form">
            <i class="fa fa-lock prefix"></i>
            <input type="password" name="pass" id="form4" class="form-control">
            <label for="form4">Password</label>
          </div>
        </div>
        <div class="modal-footer">
          <div class="text-xs-center">
            <button id="kecil-but" class="btn" name="login" value="Masuk">Login</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="view hm-black-strong">
  <?php if ($this->session->userdata('isLogin') == FALSE): ?>
    <div class="full-bg-img flex-center">
      <ul class="animated fadeInUp">
        <div class="row">
          <div class="col-md-12">
            <div class="jumbotron text-xs-center wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
              <a id="kecil-but"  class="btn btn-lg waves-effect waves-light" href="#" onclick="muncul()" data-target="#myModal">Login</a>
            <?php else: ?>
              <?php if($user['level'] == '1'): ?>
                <div class="full-bg-img flex-center">
      <ul class="animated fadeInUp">
        <div class="row">
          <div class="col-md-12">
            <div class="jumbotron text-xs-center wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
                <a id="kecil-but"  class="btn btn-lg waves-effect waves-light" href="<?php echo base_url ('/nilai')?>">Nilai</a>
      <!-- <div class="col-md-12">
        <div class="card card-primary text-xs-center">
          <div class="card-block" id="gede-teng">
            <small>IoT & Product 1 Design</small>
            <span><?php echo $jumlahiotpd; ?></span>
          </div>
        </div>
      </div> -->
    <?php endif; ?>
    <?php if($user['level'] == '3'): ?>
      <div class="full-bg-img flex-center">
      <ul class="animated fadeInUp">
        <div class="row">
          <div class="col-md-12">
            <div class="jumbotron text-xs-center wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
      <a id="kecil-but"  class="btn btn-lg waves-effect waves-light" href="<?php echo base_url ('/nilaitop')?>">Nilai</a>
      <!-- <div class="col-md-12">
        <div class="card card-primary text-xs-center">
          <div class="card-block" id="gede-teng">
            <small>IoT & Product 3 Design</small>
            <span><?php echo $jumlahiotpd; ?></span>
          </div>
        </div>
      </div> -->
    <?php endif; ?>
    <?php if($user['level'] == '2' || $user['level'] == '4' || $user['level'] == '5'): ?>
      <div class="full-bg-img flex-center">
        <ul class="animated fadeInUp">
          <div class="row">
            <div class="col-md-12">
              <div class="jumbotron text-xs-center wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
                <h1 class="h1-responsive">Total : <?php echo $jumlahall; ?> Ideas</h1></li>
                <li>
                  <div class="col-md-6">
                    <div class="card card-primary text-xs-center">
                      <div class="card-block" id="gede-but">
                        <blockquote class="card-blockquote">
                          <small>Product Design</small>
                          <span><?php echo $jumlahpd; ?></span>
                        </blockquote>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="card card-primary text-xs-center">
                      <div class="card-block" id="gede-but">
                        <small>Internet of Things</small>
                        <span><?php echo $jumlahiot; ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="card card-primary text-xs-center">
                      <div class="card-block" id="gede-teng">
                        <small>IoT & Product Design</small>
                        <span><?php echo $jumlahiotpd; ?></span>
                      </div>
                    </div>
                  </div>
                </li>
              <?php endif; ?>
            <?php endif; ?>
            <!-- <li>
              <a href="http://localhost/screeningrevisi/pertama" id="kecil-but" class="btn btn-lg waves-effect waves-light">N to X</a>
              <a href="http://localhost/screeningrevisi/keempat" id="kecil-but" class="btn btn-lg waves-effect waves-light">Top 50</a>
            </li> -->
          </div>
        </div>
      </div>
    </div>
  </ul>
</div>
</div>