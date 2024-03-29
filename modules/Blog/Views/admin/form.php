<?php echo form_open_multipart(uri_string(), 'id="' . $method . '-form"'); ?>
<?php echo form_hidden('method', 1); ?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <?php echo form_label('Danh mục', 'category_id', array('class' => 'control-label')); ?>
            <div>
                <select id="category_id" name="category_id" class="form-control select2" data-width="100%">
                    <?php echo dropdown_nested_menu(0, $categories, 0, $item->category_id); ?>
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <?php echo form_label('Trạng thái', 'status', array('class' => 'control-label')); ?>
            <input type="checkbox" name="status" value="1" <?php echo $item->status == 1 ? "checked" : "" ?> data-plugin="switchery" data-color="#23b195" data-size="small" />
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <?php echo form_label('Nổi bật', 'is_featured', array('class' => 'control-label')); ?>
            <input type="checkbox" name="is_featured" value="1" <?php echo $item->is_featured == 1 ? "checked" : "" ?> data-plugin="switchery" data-color="#23b195" data-size="small" />
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <?php echo form_label('Nội bộ', 'is_privated', array('class' => 'control-label')); ?>
            <input type="checkbox" name="is_privated" value="1" <?php echo $item->is_privated == 1 ? "checked" : "" ?> data-plugin="switchery" data-color="#23b195" data-size="small" />
        </div>
    </div>

</div>

<div class="form-group">
    <?php echo form_label('Tiêu đề', "title", array('class' => 'control-label')); ?>
    <div>
        <?php echo form_input("title", html_entity_decode(set_value("title", strip_tags($item->{"title"}))), "id=\"title\" class=\"form-control text-slug\""); ?>
    </div>
</div>

<div class="form-group">
    <?php echo form_label('Mô tả', "description", array('class' => 'control-label')); ?>
    <div>
        <textarea name="description" id="description" class="form-control ckeditor" spellcheck="false"><?php echo html_entity_decode(set_value("description", $item->{"description"})) ?></textarea>
    </div>
</div>

<div class="form-group">
    <?php echo form_label('Nội dung', 'content', array('class' => 'control-label')); ?>
    <div>
        <textarea name="content" id="content" class="form-control ckeditor" spellcheck="false"><?php echo html_entity_decode(set_value("content", $item->{"content"})) ?></textarea>
    </div>
</div>


<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

        <div class="form-group">
            <?php echo form_label('Hình ảnh', 'image', array('class' => 'control-label')); ?>
            <div class="div-image">
                <div class="input-group">
                    <div class="upload-image">
                        <div class="ctrl-image">
                            <a href="#" class="recycle"><i class="fa fa-recycle"></i></a>
                        </div>
                        <div class="update-photo">
                            <img class="image" src="<?php echo (isset($item->image) && $item->image) ?  $base_path . $item->image : $base_path . 'uploads/images/no_image.jpg' ?>" alt="" />
                            <input type="hidden" name="image" value="<?php echo set_value('image', $item->image ?? "") ?>" />
                        </div>
                        <div class="file-upload">
                            <input type="file" class="file-input">
                            <span class="ti-plus"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo form_label('File đính kèm', 'file', array('class' => 'control-label')); ?>
            <div>
                <div class="input-group">
                    <input type="text" name="file" class="button-open-file form-control" placeholder="File" readonly="readonly" value="<?php echo set_value('file', strip_tags($item->file)) ?>" />
                    <span class="input-group-addon button-file"><i class="fa fa-folder-o"></i></span>
                    <span class="input-group-addon button-clear-file"><i class="fa fa-remove"></i></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <div class="form-group">
            <?php echo form_label('Tác giả', 'author', array('class' => 'control-label')); ?>
            <div>
                <?php echo form_input('author', html_entity_decode(set_value('author', strip_tags($item->author))), 'id="author" class="form-control"'); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo form_label('Nguồn', 'source', array('class' => 'control-label')); ?>
            <div>
                <?php echo form_input('source', html_entity_decode(set_value('source', strip_tags($item->source))), 'id="source" class="form-control"'); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo form_label('Xuất bản', 'published_at', array('class' => 'control-label')); ?>
            <div>
                <?php echo form_input('published_at', html_entity_decode(set_value('published_at', strip_tags($item->published_at))), 'id="published_at" class="form-control datepicker"'); ?>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div class="form-group">
            <?php echo form_label('Tags', 'tags', array('class' => 'control-label')); ?>
            <div>
                <?php echo form_input('tags', html_entity_decode(set_value('tags', strip_tags($item->tags))), 'id="tags" class="form-control"'); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo form_label('Meta keywords', "meta_keywords", array('class' => 'control-label')); ?>
            <div>
                <?php echo form_input("meta_keywords", html_entity_decode(set_value("meta_keywords", strip_tags($item->{"meta_keywords"}))), 'id="meta_keywords" class="form-control" max-length="100"'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo form_label('Meta description', "meta_description", array('class' => 'control-label')); ?>
            <div>
                <?php echo form_input("meta_description", html_entity_decode(set_value("meta_description", strip_tags($item->{"meta_description"}))), 'id="meta_description" class="form-control" max-length="159"'); ?>
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div class="form-group">
            <?php echo form_label('Layout', 'layout', array('class' => 'control-label')); ?>
            <div>
                <?php echo form_input('layout', html_entity_decode(set_value('layout', strip_tags($item->layout))), 'id="layout" class="form-control"'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo form_label('Template', 'template', array('class' => 'control-label')); ?>
            <div>
                <?php echo form_input('template', html_entity_decode(set_value('template', strip_tags($item->template))), 'id="template" class="form-control"'); ?>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>