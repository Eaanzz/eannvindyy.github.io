<?php
require 'config.php';

// Create
if (isset($_POST['add_kenangan'])) {
    $deskripsi = $_POST['deskripsi'];
    $foto = $_FILES['foto']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($foto);

    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        $stmt = $conn->prepare("INSERT INTO kenangan (foto, deskripsi) VALUES (?, ?)");
        $stmt->execute([$foto, $deskripsi]);
        echo "Kenangan berhasil ditambahkan!";
    } else {
        echo "Terjadi kesalahan saat mengupload gambar.";
    }
}

// Read
$kenangan = $conn->query("SELECT * FROM kenangan")->fetchAll(PDO::FETCH_ASSOC);

// Update
if (isset($_POST['update_kenangan'])) {
    $id = $_POST['id'];
    $deskripsi = $_POST['deskripsi'];
    $stmt = $conn->prepare("UPDATE kenangan SET deskripsi = ? WHERE id = ?");
    $stmt->execute([$deskripsi, $id]);
    echo "Kenangan berhasil diupdate!";
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM kenangan WHERE id = ?");
    $stmt->execute([$id]);
    echo "Kenangan berhasil dihapus!";
}
?>

<!-- Form tambah kenangan -->
<form action="kenangan.php" method="post" enctype="multipart/form-data">
    <label for="deskripsi">Deskripsi:</label>
    <input type="text" name="deskripsi" required>
    <label for="foto">Foto:</label>
    <input type="file" name="foto" required>
    <button type="submit" name="add_kenangan">Tambah Kenangan</button>
</form>

<!-- Daftar kenangan -->
<?php foreach ($kenangan as $item): ?>
<div>
    <img src="uploads/<?php echo $item['foto']; ?>" alt="<?php echo $item['deskripsi']; ?>" width="100">
    <p><?php echo $item['deskripsi']; ?></p>
    <form action="kenangan.php" method="post">
        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
        <input type="text" name="deskripsi" value="<?php echo $item['deskripsi']; ?>">
        <button type="submit" name="update_kenangan">Update</button>
    </form>
    <a href="kenangan.php?delete=<?php echo $item['id']; ?>"
        onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
</div>
<?php endforeach; ?>