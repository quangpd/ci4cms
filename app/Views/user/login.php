<?= $this->extend('layouts/master') ?>
<?= $this->section('main') ?>
<?php echo form_open('login') ?>
<?= csrf_field() ?>
<div class="container justify-content-center d-flex p-5">
    <div class="card col-12 col-md-5 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-5">Login</h5>
            <?= $this->include('partials/message') ?>
            <div class="mb-2">
                <?php if (config('Auth')->validFields == ['email']) : ?>
                    <input type="email" class="form-control" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required />
                <?php else : ?>
                    <input type="text" class="form-control" name="username" placeholder="<?= lang('Auth.emailOrUsername') ?>" value="<?= old('login') ?>" required />
                <?php endif; ?>
            </div>

            <!-- Password -->
            <div class="mb-2">
                <input type="password" class="form-control" name="password" inputmode="text" autocomplete="current-password" placeholder="<?= lang('Auth.password') ?>" required />
            </div>

            <!-- Remember me -->
            <?php if (setting('Auth.sessionConfig')['allowRemembering']) : ?>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked<?php endif ?>>
                        <?= lang('Auth.rememberMe') ?>
                    </label>
                </div>
            <?php endif; ?>

            <div class="d-grid col-12 col-md-8 mx-auto m-3">
                <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.login') ?></button>
            </div>

            <?php if (setting('Auth.allowMagicLinkLogins')) : ?>
                <p class="text-center"><?= lang('Auth.forgotPassword') ?> <a href="<?= url_to('magic-link') ?>"><?= lang('Auth.useMagicLink') ?></a></p>
            <?php endif ?>

            <?php if (setting('Auth.allowRegistration')) : ?>
                <p class="text-center"><?= lang('Auth.needAccount') ?> <a href="<?= url_to('register') ?>"><?= lang('Auth.register') ?></a></p>
            <?php endif ?>
        </div>
    </div>
</div>
<?php echo form_close() ?>
<?= $this->endSection() ?>