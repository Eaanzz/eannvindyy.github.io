<?php
// Koneksi ke database
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "website_cinta"; // Sesuaikan nama database

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cek apakah form disubmit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $deskripsi = $_POST['deskripsi'];

        // Cek apakah file gambar diupload
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $target_dir = "uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $target_file = $target_dir . basename($_FILES['foto']['name']);
            $foto = basename($_FILES['foto']['name']);
            
            // Pindahkan file yang diupload ke direktori target
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                // Insert ke database
                $stmt = $conn->prepare("INSERT INTO kenangan (foto, deskripsi) VALUES (?, ?)");
                $stmt->execute([$foto, $deskripsi]);
                echo "<script>alert('Kenangan berhasil ditambahkan!');</script>";
            } else {
                echo "<script>alert('Terjadi kesalahan saat mengupload gambar.');</script>";
            }
        }
    }

    // Hapus kenangan
    if (isset($_POST['hapus'])) {
        $id = $_POST['id'];
        $stmt = $conn->prepare("DELETE FROM kenangan WHERE id = ?");
        $stmt->execute([$id]);
        echo "<script>alert('Kenangan berhasil dihapus!');</script>";
    }

    // Tampilkan semua kenangan
    $stmt = $conn->prepare("SELECT * FROM kenangan");
    $stmt->execute();
    $kenangan = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I Love You Vindyyy</title>
    <meta name="description" content="Semangat beraktifitas ya sayang">
    <meta name="author" content="Raehan Ramadhan">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/efekteks.css">
    <link rel="stylesheet" href="css/responsif.css">
    <link rel="stylesheet" href="css/buciners.css">
    <link rel="stylesheet" href="css/yains.css">
    <!-- <link rel="shortcut icon" href="gambar/gambar1.jpg" type="image/x-icon"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
</head>

<body>
    <nav class="navbar" id="navbar">
        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">Tentang Kita</a></li>
            <li><a href="#memories">Kenangan</a></li>
            <li><a href="#contact">Kontak</a></li>
        </ul>
    </nav>

    <div class="kontener2" id="kontener2">
        <h1>Hai Sayang</h1>
        <button class="tombol" id="tombol">Mulai Sekarang</button>
    </div>

    <div class="kontener" id="kontener" style="display: none">
        <div class="dalemnya_kontener">
            <section class="halaman4 dalemnya_halaman" id="home" onclick="PindahKeHalaman(3)">
                <h1 class="judul_halaman">Vindyy anddd Rehannn</h1>
                <br />
                <h1 id="waktu"></h1>
                <script type="text/javascript">
                document.write("<center>");
                var hari = new Date();
                var jam = hari.getHours();
                if (jam >= 0 && jam < 12) {
                    document.write(
                        "<h1 class='ucapan'>Selamat Pagi Cintakuu!</h1><p class='isiucapan'>Saat aku membuka mata setiap harinya, yang ingin aku lihat hanya you you and youuu. i love you sayanggg <3</p>"
                    );
                } else if (jam == 12) {
                    document.write(
                        "<h1 class='ucapan'>Selamat Siang Sayanggkuuuu!</h1><p class='isiucapan'>Jangan Lupa Makan Yaa Sayanggg. aku sayang kamuuu <3</p>"
                    );
                } else if (jam >= 12 && jam <= 17) {
                    document.write(
                        "<h1 class='ucapan'>Selamat Siang Menjelang Sore Sayang!</h1><p class='isiucapan'>Jangan Lupa Mandi + Jam demi jam telah kamu lalui dengan baik, persiapkan diri kamu untuk aktifitas yang akan datang ya sayang. i love you sayang <3</p>"
                    );
                } else {
                    document.write(
                        "<h1 class='ucapan'>Selamat Malam Sayang!</h1><p class='isiucapan'>Setelah seharian beraktifitas, kini telah tiba saatnya untuk beristirahat, rebahkan dirimu di kasur kesayanganmu. kabari aku disetiap kegiatan kammuu yaaa. i love you sayang <3</p>"
                    );
                }
                document.write("</center>");
                </script>
            </section>
        </div>

        <section class="tentang-kita" id="about">
            <div class="konten-tentang">
                <h1 class="judul-tentang">Tentang Kita</h1>
                <p class="isi-tentang">
                    Ini tentang dua hati yang bertemu di persimpangan waktu. Sejak
                    pertama kali kita berbicara, aku tahu ada sesuatu yang lebih dalam,
                    sebuah ikatan yang tak terlihat, tapi begitu nyata. Kamu adalah
                    alasan di balik senyumku, cahaya di hari-hariku yang gelap. Setiap
                    detik bersamamu adalah keindahan yang tak terlukiskan. Kamu adalah
                    rumahku, tempat aku pulang, dan aku selalu ingin bersamamu, hingga
                    akhir waktu.
                </p>
                <div class="foto-tentang">
                    <img src="gambar/gambar2.jpg" class="gambar" alt="Couple" />
                    <img src="gambar/gambar3.jpg" class="gambar" alt="Couple" />
                </div>
            </div>
        </section>

        <section class="kenangan" id="memories">
            <div class="konten-kenangan">
                <h1 class="judul-kenangan">Galeri Kenangan Kita</h1>
            </div>
            <div class="galeri-kenangan">
                <form action="" method="post" class="form-post" enctype="multipart/form-data">
                    <label for="deskripsi">Deskripsi:</label>
                    <input type="text" id="deskripsi" placeholder="Ketik disini yaaa" name="deskripsi">

                    <label for="foto">Upload Foto:</label>
                    <input type="file" id="foto" name="foto" required>

                    <button type="submit">Tambah Kenangan</button>
                </form>
            </div>

            <div class="galeri-kenangan">
                <?php foreach ($kenangan as $item): ?>
                <div class="item-kenangan">
                    <img src="uploads/<?php echo $item['foto']; ?>" alt="Kenangan" />
                    <div class="deskripsi-kenangan">
                        <?php echo $item['deskripsi']; ?>
                    </div>

                    <form action="hapus.php" class="hapus-form" method="post">
                        <input type="hidden" name="id" value="<?php echo $item['id_kenangan']; ?>" />
                        <button type="submit" name="hapus">Hapus</button>
                    </form>

                </div>
                <?php endforeach; ?>
            </div>

        </section>

        <section class="kontak" id="contact">
            <div class="konten-kontak">
                <h1 class="judul-kontak">Kontak Kita</h1>
                <p class="deskripsi-kontak">
                    Sayang, jika ada yang ingin kamu sampaikan atau jika kamu ingin
                    berbagi cerita, jangan ragu untuk menghubungi aku. Aku akan selalu
                    ada untuk mendengarkanmu. Berikut adalah beberapa cara untuk
                    menghubungiku:
                </p>
                <ul class="info-kontak">
                    <li><strong>Email:</strong><a
                            href="mailto:muhamadraehan949@gmail.com">muhamadraehan949@gmail.com</a></li>
                    <li><strong>Telepon:</strong><a href="tel:+6285157668341">+62 851 5766 8341 (Raehan)</a></li>
                    <li><strong>Telepon:</strong><a href="tel:+6285387669600">+62 853 8766 9600 (Vindy)</a></li>
                    <li><strong>Alamat:</strong>Kepoooooo, wleee😜😜</li>
                </ul>
            </div>
        </section>
    </div>

    <script>
    const tombol = document.getElementById('tombol');
    const kontener = document.getElementById('kontener');
    tombol.addEventListener('click', () => {
        kontener.style.display = 'block';
    });

    function PindahKeHalaman(halaman) {
        const sections = document.querySelectorAll('.dalemnya_halaman');
        sections.forEach(section => {
            section.style.display = 'none';
        });
        document.querySelector('.halaman' + halaman).style.display = 'block';
    }
    </script>

    <script src="script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.0/jquery.min.js"
        integrity="sha512-synHs+rLg2WDVE9U0oHVJURDCiqft60GcWOW7tXySy8oIr0Hjl3K9gv7Bq/gSj4NDVpc5vmsNkMGGJ6t2VpUMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.rawgit.com/bungfrangki/efeksalju/2a7805c7/efek-salju.js" type="text/javascript"></script>
    <script src="script.js"></script>
    <script>
    document.getElementById("waktu").innerHTML = formatAMPM();

    function formatAMPM() {
        var waktu = new Date(),
            menit =
            waktu.getMinutes().toString().length == 1 ?
            "0" + waktu.getMinutes() :
            waktu.getMinutes(),
            jam =
            waktu.getHours().toString().length == 1 ?
            "0" + waktu.getHours() :
            waktu.getHours(),
            ampm = waktu.getHours() >= 12 ? "PM" : "AM",
            bulan = [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Agustus",
                "September",
                "Oktober",
                "November",
                "Desember",
            ],
            hari = [
                "Minggu",
                "Senin",
                "Selasa",
                "Rabu",
                "Kamis",
                "Jumat",
                "Sabtu",
            ];
        return (
            '<h1 class="ml1"><span class="text-wrapper"><span class="line line1"></span><span class="letters">' +
            hari[waktu.getDay()] +
            ", " +
            waktu.getDate() +
            " " +
            bulan[waktu.getMonth()] +
            " " +
            waktu.getFullYear() +
            '</span><span class="line line2"></span></span></h1><p class="ml2"> ' +
            jam +
            ":" +
            menit +
            " " +
            ampm +
            " </p>"
        );
    }
    </script>
    <script>
    $(document).ready(function() {
        var audio = new Audio("audio/musik.mp3");
        $("#tombol").click(function() {
            $("#kontener2").fadeOut();
            $("#kontener").fadeIn(4000);
            audio.play();
        });
    });
    </script>
    <script>
    var textWrapper = document.querySelector(".ml1 .letters");
    textWrapper.innerHTML = textWrapper.textContent.replace(
        /\S/g,
        "<span class='letter'>$&</span>"
    );

    anime
        .timeline({
            loop: false,
        })
        .add({
            targets: ".ml1 .letter",
            scale: [0.3, 1],
            opacity: [0, 1],
            translateZ: 0,
            easing: "easeOutExpo",
            duration: 950,
            delay: 1400,
        })
        .add({
            targets: ".ml2",
            opacity: 1,
            duration: 1000,
            easing: "easeOutExpo",
            delay: 1000,
        });
    </script>
</body>

</html>