<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use Session;
use App\Models\City;

class CategoryController extends Controller
{
  public function AuthLogin()
  {
    $adminID = Session::get('id_admin');
    $sellerID  = Session::get('SellerId');
    if ($adminID) {
      return 'admin';
    }
    if ($sellerID) {
      return 'seller';
    }
    return view('admin_login');
  }

  public function view_category()
  {
    $check = $this->AuthLogin();
    $view_cate = DB::table('tbl_category_product')->get();
    if ($check == 'admin') {
      $manager_category = view('admin.view_category')->with('view_cate', $view_cate);
      return view('admin_layout')->with('admin.view_category', $manager_category);
    }
    if ($check == 'seller') {
      $manager_category = view('seller.view_category')->with('view_cate', $view_cate);
      return view('seller_layout')->with('seller.view_category', $manager_category);
    }
  }


  public function add_category()
  {
    $check = $this->AuthLogin();
    if ($check == 'admin') {
      return view('admin.add_category');
    }
    if ($check == 'seller') {
      return view('seller.add_category');
    }
  }


  public function edit_category($category_proID)
  {
    $check = $this->AuthLogin();
    $edit_cate = DB::table('tbl_category_product')->where('CategoryID', $category_proID)->get();
    if ($check == 'admin') {
      $manager_category = view('admin.edit_category')->with('edit_cate', $edit_cate);
      return view('admin_layout')->with('admin.edit_category', $manager_category);
    }
    if ($check == 'seller') {
      $manager_category = view('seller.edit_category')->with('edit_cate', $edit_cate);
      return view('seller_layout')->with('seller.edit_category', $manager_category);
    }
  }

  public function delete_category($category_proID)
  {
    $this->AuthLogin();
    DB::table('tbl_category_product')->where('CategoryID', $category_proID)->delete();
    Session::put('message', 'Xóa thành công');
    return Redirect::to('/view-category');
  }

  public function update_category(Request $request)
  {
    $this->AuthLogin();
    $data = array();
    $data['CategoryName'] = $request->cateName;
    $data['CategoryDescrip'] = $request->cateDes;
    DB::table('tbl_category_product')->where('CategoryID', $request->cateID)->update($data);
    Session::put('message', 'Cập nhật thành công');
    return Redirect::to('/view-category');
  }

  public function add_category_product(Request $request)
  {
    $this->AuthLogin();
    $data = array();
    $data['CategoryName'] = $request->cateName;
    $data['CategoryDescrip'] = $request->cateDes;
    $data['CategoryStatus'] = $request->cateStatus;
    DB::table('tbl_category_product')->insert($data);
    Session::put('message', 'Thêm thành công');
    return Redirect::to('/add-category');
  }


  public function unactive_category($category_proID)
  {
    $this->AuthLogin();
    DB::table('tbl_category_product')->where('CategoryID', $category_proID)->update(['CategoryStatus' => 0]);
    Session::put('message', 'Danh mục sản phẩm đã được ẩn');
    return Redirect::to('view-category');
  }


  public function active_category($category_proID)
  {
    $this->AuthLogin();
    DB::table('tbl_category_product')->where('CategoryID', $category_proID)->update(['CategoryStatus' => 1]);
    Session::put('message', 'Danh mục sản phẩm đã được hiển thị');
    return Redirect::to('view-category');
  }
}
