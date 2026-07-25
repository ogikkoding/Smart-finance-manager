<?php
session_start();

require_once __DIR__ . '/../../database/koneksi.php';

// Cek login
if (!isset($_SESSION['login'])) {
    header("Location: /OGIKFINANC/login.php");
    exit;
}

$user_id = $_SESSION['id'];

// ============================
// TAMBAH NOTE
// ============================
if (isset($_POST['action']) && $_POST['action'] == 'tambah') {

    $isi_note = trim($_POST['isi_note']);

    if ($isi_note == "") {
        header("Location: /OGIKFINANC/user.php?url=notes");
        exit;
    }

    $isi_note = mysqli_real_escape_string($conn, $isi_note);

    mysqli_query($conn, "
        INSERT INTO notes
        (user_id, isi_note, created_at, updated_at)
        VALUES
        ('$user_id', '$isi_note', NOW(), NOW())
    ");

    header("Location: /OGIKFINANC/user.php?url=notes");
    exit;
}

// ============================
// UPDATE NOTE
// ============================
if (isset($_POST['action']) && $_POST['action'] == 'update') {

    $id = (int)$_POST['id'];
    $isi_note = trim($_POST['isi_note']);

    if ($isi_note == "") {
        header("Location: /OGIKFINANC/user.php?url=notes");
        exit;
    }

    $isi_note = mysqli_real_escape_string($conn, $isi_note);

    mysqli_query($conn, "
        UPDATE notes
        SET
            isi_note='$isi_note',
            updated_at=NOW()
        WHERE
            id='$id'
        AND
            user_id='$user_id'
    ");

    header("Location: /OGIKFINANC/user.php?url=notes");
    exit;
}

// ============================
// HAPUS NOTE
// ============================
if (isset($_GET['action']) && $_GET['action'] == 'hapus') {

    $id = (int)$_GET['id'];

    mysqli_query($conn, "
        DELETE FROM notes
        WHERE
            id='$id'
        AND
            user_id='$user_id'
    ");

    header("Location: /OGIKFINANC/user.php?url=notes");
    exit;
}

// ============================
// JIKA AKSES LANGSUNG
// ============================
header("Location: /OGIKFINANC/user.php?url=notes");
exit;
