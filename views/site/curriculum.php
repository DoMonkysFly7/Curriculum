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

<div class="container">
    <h1 class="text-center my-4">Curriculum săptămânal - clasa IX B</h1>

    <form method="post" action="">
        <div class="row justify-content-center flex-nowrap">
            <?php
            $zile = ['Luni', 'Marți', 'Miercuri', 'Joi', 'Vineri'];
            foreach ($zile as $ziIndex => $zi): ?>
                <div class="col-auto mb-3">
                    <div class="card" data-zi-index="<?= $ziIndex ?>">
                        <div class="card-header bg-primary text-white">
                            <strong><?= $zi ?></strong>
                        </div>
                        <ul class="list-group list-group-flush" id="lista-<?= $ziIndex ?>">
                            <?php for ($i = 1; $i <= 6; $i++):
                                $ora_inceput = 8 + $i - 1;
                                $ora_sfarsit = 9 + $i - 1;
                                $materie = "Exemplu $i";
                                $input_name = "materii[$ziIndex][$i]";
                                ?>
                                <li class="list-group-item">
                                    <?= sprintf('%02d:00 - %02d:00', $ora_inceput, $ora_sfarsit) ?><br>
                                    <input type="text" class="materie-input" name="<?= $input_name ?>" value="<?= $materie ?>">
                                </li>
                            <?php endfor; ?>
                        </ul>
                        <div class="card-footer">
                            <button type="button" class="btn btn-sm btn-outline-success add-hour" data-zi="<?= $ziIndex ?>">＋</button>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-hour" data-zi="<?= $ziIndex ?>">−</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <button type="submit" class="btn btn-success save-button">Salvează modificările</button>
    </form>
</div>

<script>
    document.querySelectorAll('.add-hour').forEach(btn => {
        btn.addEventListener('click', () => {
            const zi = btn.getAttribute('data-zi');
            const list = document.getElementById('lista-' + zi);
            const count = list.children.length;
            const startHour = 8 + count;
            const endHour = 9 + count;
            const hourLabel = `${String(startHour).padStart(2, '0')}:00 - ${String(endHour).padStart(2, '0')}`;
            const inputName = `materii[${zi}][${count + 1}]`;

            const li = document.createElement('li');
            li.className = 'list-group-item';
            li.innerHTML = `${hourLabel}<br><input type="text" class="materie-input" name="${inputName}" value="Nouă materie">`;
            list.appendChild(li);
        });
    });

    document.querySelectorAll('.remove-hour').forEach(btn => {
        btn.addEventListener('click', () => {
            const zi = btn.getAttribute('data-zi');
            const list = document.getElementById('lista-' + zi);
            if (list.children.length > 0) {
                list.removeChild(list.lastElementChild);
            }
        });
    });
</script>
