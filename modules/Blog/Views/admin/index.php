<?php $this->extend('backend/layout'); ?>
<?php $this->section('content'); ?>
<div class="row">
    <div class="col">
        <div id="table" class="tablesortable table-responsive">
            <div class="row rowtop mb-1">
                <div class="col-sm-6">
                    <label>
                        <select name="length" id="length" class="form-control select2 filter">
                            <option value="15">15</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </label>
                </div>
                <div class="col-sm-6 text-end">
                    <label>
                        <input type="text" name="search" class="form-control filter" placeholder="Search" />
                    </label>
                </div>
            </div>
            <div class="row rowbody">
                <div class="col-sm-12">
                    <table class="table table-striped table-bordered table-hover table-sortable">
                        <thead>
                            <tr>
                                <th width="1"><input type="checkbox" class="chkall" value="" name="action_to_all"></th>
                                <th width="100">Hình ảnh</th>
                                <th data-field="articles.title" class="sorting">Tiêu đề</th>
                                <th data-field="category_title" class="sorting" width="200">Danh mục</th>
                                <th data-field="articles.views" class="sorting" width="75">Xem</th>
                                <th data-field="articles.author" class="sorting" width="125">Tác giả</th>
                                <th data-field="articles.published_at" class="sorting" width="100">Xuất bản</th>
                                <th data-field="articles.created_at" class="sorting" width="165">Ngày tạo</th>
                                <th width="150">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="row rowbottom">
                <div class="col-sm-5">
                    <div class="info">
                        Showing <span class="start_row">0</span> to <span class="end_row">0</span> of <span class="total_rows">0</span> rows
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="paging"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="dialog" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Blog</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-submit">Save</button>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>

<?php $this->section('homeHeader'); ?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <?php echo $breadcumbs ?>
        <h4 class="main-title mb-0"><?php echo $page_title ?? "Welcome to Dashboard" ?></h4>
    </div>
</div>
<?php $this->endSection(); ?>

<?php $this->section('extraCSS'); ?>
<?php echo link_tag('backend/css/tablesortable.css'); ?>
<?php $this->endSection() ?>

<?php $this->section('extraJS'); ?>
<?php echo script_tag('backend/js/tablesortable.js'); ?>
<?php echo script_tag('backend/js/dashboard.js'); ?>
<?php echo script_tag('backend/js/blog/admin.js'); ?>
<?php $this->endSection() ?>