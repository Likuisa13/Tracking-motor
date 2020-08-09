<?php 
include_once 'config/dao.php';
$dao = new Dao();

$uri = 'login';
if (isset($_POST['aksi'])) {
    if($_POST['aksi'] == 'forgot') {
        $user = $_POST['username'];
        $hasil = $dao->forgotPass($user);
        if ($hasil) {
            $uri = 'login?bg=info&message=Email lupa password telah dikirim, silahkan cek email anda !';
        } else {
            $uri = 'login?bg=danger&message=Email lupa password gagal dikirim, pastikan username yang anda masukkan benar !';
        }
    } elseif($_POST['aksi'] == 'change') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['password-retype'];
        if ($password == $confirm_password) {
            $query = "UPDATE `users` SET `password` = PASSWORD('$password') WHERE email = '$email'";
            $result =  $dao->execute($query);	
            if ($result != false) {
                $uri = 'login?bg=info&message=Password berhasil diubah, silahkan login dengan password baru anda';
            } else {
                $uri = 'login?bg=danger&message=Password gagal diubah pastikan inputan anda benar !';
            }
        } else {
            $uri = 'login?bg=danger&message=Password gagal diubah pastikan inputan anda benar !';
        }
    }
}

?>
<script type="text/javascript">
	document.location = '<?= $uri ?>';
</script> 