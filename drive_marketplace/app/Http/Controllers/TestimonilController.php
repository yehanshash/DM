<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialTableRequest;
use App\Models\Testimonial;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestimonilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonial=Testimonial::getAllTestimonial('id','DESC')->paginate(10);
        return view('backend.testimonial.index')->with('testimonials',$testimonial);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.testimonial.create');
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
            'size'=>'nullable',
            'stock'=>"required|numeric",
            'cat_id'=>'required|exists:categories,id',
            'brand_id'=>'nullable|exists:brands,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'is_featured'=>'sometimes|in:1',
            'status'=>'required|in:active,inactive',
            'condition'=>'required|in:default,new,hot',
            'price'=>'required|numeric',
            'discount'=>'nullable|numeric'
        ]);

        $data=$request->all();
        $slug=Str::slug($request->title);
        $count=Product::where('slug',$slug)->count();
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
        $status=Product::create($data);
        if($status){
            request()->session()->flash('success','Product Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('testimonial.index');

    }

    public function testimonial(Request $request)
    {

        if ($request->ajax()) {
            $data = Testimonial::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<div class="action__buttons">';
                    $btn = $btn . '<a href="' . route('admin.testimonial.edit', $data->id) . '" class="btn-action"><i class="fa-solid fa-pen-to-square"></i></a>';
                    $btn = $btn . '<a href="' . route('admin.testimonial.delete', $data->id) . '" class="btn-action delete"><i class="fas fa-trash-alt"></i></a>';
                    $btn = $btn . '</div>';
                    return $btn;
                })
                ->editColumn('Image', function ($data) {
                    $url = asset(TestimonialImage() . $data->Image);
                    return '<img src=' . $url . ' border="0" width="80"class="img-rounded" align="center" />';
                })
                ->editColumn('Name', function ($data) {
                    return $data->Name;
                })
                ->editColumn('en_Description', function ($data) {
                    return Str::limit($data->en_Description, 15);
                })
                ->editColumn('star', function ($data) {
                    return $data->star . ' star';
                })
                ->editColumn('fr_Description', function ($data) {
                    return Str::limit($data->fr_Description, 15);
                })
                ->rawColumns(['action', 'en_Description', 'fr_Description', 'Image'])
                ->make(true);
        }
        $data['title'] = __('Testimonial List');
        $data['testimonial_count'] = Testimonial::count();
        return view('admin.pages.testimonial.index', $data);
    }
    public function testimonialCreate()
    {
        $data['title'] = __('Testimonial Create');
        return view('admin.pages.testimonial.create', $data);
    }
    public function testimonialStore(TestimonialTableRequest $request)
    {
        if (!empty($request->image)) {
            $image = fileUpload($request['image'], TestimonialImage());
        } else {
            return redirect()->back()->with('error', __('Image is required'));
        }
        $blog = Testimonial::create([
            'Name' => $request->name,
            'en_Description' => $request->en_description,
            'fr_Description' => $request->fr_description,
            'star' => $request->star,
            'Image' => $image,
        ]);
        if ($blog) {
            return redirect()->route('admin.testimonial')->with('success', __('Successfully Stored !'));
        }
        return redirect()->back()->with('error', __('Does not insert  !'));
    }
    public function testimonialDelete($id)
    {
        $delete = Testimonial::Where('id', $id);
        if ($delete) {
            $delete->delete();
            return redirect()->route('admin.testimonial')->with('success', __('Successfully Deleted !'));
        }
        return redirect()->route('admin.testimonial')->with('error', __('Does Not Delete!'));
    }
    public function testimonialEdit($id)
    {
        $title = __('Testimonial Edit');
        $edit = Testimonial::where('id', $id)->first();
        return view('admin.pages.testimonial.edit', compact('edit', 'title'));
    }
    public function testimonialUpdate(Request $request)
    {
        $id = $request->id;
        $testimonial = Testimonial::where('id', $id)->first();
        if (!empty($request->image)) {
            $image = fileUpload($request['image'], TestimonialImage());
        } else {
            $image = $testimonial->Image;
        }
        $blog = Testimonial::where('id', $id)->update([
            'Name' => is_null($request->name) ? $testimonial->Name : $request->name,
            'en_Description' => is_null($request->en_description) ? $testimonial->en_Description : $request->en_description,
            'fr_Description' => is_null($request->fr_description) ? $testimonial->fr_Description : $request->fr_description,
            'star' => is_null($request->star) ? $testimonial->star : $request->star,
            'Image' => $image,
        ]);
        if ($blog) {
            return redirect()->route('admin.testimonial')->with('success', __('Successfully Updated !'));
        }
        return redirect()->back()->with('error', __('Does not insert  !'));
    }
}
