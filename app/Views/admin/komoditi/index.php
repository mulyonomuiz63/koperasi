<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<!-- content -->
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
            <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%; max-height: 50vh; padding:5px 20px ">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="table" role="grid" aria-describedby="kt_datatable1_info" style="width: 1110px;">
                    <thead>
                        <tr>
                            <th class="text-left">Komoditi</th>
                            <th class="text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
    <!--end::Entry-->
</div>
<!-- end content -->

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
                "url": "<?php echo site_url('komoditi/datatablesource') ?>",
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