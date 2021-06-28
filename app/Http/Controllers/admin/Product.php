<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Query;
use App\Model\ProductModel;
use App\Model\ProductPrice;
use App\Model\CityModel as CM;
use DB;

class Product extends BaseController {
    public function index( Request $request, $id = NULL ) {

        $product_no = $request->input('products');
        // $offset  = !empty($product_no) ? $product_no - 1 : 0;
        // $records = DB::table('products as p')
        //             ->join('categories as cat', 'p.product_category', '=', 'cat.category_id')
        //             ->leftJoin('categories as subcat', 'p.product_subcategory', '=', 'subcat.category_id')
        //             ->select('p.*', 'cat.category_name as mcategory', 'subcat.category_name as scategory')
        //             ->where('product_is_deleted','N')
        //             ->orderBy('product_id', 'desc')
        //             ->paginate(10);

        $records = ProductModel::where('product_is_deleted', 'N')->orderBy('product_id', 'DESC')->paginate(10);
        $input = $request->input();

        $city= DB::table('cities')->where('city_is_deleted', 'N')->get();
        // CITY LIST

        if (!empty($input['id']) && is_numeric($input['id']) && !empty($input['status'])) {
            $status = $input['status'] == "Y" ? "N" : "Y" ;
            $arr = array(
                "product_is_visible" => $status
            );
            ProductModel::where('product_id', $input['id'])->update( $arr );
            return redirect('rt-admin/product');
        }

        if (!empty($input['id']) && is_numeric($input['id']) && !empty($input['view'])) {
            $status = $input['view'] == "Y" ? "N" : "Y" ;
            $arr = array(
                "product_is_home" => $status
            );
            ProductModel::where('product_id', $input['id'])->update( $arr );
            return redirect('rt-admin/product');
        }

        if (!empty($input['id']) && is_numeric($input['id']) && !empty($input['stock'])) {
            $status = $input['stock'] == "Y" ? "N" : "Y" ;
            $arr = array(
                "product_in_stock" => $status
            );
            ProductModel::where('product_id', $input['id'])->update( $arr );
            return redirect('rt-admin/product');
        }

        if ($request->isMethod('post')) {
            $check = $request->input('check');

            foreach($check as $id) {
            	ProductModel::where('product_id', $id)->update( array('product_is_deleted' => 'Y') );
            }
            $mess = "Selected record(s) deleted successfully.";
            return redirect()->back()->with('success', $mess);
        }



    	$page 	= "product";
    	$data 	= compact('page','records', 'city');
    	return view('backend/layout', $data);
    }

    public function add( Request $request, $id = NULL ) {
        $q      = new Query();
        session()->forget('pro_price');

        $edit = $specs = $subcategories = $gallary = array();
        if(!empty($id)) {
            $edit   = ProductModel::find($id);
            $specs  = unserialize($edit->product_specification);

            if(!empty($edit->product_category)) {
                $subcategories = DB::table('categories')->where('category_parent', $edit->product_category)->get();
            }

            $gallary = DB::table('product_images')->where('pimage_pid', $id)->get();

            $prices = ProductPrice::where('price_pid', $id)->get();
            if(!$prices->isEmpty($prices)) {
                $session = [];
                foreach($prices as $price) {
                    $session[] = [
                        'price_qty'             => $price->price_qty,
                        'price_unit'            => $price->price_unit,
                        'price_original_amount' => $price->price_original_amount,
                        'price_sale_amount'     => $price->price_sale_amount
                    ];
                }

                session( ['pro_price' => $session] );
            }
        }

        $input  = $request->input();
        if(!empty($input['remove_id']) && is_numeric($input['remove_id'])) {
            $image = DB::table('product_images')->where('pimage_id', $input['remove_id'])->first();

            // dd($image);

            if(!empty($image->pimage_id)) {
                if(!empty($image->pimage_image) && file_exists(public_path().'/imgs/product/'.$image->pimage_image)) {
                    unlink(public_path().'/imgs/product/'.$edit->product_id.'/'.$image->pimage_image);
                }
                if(!empty($image->pimage_image_thumb) && file_exists(public_path().'/imgs/product/'.$image->pimage_image_thumb)) {
                    unlink(public_path().'/imgs/product/'.$edit->product_id.'/'.$image->pimage_image_thumb);
                }
                if(!empty($image->pimage_image_medium) && file_exists(public_path().'/imgs/product/'.$image->pimage_image_medium)) {
                    unlink(public_path().'/imgs/product/'.$edit->product_id.'/'.$image->pimage_image_medium);
                }

                DB::table('product_images')->where('pimage_id', $input['remove_id'])->delete();
            }

            return redirect()->back()->with('success', 'Image deleted successfully');
        }

        $input  = $request->input('record');

        $category = DB::table('categories')
                    ->where('category_parent', '0')
                    ->where('category_is_deleted', 'N')
                    ->get();

        if ($request->isMethod('post')) {
            if(empty($input['product_slug'])) $input['product_slug'] = "DEFAULT";

            $input = array_filter( $input );
            if(empty($id)) {
                $id = ProductModel::insertGetId( $input );
                $mess = "Data inserted.";
            } else {
                ProductModel::where('product_id', $id)->update( $input );
                $mess = "Data updated";
                ProductModel::whereRaw('1=1')->update(['product_is_read' => 1]);
            }

            if($input['product_slug'] == 'DEFAULT') {
                $slug = $q->create_slug($input['product_name'], "products", "product_slug", "product_id", $id);
                ProductModel::where('product_id', $id)->update( array('product_slug' => $slug) );

            }

            $current_session = session('pro_price');
            if(!empty($current_session)) {
                foreach($current_session as $cs) {
                    $cs['price_pid'] = $id;

                    ProductPrice::insert( $cs );
                }
            }

            if ($request->hasFile('product_image')) {

                // $imgid = DB::getPdo()->lastInsertId();
                if(!empty($edit->product_image) && file_exists(public_path().'/imgs/product/'.$edit->product_image)) {
                    unlink(public_path().'/imgs/product/'.$edit->product_image);
                }
                if(!empty($edit->product_image_thumb) && file_exists(public_path().'/imgs/product/'.$edit->product_image_thumb)) {
                    unlink(public_path().'/imgs/product/'.$edit->product_image_thumb);
                }
                if(!empty($edit->product_image_medium) && file_exists(public_path().'/imgs/product/'.$edit->product_image_medium)) {
                    unlink(public_path().'/imgs/product/'.$edit->product_image_medium);
                }
                $image           = $request->file('product_image');
                $name            = 'img'.$id.'.'.$image->getClientOriginalExtension();
                $destinationPath = 'public/imgs/product';
                $image->move($destinationPath, $name);
                $dir1 = public_path().'/imgs/product/';
                $dir = url('imgs/product');

                $thumb = "thumb_".$id.'.'.$image->getClientOriginalExtension();
                $q->resize_image($dir.'/'.$name, 128, 128, $dir1.'/'.$thumb);

                $medium = "medium_".$id.'.'.$image->getClientOriginalExtension();
                $q->resize_image($dir.'/'.$name, 512, 512, $dir1.'/'.$medium);

                $large = "img".$id.'.'.$image->getClientOriginalExtension();
                $q->resize_image($dir.'/'.$name, 1024, 1024, $dir1.'/'.$large);


                if(!empty($edit->product_image)) {
                    $unique = uniqid();
                    $large  .= "?v=".$unique;
                    $thumb  .= "?v=".$unique;
                    $medium .= "?v=".$unique;
                }
                $imgArr = [
                    'product_image'          => $large,
                    'product_image_thumb'    => $thumb,
                    'product_image_medium'   => $medium
                ];

                ProductModel::where('product_id', $id)->update( $imgArr );

            }

            // gallary images

            $dir1 = public_path().'/imgs/product/'.$id;
            //
            // if(is_dir($dir1)) $q->rmdir_recursive($dir1);

            $dir = url('imgs/product/'.$id.'/');

            if($files = $request->file('gallery_images')) {
                foreach($files as $image){

                    $arr = array(
                        'pimage_pid'    => $id
                    );

                    DB::table('product_images')->insert($arr);
                    $imgid = DB::getPdo()->lastInsertId();

                    $name  = 'GALL_'.$imgid.'.'.$image->getClientOriginalExtension();
                    $destinationPath = 'public/imgs/product/'.$id.'/';
                    $image->move($destinationPath, $name);

                    $thumb = "thumb_".$imgid.'.'.$image->getClientOriginalExtension();
                    $q->resize_image($dir.'/'.$name, 92, 92, $dir1.'/'.$thumb);

                    $medium = "medium_".$imgid.'.'.$image->getClientOriginalExtension();
                    $q->resize_image($dir.'/'.$name, 600, 400, $dir1.'/'.$medium);

                    $large = "GALL_".$imgid.'.'.$image->getClientOriginalExtension();
                    $q->resize_image($dir.'/'.$name, 1024, 1024, $dir1.'/'.$large);

                    $imgArr = [
                        'pimage_image'          => $large,
                        'pimage_image_thumb'    => $thumb,
                        'pimage_image_medium'   => $medium
                    ];

                    DB::table('product_images')->where('pimage_id', $imgid)->update( $imgArr );
                }
            }
            return redirect('rt-admin/product');
        }

        $page   = "add_product";
        $data   = compact('page', 'edit', 'specs', 'category','subcategories', 'gallary', 'id');
        return view('backend/layout', $data);
    }
}
