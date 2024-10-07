<?php
// Koneksi ke database
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "website_cinta"; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Hapus kenangan
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Ambil nama file foto dari database berdasarkan id_kenangan
        $stmt = $conn->prepare("SELECT foto FROM kenangan WHERE id_kenangan = ?");
        $stmt->execute([$id]);
        $kenangan = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($kenangan) {
            $foto = $kenangan['foto'];

            // Hapus record dari database
            $stmt = $conn->prepare("DELETE FROM kenangan WHERE id_kenangan = ?");
            $stmt->execute([$id]);

            // Hapus file foto dari server
            $filePath = 'uploads/' . $foto;
            if (file_exists($filePath)) {
                if (unlink($filePath)) {
                    echo "<script>alert('Kenangan dan foto berhasil dihapus!'); window.location.href='cuy.php#memories';</script>";
                } else {
                    echo "<script>alert('Gagal menghapus foto.'); window.location.href='cuy.php#memories';</script>";
                }
            } else {
                echo "<script>alert('File foto tidak ditemukan.'); window.location.href='cuy.php#memories';</script>";
            }
        } else {
            echo "<script>alert('Kenangan tidak ditemukan!'); window.location.href='cuy.php#memories';</script>";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>