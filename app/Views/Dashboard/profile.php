<?= $this->extend('Dashboard/components/layout'); ?>

<?= $this->section('ante-template'); ?>

  <div class="main-content">
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="<?= route_to('profile') ?>"><?= lang('app.uprofile', [], session('language')); ?></a>
         <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto" method="POST" action="<?= route_to('searchPage') ?>">
        <?= csrf_field() ?>
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="<?= lang('app.search', [], session('language')); ?>" type="text" name="search">
            </div>
          </div>
        </form>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="<?= $userdata->avatar_url ?>">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?= $userdata->nickname ?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0"><?= lang('app.welcome', [], session('language')); ?></h6>
              </div>
              <a href="<?= route_to('profile') ?>" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span><?= lang('app.myprfl', [], session('language')); ?></span>
              </a>
              <a href="<?= route_to('notification') ?>" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span><?= lang('app.noti', [], session('language')); ?></span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="/logout" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span><?= lang('app.logout', [], session('language')); ?></span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(../assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
      <span class="mask bg-gradient-default opacity-8"></span>
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white"><?= lang('app.welcome', [], session('language')); ?> <?= $userdata->nickname; ?></h1>
            <p class="text-white mt-0 mb-5"><?= lang('app.welcomesh', [], session('language')); ?></p>
          </div>
        </div>
      </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section('post-template'); ?>
<div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="<?= $userdata->avatar_url; ?>" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                <br/>
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    <div>
                      <span class="heading"><?= $apidata->followers; ?></span>
                      <span class="description"><?= lang('app.followers', [], session('language')); ?></span>
                    </div>
                    <div>
                      <span class="heading"><?= $apidata->following; ?></span>
                      <span class="description"><?= lang('app.following', [], session('language')); ?></span>
                    </div>
                    <div>
                      <span class="heading"><?= $apidata->public_repos; ?></span>
                      <span class="description"><?= lang('app.repo', [], session('language')); ?></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h3>
                  <?= $userdata->name; ?><span class="font-weight-light">, <?= $userdata->nickname; ?></span>
                </h3>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i><?= htmlspecialchars($apidata->location); ?>
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i><?= htmlspecialchars($apidata->company); ?>
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i><a href="mailto:<?= $userdata->email; ?>"><?= $userdata->email; ?></a>
                </div>
                <hr class="my-4" />
                <p><?= htmlspecialchars($apidata->bio); ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0"><?= lang('app.myaccount', [], session('language')); ?></h3>
                </div>
                <div class="col-4 text-right">
              <form method="POST" action="<?= route_to('profilePage') ?>">
              <?= csrf_field() ?>
                  <button type="submit" class="btn btn-sm btn-primary"><?= lang('app.edit', [], session('language')); ?></button>
                </div>
              </div>
            </div>
            <div class="card-body">
                <h6 class="heading-small text-muted mb-4"><?= lang('app.uinfo', [], session('language')); ?></h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"><?= lang('app.un', [], session('language')); ?></label>
                        <input type="text" name="name" id="input-username" class="form-control form-control-alternative" value="<?= $userdata->name; ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email"><?= lang('app.ea', [], session('language')); ?></label>
                        <input type="email" name="email" id="input-email" class="form-control form-control-alternative" value="<?= $userdata->email; ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <h6 class="heading-small text-muted mb-4"><?= lang('app.oi', [], session('language')); ?></h6>
                <div class="pl-lg-4">
                  <div class="form-group">
                    <button type="button" class="btn btn-dark">
                        <a href="https://github.com/settings/profile" class="text-white"><span><i class="fab fa-github"></i></span><?= lang('app.eg', [], session('language')); ?></a>
                    </button>  
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
<?= $this->endSection(); ?>