<?= $this->extend('dashboard/components/layout') ?>

<?= $this->section('ante-template') ?>
<div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="../index.html"><?= lang('app.repois', [], session('language')); ?></a>
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto" method="POST" action="<?= route_to('searchPage') ?>">
        <?= csrf_field() ?>
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Search" type="text" name="search">
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
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-danger pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
        </div>
      </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('post-template') ?>
<div class="container-fluid mt--7">
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0"><?= lang('app.issues', [], session('language')); ?></h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col"><?= lang('app.isstit', [], session('language')); ?></th>
                    <th scope="col"><?= lang('app.creator', [], session('language')); ?></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($issues as $issue): ?>
                  <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <a href="issue/<?= $issue['number'] ?>">
                            <span class="mb-0 text-sm"><?= '(ID: ' . $issue['number'] . ') ' . $issue['title'] ?>
                                <?php foreach($issue['labels'] as $label): ?>
                                    <span class="badge badge-pill text-white" style="background-color: <?= $label['color'] ?>"><?= $label['name'] ?></span>
                                <?php endforeach ?>
                            </span>
                          </a>
                        <button type="button" class="btn btn-block btn-warning mb-3" data-toggle="modal" data-target="#modal-notification-<?= $issue['number'] ?>"><?= lang('app.description', [], session('language')); ?></button>
                        <div class="modal fade" id="modal-notification-<?= $issue['number'] ?>" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                            <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                <div class="modal-content bg-gradient-danger">

                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modal-title-notification"><?= lang('app.attreq', [], session('language')); ?></h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="py-3 text-center">
                                            <i class="ni ni-bell-55 ni-3x"></i>
                                            <h4 class="heading mt-4"<?= lang('app.tdes', [], session('language')); ?></h4>
                                            <p><?= htmlspecialchars($issue['body']) ?></p>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white ml-auto" data-dismiss="modal"><?= lang('app.gotit', [], session('language')); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                      </div>
                    </th>
                    <td>
                      <div class="avatar-group">
                        <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="<?= $issue['user']['login'] ?>">
                          <img alt="Image placeholder" src="<?= $issue['user']['avatar_url'] ?>" class="rounded-circle">
                        </a>
                      </div>
                    </td>
                    <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <div class="modal fade show" id="modal-github-<?= $issue['number'] ?>" tabindex="-1" role="dialog" aria-labelledby="modal-github" aria-hidden="true">
                            <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                <div class="modal-content bg-gradient-danger">

                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modal-title-notification"><?= lang('app.attreq', [], session('language')); ?></h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="py-3 text-center">
                                            <i class="ni ni-bell-55 ni-3x"></i>
                                            <h4 class="heading mt-4"<?= lang('app.tdes', [], session('language')); ?></h4>
                                            <p><?= $issue['body'] ?></p>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white ml-auto" data-dismiss="modal"><?= lang('app.gotit', [], session('language')); ?></button>
                                    </div>

                                </div>
                            </div>
                            </div>
                          <a class="dropdown-item text-danger" href="<?= route_to('issueCancel', $repoID, $issue['number']) ?>">Cancel</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                  <?php if(!count($issues)): ?>
                    <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                            <?= lang('app.noiss', [], session('language')); ?>
                        </div>
                      </div>
                    </th>
                    </tr>
                  <?php endif ?>
                </tbody>
              </table>
            </div>
            <div class="card-footer py-4">
            </div>
          </div>
        </div>
      </div>
<?= $this->endSection() ?>