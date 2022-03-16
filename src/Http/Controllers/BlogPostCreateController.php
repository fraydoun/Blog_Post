<?php

namespace Fraidoon\Blog\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

use Fraidoon\Blog\Models\BlogPost;
use Fraidoon\Blog\Models\BlogCategory;


class BlogPostCreateController extends Controller
{
    public function index(){
        $data['blog_categories'] = BlogCategory::get(['id','title']);
        $data['admins'] = \App\Models\Admin::get(['id','name']);
        return view('blog::post_create',$data);
    }
    
    
    public function store(Request $request)
    {
        $input_data = $request->all();
        
        $validate = Validator::make(
            $input_data,[
                'title' => 'required|max:200',
                'short_content' => 'required|max:1000',
                'content' => 'required|max:10000',
                'tags' => 'required',
                'photo' => 'mimes:jpg,jpeg,png,bmp|max:5120',
                'blog_category_id' => 'required',
                'admin_id' => 'required'
            ],[
                'title.required' => 'عنوان پست  حتما باید وارد شود',
                'title.regex' => 'عنوان پست بیشتر از 200 حرف نباشد',
                'short_content.required' => 'متن کوتاه پست باید وارد شود',
                'short_content.regex' => 'متن کوتاه پست بیشتر از 500 حرف نباشد',
                'content.required' => 'متن پست باید وارد شود',
                'content.regex' => 'متن پست بیشتر از 10000 حرف نباشد',
                'tags.required' => 'برچسپ وارد شود',
                'blog_category_id.required' => ' دسته بندی را انتخاب کنید',
                'admin_id.required' => ' نویسنده را انتخاب کنید',
                'photo.mimes' => '  تنها عکس با فرمت (jpg,jpeg,png,bmp)را میتوانید انتخاب کنید',
                'photo.max' => 'عکس نباید بیشتر از 5 میگابیت باشد',
                ]
            );
            if ($validate->fails()) {
                return redirect()->back()->withInput()->withErrors($validate->errors());
            }
            $path = '';
            if ($request->hasFile('photo')) {
                
                $file = $request->file('photo');
                $imgName = date("Y-m-d") . "_" . time() . "_" . $file->getclientoriginalname();
                $file->storeAs("public/uploads/images/posts/",$imgName);
                $path = 'storage/uploads/images/posts/'.$imgName;
            }
            
            BlogPost::create([
                'title' => $request->title,
                'slug_title' => \Morilog\Jalali\Jalalian::now()->format('Y-m-d') . $request->title,
                'short_content' => $request->short_content,
                'content' => $request->content,
                'photo' => $path,
                'tags' => $request->tags,
                'blog_category_id' => $request->blog_category_id,
                'admin_id' => $request->admin_id,
            ]);
            
            session()->flash('success', 'پست با موفقیت ثبت شد');
            return redirect()->route('post');
        }
        
        
        
        public function edit($id)
        {
            $data['post'] = BlogPost::where('id', $id)->firstOrFail();
            $data['blog_categories'] = BlogCategory::get(['id','title']);
            $data['admins'] = \App\Models\Admin::get(['id','name']);
            
            return view('blog::post_update',$data);
        }
        
        public function update(Request $request, $id)
        {
            $input_data = $request->all();
            
            $validate = Validator::make(
                $input_data,
                [
                    'title' => 'required|max:200',
                    'short_content' => 'required|max:1000',
                    'content' => 'required|max:10000',
                    'tags' => 'required',
                    'photo' => 'mimes:jpg,jpeg,png,bmp|max:5120',
                    'blog_category_id' => 'required',
                    'admin_id' => 'required'
                ],[
                    'title.required' => 'عنوان پست  حتما باید وارد شود',
                    'title.regex' => 'عنوان پست بیشتر از 200 حرف نباشد',
                    'short_content.required' => 'متن کوتاه پست باید وارد شود',
                    'short_content.regex' => 'متن کوتاه پست بیشتر از 500 حرف نباشد',
                    'content.required' => 'متن پست باید وارد شود',
                    'content.regex' => 'متن پست بیشتر از 10000 حرف نباشد',
                    'tags.required' => 'برچسپ وارد شود',
                    'blog_category_id.required' => ' دسته بندی را انتخاب کنید',
                    'admin_id.required' => ' نویسنده را انتخاب کنید',
                    'photo.mimes' => '  تنها عکس با فرمت (jpg,jpeg,png,bmp)را میتوانید انتخاب کنید',
                    'photo.max' => 'عکس نباید بیشتر از 5 میگابیت باشد',
                    ]
                );
                if ($validate->fails()) {
                    return redirect()->back()->withInput()->withErrors($validate->errors());
                }
                
                $blogpost = BlogPost::find($id);
                $blogpost->title = $request->title;
                $blogpost->short_content = $request->short_content;
                
                $blogpost->content = $request->content;            
                
                $blogpost->tags = $request->tags;
                $blogpost->blog_category_id = $request->blog_category_id;
                $blogpost->admin_id = $request->admin_id;
                if($blogpost->photo !== $request->photo){
                    
                    if(\File::exists(public_path($blogpost->photo)) && $blogpost->photo !== ''){
                        unlink(public_path($blogpost->photo));
                    }

                    $path = '';
                    if ($request->hasFile('photo')) {
                        $file = $request->file('photo');
                        $imgName = date("Y-m-d") . "_" . time() . "_" . $file->getclientoriginalname();
                        $file->storeAs("public/uploads/images/posts/",$imgName);
                        $path = 'storage/uploads/images/posts/'.$imgName;
                    }
                    $blogpost->photo = $path;
                }
                
                $blogpost->save();
                
                session()->flash('success', 'پست با موفقیت ویرایش شد');
                return redirect()->route('post');
            }
            
        }
        