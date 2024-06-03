<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\Billdescription;
use App\Models\TypeProduct;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


use Illuminate\Support\Facades\Session;
class PageController extends Controller
{
    public function index(){
        $new_products=Product::where('new',1)->get();
        return view('banhang.index-show',compact('new_products'));
    }

    public function getChiTietsp($id){
        $product =Product::where('id',$id)->get();
        return view('banhang.product', compact('product'));
    }
    public function show($id)
    {
        $detail=Product::find($id);
        return view('banhang.detail',compact('detail'));
    }
    public function addToCart(Request $request,$id){
        $product=Product::find($id);
        $oldCart=Session('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->add($product,$id);
        $request->session()->put('cart',$cart);
        return redirect()->back();
     }
     public function removeFromCart($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->back();
    }
    public function getCheckout()
    {
        // Logic for displaying the checkout page
        return view('cart.checkout');
    }
    public function postCheckout(Request $request){
    
        $cart=Session::get('cart');
        $customer= new Customer();
        $customer->name=$request->input('name');
        $customer->gender=$request->input('gender');
        $customer->email=$request->input('email');
        $customer->address=$request->input('address');
        $customer->phone_number=$request->input('phone_number');
        $customer->note=$request->input('notes');
        $customer->save();

        $bill=new Bill();
        $bill->id_customer=$customer->id;
        $bill->date_order=date('Y-m-d');
        $bill->total=$cart->totalPrice;
        $bill->payment=$request->input('payment_method');
        $bill->note=$request->input('notes');
        $bill->save();

        foreach($cart->items as $key=>$value)
        {
            $bill_description=new Billdescription();
            $bill_description->id_bill=$bill->id;
            $bill_description->id_product=$key;
            $bill_description->quantity=$value['qty'];
            $bill_description->unit_price=$value['unit_price']/$value['qty'];
            $bill_description->save();
        }
        Session::forget('cart');
        return redirect()->back()->with('success','Đặt hàng thành công');

    }
    public function store(Request $request)
    {
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
            return redirect('them')->withErrors($validation)->withInput();
        }
        $name = null;
        if($request->hasfile('image_file'))
        {
            $file = $request->file('image_file');
            $name=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('image'); //project\public\images, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/
        }
     
        $products=new product();
        $products->name=$request->input('name');
        $products->unit_price=$request->input('unit_price');
        $products->promotion_price=$request->input('promotion_price');
        $products->description=$request->input('description');
        // $products->id_type=$request->input('id_type');
        $products->unit=$request->input('unit');
        $products->new=$request->input('new');

        $products->image=$name ?? '';
        $products->save();
        return redirect('them')->with('message','Thêm thành công');
    }
    public function create()
    {
        $products=Product::all();
        return view('user.them',compact('products'));
    }
    public function getSignin(){
       
        return view('user.dangky');
    }

    public function postSignin(Request $req){
        $validator = Validator::make($req->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:20',
            'fullname' => 'required',
            'repassword' => 'required|same:password',
            'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address' => 'nullable|string|max:255',
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Không đúng định dạng email',
            'email.unique' => 'Email đã có người sử dụng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu ít nhất 6 ký tự',
            'password.max' => 'Mật khẩu tối đa 20 ký tự',
            'fullname.required' => 'Vui lòng nhập tên đầy đủ',
            'repassword.required' => 'Vui lòng xác nhận mật khẩu',
            'repassword.same' => 'Mật khẩu không giống nhau',
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'phone.min' => 'Số điện thoại phải có ít nhất 10 chữ số',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User(); // Correctly instantiate the User model
        $user->full_name = $req->fullname;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->save();

        return redirect()->back()->with('success', 'Tạo tài khoản thành công');
    }
    public function getLogin(){
        return view('user.dangnhap');
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
        $credentials=['email'=>$req->email,'password'=>$req->password];
        if(Auth::attempt($credentials)){//The attempt method will return true if authentication was successful. Otherwise, false will be returned.
            return redirect('/index')->with(['flag'=>'alert','message'=>'Đăng nhập thành công']);
        }
        else{
            return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập không thành công']);
        }
    }
    public function getLogout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('banhang.index-show');
    }
    public function getInputEmail(){
        return view('emails.input-email');
    }
    public function postInputEmail(Request $req){
        $email=$req->txtEmail;
        //validate

        // kiểm tra có user có email như vậy không
        $user=User::where('email',$email)->get();
        //dd($user);
        if($user->count()!=0){
            //gửi mật khẩu reset tới email
            $sentData = [
                'title' => 'Mật khẩu mới của bạn là:',
                'body' => '123456'
            ];
            Mail::to($email)->send(new \App\Mail\SendMail($sentData));
            Session::flash('message', 'Send email successfully!');
            return view('user.dangnhap');  //về lại trang đăng nhập của khách
        }
        else {
              return redirect()->route('getInputEmail')->with('message','Your email is not right');
        }
    }//hết postInputEmail
    public function postSearch(Request $req){
        $search_value=$req->txSearch;
        $new_products=product::where('name','like','%'.$search_value.'%')
        ->get();
        return view('banhang.index-show',compact('new_products'));
        }
    
}