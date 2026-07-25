<!-- ===================================================== -->
<!--                 CADANGKAN DATA                        -->
<!-- ===================================================== -->

<div class="container">

    <!-- ================= HEADER ================= -->

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <h3 class="mb-2">

                <i class="fas fa-database text-primary"></i>

                Cadangkan Data

            </h3>

            <p class="text-muted mb-0">

                Buat salinan database atau ekspor data catatan untuk menjaga keamanan data Anda.

            </p>

        </div>

    </div>

    <!-- ================================================= -->
    <!--                BACKUP DATABASE                    -->
    <!-- ================================================= -->

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-primary text-white">

            <strong>

                <i class="fas fa-download"></i>

                Cadangkan Database

            </strong>

        </div>

        <div class="card-body">

            <form
                action="proses/Proses logika fitur/proses_pencadangan_data.php"
                method="POST">

                <!-- Nama Backup -->
                <div class="form-group">
                    <label>
                        Nama Cadangan
                    </label>

                    <input
                        type="text"
                        name="nama_backup"
                        class="form-control"
                        value="backup_<?php echo date('Y-m-d_H-i-s'); ?>">

                </div>

                <!-- Jenis -->

                <div class="form-group">

                    <label>

                        Jenis Cadangan

                    </label>

                    <select
                        name="jenis_backup"
                        class="form-control">

                        <option value="sql">

                            Database MySQL (.sql)

                        </option>

                    </select>

                </div>

                <div class="alert alert-info mb-3">

                    <i class="fas fa-info-circle"></i>

                    Setelah tombol ditekan, file backup akan langsung diunduh oleh browser.

                </div>

                <button
                    type="submit"
                    class="btn btn-success">

                    <i class="fas fa-download"></i>

                    Cadangkan Database

                </button>

            </form>

        </div>

    </div>

    <!-- ================================================= -->
    <!--                EXPORT CATATAN                     -->
    <!-- ================================================= -->
    <div class="card shadow-sm">

        <div class="card-header bg-success text-white">

            <strong>
                <i class="fas fa-file-excel"></i>
                Export Catatan Pengeluaran
            </strong>

        </div>

        <div class="card-body">

            <form
                action="/OGIKFINANC/fitur_lainnya/proses_export_catatan.php" method="POST">

                <div class="form-group">
                    <label>Format Export</label>
                    <select
                        name="format"
                        class="form-control">

                        <option value="xls">
                            Microsoft Excel (.xls)
                        </option>

                    </select>

                </div>

                <div class="alert alert-success mb-3">
                    <i class="fas fa-info-circle"></i>
                    Data pada tabel <strong>catatan_pengeluaran</strong> akan diekspor ke Microsoft Excel.

                </div>

                <button
                    type="submit"
                    class="btn btn-success">
                    <i class="fas fa-file-export"></i>
                    Export Catatan Pengeluaran

                </button>

            </form>

        </div>

    </div>