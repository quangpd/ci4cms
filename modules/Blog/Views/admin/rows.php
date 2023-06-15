<?php if (isset($items) && $items) : ?>
    <?php foreach ($items as $item) : ?>
        <tr class="<?php echo $item->status ? '' : 'table-primary'; ?>">
            <td><?php echo form_checkbox('action_to[]', $item->id ?? ""); ?></td>
            <td><?php echo $item->is_featured ?> | <?php echo $item->is_privated ?></td>
            <td>
                <div>
                    <?php echo anchor('article/' . $item->id . '/' . url_title($item->title), $item->title, 'target="_blank"'); ?>
                    <?php if ($item->is_featured == 1) : ?><span class="badge bg-danger">Nổi bật</span><?php endif; ?>
                    <?php if ($item->is_privated == 1) : ?><span class="badge bg-secondary">Nội bộ</span><?php endif; ?>
                </div>
                <div>
                    <?php echo word_limiter(strip_tags(htmlspecialchars_decode($item->description)), 50) ?>
                </div>
                <div>
                    <?php echo $item->file ? anchor($item->file, '<i class="fa fa-file-o"></i> File đính kèm', 'target="_blank"') : ""; ?>
                </div>
            </td>
            <td><?php echo isset($item->category->title) ? anchor('blog/category/' . $item->category->id . '/' . url_title($item->category->title), $item->category->title, 'target="_blank"') : ''; ?></td>
            <td class="text-center"><?php echo $item->views; ?></td>
            <td><?php echo $item->author; ?></td>
            <td><?php echo date('H:i d/m/Y', strtotime($item->published_at)); ?></td>
            <td>
                <?php echo isset($item->creater->id) ? anchor('admin/users/user/' . $item->creater->id,  $item->creater->username) : "Bot"; ?> [<?php echo date('H:i d/m/y', strtotime($item->created_at)); ?>]
                <br>
                <?php echo isset($item->updater->id) ? anchor('admin/users/user/' . $item->updater->id,  $item->updater->username) : "Bot"; ?> [<?php echo date('H:i d/m/y', strtotime($item->updated_at)); ?>]
            </td>
            <td class="text-center ctrl">
                <div class="btn-group" role="group" aria-label="Button group example">
                    <?php echo anchor('admin/blog/featured/' . $item->id, '<i class="fa fa-star"></i>', 'title="Thay đổi trạng thái" class="btn btn-sm btn-ajax btn-outline-secondary"'); ?>
                    <?php echo anchor('admin/blog/private/' . $item->id, '<i class="fa fa-lock"></i>', 'title="Thay đổi trạng thái" class="btn btn-sm btn-ajax btn-outline-secondary"'); ?>
                    <?php echo anchor('admin/blog/active/' . $item->id, '<i class="fa fa-check"></i>', 'title="Thay đổi trạng thái" class="btn btn-sm btn-ajax btn-outline-secondary"'); ?>
                    <?php echo anchor('admin/blog/form/' . $item->id, '<i class="fa fa-edit"></i>', 'title="Cập nhật" class="btn btn-sm btn-outline-secondary btn-modal"'); ?>
                    <?php echo anchor('admin/blog/delete/' . $item->id, '<i class="fa fa-trash-o"></i>', 'title="Xóa bản ghi!?" class="btn btn-sm btn-ajax btn-confirm btn-outline-secondary"'); ?>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>