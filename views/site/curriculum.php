<style>
    .card {
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
        font-size: 0.9rem;
        max-width: 240px;
        margin: auto;
    }
    .card-header {
        font-size: 1.1rem;
        padding: 10px 14px;
        text-align: center;
    }
    .list-group-item {
        padding: 8px 12px;
    }
    .row.flex-nowrap {
        overflow-x: auto;
        flex-wrap: nowrap;
    }
    .materie-input {
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 4px 6px;
        font-size: 0.85rem;
        margin-top: 4px;
    }
    .save-button {
        display: block;
        margin: 30px auto;
    }
    .card-footer {
        padding: 8px;
        text-align: center;
        background: #f8f9fa;
    }
    .card-footer button {
        margin: 0 5px;
        font-weight: bold;
    }
</style>

<?php
$this->title = 'Curriculum';
?>

<div class="container mt-5 pt-5">
    <h1 class="text-center my-4">Curriculum săptămânal - clasa IX B</h1>

<!--    Trimitem catre o functie separata. Pt. simplitate ramanem in SiteController -->

    <form method="post" action="<?= \yii\helpers\Url::to(['site/edit-curriculum']) ?>">
<!--        protectie CSRF -->
        <?= \yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>

        <div class="row justify-content-center flex-nowrap">
            <?php
            foreach ($zile as $ziIndex => $zi) {


                $materii = $schedule[$zi] ?? [];
                ?>


                <div class="col-auto mb-3">
                    <div class="card" data-zi-index="<?= $ziIndex ?>">


                        <div class="card-header bg-primary text-white">
                            <strong><?= $zi ?></strong>
                        </div>


                        <ul class="list-group list-group-flush" id="lista-<?= $ziIndex ?>">


                            <?php foreach ($materii as $interval => $materie) {

                                $input_name = "materii[$ziIndex][$interval]";
                                ?>


                                <li class="list-group-item">
                                    <?= $interval ?><br>
                                    <input type="text" class="materie-input" name="<?= $input_name ?>" value="<?= htmlspecialchars($materie) ?>">
                                </li>

                            <?php } ?>


                        </ul>
                        <div class="card-footer">
                            <button type="button" class="btn btn-sm btn-outline-success add-hour" data-zi="<?= $ziIndex ?>">＋</button>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-hour" data-zi="<?= $ziIndex ?>">−</button>
                        </div>
                    </div>
                </div>
            <?php }; ?>
        </div>

        <button type="submit" class="btn btn-success save-button">Salvează modificările</button>
    </form>
</div>


<!--In caz ca am modificat cu success-->
<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success"><?= Yii::$app->session->getFlash('success') ?></div>
<?php elseif (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger"><?= Yii::$app->session->getFlash('error') ?></div>
<?php endif; ?>


<?php
$this->registerJsFile('@web/assets/js/curriculum.js');
?>


