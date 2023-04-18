<?php
include "akses.php";
$kategori = $_GET['kategori'];
$name = mysqli_query($koneksi,"SELECT * FROM list_akun WHERE kategori='$kategori' order by name");
echo "<option>- Select Account Name -</option>";
while($k = mysqli_fetch_array($name)){
echo "<option value=\"".$k['id']."\">".$k['id']." - ".$k['name']."</option>\n";
}
?>