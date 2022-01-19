<?= $this->extend('Modules\Backend\Views\base') ?>

<?= $this->section('title') ?>
<?=lang('Backend.'.$title->pagename)?>
<?= $this->endSection() ?>

<?= $this->section('head') ?>
<?=link_tag("be-assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css")?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?=lang('Backend.'.$title->pagename)?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <a href="<?= route_to('blogCreate') ?>" class="btn btn-outline-success"><?=lang('Backend.add')?></a>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card card-outline card-shl">
        <div class="card-header">
            <h3 class="card-title font-weight-bold"><?= lang('Backend.' . $title->pagename) ?></h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <?= view('Modules\Auth\Views\_message_block') ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><?=lang('Backend.email')?></th>
                        <th>IP</th>
                        <th><?=lang('Backend.start')?></th>
                        <th><?=lang('Backend.expire')?></th>
                        <th><?=lang('Backend.transactions')?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($locks as $keys =>  $lock) : ?>
                        <tr>
                            <td><?= $keys+1 ?></td>
                            <td><?= $lock->username ?></td>
                            <td><?= $lock->ip_address ?></td>
                            <td><?= $lock->locked_at ?></td>
                            <td><?= $lock->expiry_date ?></td>
                            <td>
                                <a href="<?= route_to('blogUpdate', $lock->_id) ?>"
                                   class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i> Düzenle</a>
                                <a href="<?= route_to('blogDelete', $lock->_id) ?>"
                                   class="btn btn-outline-danger btn-sm"><i class="fas fa-edit"></i> Sil</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php if ($paginator->getNumPages() > 1): ?>
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <?php if ($paginator->getPrevUrl()): ?>
                            <li class="page-item"><a class="page-link" href="<?php echo $paginator->getPrevUrl(); ?>">&laquo;</a>
                            </li>
                        <?php endif; ?>

                        <?php foreach ($paginator->getPages() as $page): ?>
                            <?php if ($page['url']): ?>
                                <li class="page-item <?php echo $page['isCurrent'] ? 'active' : ''; ?>">
                                    <a class="page-link"
                                       href="<?php echo $page['url']; ?>"><?php echo $page['num']; ?></a>
                                </li>
                            <?php else: ?>
                                <li class="disabled page-item"><span><?php echo $page['num']; ?></span></li>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <?php if ($paginator->getNextUrl()): ?>
                            <li class="page-item"><a class="page-link" href="<?php echo $paginator->getNextUrl(); ?>">&raquo;</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<?=script_tag("be-assets/plugins/sweetalert2/sweetalert2.min.js")?>
<?= $this->endSection() ?>
