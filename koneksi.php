<?php
$koneksi = mysqli_connect("localhost", "root", "", "sesepuh");

// Check connection
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}
// $user = mysqli_query($koneksi, "select * from tbl_user");
// $hasil = "daftar member";
// while ($d = mysqli_fetch_array($user)) {
//     $hasil .= $d['name'] . "\n";
// }
$date = date('Y-m-d');
// $data = mysqli_query($koneksi, "select * from tbl_member where kode_ses='S11'");
// $data =  mysqli_query($koneksi, "SELECT B.nama, A.jumlah AS jml FROM tbl_transaksi A JOIN tbl_member B ON A.user_id = B.id WHERE A.tgl_transaksi ='$date' ");
// $data = mysqli_query($koneksi, "select * from tbl_member where kode_ses='S01'");
// $id = mysqli_num_rows($data);
$raport = mysqli_query($koneksi, "SELECT
B.`nama`,
SUM( A.jumlah ) AS jml 
FROM
tbl_transaksi A
JOIN tbl_member B ON A.user_id = B.id 
WHERE
A.tgl_transaksi BETWEEN '2019-11-01' 
AND '2019-11-30' 
GROUP BY
A.user_id 
ORDER BY
A.jumlah DESC");
$id = mysqli_fetch_array($raport);
print_r($id);
// if ($id) {
//     echo $id['id'];
// } else {
//     echo 'kosong';
// }
// echo $id;
// echo mysqli_num_rows($data);
