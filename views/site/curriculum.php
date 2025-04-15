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
</style>

<?php
$this->title = 'Curriculum';
?>

<div class="container">
    <h1 class="text-center my-4">Curriculum saptamanal</h1>
    <div class="row justify-content-center flex-nowrap">
        <?php
        $zile = ['Luni', 'Marti', 'Miercuri', 'Joi', 'Vineri'];
        foreach ($zile as $zi): ?>
            <div class="col-auto mb-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <strong><?= $zi ?></strong>
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php for ($i = 1; $i <= rand(5, 8); $i++): ?>
                            <li class="list-group-item">
                                <?= sprintf('%02d:00 - %02d:00', 8 + $i - 1, 9 + $i - 1) ?><br>
                                Materie: Exemplu <?= $i ?>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
