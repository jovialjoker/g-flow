<?= $this->extend('Dashboard/components/layout'); ?>

<?= $this->section('ante-template'); ?>
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="../index.html"><?= lang('app.list', [], session('language')); ?></a>
        <!-- Form -->
        <?= $this->include('Dashboard/components/header') ?>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0"><?= lang('app.tl', [], session('language')); ?></h5>
                      <span class="h2 font-weight-bold mb-0"><?= $pageData->countResults ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-danger mr-2"><?= $pageData->latestList ?></span>
                    <span class="text-nowrap"><?= lang('app.ll', [], session('language')); ?></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0"><?= lang('app.tt', [], session('language')); ?></h5>
                      <span class="h2 font-weight-bold mb-0"><?= $pageData->totalTasks ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="fas fa-chart-pie"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2">
                    <?php if($pageData->completedTasks): ?>
                      <i class="fas fa-arrow-up"></i>
                    <?php endif; ?> 
                    <?=$pageData->completedTasks ?></span>
                    <span class="text-nowrap"><?= lang('app.ct', [], session('language')); ?></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0"><?= lang('app.ut', [], session('language')); ?></h5>
                      <span class="h2 font-weight-bold mb-0"><?= $pageData->urgentTasks ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-nowrap"><?= lang('app.gi', [], session('language')); ?></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0"><?= lang('app.solveratio', [], session('language')); ?></h5>
                      <?php if($pageData->totalTasks): ?>
                      <span class="h2 font-weight-bold mb-0">
                        <?= intval($pageData->completedTasks / $pageData->totalTasks * 100) ?>%
                      </span>
                      <?php else: ?>
                      <span class="h2 font-weight-bold mb-0">
                      0%
                      </span>
                      <?php endif ?>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                        <i class="fas fa-percent"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-nowrap"><?= lang('app.sr', [], session('language')); ?></span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section('post-template'); ?>
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0"><?= lang('app.list', [], session('language')); ?> <button type="button" data-target="#createModal" data-toggle="modal" class="btn btn-sm btn-primary"><?= lang('app.create', [], session('language')); ?></button></h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col"><?= lang('app.project', [], session('language')); ?></th>
                    <th scope="col"><?= lang('app.status', [], session('language')); ?></th>
                    <th scope="col"><?= lang('app.users', [], session('language')); ?></th>
                    <th scope="col"></th>
                  </tr>
                </thead>  
                <tbody>
                <?php foreach($pageData->lists as $lists): ?>
                  <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <a href="list/view/<?= $lists->id ?>"<span class="mb-0 text-sm"><?= $lists->name; ?></span>
                        </div>
                      </div>
                    </th>
                    <td>
                      <span class="badge badge-dot mr-4">
                        <i <?= time() < strtotime($lists->deadline_date) ? 'class="bg-success"' : 'class="bg-danger"' ?>></i>
                        <?= time() < strtotime($lists->deadline_date) ?  lang('app.ontime', [], session('language')) :  lang('app.deadline', [], session('language')) ?>
                      </span>
                    </td>
                    <td>
                      <div class="avatar-group">
                        <?php foreach((new \App\Helpers\Functions)->getListAvatars($lists->id) as $userAvatar): ?>
                        <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="<?= $userAvatar->nickname; ?>">
                          <img alt="Image placeholder" src="<?= $userAvatar->avatar_url; ?>" class="rounded-circle">
                        </a>
                        <?php endforeach; ?>
                      </div>
                    </td>
                    <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item text-danger" href="<?= route_to('deleteList', $lists->id) ?>"><?= lang('app.delete', [], session('language')); ?></a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <div class="card-footer py-4">
            </div>
          </div>
        </div>
      </div>
      <form method="POST" action="<?= route_to('createList') ?>">
      <?= csrf_field() ?>
      <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="createModalLabel">Create a list</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <div class="form-group">
                <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-align-center"></i></span>
                      </div>
                      <input class="form-control" name="list-name" placeholder="List name" type="text">
                  </div>
              </div>
                <label for="list-date">Deadline</label>
                <br/>
              <div class="input-group input-group-alternative">
                <input class="form-control" name="list-date" placeholder="" type="date">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
        </form>
      </div>
    </div>
<?= $this->endSection(); ?>