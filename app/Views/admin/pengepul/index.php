<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>
<div class="d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <?= $this->include('admin/layout/_headerBawah'); ?>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <!--begin::Container-->
    <div class="ml-5 mr-5">
        <?php
        $pesan = session()->getFlashData('pesan');
        if (!empty($pesan)) {
            echo $pesan;
        }
        ?>
        <!--begin::Card-->
        <div class="card card-custom">
            <?= $this->include('tools/tombolTambah'); ?>
            <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%; max-height: 50vh;padding:10px 20px">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="table" role="grid" aria-describedby="kt_datatable1_info" style="width: 1110px;">
                    <thead class="text-center">
                        <tr>
                            <th>Nama Pengepul</th>
                            <th>Email</th>
                            <th>Hp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script type="text/javascript">
    var table;

    $(document).ready(function() {

        //defenisi datatable
        $('#table').DataTable({
            "searching": true,
            "filter": false,
            "lengthChange": false,
            "processing": true,
            "language": {
                "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('pengepul/datatablesource') ?>",
                "type": "POST",
            },
            "columnDefs": [{
                    "targets": [0],
                    "orderable": false,
                    "className": 'text-center'
                },
                {
                    "targets": [1],
                    "orderable": false,
                    "className": 'text-center'
                },
                {
                    "targets": [2],
                    "orderable": false,
                    "className": 'text-center'
                },
                {
                    "targets": [3],
                    "orderable": false,
                    "className": 'text-center'
                },
            ],
            "language": {
                "infoFiltered": ""
            },
            fnInitComplete: function() {
                $("[data-toggle='tooltip']").tooltip({
                    container: 'body'
                });
            }
        });


    }); //end (document).ready
</script>
<?= $this->endSection() ?>