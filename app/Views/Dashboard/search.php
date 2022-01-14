<?= $this->extend('Dashboard/components/layout'); ?>
<?= $this->section('ante-template'); ?>
<div class="main-content">
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="../index.html"><?= lang('app.search', [], session('language')); ?></a>
        <!-- Form -->
        <?= $this->include('Dashboard/components/header') ?>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
        </div>
    </div>

<?= $this->endSection(); ?>
<?= $this->section('post-template'); ?>

<div class="container-fluid mt--7">
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Search results</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Nickname / Name</th>
                    <th scope="col">EMail</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($users as $user): ?>
                  <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <a class="avatar rounded-circle mr-3">
                          <img alt="Image placeholder" src="<?= $user->avatar_url ?>">
                        </a>
                        <div class="media-body">
                            <span class="mb-0 text-sm"><?= $user->nickname ?> <?= !is_null($user->name) ? ' / '. $user->name : ' / none'?></span>
                        </div>
                      </div>
                    </th>
                    <td>
                        <span class="mb-0 text-sm"><?= $user->email ?></span>
                    </td>
                    <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" data-toggle="modal" data-target="#modalData<?= $user->id ?>">Invite to list...</a>
                        </div>              
                      <!-- Modal -->
                      <form method="POST" action="<?= route_to('insertToList', $user->provider_id) ?>">
                      <?= csrf_field() ?>
                      <div class="modal fade" id="modalData<?= $user->id ?>" tabindex="-1" role="dialog" aria-labelledby="modalData<?= $user->id ?>Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="modalData<?= $user->id ?>Label">Add <?= $user->nickname ?> to a list</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                            <?php if(count($lists) != (new \App\Helpers\Functions)->countUserList($user->provider_id)): ?>
                              <select name="user">
                                <?php foreach($lists as $list): ?>
                                  <?php if(!(new \App\Helpers\Functions)->checkIsUserInList($user->provider_id, $list->id)): ?>
                                    <option value="<?= $list->id ?>"><?= $list->name ?></option>
                                  <?php endif ?>
                                <?php endforeach ?>
                              </select>
                              <?php else: ?>
                                The user is already in all of your lists.
                              <?php endif ?>
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
                  </tr>
                  <?php endforeach ?>
                  <?php if(!count($users)): ?>
                  <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                            No user was found
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
<?= $this->endSection(); ?>