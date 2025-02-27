<?= $this->extend('Modules\Backend\Views\base') ?>

<?= $this->section('title') ?>
<?= lang('Backend.' . $title->pagename) ?>
<?= $this->endSection() ?>

<?= $this->section('head') ?>
<?=link_tag("be-assets/node_modules/@yaireo/tagify/dist/tagify.css")?>
<?=link_tag("be-assets/plugins/jquery-ui/jquery-ui.css")?>
<link rel="stylesheet" type="text/css"
      href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<?=link_tag("be-assets/plugins/elFinder/css/elfinder.full.css")?>
<?=link_tag("be-assets/plugins/elFinder/css/theme.css")?>
<!-- Select2 -->
<?=link_tag("be-assets/plugins/select2/css/select2.min.css")?>
<?=link_tag("be-assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")?>
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
                    <a href="<?= route_to('categories', 1) ?>" class="btn btn-outline-info"><?=lang('Backend.backToList')?></a>
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
            <form action="<?= route_to('categoryUpdate',$infos->_id) ?>" class="form-row" method="post">
                <?= csrf_field() ?>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for=""><?=lang('Backend.title')?></label>
                        <input type="text" class="form-control ptitle" required name="title" value="<?=$infos->title?>">
                    </div>
                    <div class="form-group">
                        <label for=""><?=lang('Backend.url')?></label>
                        <input type="text" class="form-control seflink" name="seflink" required value="<?=$infos->seflink?>">
                    </div>
                    <div class="form-group">
                        <label for=""><?=lang('Backend.seoDescription')?></label>
                        <textarea name="description" class="form-control" rows="10"><?=$infos->seo->description?></textarea>
                    </div>
                </div>
                <div class="col-md-4 row">
                    <div class="col-md-12 form-group">
                        <label for=""><?=lang('Backend.parentCategory')?></label>
                        <select name="parent" id="" class="form-control select2bs4" data-placeholder="Select a Category">
                            <option value=""><?=lang('Backend.select')?></option>
                            <?php foreach ($categories as $category) :?>
                                <option value="<?=$category->_id?>" <?=(!empty($infos->parent) && $infos->parent==$category->_id)?'selected':''?>><?=$category->title?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for=""><?=lang('Backend.parentCategory')?></label>
                        <img src="<?=$infos->seo->coverImage?>" alt="" class="pageimg img-fluid">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for=""><?=lang('Backend.parentCategory')?></label>
                        <input type="text" name="pageimg" class="form-control pageimg-input"
                               placeholder="Görsel URL" value="<?=$infos->seo->coverImage?>">
                    </div>
                    <div class="col-md-12 row form-group">
                        <div class="col-sm-6">
                            <label for=""><?=lang('Backend.parentCategory')?></label>
                            <input type="number" name="pageIMGWidth" class="form-control" id="pageIMGWidth"
                                   readonly value="<?=$infos->seo->IMGWidth?>">
                        </div>
                        <div class="col-sm-6">
                            <label for=""><?=lang('Backend.parentCategory')?></label>
                            <input type="number" name="pageIMGHeight" class="form-control" id="pageIMGHeight"
                                   readonly value="<?=$infos->seo->IMGHeight?>">
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <button type="button" class="pageIMG btn btn-info w-100"><?=lang('Backend.parentCategory')?></button>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for=""><?=lang('Backend.seoKeywords')?></label>
                        <textarea name="keywords" class="keywords" placeholder="write some tags"><?=!empty($infos->seo->keywords)?json_encode($infos->seo->keywords):''?></textarea>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <button class="btn btn-success float-right"><?=lang('Backend.update')?></button>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<?=script_tag("be-assets/plugins/jquery-ui/jquery-ui.js")?>
<?=script_tag("be-assets/node_modules/@yaireo/tagify/dist/jQuery.tagify.min.js")?>
<?=script_tag("be-assets/plugins/elFinder/js/elfinder.full.js")?>
<?=script_tag("be-assets/plugins/elFinder/js/i18n/elfinder.tr.js")?>
<?=script_tag("be-assets/plugins/elFinder/js/extras/editors.default.js")?>
<?=script_tag("be-assets/plugins/summernote/plugin/elfinder/summernote-ext-elfinder.js")?>
<!-- Select2 -->
<?=script_tag("be-assets/plugins/select2/js/select2.full.min.js")?>
<?=script_tag("be-assets/js/ci4ms.js")?>
<script>
    tags([]);

    $('.ptitle').on('change', function () {
        $.post('<?=route_to('checkSeflink')?>', {
            "<?=csrf_token()?>": "<?=csrf_hash()?>",
            'makeSeflink': $(this).val(),
            'where': 'categories'
        }, 'json').done(function (data) {
            $('.seflink').val(data.seflink);
        });
    });

    $('.seflink').on('change', function () {
        $.post('<?=route_to('checkSeflink')?>', {
            "<?=csrf_token()?>": "<?=csrf_hash()?>",
            'makeSeflink': $(this).val(),
            'where': 'categories'
        }, 'json').done(function (data) {
            $('.seflink').val(data.seflink);
        });
    });

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
</script>
<?= $this->endSection() ?>
