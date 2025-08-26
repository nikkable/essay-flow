<div class="container" style="padding-top: 100px;padding-bottom: 250px;">
    <?php $this->title = Yii::t('default', 'Error') . ' ' . $error['code']; ?>

    <div class="error">

    </div>

    <?php if($error['code'] === 404): ?>
        <div class="error-title">
            40<span>4</span>
        </div>
    <?php else: ?>
        <h2><?= $error['code']; ?></h2>
    <?php endif; ?>

    <?php
    switch ($error['code']) {
        case '404':
            $msg = '';
            break;
        default:
            $msg = $error['message'];
            break;
    }
    ?>

    <?php if($error['code'] !== 404): ?>
        <p class="alert alert-danger">
            <?= $msg; ?>
        </p>
    <?php endif; ?>
</div>

