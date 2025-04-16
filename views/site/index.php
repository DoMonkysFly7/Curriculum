<?php

/** @var yii\web\View $this */
$this->title = 'Hello Yii2!';
?>

<div class="site-index mt-5 pt-5">

    <div class="jumbotron text-center bg-light py-5 px-3 rounded">
        <h1 class="display-5 fw-bold mb-3">
            <i class="fas fa-check-circle text-success me-2"></i>Felicitări!
        </h1>
        <p class="lead mb-0 text-muted">echo "<strong>Hello Yii2!</strong>"</p>
    </div>

    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-4 border rounded h-100 shadow-sm bg-white">
                    <h2 class="h5 text-primary">
                        <i class="fas fa-handshake me-2"></i>Salutare

                    </h2>
                    <p class="mb-0">
                        Bine ai venit la primul meu proiect în Yii2! Sper să nu fie și ultimul. Astăzi îți voi prezenta exercițiul <strong>„Orar liceean”</strong>. Sper că o să îți placă să-l folosești la fel de mult cum mi-a plăcut mie să-l creez.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 border rounded h-100 shadow-sm bg-white">
                    <h2 class="h5 text-primary">
                        <i class="fas fa-history me-2"></i>Înapoi în timp
                    </h2>
                    <p class="mb-0">
                        Fă o pauză de la grijile cotidiene și imaginează-ți că ești iar în liceu. Doar că, de data asta, ai acces la o platformă digitală (MagicEducativa!) pentru orarul tău — nu doar o foaie mototolită (pe care, oricum, probabil ai pierdut-o).
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 border rounded h-100 shadow-sm bg-white">
                    <h2 class="h5 text-primary">
                        <i class="fas fa-tasks me-2"></i>Ce poți face
                    </h2>
                    <ul class="ps-3 mb-3">
                        <li><i class="fas fa-edit text-secondary me-1"></i> Modifică-ți orarul după cum dorești, adăugând sau ștergând clasele</li>
                        <li><i class="fas fa-bold text-secondary me-1"></i> Ai o oră importantă săptămâna asta? Poți să folosești editorul de text pentru a o „îngroșa” sau a o sublinia</li>
                        <li><i class="fas fa-sticky-note text-secondary me-1"></i> Nu vrei să uiți de tema lui domn' Popescu de la Fizică, nu? Aia mai lipsea, încă un 4 în catalog... deci mai bine adaugă-ți o notiță!</li>
                    </ul>
                    <p class="mb-3">Înainte de toate însă, orarul tău este o treabă personală, așa că trebuie să te loghezi. Succes în noul an școlar!</p>

                    <div class="text-center">
                        <a class="btn btn-primary px-4" href="/login">
                            <i class="fas fa-sign-in-alt me-2"></i>Logare &raquo;
                        </a>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
