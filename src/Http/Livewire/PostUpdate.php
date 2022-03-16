<?php

namespace Fraidoon\Blog\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use Fraidoon\Blog\Models\BlogPost;
use Fraidoon\Blog\Models\BlogCategory;

class PostUpdate extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $updateMode = false;
    public $createModal = false;
    public $deleteModal = false;
    public $modelId;
    public $title;
    public $short_content;  
    public $content;
    public $oldPhoto;
    public $photo;
    public $view_counter;
    public $tags;
    public $blog_category;
    public $admin_id;
    public $blog_categories= [];
    public $admins =[];
    
    
    protected $rules = [
        'title' => 'required|max:200',
        'short_content' => 'required|max:500',
        'content' => 'required|max:2000',
        'tags' => 'required',
        'blog_category_id' => 'required',
        'photo' => 'image|max:1024',
        'admin_id' => 'required'
    ];
    
    protected $messages = [
        'title.required' => 'عنوان پوست  حتما باید وارد شود',
        'title.regex' => 'عنوان بیشتر از 200 حرف نباشد',
        'short_content.required' => 'متن کوتاه پوست باید وارد شود',
        'short_content.regex' => 'متن کوتاه بیشتر از 500 حرف نباشد',
        'content.required' => 'متن پوست باید وارد شود',
        'content.regex' => 'متن بیشتر از 2000 حرف نباشد',
        'tags.required' => 'tags وارد شود',
        'blog_category_id.required' => 'ایدی دسته بندی را انتخاب کنید',
        'admin_id.required' => 'ایدی نویسنده'
    ];
    
    public function ResetVars(){
        $this->search = null;
        $this->modelId = null;
        $this->title = null;        
        $this->short_content = null;  
        $this->content = null;
        $this->oldPhoto =null;
        $this->photo = null;
        $this->view_counter = null;
        $this->tags = null;
        $this->blog_category = null;
        $this->admin_id = null;
        $this->blog_categorie = null;
        $this->admins = null;
    }
    
    public function read()
    {
        
        $datas = BlogPost::with(['blogCategory','admin'])->latest()->paginate(5);
        // dd($datas);
        return $datas;
    }
    
    public function render()
    {
        return view('blog::livewire.post'
        ,[
            'datas' => $this->read()
        ]);
    }
    
    public function create()
    {
        $this->validate();
        BlogPost::create(['title' => $this->title]);
        $this->ResetVars();
        session()->flash('success', 'پوست با موفقیت ثبت شد');
    }
    
    
    public function show($id){
        $this->ResetVars();
        $this->modelId = $id;
        $this->getModalData();
    }
    public function getModalData(){
        $data = BlogPost::where('id','=',$this->modelId )->with(['blogCategory','admin'])->get();
        $this->blog_categories = BlogCategory::get(['id','title']);
        $this->admins = \App\Models\Admin::get(['id','name']);
        
        $this->modelId = $data[0]->id;
        $this->title = $data[0]->title;
        $this->short_content = $data[0]->short_content;  
        $this->content = $data[0]->content;
        $this->oldPhoto = $data[0]->photo;
        // $this->view_counter = $data[0]->view_counter;
        $this->tags = $data[0]->tags;
        $this->blog_category = $data[0]->blogCategory->id;
        $this->admin_id = $data[0]->admin->id;
        
    }
    public function cancel(){
        $this->ResetVars();
    }
    
    public function update()
    {
        dd($this->photo->store('upload/posts'));
        // $this->validate();
        // if ($this->modelId) {
        //     $data = BlogPost::find($this->modelId);
        //     $data->update([
        //         'title' => $this->title,
        //         'photo' => $this->photo->store('upload'),
        //     ]);
        //     $this->ResetVars();

        //     session()->flash('success', 'پوست با موفقیت ویرایش شد');
        // }
    }

    public function showDelete($id){
        $this->ResetVars();
        $this->modelId = $id;
        
    }

    public function deleteMessageData(){
        $data = BlogPost::where('id' , $this->modelId)->delete();
        if($data){
            session()->flash('success', 'پوست با موفقیت حذف شد');
        }
    }
    
   
    
}
