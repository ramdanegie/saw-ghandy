<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\User;
use App\Traits\CrudMaster;
use App\Traits\Valet;

use Carbon\Carbon;
use Illuminate\Http\Request;


use DB;
use Illuminate\Support\Facades\Hash;
use Namshi\JOSE\Base64\Base64UrlSafeEncoder;
use Namshi\JOSE\JWT;
use Namshi\JOSE\JWS;
use Namshi\JOSE\Base64\Encoder;
use Webpatser\Uuid\Uuid;

use Lcobucci\JWT\Signer\Hmac\Sha512;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Hmac\Sha384;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Key;
use App\Datatrans\PasienDaftar;
use App\Datatrans\AntrianPasienDiperiksa;
use App\Datatrans\TempatTidur;
use App\Datatrans\RegistrasiPelayananPasien;

class AuthController extends ApiController
{
    use CrudMaster, Valet;
    protected $kdProfile = 1;

    protected $formAwal = "daftar-pasien";

    public function __construct()
    {
        parent::__construct($skip_authentication = true);
    }

    public function createToken2($namaUser)
    {
        $class = new Builder();
        $signer = new Sha512();
        $token = $class->setHeader('alg', 'HS512')
            ->set('sub', $namaUser)
            ->sign($signer, "XOXO")
            ->getToken();
        return $token;
    }

    public function loginKeun(Request $r)
    {
        try {

            $data = array(
                'username' => $r->username,
                'password' => $r->password,
            );

            $data = $this->validate_input($data);

            if ($this->validate_login($data)) {
                return redirect()->route("show_page", ["role" => $_SESSION["role"], "pages" => "dashboard"]);
            } else {
                toastr()->error('Incorrect username or password.', 'Error !');
                $notification = array(
                    'message' => 'Nama User atau Kata Sandi Salah !',
                    'alert-type' => 'error'
                );
//                dd($notification);
                return redirect()->route("login", ['username' => $r->username])->with($notification);
            }

        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function validate_login($data)
    {
        $user = \DB::table('loginuser')
            ->where('namauser', $data["username"])
            ->where('katasandi', $data['password'])
            ->where('aktif', true)
            ->first();
//dd($user);
        if (!empty($user)) {
            $_SESSION["role"] = 'admin';
            $_SESSION["namaLengkap"] = $user->namalengkap;
            $_SESSION["username"] = $user->namauser;
            $_SESSION["namaProfile"] = 'SAW APP';
            $_SESSION["id"] = $user->id;
            $_SESSION["tokenLogin"] = $this->createToken2($user->namauser) . ''; //
            $sts = true;
        } else {
            $sts = false;
        }
        return $sts;
    }
    public function show()
    {
        if (isset($_SESSION["tokenLogin"])) {
            return redirect()->route("show_page", ["role" => $_SESSION["role"], "pages" => "dashboard"]);
//            return redirect(    $_SESSION["role"]."/dashboard");
        }
        return view("auth.login");
    }
    public function logoutKeun()
    {
        session_destroy();
        return redirect()->route("login");
    }

}

