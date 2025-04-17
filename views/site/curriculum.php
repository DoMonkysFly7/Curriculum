<style>
    /* Style pentru orar. Pastram CSS-ul aici pt. simplitate */
    .orar-scroll-wrapper {
        overflow-x: unset;
        overflow-y: visible;
        white-space: normal;
    }

    @media (max-width: 768px) {
        .orar-scroll-wrapper {
            overflow-x: auto;
            overflow-y: hidden;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .orar-scroll-inner {
            display: flex;
            flex-wrap: nowrap;
            gap: 1rem;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .card {
            flex: 0 0 auto;
        }
    }

    /* Pe desktop: afișează frumos în rânduri */
    @media (min-width: 769px) {
        .orar-scroll-inner {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            justify-content: center;
        }

        .card {
            width: 240px;
        }
    }


    .orar-scroll-inner {
        display: flex;
        flex-wrap: nowrap;
        gap: 1rem;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .card {
        flex: 0 0 auto;
        width: 240px;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
        font-size: 0.9rem;
    }

    .card-header {
        font-size: 1.1rem;
        text-align: center;
        background-color: #007bff;
        color: white;
        padding: 10px 14px;
    }

    .list-group-item {
        padding: 8px 12px;
        font-size: 0.85rem;
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
        max-width: 300px;
        width: 100%;
        font-weight: bold;
    }

    .card-footer {
        padding: 8px;
        text-align: center;
        background: #f8f9fa;
    }

    .card-footer button {
        margin: 0 5px;
        font-weight: bold;
        padding: 4px 10px;
        font-size: 0.8rem;
    }

    @media (max-width: 576px) {
        .card {
            width: 220px;
            font-size: 0.8rem;
        }

        h1 {
            font-size: 1.3rem;
        }

        .materie-input {
            font-size: 0.75rem;
        }
    }
</style>


<?php
$this->title = 'Curriculum';
?>




<div class="container pt-5 mt-4">

    <!--In caz ca am modificat cu success-->
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success"><?= Yii::$app->session->getFlash('success') ?></div>
    <?php elseif (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger"><?= Yii::$app->session->getFlash('error') ?></div>
    <?php endif; ?>


    <h1 class="text-center my-4">Curriculum săptămânal - clasa IX B</h1>

<!--    Trimitem catre o functie separata. Pt. simplitate ramanem in SiteController -->

    <form method="post" action="<?= \yii\helpers\Url::to(['site/edit-curriculum']) ?>">


<!--        protectie CSRF -->
        <?= \yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>


        <div class="orar-scroll-wrapper">
            <div class="orar-scroll-inner">
                <?php foreach ($zile as $ziIndex => $zi): ?>
                    <?php $materii = $schedule[$zi] ?? []; ?>
                    <div class="card" data-zi-index="<?= $ziIndex ?>">
                        <div class="card-header">
                            <strong><?= $zi ?></strong>
                        </div>

                        <ul class="list-group list-group-flush" id="lista-<?= $ziIndex ?>">
                            <?php foreach ($materii as $interval => $materie):
                                $input_name = "materii[$ziIndex][$interval]";
                                ?>
                                <li class="list-group-item">
                                    <?= $interval ?><br>
                                    <input maxlength="30" type="text" class="materie-input" name="<?= $input_name ?>" value="<?= htmlspecialchars($materie) ?>">
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <div class="p-2">
                            <label for="notita-<?= $ziIndex ?>" class="form-label small text-muted">Notiță pentru <?= $zi ?>:</label>
                            <textarea maxlength="30" name="notita_<?= $ziIndex ?>" id="notita-<?= $ziIndex ?>" rows="2" class="form-control"><?= htmlspecialchars($notite[$zi] ?? '') ?></textarea>
                        </div>

                        <div class="card-footer">
                            <button type="button" class="btn btn-sm btn-outline-success add-hour" data-zi="<?= $ziIndex ?>">＋</button>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-hour" data-zi="<?= $ziIndex ?>">−</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>


        <button type="submit" class="btn btn-success save-button">Salvează modificările</button>
    </form>
</div>


<?php
$this->registerJsFile('@web/assets/js/curriculum.js');
?>


