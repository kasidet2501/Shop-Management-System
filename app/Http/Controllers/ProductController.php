<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

use App\Models\Category;

use Config, Validator;

use Image;

class ProductController extends Controller
{
    // rp = Result per Page
    var $rp = 5;

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


        if($id) {
            // edit view
            $product = Product::where('id', $id)->first(); 
            return view('product/edit')
            ->with('product', $product)
            ->with('categories', $categories);
        } else {
            // add view
            return view('product/add')
            ->with('categories', $categories);
        }



        //สินค้าที่ดึงขึ้นมาด้วยคําสั่ง find มีรายการเดียว product ไม่มีs
        // $product = Product::find($id);

        // ทําการส่งข้อมูลไปยังวิว ด้วยคําสั่ง with() โดยใช้ชื่ออ้างอิงเป็น product ชื่อเดิม
        // return view('product/edit')
        // ->with('product', $product)
        // ->with('categories', $categories);
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



        // --------------> ส่วนบันทึกข้อมูลรูปภาพ <---------------------

        // เพื่อตรวจÿอบว่าผู้ใช้ได้เลือกไฟล์เข้ามาหรือไม่
        if($request->hasFile('image')){
            $f = $request->file('image');
            // อยู่ในโฟลเดอร์ Public
            $upload_to = 'upload/images'; //แปลว่า คุณต้องไปสร้างโฟลเดอร์ชื่อนี้ไว้ในโปรเจคคุณด้วยนะ

            // get path
            $relative_path = $upload_to.'/'.$f->getClientOriginalName();    // relativepath จะ มีค่าเป็น “upload/images/file1.jpg”
            $absolute_path = public_path().'/'.$upload_to;                  // absolute path จะเป็นพาธจริงในเครื่องเซิร์ฟเวอร์ก็จะมีค่าเป็น “E:/Laravel/bikeshop/public/upload/image/file1.jpg” (ขึ้นอยู่กับคุณสร้างโปรเจคไว้ที่ไหน)


            // upload file
            $f->move($absolute_path, $f->getClientOriginalName());  //$f->move() ก็จะทำการอัพโĀลด รูปภาพลงไปสู่ absolute path ต่อไป 

            // save image path to database
            $product->image_url = $relative_path;

            $product->save(); // บันทึกลงฐานข้อมูล อย่าเพิ่งพิมพ์จนกว่าจะไม่มี error นะครับ

            // ลดขนาดรูปภาพโดยกำหนดความกว้าง 250px และสูง250px
            // อย่าลืม use Image;
            Image::make(public_path().'/'.$relative_path)->resize(250, 250)->save();
        }



        // --------------> จบส่วนบันทึกข้อมูลรูปภาพ <---------------------

        return redirect('product')
        ->with('ok', true)
        ->with('msg', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function insert(Request $request){

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

        // $id = $request->id;

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
            return redirect('product/edit')
            ->withErrors($validator)
            ->withInput();
        }
        // --------------> จบส่วนตรวจสอบข้อมูล <---------------------

        // --------------> ส่วนเพิ่มข้อมูล <---------------------

        // สร้าง product มาใหม่ในฐานข้อมูลเพื่อจะเพิ่มสินค้า
        $product = new Product();
        $product->code = $request->code;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->stock_qty = $request->stock_qty;

        $product->save(); // ถ้าไม่ชัวร์ อย่าเพิ่งพิมพ์ save 

        // --------------> จบส่วนเพิ่มข้อมูล <---------------------

        // เพื่อตรวจÿอบว่าผู้ใช้ได้เลือกไฟล์เข้ามาหรือไม่
        if($request->hasFile('image')){
            $f = $request->file('image');
            // อยู่ในโฟลเดอร์ Public
            $upload_to = 'upload/images'; //แปลว่า คุณต้องไปสร้างโฟลเดอร์ชื่อนี้ไว้ในโปรเจคคุณด้วยนะ

            // get path
            $relative_path = $upload_to.'/'.$f->getClientOriginalName();    // relativepath จะ มีค่าเป็น “upload/images/file1.jpg”
            $absolute_path = public_path().'/'.$upload_to;                  // absolute path จะเป็นพาธจริงในเครื่องเซิร์ฟเวอร์ก็จะมีค่าเป็น “E:/Laravel/bikeshop/public/upload/image/file1.jpg” (ขึ้นอยู่กับคุณสร้างโปรเจคไว้ที่ไหน)


            // upload file
            $f->move($absolute_path, $f->getClientOriginalName());  //$f->move() ก็จะทำการอัพโĀลด รูปภาพลงไปสู่ absolute path ต่อไป 

            // save image path to database
            $product->image_url = $relative_path;

            $product->save(); // บันทึกลงฐานข้อมูล อย่าเพิ่งพิมพ์จนกว่าจะไม่มี error นะครับ

            // ลดขนาดรูปภาพโดยกำหนดความกว้าง 250px และสูง250px
            // อย่าลืม use Image;
            Image::make(public_path().'/'.$relative_path)->resize(250, 250)->save();
        }
        return redirect('product')
        ->with('ok', true)
        ->with('msg', 'เพิ่มข้อมูลสินค้าเรียบร้อยแล้ว');
    }

    public function remove($id) {
        Product::find($id)->delete();
        return redirect('product')
        ->with('ok', true)
        ->with('msg', 'ลบข้อมูลสำเร็จ');
    }
}
