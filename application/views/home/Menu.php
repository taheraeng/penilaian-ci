<nav class="navbar navbar-dark navbar-fixed-top scrolling-navbar">
  <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#collapseEx">
    <i class="fa fa-bars"></i>
  </button>
  <div class="container">
    <div class="collapse navbar-toggleable-xs" id="collapseEx">
      <span class="navbar-brand waves-effect waves-light">
        <a href="<?php echo base_url('/') ?>">
          <img src="<?php echo base_url('bt4/img/biv-logo.png') ?>" width="120px"></a>
        </span>
        <ul class="nav navbar-nav">
        <?php if($user['level'] == '2'): ?>
          <li class="nav-item <?php echo activate_menu('Depan'); ?>">
            <a class="nav-link waves-effect waves-light" href="<?php echo base_url ('/')?>">Home <span class="sr-only">(current)</span></a>
          </li>
          <?php endif; ?>
          <?php if ($this->session->userdata('isLogin') == FALSE): ?>
            <!-- <li class="nav-item">
              <a class="nav-link waves-effect waves-light" href="#" onclick="muncul()" data-target="#myModal">Login</a>
            </li> -->
          <?php else: ?>

            <?php if($user['level'] == '2' || $user['level'] == '4' || $user['level'] == '5'): ?>
              <li class="nav-item <?php echo activate_menu('Coba_contr'); ?>">
                <a class="nav-link waves-effect waves-light" href="<?php echo base_url ('/ntox')?>">N to X </a>
              </li>
              <li class="nav-item <?php echo activate_menu('Lolos_contr'); ?>">
                <a class="nav-link waves-effect waves-light" href="<?php echo base_url ('/lolos')?>">X to 100 </a>
              </li>

                <?php if($user['level'] == '4'): ?>
                    <li class="nav-item <?php echo activate_menu('Xtosera_contr'); ?>">
                        <a class="nav-link waves-effect waves-light" href="<?php echo base_url ('/nilai')?>">Nilai </a>
                    </li>
                <?php endif; ?>
              <li class="nav-item <?php echo activate_menu('Scren_contr'); ?>">
                <a class="nav-link waves-effect waves-light" href="<?php echo base_url ('/scren')?>">Lihat Nilai 1</a>
              </li>
              <!-- <li class="nav-item <?php echo activate_menu('Topsera_contr'); ?>">
                <a class="nav-link waves-effect waves-light" href="<?php echo base_url ('/topsera')?>">Top 100 </a>
              </li>
              <li class="nav-item <?php echo activate_menu('Topsere_contr'); ?>">
                <a class="nav-link waves-effect waves-light" href="<?php echo base_url ('/topsere')?>">Top 100 r </a>
              </li> -->
              <li class="nav-item btn-group">
                <a class="nav-link dropdown-toggle waves-effect waves-light" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Top Tahap 1</a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <a class="dropdown-item waves-effect waves-light" href="<?php echo base_url ('/topsera')?>">Top Product Design</a>
                  <a class="dropdown-item waves-effect waves-light" href="<?php echo base_url ('/topsere')?>">Top IOT</a>
                  
                </div>
              </li>
                <?php if($user['level'] == '5'): ?>
                     <li class="nav-item <?php echo activate_menu('Nilaitop_contr'); ?>">
                <a class="nav-link waves-effect waves-light" href="<?php echo base_url ('/nilaitop')?>">Nilai 2</a>
              </li>
                <?php endif; ?>
              <li class="nav-item <?php echo activate_menu('Screne_contr'); ?>">
                <a class="nav-link waves-effect waves-light" href="<?php echo base_url ('/screne')?>">Lihat Nilai 2</a>
              </li>
              <li class="nav-item <?php echo activate_menu('Topfinal_contr'); ?>">
                <a class="nav-link waves-effect waves-light" href="<?php echo base_url ('/topfinal')?>">Top 100</a>
              </li>
              <li class="nav-item <?php echo activate_menu('Limatotiga_contr'); ?>">
                <a class="nav-link waves-effect waves-light" href="<?php echo base_url ('/top')?>">Top 30 </a>
              </li>
            <?php endif; ?>

            <?php if($user['level'] == '3' || $user['level'] == '5'): ?>
              <!-- <li class="nav-item <?php echo activate_menu('Nilaitop_contr'); ?>">
                <a class="nav-link waves-effect waves-light" href="<?php echo base_url ('/nilaitop')?>">Nilai</a>
              </li> -->
              <?php endif; ?>

            <?php if($user['level'] == '1'): ?>
              <!-- <li class="nav-item <?php echo activate_menu('Xtosera_contr'); ?>">
                <a class="nav-link waves-effect waves-light" href="<?php echo base_url ('/nilai')?>">Nilai </a>
              </li> -->
            <?php endif; ?>

            <li class="nav-item btn-group logout-menu">
              <a class="nav-link dropdown-toggle waves-effect waves-light" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$user['nama'];?></a>
            <?php endif; ?>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
              <a class="dropdown-item waves-effect waves-light" href="<?=base_url()?>akun/logout">Logout</a>
            </div>
          </li>
        </ul>
        <form class="form-inline waves-effect waves-light">
        </form>
      </div>
    </div>
  </nav>