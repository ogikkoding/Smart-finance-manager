<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include __DIR__ . '/database/koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: /OGIKFINANC/login.php");
    exit;
}

$user_id = $_SESSION['id'];

$query = mysqli_query($conn, "
    SELECT *
    FROM notes
    WHERE user_id='$user_id'
    ORDER BY created_at DESC
");
?>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">
            <i class="fas fa-sticky-note"></i> Catatan Saya
        </h4>
    </div>

    <div class="card-body">

        <form action="/OGIKFINANC/proses/Proses logika/proses_notes.php" method="POST">
            <input type="hidden" name="action" value="tambah">
            <div class="form-group">
                <label>Tulis Catatan</label>

                <textarea id="isi_note"
                    name="isi_note"
                    class="form-control auto-list"
                    rows="4"
                    placeholder="Tulis sesuatu..."
                    required></textarea>
            </div>

            <button class="btn btn-success">
                <i class="fas fa-save"></i> Simpan Note
            </button>
        </form>

        <hr>

        <?php if (mysqli_num_rows($query) == 0) { ?>

            <div class="alert alert-warning">
                Belum ada catatan.
            </div>

        <?php } ?>

        <?php while ($note = mysqli_fetch_assoc($query)) { ?>

            <div class="card mb-3 shadow-sm">
                <div class="card-body">

                    <div id="view<?= $note['id']; ?>">

                        <p style="white-space:pre-line;">
                            <?= htmlspecialchars($note['isi_note']); ?>
                        </p>

                        <small class="text-muted">
                            Dibuat :
                            <?= date('d-m-Y H:i', strtotime($note['created_at'])); ?>
                        </small>

                    </div>

                    <div id="edit<?= $note['id']; ?>" style="display:none">

                        <form action="/OGIKFINANC/proses/Proses logika/proses_notes.php" method="POST">

                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="<?= $note['id']; ?>">

                            <textarea
                                name="isi_note"
                                class="form-control auto-list mb-2"
                                rows="4"
                                required><?= htmlspecialchars($note['isi_note']); ?></textarea>

                            <button class="btn btn-success btn-sm">
                                Simpan
                            </button>

                            <button
                                type="button"
                                class="btn btn-secondary btn-sm"
                                onclick="batalEdit(<?= $note['id']; ?>)">
                                Batal
                            </button>

                        </form>

                    </div>

                    <hr>

                    <button
                        type="button"
                        class="btn btn-warning btn-sm"
                        onclick="editNote(<?= $note['id']; ?>)">
                        Edit
                    </button>

                    <a
                        href="/OGIKFINANC/proses/Proses logika/proses_notes.php?action=hapus&id=<?= $note['id']; ?>"
                        onclick="return confirm('Hapus catatan ini?')"
                        class="btn btn-danger btn-sm">
                        Hapus
                    </a>

                </div>
            </div>

        <?php } ?>

    </div>
</div>

<script>
    function editNote(id) {
        document.getElementById("view" + id).style.display = "none";
        document.getElementById("edit" + id).style.display = "block";
    }

    function batalEdit(id) {
        document.getElementById("view" + id).style.display = "block";
        document.getElementById("edit" + id).style.display = "none";
    }

    function installAutoList(el) {

        if (el.dataset.ready) return;
        el.dataset.ready = "1";

        el.addEventListener("keydown", function(e) {

            if (e.key !== "Enter") return;

            const pos = this.selectionStart;
            const before = this.value.substring(0, pos);
            const line = before.split("\n").pop();

            let m;

            // 1.
            m = line.match(/^(\d+)\.\s*(.*)$/);
            if (m) {
                e.preventDefault();
                const next = parseInt(m[1]) + 1;
                this.setRangeText("\n" + next + ". ", pos, pos, "end");
                return;
            }

            // a.
            m = line.match(/^([a-zA-Z])\.\s*(.*)$/);
            if (m) {
                e.preventDefault();
                const c = m[1];
                const next = String.fromCharCode(c.charCodeAt(0) + 1);
                this.setRangeText("\n" + next + ". ", pos, pos, "end");
                return;
            }

            // -
            m = line.match(/^\-\s*(.*)$/);
            if (m) {
                e.preventDefault();
                this.setRangeText("\n- ", pos, pos, "end");
                return;
            }

            // *
            m = line.match(/^\*\s*(.*)$/);
            if (m) {
                e.preventDefault();
                this.setRangeText("\n* ", pos, pos, "end");
            }

        });

    }

    document.querySelectorAll(".auto-list").forEach(installAutoList);
</script>