<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

use App\Models\Category;

use Config, Validator;

class ProductController extends Controller
{
    // rp = Result per Page
    var $rp = 2;

    public function index(){
        $products = Product::paginate($this->rp);

        // ส่ง compactของproductsที่เราget all มา ให้ส่งไปยังpage index
        return view('product/index', compact('products'));
    }

    public function search(Request $request) {
        $query = $request->q;
        if($query) {
            $products = Product::where('code', 'like', '%'.$query.'%')
            ->orWhere('name', 'like', '%'.$query.'%')
            ->paginate($this->rp);
        }
        else {
            $products = Product::paginate($this->rp);
        }
        return view('product/index', compact('products'));
    }

    public function edit($id = null){
        // สำหรับ dropdown list โดยpluckจะดึงข้อมูลมาเป็นarray และprependคือจะเอารายการที่บอกอเอาไว้บนสุด
        $categories = Category::pluck('name', 'id')->prepend('เลือกรายการ', '');

        //สินค้าที่ดึงขึ้นมาด้วยคําสั่ง find มีรายการเดียว product ไม่มีs
        $product = Product::find($id);

        // ทําการส่งข้อมูลไปยังวิว ด้วยคําสั่ง with() โดยใช้ชื่ออ้างอิงเป็น product ชื่อเดิม
        return view('product/edit')
        ->with('product', $product)
        ->with('categories', $categories);
    }

    public function update(Request $request){


        // --------------> ส่วนตรวจสอบข้อมูล <---------------------
        $rules = array(
            'code' => 'required',
            'name' => 'required',
            'category_id' => 'required|numeric',
            'price' => 'numeric',
            'stock_qty' => 'numeric',
        );

        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 
            'numeric' => 'กรุณากรอกข้อมูล :attribute ให้เป็นตัวเลข',
        );

        $id = $request->id;

        $temp = array(
            'code'=> $request->code,
            'name' => $request->name,
            'category_id'=> $request->category_id,
            'price'=> $request->price,
            'stock_qty'=> $request->stock_qty,
        );

        //ตรงนี้เป็นการนําค่าจากฟอร์ม มาใส่ตัวแปร array temp เพราะ class Validator ต้องการ array
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
            return redirect('product/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }
        // --------------> จบส่วนตรวจสอบข้อมูล <---------------------



        // --------------> ส่วนบันทึกข้อมูล <---------------------
        $product = Product::find($id);
        $product->code = $request->code;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->stock_qty = $request->stock_qty;

        $product->save();



        // --------------> จบส่วนบันทึกข้อมูล <---------------------


        // คําสั่ง redirect() ซึ่งจะสั่งให้ไปเรียก “product” ซึ่ง ก็คือ หน้าจอรายการสินค้าของเรานั่นเอง
        return redirect('product')
        ->with('ok', true)
        ->with('msg', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }
}
