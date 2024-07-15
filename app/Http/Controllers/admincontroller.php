<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\car_product;

class admincontroller extends Controller
{
    public function index()
    {
        $car_products = DB::table('car_products')->orderBy('id', 'desc')->paginate(3);
        return view('home', compact('car_products'));
    }

    public function show($id)   
    {
        $car = DB::table('car_products')->find($id); 
        return view('show', compact('car'));
    }

    public function create(){
        return view('from');
    }

    public function insert(Request $request){
        $request->validate([
            'car_name' => 'required|max:50',
            'car_detail' => 'required|max:1000',
            'car_price' => 'required|numeric',
            'car_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048'
        ], 
        [
            'car_name.required' => 'กรุณากรอกชื่อรถ',
            'car_name.max' => 'กรุณากรอกชื่อรถไม่เกิน 50 ตัวอักษร',
            'car_detail.required' => 'กรุณากรอกรายละเอียดรถ',
            'car_detail.max' => 'กรุณากรอกรายละเอียดไม่เกิน 1000 ตัวอักษร',
            'car_price.required' => 'กรุณากรอกราคา',
            'car_price.numeric' => 'กรุณากรอกตัวเลขเท่านั้นสำหรับราคา',
        ]);

        if ($request->hasFile('car_image')) {
            $imagePath = $request->file('car_image')->store('car_images', 'public');
        } else {
            $imagePath = null;
        }        

        $data =[
            'car_name'=> $request->car_name,
            'car_detail'=>$request->car_detail,
            'car_price'=> $request->car_price,
            'car_image' => $imagePath
        ];
        
        DB::table('car_products')->insert($data);
        return redirect()->route('home');
    }

    public function delete($id){
        DB::table('car_products')->where('id',$id)->delete();
        return redirect('/home');
    }

    public function edit($id){
        $home = DB::table('car_products')->where('id', $id)->first();
        return view('edit', compact('home'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'car_name' => 'required|max:50',
            'car_detail' => 'required|max:1000',
            'car_price' => 'required|numeric',
            'car_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048'
        ], 
        [
            'car_name.required' => 'กรุณากรอกชื่อรถ',
            'car_name.max' => 'กรุณากรอกชื่อรถไม่เกิน 50 ตัวอักษร',
            'car_detail.required' => 'กรุณากรอกรายละเอียดรถ',
            'car_detail.max' => 'กรุณากรอกรายละเอียดไม่เกิน 1000 ตัวอักษร',
            'car_price.required' => 'กรุณากรอกราคา',
            'car_price.numeric' => 'กรุณากรอกตัวเลขเท่านั้นสำหรับราคา',
        ]);

        if ($request->hasFile('car_image')) {
            $imagePath = $request->file('car_image')->store('car_images', 'public');
        } else {
            $imagePath = null;
        }        

        $data =[
            'car_name'=> $request->car_name,
            'car_detail'=>$request->car_detail,
            'car_price'=> $request->car_price,
            'car_image' => $imagePath
        ];
        
        DB::table('car_products')->where('id', $id)->update($data);
        return redirect('/home');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $car_products = DB::table('car_products')
            ->where('car_name', 'like', "%{$query}%")
            ->orWhere('car_detail', 'like', "%{$query}%")
            ->orderBy('id', 'desc')
            ->paginate(3);

        $car_products->appends(['query' => $query]);

        if ($request->ajax()) {
            return view('car_products_list', compact('car_products'))->render();
        }

        return view('home', compact('car_products', 'query'));
    }


    




    /*function about(){
        return view('about');
    }
     public function searchs(Request $request)
     {
        $query = $request->input('query');
         $car_products = DB::table('car_products')
                           ->where('car_name', 'like', "%{$query}%")
                           ->orWhere('car_detail', 'like', "%{$query}%")
                           ->paginate(3);

         return view('welcom', compact('car_products'));
     }
      public function indexz()
    {
        $car_products = DB::table('car_products')->orderBy('created_at', 'desc')->paginate(3);
        return view('home', compact('car_products'));
    }

    function inde()
    {
        $car_products = DB::table('car_products')->orderBy('id', 'desc')->paginate(3);
        return view('welcom', compact('car_products'));
    }*/
}