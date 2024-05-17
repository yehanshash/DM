<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProduct;
use App\Models\Category;
use App\Models\Brand;

use Illuminate\Support\Str;

class UserProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = UserProduct::where('user_id', auth()->user()->id)->paginate(10);
        // return $products;
        return view('user.user-product.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand=Brand::get();
        $category=Category::where('is_parent',1)->get();
        // return $category;
        return view('user.user-product.create')->with('categories',$category)->with('brands',$brand);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'photo'=>'string|required',
            'cat_id'=>'required|exists:categories,id',
            'brand_id'=>'nullable|exists:brands,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'is_featured'=>'sometimes|in:1',
            'status'=>'required|in:active,inactive',
            'price'=>'required|numeric',
            'model' => 'required|string',
            'mileage' => 'required|string',
            'year' => 'nullable|integer|min:1900|max:'.date('Y'),
            'fuel_type' => 'nullable|in:petrol,diesel,electric,hybrid',
            'phone_number' =>'required|string',
            'transmission' => 'nullable|in:automatic,manual'
        ]);

        $data=$request->all();
        $data['user_id'] = auth()->user()->id;
        $data['model'] = $request->input('model');
        $data['mileage'] = $request->input('mileage');
        $data['year'] = $request->input('year');
        $data['fuel_type'] = $request->input('fuel_type');
        $data['phone_number'] = $request->input('phone_number');
        $data['transmission'] = $request->input('transmission');
        $slug=Str::slug($request->title);
        $count=UserProduct::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;
        $data['is_featured']=$request->input('is_featured',0);
        $size=$request->input('size');
        if($size){
            $data['size']=implode(',',$size);
        }
        else{
            $data['size']='';
        }
        // return $size;
        // return $data;
        $status=UserProduct::create($data);
        if($status){
            request()->session()->flash('success','Product Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('user-product.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand=Brand::get();
        $product=UserProduct::findOrFail($id);
        $category=Category::where('is_parent',1)->get();
        $items=UserProduct::where('id',$id)->get();
        $userName = $product->user->name;
        // return $items;
        return view('user.user-product.edit')->with('product',$product)
            ->with('brands',$brand)
            ->with('categories',$category)->with('items',$items)
            ->with('userName', $userName);
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
        $product=UserProduct::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'photo'=>'string|required',
            'cat_id'=>'required|exists:categories,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'is_featured'=>'sometimes|in:1',
            'brand_id'=>'nullable|exists:brands,id',
            'status'=>'required|in:active,inactive',
            'price'=>'required|numeric',
            'model' => 'required|string',
            'mileage' => 'required|string',
            'year' => 'nullable|integer|min:1900|max:'.date('Y'),
            'fuel_type' => 'nullable|in:petrol,diesel,electric,hybrid',
            'phone_number' =>'required|string',
            'transmission' => 'nullable|in:automatic,manual'
        ]);

        $data=$request->all();
        $data['model'] = $request->input('model');
        $data['mileage'] = $request->input('mileage');
        $data['year'] = $request->input('year');
        $data['fuel_type'] = $request->input('fuel_type');
        $data['phone_number'] = $request->input('phone_number');
        $data['transmission'] = $request->input('transmission');
        $data['is_featured']=$request->input('is_featured',0);
        $size=$request->input('size');
        if($size){
            $data['size']=implode(',',$size);
        }
        else{
            $data['size']='';
        }
        // return $data;
        $status=$product->fill($data)->save();
        if($status){
            request()->session()->flash('success','Product Successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('user-product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=UserProduct::findOrFail($id);
        $status=$product->delete();

        if($status){
            request()->session()->flash('success','Product successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting product');
        }
        return redirect()->route('user-product.index');
    }

}
