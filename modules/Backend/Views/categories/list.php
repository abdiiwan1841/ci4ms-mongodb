<?= $this->extend('Modules\Backend\Views\base') ?>

<?= $this->section('title') ?>
<?= lang('Backend.' . $title->pagename) ?>
<?= $this->endSection() ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/be-assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= lang('Backend.' . $title->pagename) ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <a href="<?= route_to('categoryCreate') ?>" class="btn btn-outline-success"><i
                                class="fas fa-plus"></i> Kategori Oluştur</a>
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
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Kategori Adı</th>
                        <th>Üst Kategorisi</th>
                        <th>#İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($categories as $category) : ?>
                        <tr>
                            <td><?= $category->title ?></td>
                            <td><?php if (isset($category->pivot)):
                                    echo $category->pivot->title;
                                endif; ?></td>
                            <td>
                                <a href="<?= route_to('categoryUpdate', $category->_id) ?>"
                                   class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i> Düzenle</a>
                                <a href="<?= route_to('categoryDelete', $category->_id) ?>"
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
<script src="/be-assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<?= $this->endSection() ?>
