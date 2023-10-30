<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row pt-4">
        <div class="col d-flex flex-row align-items-center">
            <h4 class="">Laporan Tanam</h4>
            <i class=" mx-2 fa-solid fa-angles-right"></i>
            <span class="text-success">Laporan</span>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded mt-3 table-responsive">
                <h6 class="mt-4">Dashboard</h6>


                <div class="accordion-item">
                    <div class="accordion-body">
                        <div class="input-group">
                        </div>
                    </div>
                </div>
                <table class="table table-hover" id="table-view">
                    <thead class="text-center">
                        <tr>
                            <th> Jenis Laporan</th>
                            <th> Tanggal</th>
                            <th> Komoditi</th>
                            <th> Luas/Hektar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>
<?= $this->endSection() ?>