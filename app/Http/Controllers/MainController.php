<?php

namespace App\Http\Controllers;

use App\Model\Kriteria;
use App\Model\NilaiCrips;
use App\Model\Alternatif;
use App\Model\NilaiAlternatif;
use App\Traits\Valet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Webpatser\Uuid\Uuid;

date_default_timezone_set('Asia/Jakarta');

class MainController extends ApiController
{
    use Valet;

    public function __construct()
    {
        parent::__construct($skip_authentication = true);
    }

    public function show_page(Request $r)
    {
        $request = array('role' => $r->role, 'pages' => $r->pages, "id" => $r->id);
        $request = $this->validate_input($request);
        $compact = [];
        switch ($request["pages"]) {
            case 'dashboard':
                $data['c_alternatif'] = DB::table('alternatif')->where('aktif', true)->count();
                $data['c_nilaicrips'] = DB::table('nilaicrips')->where('aktif', true)->count();
                $data['c_kriteria'] = DB::table('kriteria')->where('aktif', true)->count();
                $data['c_nilaialter'] = DB::table('nilaialternatif')->where('aktif', true)->count();
                $data['ranking'] = $this->getPerhitungan();
                $listKriteria = Kriteria::where('aktif', true)->orderBy('kode')->get();
                // dd($data);
                array_push($compact, "data", "r",'listKriteria');
                break;
            case 'kriteria':
                $q_kriteria = '';
                if (!isset($r->q_kriteria)) {
                    $q_kriteria = '';
                } else {
                    $q_kriteria = $r->q_kriteria;
                }

                $data = DB::table('kriteria')
                    ->where('aktif', true);
                if ($q_kriteria != '') {
                    $data = $data->where('kriteria', 'ilike', '%' . $q_kriteria . '%');
                }
                $data = $data->orderBy('bobot', 'desc');
                $data = $data->get();
                array_push($compact, "data", "r");
                break;
            case 'nilai-crips':
                $q_keterangan = '';
                if (!isset($r->q_keterangan)) {
                    $q_keterangan = '';
                } else {
                    $q_keterangan = $r->q_keterangan;
                }

                $data = DB::table('nilaicrips as nn')
                    ->leftJoin('kriteria as k', 'k.kode', '=', 'nn.kriteriafk')
                    ->select('nn.*', 'k.kriteria')
                    ->where('nn.aktif', true);
                if ($q_keterangan != '') {
                    $data = $data->where('nn.keterangan', 'ilike', '%' . $q_keterangan . '%');
                }
                $data = $data->orderBy('k.kriteria', 'asc');
                $data = $data->get();
                array_push($compact, "data", "r");
                break;
            case 'alternatif':
                $q_alternatif = '';
                if (!isset($r->q_alternatif)) {
                    $q_alternatif = '';
                } else {
                    $q_alternatif = $r->q_alternatif;
                }

                $data = DB::table('alternatif')
                    ->where('aktif', true);
                if ($q_alternatif != '') {
                    $data = $data->where('alternatif', 'ilike', '%' . $q_alternatif . '%');
                }
                $data = $data->orderBy('alternatif', 'asc');
                $data = $data->get();
                array_push($compact, "data", "r");
                break;
            case 'nilai-alternatif':
                $q_alternatif = '';
                if (!isset($r->q_alternatif)) {
                    $q_alternatif = '';
                } else {
                    $q_alternatif = " and al.alternatif ilike '%" . $r->q_alternatif  . "%'";
                }

                $data = DB::select(DB::raw("SELECT
                         nn.*, cy.keterangan as capacity,
                        cy.nilai as n_capacity,
                            cl.keterangan as capital,
                            cl.nilai as n_capital,
                            cw.keterangan as cashflow,
                        cw.nilai as n_cashflow,
                            cr.keterangan as `character`,
                            cr.nilai as n_character,
                            cll.keterangan as collateral,
                        cll.nilai as n_collateral,
                            cn.keterangan as `condition`,
                            cn.nilai as n_condition,
                            ce.keterangan as culture,
                            ce.nilai as n_culture,
                            al.kode,
                            al.alternatif
                        FROM
                            nilaialternatif AS nn
                        INNER JOIN alternatif AS al ON al.kode = nn.alternatiffk
                        LEFT JOIN nilaicrips AS cy ON cy.kode = nn.capacityfk
                        LEFT JOIN nilaicrips AS cl ON cl.kode = nn.capitalfk
                        LEFT JOIN nilaicrips AS cw ON cw.kode = nn.cashflowfk
                        LEFT JOIN nilaicrips AS cr ON cr.kode = nn.characterfk
                        LEFT JOIN nilaicrips AS cll ON cll.kode = nn.collateralfk
                        LEFT JOIN nilaicrips AS cn ON cn.kode = nn.conditionfk
                        LEFT JOIN nilaicrips AS ce ON ce.kode = nn.culturefk
                        WHERE
                            nn.aktif = 1
                            $q_alternatif
                        ORDER BY
                            al.alternatif ASC"));

                array_push($compact, "data", "r");
                break;
            case 'perhitungan':
                $q_alternatif = '';
                if (!isset($r->q_alternatif)) {
                    $q_alternatif = '';
                } else {
                    $q_alternatif = $r->q_alternatif;
                }

                $listKriteria = Kriteria::where('aktif', true)->orderBy('kode')->get();
                $pendaftar = $this->getPerhitungan();
                array_push($compact, "pendaftar", "r", "listKriteria");
                break;
            case 'cetak-perhitungan':
                $perhitungan = $this->getPerhitungan();
                $listKriteria = Kriteria::where('aktif', true)->orderBy('kode')->get();
                array_push($compact, "perhitungan", "r","listKriteria");
                break;
            default:
                return abort(404);
                break;
        }

        $pages = $request["pages"];
        $role = $request["role"];
        array_push($compact, "pages");
        //        return view("pages." . $pages, compact($compact));
        return view("pages." . $pages . "." . $pages, compact($compact));
    }
    public function getPerhitungan()
    {
        $pendaftar = DB::select(DB::raw("SELECT
        nn.*, cy.keterangan AS capacity,
        cy.nilai AS n_capacity,
        cyk.atribut AS att_capacity,
        cyk.kode AS kode_capacity,
    cyk.bobot AS bobot_capacity,
        cl.keterangan AS capital,
        cl.nilai AS n_capital,
        clk.atribut AS att_capital,
        clk.kode AS kode_capital,
        clk.bobot AS bobot_capital,
    
        cw.keterangan AS cashflow,
        cw.nilai AS n_cashflow,
        cwk.atribut AS att_cashflow,
        cwk.kode AS kode_cashflow,
        cwk.bobot AS bobot_cashflow,
    
        cr.keterangan AS `character`,
        cr.nilai AS n_character,
        crk.atribut AS att_character,
        crk.kode AS kode_character,
        crk.bobot AS bobot_character,
    
        cll.keterangan AS collateral,
        cll.nilai AS n_collateral,
        cllk.atribut AS att_collateral,
        cllk.kode AS kode_collateral,
        cllk.bobot AS bobot_collateral,
    
        cn.keterangan AS `condition`,
        cn.nilai AS n_condition,
        cnk.atribut AS att_condition,
        cnk.kode AS kode_condition,
        cnk.bobot AS bobot_condition,
    
        ce.keterangan AS culture,
        ce.nilai AS n_culture,
        cek.atribut AS att_culture,
        cek.kode AS kode_culture,
        cek.bobot AS bobot_culture,
        al.kode,
        al.alternatif,
        cy.kriteriafk
    FROM
        nilaialternatif AS nn
    INNER JOIN alternatif AS al ON al.kode = nn.alternatiffk
    LEFT JOIN nilaicrips AS cy ON cy.kode = nn.capacityfk
    LEFT JOIN nilaicrips AS cl ON cl.kode = nn.capitalfk
    LEFT JOIN nilaicrips AS cw ON cw.kode = nn.cashflowfk
    LEFT JOIN nilaicrips AS cr ON cr.kode = nn.characterfk
    LEFT JOIN nilaicrips AS cll ON cll.kode = nn.collateralfk
    LEFT JOIN nilaicrips AS cn ON cn.kode = nn.conditionfk
    LEFT JOIN nilaicrips AS ce ON ce.kode = nn.culturefk
    LEFT JOIN kriteria AS cyk ON cyk.kode = cy.kriteriafk
    LEFT JOIN kriteria AS clk ON clk.kode = cl.kriteriafk
    LEFT JOIN kriteria AS cwk ON cwk.kode = cw.kriteriafk
    LEFT JOIN kriteria AS crk ON crk.kode = cr.kriteriafk
    LEFT JOIN kriteria AS cllk ON cllk.kode = cll.kriteriafk
    LEFT JOIN kriteria AS cnk ON cnk.kode = cn.kriteriafk
    LEFT JOIN kriteria AS cek ON cek.kode = ce.kriteriafk
    WHERE
        nn.aktif = 1
    ORDER BY
        al.alternatif ASC;"));
        $rankp = [];
        foreach ($pendaftar as $p) {
            // character
            if ($p->att_character == 'cost') {
                $order1 = 'asc';
            } else {
                $order1 = 'desc';
            }
            $kode1 = $p->kode_character;
            $dataPembagi1 = collect(DB::select("select cy.nilai 
                    from nilaialternatif  as nn
                    LEFT JOIN nilaicrips AS cy ON cy.kode = nn.characterfk
                    where characterfk in ( select kode from nilaicrips where  kriteriafk='$kode1') 
                    order by cy.nilai $order1"))
                ->first()->nilai;
            $pembagi1 = (float) $dataPembagi1;
            $nilai1 = (float) $p->n_character;
            if ($order1 == 'desc') {
                $pembagi1 = (float) $p->n_character;
                $nilai1 = (float) $dataPembagi1;
            }
            $p->normal_character = $pembagi1 / $nilai1;
            // end character
            // capacity
            if ($p->att_capacity == 'cost') {
                $order2 = 'asc';
            } else {
                $order2 = 'desc';
            }
            $kode2 = $p->kode_capacity;
            $dataPembagi2 = collect(DB::select("select cy.nilai 
                    from nilaialternatif  as nn
                    LEFT JOIN nilaicrips AS cy ON cy.kode = nn.capacityfk
                    where capacityfk in ( select kode from nilaicrips where  kriteriafk='$kode2') 
                    order by cy.nilai $order2"))
                ->first()->nilai;
            $pembagi2 = (float) $dataPembagi2;
            $nilai2 = (float) $p->n_capacity;
            if ($order2 == 'desc') {
                $pembagi2 = (float) $p->n_capacity;
                $nilai2 = (float) $dataPembagi2;
            }
            $p->normal_capacity = $pembagi2 / $nilai2;
            // end character
            // capital
            if ($p->att_capital == 'cost') {
                $order3 = 'asc';
            } else {
                $order3 = 'desc';
            }
            $kode3 = $p->kode_capital;
            $dataPembagi3 = collect(DB::select("select cy.nilai 
                    from nilaialternatif  as nn
                    LEFT JOIN nilaicrips AS cy ON cy.kode = nn.capitalfk
                    where capitalfk in ( select kode from nilaicrips where  kriteriafk='$kode3') 
                    order by cy.nilai $order3"))
                ->first()->nilai;
            $pembagi3 = (float) $dataPembagi3;
            $nilai3 = (float) $p->n_capital;
            if ($order3 == 'desc') {
                $pembagi3 = (float) $p->n_capital;
                $nilai3 = (float) $dataPembagi3;
            }
            $p->normal_capital = $pembagi3 / $nilai3;

            // collateral
            if ($p->att_collateral == 'cost') {
                $order4 = 'asc';
            } else {
                $order4 = 'desc';
            }
            $kode4 = $p->kode_collateral;
            $dataPembagi4 = collect(DB::select("select cy.nilai 
                    from nilaialternatif  as nn
                    LEFT JOIN nilaicrips AS cy ON cy.kode = nn.collateralfk
                    where collateralfk in ( select kode from nilaicrips where  kriteriafk='$kode4') 
                    order by cy.nilai $order4"))
                ->first()->nilai;
            $pembagi4 = (float) $dataPembagi4;
            $nilai4 = (float) $p->n_collateral;
            if ($order4 == 'desc') {
                $pembagi4 = (float) $p->n_collateral;
                $nilai4 = (float) $dataPembagi4;
            }
            $p->normal_collateral = $pembagi4 / $nilai4;
            // end collateral
            // character
            if ($p->att_condition == 'cost') {
                $order5 = 'asc';
            } else {
                $order5 = 'desc';
            }
            $kode5 = $p->kode_condition;
            $dataPembagi5 = collect(DB::select("select cy.nilai 
                    from nilaialternatif  as nn
                    LEFT JOIN nilaicrips AS cy ON cy.kode = nn.conditionfk
                    where conditionfk in ( select kode from nilaicrips where  kriteriafk='$kode5') 
                    order by cy.nilai $order5"))
                ->first()->nilai;
            $pembagi5 = (float) $dataPembagi5;
            $nilai5 = (float) $p->n_character;
            if ($order5 == 'desc') {
                $pembagi5 = (float) $p->n_condition;
                $nilai5 = (float) $dataPembagi5;
            }
            $p->normal_condition = $pembagi5 / $nilai5;
            // end condition
            // cashflow
            if ($p->att_cashflow == 'cost') {
                $order6 = 'asc';
            } else {
                $order6 = 'desc';
            }
            $kode6 = $p->kode_cashflow;
            $dataPembagi6 = collect(DB::select("select cy.nilai 
                    from nilaialternatif  as nn
                    LEFT JOIN nilaicrips AS cy ON cy.kode = nn.cashflowfk
                    where cashflowfk in ( select kode from nilaicrips where  kriteriafk='$kode6') 
                    order by cy.nilai $order6"))
                ->first()->nilai;
            $pembagi6 = (float) $dataPembagi6;
            $nilai6 = (float) $p->n_cashflow;
            if ($order6 == 'desc') {
                $pembagi6 = (float) $p->n_cashflow;
                $nilai6 = (float) $dataPembagi6;
            }
            $p->normal_cashflow = $pembagi6 / $nilai6;
            // end cashflow
            // culture
            if ($p->att_culture == 'cost') {
                $order7 = 'asc';
            } else {
                $order7 = 'desc';
            }
            $kode7 = $p->kode_culture;
            $dataPembagi7 = collect(DB::select("select cy.nilai 
                    from nilaialternatif  as nn
                    LEFT JOIN nilaicrips AS cy ON cy.kode = nn.culturefk
                    where culturefk in ( select kode from nilaicrips where  kriteriafk='$kode7') 
                    order by cy.nilai $order7"))
                ->first()->nilai;
            $pembagi7 = (float) $dataPembagi7;
            $nilai7 = (float) $p->n_culture;
            if ($order7 == 'desc') {
                $pembagi7 = (float) $p->n_culture;
                $nilai7 = (float) $dataPembagi7;
            }
            $p->normal_culture = $pembagi7 / $nilai7;
            // end culture
            $p->total =  ((float)number_format((float) $p->normal_character, 2, '.', '') * (float)$p->bobot_character)
                + ((float)number_format((float) $p->normal_capacity, 2, '.', '') * (float)$p->bobot_capacity)
                + ((float)number_format((float) $p->normal_capital, 2, '.', '') * (float)$p->bobot_capital)
                + ((float)number_format((float) $p->normal_collateral, 2, '.', '') * (float)$p->bobot_collateral)
                + ((float)number_format((float) $p->normal_condition, 2, '.', '') * (float)$p->bobot_condition)
                + ((float)number_format((float) $p->normal_cashflow, 2, '.', '') * (float)$p->bobot_cashflow)
                + ((float)number_format((float) $p->normal_culture, 2, '.', '') * (float)$p->bobot_culture);
        }

        $ordered_values = $pendaftar;
        foreach ($ordered_values as $key => $row) {
            $count[$key] = $row->total;
        }
        array_multisort($count, SORT_DESC, $ordered_values);
        // rsort($ordered_values);
  
        foreach ($pendaftar as $p) {
            foreach ($ordered_values as $ordered_key => $ordered_value) {
                if ($p->total === $ordered_value->total) {
                    $key = $ordered_key;
                    break;
                }
            }
            $p->ranking =  ((int) $key + 1);
            //    $rankp[]=  $p->total . '- Rank: ' . ((int) $key + 1) ;
        }
        // dd($pendaftar);
        return $pendaftar;
    }

    //    public function getKriteria(Request $r)
    //    {
    //        $data = DB::table('kriteria')
    //            ->where('aktif', true)
    //            ->orderBy('bobot', 'desc')
    //            ->get();
    //        $response['kriteria'] = $data;
    //        return $this->respond($response);
    //    }
    public function getKriteria(Request $r)
    {
        $edit = null;
        $listAtribut = array([
            'name' => 'benefit'
        ], [
            'name' => 'cost'
        ]);
        if (isset($r['kode'])  && $r['kode'] != '') {
            $edit = DB::table('kriteria')->where('kode', $r['kode'])->first();
        }
        //        dd($edit);
        return view('pages.kriteria.add', compact(
            'edit',
            'listAtribut',
            'r'
        ));
    }
    public function saveKriteria(Request $r)
    {
        DB::beginTransaction();
        try {
            $saveStatus = 'true';

            if ($r['kode'] == null) {
                $model =  new Kriteria();
                $model->kode = $this->generateCode($model, 'kode', 2, 'C');
                $model->aktif = true;
            } else {
                $model = Kriteria::where('kode', $r['kode'])->first();
            }
            $model->kriteria = $r['kriteria'];
            $model->atribut = $r['atribut'];
            $model->bobot = $r['bobot'];
            $model->save();
            $msg = 'Insert';
        } catch (\Exception $e) {
            $saveStatus = 'false';
        }

        if ($saveStatus == 'true') {
            DB::commit();
            $notification = array(
                'message' => 'Data ' . $msg . ' Successfully',
                'alert-type' => 'success'
            );
        } else {
            DB::rollBack();
            $notification = array(
                'message' => 'Data Inserted Error ' . $e->getMessage(),
                'alert-type' => 'error'
            );
        }
        if ($saveStatus == 'true') {
            return redirect()->route("show_page", ["role" => $_SESSION["role"], "pages" => "kriteria"])->with($notification);
        } else {
            return redirect()->route("getKriteria")->with($notification);
        }
    }
    public function deleteAll(Request $r)
    {
        DB::beginTransaction();
        try {

            if ($r['table'] == 'nilai-alternatif') {
                $models = DB::table($r['table'])->where('id', $r['kode'])->update([
                    'aktif' => false
                ]);
            } else {
                $models = DB::table($r['table'])->where('kode', $r['kode'])->update([
                    'aktif' => false
                ]);
            }

            $msg = 'Delete';
            $saveStatus = 'true';
        } catch (\Exception $e) {
            $saveStatus = 'false';
        }

        if ($saveStatus == 'true') {
            DB::commit();
            $notification = array(
                'message' => 'Data ' . $msg . ' Successfully',
                'alert-type' => 'success'
            );
        } else {
            DB::rollBack();
            $notification = array(
                'message' => 'Data Inserted Error ' . $e->getMessage(),
                'alert-type' => 'error'
            );
        }
        return $saveStatus;
    }
    public function getNilaiCrips(Request $r)
    {
        $edit = null;
        $listKriteria = Kriteria::where('aktif', true)->orderBy('kriteria')->get();
        if (isset($r['kode'])  && $r['kode'] != '') {
            $edit = DB::table('nilaicrips')->where('kode', $r['kode'])->first();
        }
        return view('pages.nilai-crips.add', compact(
            'edit',
            'listKriteria',
            'r'
        ));
    }
    public function saveNilaiCrips(Request $r)
    {
        DB::beginTransaction();
        try {
            $saveStatus = 'true';

            if ($r['kode'] == null) {
                $model =  new NilaiCrips();
                $model->kode = $this->generateCode($model, 'kode', 4, 'N');
                $model->aktif = true;
            } else {
                $model = NilaiCrips::where('kode', $r['kode'])->first();
            }
            $model->keterangan = $r['keterangan'];
            $model->nilai = $r['nilai'];
            $model->kriteriafk = $r['kriteriafk'];
            $model->save();
            $msg = 'Insert';
        } catch (\Exception $e) {
            $saveStatus = 'false';
        }

        if ($saveStatus == 'true') {
            DB::commit();
            $notification = array(
                'message' => 'Data ' . $msg . ' Successfully',
                'alert-type' => 'success'
            );
        } else {
            DB::rollBack();
            $notification = array(
                'message' => 'Data Inserted Error ' . $e->getMessage(),
                'alert-type' => 'error'
            );
        }
        if ($saveStatus == 'true') {
            return redirect()->route("show_page", ["role" => $_SESSION["role"], "pages" => "nilai-crips"])->with($notification);
        } else {
            return redirect()->route("getNilaiCrips")->with($notification);
        }
    }
    public function getAlternatif(Request $r)
    {
        $edit = null;
        $listAtribut = array([
            'name' => 'benefit'
        ], [
            'name' => 'cost'
        ]);
        if (isset($r['kode'])  && $r['kode'] != '') {
            $edit = DB::table('alternatif')->where('kode', $r['kode'])->first();
        }
        //        dd($edit);
        return view('pages.alternatif.add', compact(
            'edit',
            'listAtribut',
            'r'
        ));
    }
    public function saveAlternatif(Request $r)
    {
        DB::beginTransaction();
        try {
            $saveStatus = 'true';

            if ($r['kode'] == null) {
                $model =  new Alternatif();
                $model->kode = $this->generateCode($model, 'kode', 4, 'A');
                $model->aktif = true;
            } else {
                $model = Alternatif::where('kode', $r['kode'])->first();
            }
            $model->alternatif = $r['alternatif'];
            $model->keterangan = $r['keterangan'];
            $model->save();
            $msg = 'Insert';
        } catch (\Exception $e) {
            $saveStatus = 'false';
        }

        if ($saveStatus == 'true') {
            DB::commit();
            $notification = array(
                'message' => 'Data ' . $msg . ' Successfully',
                'alert-type' => 'success'
            );
        } else {
            DB::rollBack();
            $notification = array(
                'message' => 'Data Inserted Error ' . $e->getMessage(),
                'alert-type' => 'error'
            );
        }
        if ($saveStatus == 'true') {
            return redirect()->route("show_page", ["role" => $_SESSION["role"], "pages" => "alternatif"])->with($notification);
        } else {
            return redirect()->route("getAlternatif")->with($notification);
        }
    }
    public function getNilaiAlternatif(Request $r)
    {
        $edit = null;
        $listAlternatif = Alternatif::where('aktif', true)->orderBy('alternatif')->get();
        $listCharacter = DB::table('nilaicrips')->where('aktif', true)->where('kriteriafk', 'C1')->orderBy('nilai')->get();
        $listCapacity = DB::table('nilaicrips')->where('aktif', true)->where('kriteriafk', 'C2')->orderBy('nilai')->get();
        $listCapital = DB::table('nilaicrips')->where('aktif', true)->where('kriteriafk', 'C3')->orderBy('nilai')->get();
        $listCollateral = DB::table('nilaicrips')->where('aktif', true)->where('kriteriafk', 'C4')->orderBy('nilai')->get();
        $listCondition = DB::table('nilaicrips')->where('aktif', true)->where('kriteriafk', 'C5')->orderBy('nilai')->get();
        $listCashflow = DB::table('nilaicrips')->where('aktif', true)->where('kriteriafk', 'C6')->orderBy('nilai')->get();
        $listCulture = DB::table('nilaicrips')->where('aktif', true)->where('kriteriafk', 'C7')->orderBy('nilai')->get();
        if (isset($r['id'])  && $r['id'] != '') {
            $edit = DB::table('nilaialternatif')->where('id', $r['id'])->first();
        }
        // dd($edit);
        return view('pages.nilai-alternatif.add', compact(
            'edit',
            'listAlternatif',
            'listCharacter',
            'listCapacity',
            'listCapital',
            'listCollateral',
            'listCondition',
            'listCashflow',
            'listCulture',
            'r'
        ));
    }
    public function saveNilaiAlternatif(Request $r)
    {
        DB::beginTransaction();
        try {
            $saveStatus = 'true';

            if ($r['id'] == null) {
                $model =  new NilaiAlternatif();
                $model->id = NilaiAlternatif::max('id') + 1; //$this->generateCode( $model,'kode',4,'N');
                $model->aktif = true;
            } else {
                $model = NilaiAlternatif::where('id', $r['id'])->first();
            }
            $model->alternatiffk = $r['alternatiffk'];
            $model->characterfk = $r['characterfk'];
            $model->capitalfk = $r['capitalfk'];
            $model->capacityfk = $r['capacityfk'];
            $model->collateralfk = $r['collateralfk'];
            $model->conditionfk = $r['conditionfk'];
            $model->cashflowfk = $r['cashflowfk'];
            $model->culturefk = $r['culturefk'];

            $model->save();
            $msg = 'Insert';
        } catch (\Exception $e) {
            $saveStatus = 'false';
        }

        if ($saveStatus == 'true') {
            DB::commit();
            $notification = array(
                'message' => 'Data ' . $msg . ' Successfully',
                'alert-type' => 'success'
            );
        } else {
            DB::rollBack();
            $notification = array(
                'message' => 'Data Inserted Error ' . $e->getMessage(),
                'alert-type' => 'error'
            );
        }
        if ($saveStatus == 'true') {
            return redirect()->route("show_page", ["role" => $_SESSION["role"], "pages" => "nilai-alternatif"])->with($notification);
        } else {
            return redirect()->route("getNilaiAlternatif")->with($notification);
        }
    }
}
