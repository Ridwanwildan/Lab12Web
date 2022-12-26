<?php
    $q="";
    if (isset($_GET['submit']) && !empty($_GET['q'])) {
      $q = $_GET['q'];
      $sql_where = " WHERE nama LIKE '%{$q}%'";
    }

    $title = 'Data Barang';
    include_once 'koneksi.php';
    $sql = 'SELECT * FROM data_barang';
    if (isset($sql_where))
      $sql .=$sql_where;
    $result = mysqli_query($conn, $sql);
    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link href="style/style.css" rel="stylesheet" type="text/css" />
    <title>Data Barang</title>
  </head>
  <body>
    <div class="container">
      <h1>Data Barang</h1>
      <a href="tambah.php">Tambah Barang</a>
      <form action="" method="get">
        <label for="q">
          Cari data:
        </label>
        <input type="text" id="q" name="q" class="input-q" value="<?php echo $q ?>">
        <input type="submit" name="submit" value="cari" class="btn btn-primary">
      </form>
      <div class="main">
        <table>
          <tr>
            <th>Gambar</th>
            <th>Nama Barang</th>
            <th>Katagori</th>
            <th>Harga Jual</th>
            <th>Harga Beli</th>
            <th>Stok</th>
            <th>Aksi</th>
          </tr>
          <?php if($result): ?>
          <?php while($row = mysqli_fetch_array($result)): ?>
          <tr>
            <td>
              <img
                src="gambar/<?= $row['gambar'];?>"
                alt="<?=$row['nama'];?>"
              />
            </td>
            <td><?= $row['nama'];?></td>
            <td><?= $row['kategori'];?></td>
            <td><?= $row['harga_beli'];?></td>
            <td><?= $row['harga_jual'];?></td>
            <td><?= $row['stok'];?></td>
            <td>
              <a href="ubah.php?id=<?php echo $row['id_barang'];?>">
                ubah
              </a>
              <a href="hapus.php?id=<?php echo $row['id_barang'];?>">
                hapus
              </a>
            </td>
          </tr>
          <?php endwhile; else: ?>
          <tr>
            <td colspan="7">Belum ada data</td>
          </tr>
          <?php endif; ?>
        </table>
      </div>
    </div>
  </body>
</html>
