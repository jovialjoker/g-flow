<?= $this->extend('Dashboard/components/layout') ?>

<?= $this->section('ante-template') ?>
<div class="main-content">
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="../index.html"><?= lang('app.noti', [], session('language')); ?></a>
        <!-- Form -->
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
                  <img alt="Image placeholder" src="<?= $profile->avatar_url ?>">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?= $profile->nickname ?></span>
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
    <!-- Header -->
    <div class="header bg-gradient-info pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('post-template') ?>
<div class="container-fluid mt--7">
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0"><?= lang('app.notilist', [], session('language')); ?></h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col"><?= lang('app.notiid', [], session('language')); ?></th>
                    <th scope="col"><?= lang('app.text', [], session('language')); ?></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($notifications as $notification): ?>
                  <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <span class="badge badge-pill badge-info mb-0 text-sm"><a href="<?= base_url($notification->action) ?>">dbID: <?= $notification->id ?></a></span>
                      </div>
                    </th>
                    <td>
                        <span class="mb-0 text-sm"><?= $notification->text ?></span>
                    </td>
                    <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item text-danger" href="<?= route_to('notificationDelete', $notification->id) ?>">Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <?php endforeach ?>
                  <?php if(!count($notifications)): ?>
                  <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                            <?= lang('app.nonoti', [], session('language')); ?>
                        </div>
                      </div>
                    </th>
                  </tr>
                  <?php endif ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
<?= $this->endSection() ?>