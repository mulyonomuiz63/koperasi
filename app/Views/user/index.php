<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">User</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">View</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <?php
            $pesan = session()->getFlashData('pesan');
            if (!empty($pesan)) {
                echo $pesan;
            }
            ?>
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header flex-wrap bg-light-warning">
                    <div class="card-title">
                        <!-- <h3 class="card-label">User
                        </h3> -->
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Dropdown-->
                        <!-- $this->include('layout/custom/_export');  -->
                        <!--end::Dropdown-->
                        <!--begin::Button-->
                        <a href="<?php echo ('user/tambah') ?>" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <circle fill="#000000" cx="9" cy="15" r="6" />
                                        <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>Tambah User
                        </a>
                        <!--end::Button-->
                    </div>
                </div>
                <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%; max-height: 60vh;padding:10px 20px">
                    <!--begin: Datatable-->
                    <table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="table" role="grid" aria-describedby="kt_datatable1_info" style="width: 1110px;">
                        <thead class="text-center">
                            <tr>
                                <th class="text-left">Nama User</th>
                                <th>Role AKses</th>
                                <th>Email</th>
                                <th>Hp</th>
                                <th>Verifikasi Email</th>
                                <th>Status</th>
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
                "url": "<?php echo site_url('user/datatablesource') ?>",
                "type": "POST",
            },
            "columnDefs": [{
                    "targets": [0],
                    "orderable": false,
                    "className": 'text-left'
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
                {
                    "targets": [4],
                    "orderable": false,
                    "className": 'text-center'
                },
                {
                    "targets": [5],
                    "orderable": false,
                    "className": 'text-center'
                },
                {
                    "targets": [6],
                    "orderable": false,
                    "className": 'text-center'
                },


            ],
            "language": {
                "infoFiltered": ""
            }
        });


    }); //end (document).ready
</script>
<?= $this->endSection() ?>