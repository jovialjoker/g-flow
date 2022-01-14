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
                  <img alt="Image placeholder" src="<?= $profileData->avatar_url ?>">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?= $profileData->nickname ?></span>
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