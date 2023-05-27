<?= $this->extend('layouts/master') ?>
<?= $this->section('main') ?>
<div class="row">
    <div class="col-4">Sidebar</div>
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <?php echo anchor('logout', 'Logout'); ?>
                <ul>
                    <li>Họ và tên: <?php echo $user->name ?></li>
                    <li>Công ty: <?php echo $user->company ?></li>
                    <li>Facebook: <?php echo $user->facebook ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>