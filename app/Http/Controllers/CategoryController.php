<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use Config, Validator;

class CategoryController extends Controller
{
    var $rp = 2;

    public function index(){
        $categorys = Category::paginate($this->rp);

        // ส่ง compactของproductsที่เราget all มา ให้ส่งไปยังpage index
        return view('category/index', compact('categorys'));
    }

    public function search(Request $request) {
        $query = $request->q;
        if($query) {
            $categorys = Category::where('id', 'like', '%'.$query.'%')
            ->orWhere('name', 'like', '%'.$query.'%')
            ->paginate($this->rp);
        }
        else {
            $categorys = Category::paginate($this->rp);
        }
        return view('category/index', compact('categorys'));
    }

    public function edit($id = null){
        //สินค้าที่ดึงขึ้นมาด้วยคําสั่ง find มีรายการเดียว category ไม่มีs
        $category = Category::find($id);

        // ทําการส่งข้อมูลไปยังวิว ด้วยคําสั่ง with() โดยใช้ชื่ออ้างอิงเป็น category ชื่อเดิม
        return view('category/edit')
        ->with('category', $category);
    }

    public function update(Request $request){


        // --------------> ส่วนตรวจสอบข้อมูล <---------------------
        $rules = array(
            'name' => 'required',
        );

        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 
        );

        $id = $request->id;

        $temp = array(
            'name' => $request->name,
        );

        //ตรงนี้เป็นการนําค่าจากฟอร์ม มาใส่ตัวแปร array temp เพราะ class Validator ต้องการ array
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
            return redirect('category/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }
        // --------------> จบส่วนตรวจสอบข้อมูล <---------------------



        // --------------> ส่วนบันทึกข้อมูล <---------------------
        $category = Category::find($id);

        $category->name = $request->name;

        $category->save();

        // --------------> จบส่วนบันทึกข้อมูล <---------------------

        

        // คําสั่ง redirect() ซึ่งจะสั่งให้ไปเรียก “category” ซึ่ง ก็คือ หน้าจอรายการประเภทสินค้าของเรานั่นเอง
        return redirect('category')
        ->with('ok', true)
        ->with('msg', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }
}
