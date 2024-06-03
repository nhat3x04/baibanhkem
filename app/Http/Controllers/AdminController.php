<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\TypeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
class AdminController extends Controller
{
    public function getLogin(){
        return view('admin.login');
    }

    public function postLogin(Request $req){
        $this->validate($req,
        [
            'email'=>'required|email',
            'password'=>'required|min:6|max:20'
        ],
        [
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Không đúng định dạng email',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu ít nhất 6 ký tự'
        ]
        );
        $credentials=array('email'=>$req->email,'password'=>$req->password);
        if(Auth::attempt($credentials)){
            return redirect('/admin/category/danhsach')->with(['flag'=>'alert','message'=>'Đăng nhập thành công']);
        }
        else{
            return redirect()->back()->with(['flag'=>'danger','thongbao'=>'Đăng nhập không thành công']);
        }
    }

    public function getLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.getLogin');
    }
    public function show()
    {
        $products=Product::paginate(10);
        //tương đương select* from where
        return view('admin.list',compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $product=Product::find($id);
        return view('admin.edit',compact('TypeProduct','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name='';
        $validation = Validator::make($request->all(),
        [
            "name"  => "required",
            // "id_type"=> "required",
            "unit_price" => "required",
            "promotion_price" => "required",
            "description"  => "required",
            "unit" =>"required",
            "new" =>"required",
            'image_file'=>'mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        if ($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
        if($request->hasfile('image_file'))
        {
            $file = $request->file('image_file');
            $name=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('images'); //project\public\images, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/
        }
        //lấy về xe cần sửa
        $product=Product::find($id);
        if($product!=null){
            $products=new product();
            $products->name=$request->input('name');
            $products->unit_price=$request->input('unit_price');
            $products->promotion_price=$request->input('promotion_price');
            $products->description=$request->input('description');
            // $products->id_type=$request->input('id_type');
            $products->unit=$request->input('unit');
            $products->new=$request->input('new');
            if($name==''){
                $name=$product->image;
            }    
            $product->image=$name;  
            $product->save();
        }
        return redirect('product')->with('message','Sửa  thành công');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
* @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        
        $linkImage=public_path('image/').$product->image;
        if(File::exists($linkImage)){
            File::delete($linkImage);
        }
        $product->delete();
        return redirect()->back()->with('message', 'bạn đã xóa thành công !');
    }
    public function postSearch(Request $req){
        $search_value=$req->txSearch;
        $products=product::where('name','like','%'.$search_value.'%')
        ->get();
        return view('admin.list',compact('products'));
        }
    
}
