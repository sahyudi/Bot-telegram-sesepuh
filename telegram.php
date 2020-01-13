DATA HOSTED WITH ♥ BY PASTEBIN.COM - DOWNLOAD RAW - SEE ORIGINAL
<?php
/*
BOT PENGANTAR
Materi EBOOK: Membuat Sendiri Bot Telegram dengan PHP
Ebook live http://telegram.banghasan.com/
oleh: bang Hasan HS
id telegram: @hasanudinhs
email      : banghasan@gmail.com
twitter    : @hasanudinhs
disampaikan pertama kali di: Grup IDT
dibuat: Juni 2016, Ramadhan 1437 H
nama file : PertamaBot.php
change log:
revisi 1 [15 Juli 2016] :
+ menambahkan komentar beberapa line
+ menambahkan kode webhook dalam mode comment
Pesan: baca dengan teliti, penjelasan ada di baris komentar yang disisipkan.
Bot tidak akan berjalan, jika tidak diamati coding ini sampai akhir.
*/
//isikan token dan nama botmu yang di dapat dari bapak bot :
$TOKEN      = "910315548:AAFGD3BDxaKxvUhGZvFd1YdXZj5xmh85iYk"; // ganti dengan token bot anda
$usernamebot = "@sesepuh_bot"; // sesuaikan besar kecilnya, bermanfaat nanti jika bot dimasukkan grup.
// aktifkan ini jika perlu debugging
$debug = false;

// include 'koneksi.php';

// fungsi untuk mengirim/meminta/memerintahkan sesuatu ke bot
function request_url($method)
{
  global $TOKEN;
  return "https://api.telegram.org/bot" . $TOKEN . "/" . $method;
}

// fungsi untuk meminta pesan
// bagian ebook di sesi Meminta Pesan, polling: getUpdates
function get_updates($offset)
{
  $url = request_url("getUpdates") . "?offset=" . $offset;
  $resp = file_get_contents($url);
  $result = json_decode($resp, true);
  if ($result["ok"] == 1)
    return $result["result"];
  return array();
}
// fungsi untuk mebalas pesan,
// bagian ebook Mengirim Pesan menggunakan Metode sendMessage
function send_reply($chatid, $msgid, $text)
{
  global $debug;
  $data = array(
    'chat_id' => $chatid,
    'text'  => $text,
    'reply_to_message_id' => $msgid   // <---- biar ada reply nya balasannya, opsional, bisa dihapus baris ini
  );
  // use key 'http' even if you send the request to https://...
  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data),
    ),
  );
  $context  = stream_context_create($options);
  $result = file_get_contents(request_url('sendMessage'), false, $context);
  if ($debug) {
    print_r($result);
  }
}

// fungsi mengolahan pesan, menyiapkan pesan untuk dikirimkan
function create_response($text, $message)
{
  global $usernamebot;
  $date = date('Y-m-d');
  // inisiasi variable hasil yang mana merupakan hasil olahan pesan
  $koneksi = mysqli_connect("localhost", "root", "", "sesepuh");
  $user = mysqli_query($koneksi, "select * from tbl_user");
  $member = mysqli_query($koneksi, "select * from tbl_member");
  $rekapan = mysqli_query($koneksi, "SELECT B.nama, B.kode_ses As s_id, A.jumlah AS jml FROM tbl_transaksi A JOIN tbl_member B ON A.user_id = B.id WHERE A.tgl_transaksi ='$date' ORDER BY B.kode_ses ASC ");
  $raport = mysqli_query($koneksi, "SELECT
  B.`nama`, B.kode_ses,
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
  SUM( A.jumlah ) DESC");

  $hasil = '';
  $fromid = $message["from"]["id"]; // variable penampung id user
  $chatid = $message["chat"]["id"]; // variable penampung id chat
  $pesanid = $message['message_id']; // variable penampung id message
  // variable penampung username nya user
  isset($message["from"]["username"])
    ? $chatuser = $message["from"]["username"]
    : $chatuser = '';

  // variable penampung nama user
  isset($message["from"]["last_name"])
    ? $namakedua = $message["from"]["last_name"]
    : $namakedua = '';
  $namauser = $message["from"]["first_name"] . ' ' . $namakedua;
  // ini saya pergunakan untuk menghapus kelebihan pesan spasi yang dikirim ke bot.
  $textur = preg_replace('/\s\s+/', ' ', $text);
  // memecah pesan dalam 2 blok array, kita ambil yang array pertama saja
  $command = explode('_', $textur); //
  $date = date('Y-m-d');
  // identifikasi perintah (yakni kata pertama, atau array pertamanya)
  if (substr($command[0], 0, 1) == '/') {
    if ($command[0] == '/lapor') {
      // untuk menangkap idnyaa
      $data = mysqli_query($koneksi, "select * from tbl_member where kode_ses='$command[1]'");
      $id = mysqli_fetch_array($data);
      if ($id) {
        $data = mysqli_query($koneksi, "select * from tbl_transaksi where tgl_transaksi='$date' AND user_id='$id[id]'");
        if (mysqli_num_rows($data) < 1) {
          if ($id['telegram_id'] == $fromid) {
            $data = mysqli_query($koneksi, "insert into tbl_transaksi values('','$id[id]','$date','$command[3]')");
            if ($data) {
              $data = mysqli_query($koneksi, "UPDATE tbl_member SET `status` = 1 WHERE id = " . $id['id'] . " ");
              $hasil = "\xE2\x9C\x85 $command[1] $command[2] ($command[3])";
            } else {
              $hasil = "Gagal Menyimpan data laporan";
            }
          } else {
            $hasil = "Jangan Kerajinan deh buat ngelaporin orang lain, tolong yahh ";
          }
        } else {
          $hasil = "Anda sudah laporan hari ini";
        }
      } else {
        $hasil = "ID Sesepuh kamu tidak dikenali \n";
      }
      // memeriksa idnya sudah laporan atau belum

    } else if ($command[0] == '/daftar') {
      $data = mysqli_query($koneksi, "INSERT INTO tbl_member VALUES('','$command[1]','$command[2]','1','1','$fromid')");
      if ($data) {
        $hasil = "$namauser, selamat anda telah berhasil mendaftar sebagai member sesepuh";
      } else {
        $hasil = "Gagal Mendaftar sebagai member sesepuh";
      }
    } else if ($command[0] == '/update') {

      $data = mysqli_query($koneksi, "select * from tbl_member where kode_ses='$command[1]'");
      $id = mysqli_fetch_array($data);
      if ($command[2] == 'idTelegram') {
        if ($id) {
          $data = mysqli_query($koneksi, "UPDATE tbl_member SET telegram_id = $fromid WHERE id = '" . $id['id'] . "' ");
          if ($data) {
            $hasil = "Telegram ID anda sudah diperbarui";
          } else {
            $hasil = "Gagal Memperbarui telegram ID";
          }
        } else {
          $hasil = "Anda belum terdaftar sebagai member sesepuh";
        }
      } else {
        $hasil = "Fitur update lainnya belum tersedia";
      }

      // $hasil = "$namauser, ID kamu adalah $fromid pesan yang kamu kirim adalah $command[0]";
    } else if ($command[0] == '/id') {
      $hasil = "$namauser, ID kamu adalah $fromid pesan yang kamu kirim adalah $command[0]";
    } else if ($command[0] == 'nim') {
      $hasil = "Pesan yang kamu kirim adalah $command[0] dan $textur";
    } else if ($command[0] == '/tes-pesan') {
      $hasil = "Pesan yang kamu kirim adalah $command[0] dan $textur";
    } else if ($command[0] == '/ijazah') {
      $hasil = "Ambil di PI yah..";
    } else if ($command[0] == '/form') {
      // $hasil = "Cie jadi admin";
      $hasil = "\xF0\x9F\x93\x96 Sesepuh (Sehari Sepuluh) \xF0\x9F\x93\x96 \n";
      $hasil .= "\xE2\x98\x80" . date('d F Y') . "\xE2\x98\x80 \n\n";
      // pena \xE2\x9C\x92
      // buku \xF0\x9F\x93\x9A
      $hasil .= "\xE3\x80\xB0\xE3\x80\xB0\xE3\x80\xB0 \xE2\x9C\x92	\xF0\x9F\x93\x9A \xE2\x9C\x92 \xE3\x80\xB0\xE3\x80\xB0\xE3\x80\xB0\xE3\x80\xB0 \n\n";
      // $hasil .= "<b>" . $_quotes . "</b>\n\n";
      // $hasil .= "Admin : " . $_admin . "\n";
      $hasil .= "\xE3\x80\xB0\xE3\x80\xB0\xE3\x80\xB0\xE3\x80\xB0\xE3\x80\xB0\xE3\x80\xB0 \n\n\n";
      while ($d = mysqli_fetch_array($member)) {

        if ($d['status'] == 1) {
          $status = "\xE2\x9A\xAA";
        } else if ($d['status'] == 2) {
          $status = "\xF0\x9F\x94\xB5";
        } else if ($d['status'] == 3) {
          $status = "\xF0\x9F\x94\xB4";
        } else if ($d['status'] == 4) {
          $status = "\xF0\x9F\x9A\xB7";
        }
        $hasil .= "\x23\xE2\x83\xA3 " . $d['rank'] . " \xF0\x9F\x86\x94 " . $d['kode_ses'] . ' ' . $d['nama'] . ' ' . $status . "\n";
      }
    } else if ($command[0] == '/tanggal') {
      $hasil = "hari ini tanggal : " . date('d F Y');
    } else if ($command[0] == '/end') {
      $hasil = "Hari ini sudah esok lagi ...";
    } else if ($command[0] == '/raport') {
      $hasil = "Raport Bulan November 2019 \n\n";
      $no = 1;
      while ($d = mysqli_fetch_array($raport)) {
        $hasil .= "\x23\xE2\x83\xA3 " . $no++ . ' ' . " \xF0\x9F\x86\x94 " . $d['kode_ses'] . ' ' . $d['nama'] . ' ' . $d['jml'] . " \n";
      }
    } else if ($command[0] == '/user') {
      $hasil = "Daftar User Sesepuh : \n\n";
      while ($d = mysqli_fetch_array($user)) {
        $hasil .= $d['name'] . "\n";
      }
    } else if ($command[0] == '/member') {
      $hasil = "Daftar Member Sesepuh : \n\n";
      while ($d = mysqli_fetch_array($member)) {
        $hasil .= "\xF0\x9F\x86\x94 " . $d['kode_ses'] . ' - ' . $d['nama'] . ' - ' . $d['telegram_id'] . "\n";
      }
    } else if ($command[0] == '/rekapan') {
      $hasil = "laporan hari ini Member Sesepuh : \n\n";
      $hasil = "Tanggal : $date \n\n";
      while ($d = mysqli_fetch_array($rekapan)) {
        $hasil .= "\xE2\x9C\x85 " . $d['s_id'] . ' - ' . $d['nama'] . ' - ' . $d['jml'] . "\n";
      }
    } else {
      $hasil = "Perintah yang anda masukkan tidak ditemukan";
    }
  }
  return $hasil;
}

// jebakan token, klo ga diisi akan mati
// boleh dihapus jika sudah mengerti
if (strlen($TOKEN) < 20) {
  die("Token mohon diisi dengan benar!\n");
}
// fungsi pesan yang sekaligus mengupdate offset
// biar tidak berulang-ulang pesan yang di dapat
function process_message($message)
{
  $updateid = $message["update_id"];
  $message_data = $message["message"];
  if (isset($message_data["text"])) {
    $chatid = $message_data["chat"]["id"];
    $message_id = $message_data["message_id"];
    $text = $message_data["text"];
    $response = create_response($text, $message_data);
    if (!empty($response)) {
      send_reply($chatid, $message_id, $response);
    }
  }
  return $updateid;
}

// hapus baris dibawah ini, jika tidak dihapus berarti kamu kurang teliti!
//die("Mohon diteliti ulang codingnya..\nERROR: Hapus baris atau beri komen line ini yak!\n");

// hanya untuk metode poll
// fungsi untuk meminta pesan
// baca di ebooknya, yakni ada pada proses 1
function process_one()
{
  global $debug;
  $update_id  = 0;
  echo "-";

  if (file_exists("last_update_id"))
    $update_id = (int) file_get_contents("last_update_id");

  $updates = get_updates($update_id);
  // jika debug=0 atau debug=false, pesan ini tidak akan dimunculkan
  if ((!empty($updates)) and ($debug)) {
    echo "\r\n===== isi diterima \r\n";
    print_r($updates);
  }

  foreach ($updates as $message) {
    echo '+';
    $update_id = process_message($message);
  }

  // update file id, biar pesan yang diterima tidak berulang
  file_put_contents("last_update_id", $update_id + 1);
}
// metode poll
// proses berulang-ulang
// sampai di break secara paksa
// tekan CTRL+C jika ingin berhenti
while (true) {
  process_one();
  sleep(0);
}
// metode webhook
// secara normal, hanya bisa digunakan secara bergantian dengan polling
// aktifkan ini jika menggunakan metode webhook
/*
$entityBody = file_get_contents('php://input');
$pesanditerima = json_decode($entityBody, true);
process_message($pesanditerima);
*/
/*
 * -----------------------
 * Grup @botphp
 * Jika ada pertanyaan jangan via PM
 * langsung ke grup saja.
 * ----------------------
 
* Just ask, not asks for ask..
Sekian.
*/

?>