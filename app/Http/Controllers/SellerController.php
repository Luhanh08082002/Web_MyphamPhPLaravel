<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Redirect;
use Session;
use Mail;

class SellerController extends Controller
{
    //
    public function checkAuth()
    {
        $sellerID  = Session::get('SellerId');
        // if ($sellerID) {
        //     return Redirect::to('/seller');
        // } else {
        $this->login();
        // }
    }
    public function index()
    {
        $sellerID  = Session::get('SellerId');
        if (!$sellerID) {
            return view('seller.seller_login');
        }
        $PRD = DB::table('tbl_product')->where('ProductStatus', 1)->get();
        $ORD = DB::table('tbl_order')->where('OrderStatus', 0)->get();
        $ORDAC = DB::table('tbl_order')->where('OrderStatus', 1)->get();
        $SUB = DB::table('tbl_subcribe')->get();
        $CUS = DB::table('tbl_customer')->get();
        $GIT = DB::table('tbl_discount')->get();
        $WIS = DB::table('tbl_wishlist')->get();
        $TOTAL = DB::table('tbl_order')->where('OrderStatus', 1)->max('OrderTotal');
        $Count_PRD = count($PRD);
        $Count_ORD = count($ORD);
        $Count_SUB = count($SUB);
        $Count_CUS = count($CUS);
        $Count_GIT = count($GIT);
        $Count_WIS = count($WIS);
        $Count_ORDAC = count($ORDAC);
        return view('seller.seller_index')->with(compact('Count_PRD', 'Count_ORD', 'TOTAL', 'Count_SUB', 'Count_CUS', 'Count_GIT', 'Count_GIT', 'Count_ORDAC'));
    }
    public function login()
    {
        return view('seller.seller_login');
    }
    public function loginAuth(Request $request)
    {
        $email = $request->email;
        $password = md5($request->input('password'));
        $result = DB::table('tbl_seller')->where('email', $email)->where('password', $password)->first();
        if ($result != false) {
            Session::put('SellerName', $result->name);
            Session::put('SellerId', $result->id);
            return Redirect::to('/seller');
        } else {
            Session::put('message', 'Tài khoản hoặc mật khẩu chưa đúng . Vui lòng kiểm tra và đăng nhập lại !!!');
            return Redirect::to('/seller/login');
        }
    }
    public function register()
    {
        return view('seller.seller_register');
    }
    public function register_store(Request $request)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['password'] = md5($request->password);
        DB::table('tbl_seller')->insert($data);
        Session::put('message', 'Đăng kí tài khoản thành công');
        $this->sendMail($request->name, $request->email, $request->password);
        return Redirect::to('/seller/login');
    }

    public function logout()
    {
        Session::put('SellerName', null);
        Session::put('SellerId', null);
        return Redirect::to('/seller');
    }
    public function sendMail($name, $gmail, $password)
    {
        Mail::send('seller.send_mail', ['name' => $name, 'gmail' => $gmail, 'password' => $password], function ($email) use ($gmail) {
            $email->subject('Đăng ký thành công !');
            $email->to($gmail);
        });
    }
}
