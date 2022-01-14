<?= $this->extend('Dashboard/components/layout'); ?>

<?= $this->section('ante-template'); ?>
<div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="../index.html"><?= lang('app.back', [], session('language')); ?></a>
        <!-- Form -->
       <?= $this->include('Dashboard/components/header') ?>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
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
              <h3 class="mb-0 text-left"><?= lang('app.task', [], session('language')); ?> - <?= $pageData->title ?> | <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createTask"><?= lang('app.createtask', [], session('language')); ?></button></h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col"><?= lang('app.taskid', [], session('language')); ?></th>
                    <th scope="col"><?= lang('app.priority', [], session('language')); ?></th>
                    <th scope="col"><?= lang('app.createdat', [], session('language')); ?></th>
                    <th scope="col"><?= lang('app.user', [], session('language')); ?></th>
                    <th scope="col"><?= lang('app.status', [], session('language')); ?></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($pageData->tasks as $task): ?>
                  <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <a href="javascript:void(0)"><span class="mb-0 text-sm">dbID: #<?= $task['id'] ?></span>
                          <button type="button" class="btn btn-block btn-warning mb-3" data-toggle="modal" data-target="#modal-notification-<?= $task['id'] ?>"><?= lang('app.description', [], session('language')); ?></button>
                          <div class="modal fade" id="modal-notification-<?= $task['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
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
                                            <p><?= $task['text'] ?></p>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white ml-auto" data-dismiss="modal"><?= lang('app.gotit', [], session('language')); ?></button>
                                    </div>

                                </div>
                            </div>
                        </div>
                      </div>
                    </th>
                    <td>
                      <span class="badge badge-dot mr-4">
                        <i <?= $task['priority'] ? 'class="bg-danger"' : 'class="bg-success"' ?>></i>
                        <?= $task['priority'] ? lang('app.urgent', [], session('language')) : lang('app.normal', [], session('language'))?>
                      </span>
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <span class="mr-2"><?= $task['created_at'] ?></span>
                      </div>
                    </td>
                    <td>
                      <div class="avatar-group">
                        <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="<?= $task['nickname'] ?>">
                          <img alt="Image placeholder" src="<?= $task['avatar_url'] ?>" class="rounded-circle">
                        </a>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <span class="badge badge-dot mr-2">
                        <i <?= is_null($task['completed_at']) ? 'class="bg-danger"' : 'class="bg-success"' ?>></i>
                        <?= is_null($task['completed_at']) ? lang('app.nfinished', [], session('language')) : lang('app.compat', [], session('language')) . $task['completed_at'] ?></span>
                      </div>
                    </td>
                    <td class="text-right">
                      <?php if($pageData->check_owner || $task['provider_id'] == session('logged_in')): ?>
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" data-toggle="modal" data-target="#modalData<?= $task['id'] ?>">Assign to someone else</a>
                          <a class="dropdown-item" href="<?= route_to('statusTask', $task['id']) ?>"><?= is_null($task['completed_at']) ? 'Mark as completed' : 'Mark as uncompleted' ?></a>
                          <a class="dropdown-item" href="<?= route_to('priorityTask', $task['id']) ?>"><?= $task['priority'] ? 'Make normal' : 'Make urgent' ?></a>
                          <a class="dropdown-item text-danger" href="<?= route_to('deleteTask', $task['id']) ?>">Delete</a>
                        </div>
                        <form method="POST" action="<?= route_to('assignTask', $task['id']) ?>">
                      <?= csrf_field() ?>
                      <div class="modal fade" id="modalData<?= $task['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalData<?= $task['id'] ?>Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="modalData<?= $task['id'] ?>Label">Assign task #<?= $task['id'] ?></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <select name="user">
                                <?php foreach($users as $user): ?>
                                    <option value="<?= $user->user_id ?>"><?= (new \App\Helpers\Functions)->getNameByID($user->user_id) ?></option>
                                <?php endforeach ?>
                              </select>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      </form>
                      </div>
                    </td>
                    <?php endif ?>
                  </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
            <div class="card-footer py-4">
              <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  <li class="page-item <?= $pageData->prevPage ? '' : 'disabled' ?>">
                    <a class="page-link" href="?page=<?= $pageData->prevPage ?>">
                      <i class="fas fa-angle-left"></i>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <li class="page-item <?= $pageData->nextPage <= $pageData->totalPages ? '' : 'disabled' ?>">
                    <a class="page-link" href="?page=<?= $pageData->nextPage ?>">
                      <i class="fas fa-angle-right"></i>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <form method="POST" action="<?= base_url("dashboard/list/view/".$pageData->list_id) ?>">
      <?= csrf_field() ?>
      <div class="modal fade" id="createTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create a new task</h5>
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
                      <input class="form-control" name="task-name" placeholder="Task content" type="text">
                  </div>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="checkbox-task" id="checkpriority" type="checkbox" value="1">
                <label class="custom-control-label" for="checkpriority">Prioritize?</label>
              </div>
              <hr>
              Assign to someone
              <select name="user">
              <?php foreach($pageData->userData as $user): ?>
              <option value="<?= $user->provider_id ?>"><?= $user->name ?></option>
              <?php endforeach ?>
              </select>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      </form>
<?= $this->endSection(); ?>