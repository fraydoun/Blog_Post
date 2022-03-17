<?php

namespace Fraidoon\Blog\Http\Livewire;

use Livewire\Component;

use Fraidoon\Blog\Models\BlogComment;
use Fraidoon\Blog\Models\BlogPost;

use Livewire\WithPagination;

class Comment extends Component
{
    use WithPagination;
    public $updateMode = false;
    public $createModal = false;
    public $deleteModal = false;
    public $modelId;
    public $comment;
    public $full_name;
    public $email;
    public $phone;
    public $visiable = false;
    public $blog_post_id;
    public $blogPostTitle;
    public $blog_post=[];

    
    
    protected $rules = [
        'comment' => 'required|max:10000',
        'full_name' => 'required|max:200',
        'email' => 'required|email',
        'phone' => 'required|max:16',
        'visiable' => 'boolean',
        'blog_post_id' => 'required'
    ];
    
    protected $messages = [
        'comment.required' => 'نظریه    حتما باید وارد شود',
        'comment.max' => 'نظریه بیشتر از 10000 حرف نباشد',
        'full_name.required' => 'نام و نام خانوادگی وارد شود',
        'full_name.max' => 'نام و نام خانوادگی بیشتر از 200 حرف نباشد',
        'email.required' => 'ایمیل آدرس حتما وارد شود',
        'email.email' => 'ایمیل آدرس معتبر وارد شود',
        'phone.required' => 'شماره موبایل حتما وارد شود',
        'phone.max' => 'شماره موبایل بیشتر از 16 حرف نباشد',
        'blog_post_id' => 'پست را انتخاب کنید'
        // 'visiable.boolean' => 'چک باکس'
    ];
    
    public function ResetVars(){
        $this->search = null;
        $this->modelId = null;
        $this->comment = null;        
        $this->full_name = null;
        $this->email = null;
        $this->phone = null;
        $this->visiable = null;
        $this->blog_post_id = null;
        $this->blogPostTitle =null;
    }
    
    public function read()
    {
        $this->blog_post = BlogPost::get(['id','title']);
        $datas = BlogComment::with(['blogPost'])->latest()->paginate(5);

        return $datas;
    }
    
    public function render()
    {
        return view('blog::livewire.Comment'
        ,[
            'datas' => $this->read()
        ]);
    }
    
    public function create()
    {
        if($this->validate()){
            BlogComment::create([
                'comment' => strip_tags($this->comment),
                'full_name' => strip_tags($this->full_name),
                'email' => $this->email,
                'phone' => strip_tags($this->phone),
                'visiable' => strip_tags($this->visiable),
                'blog_post_id' => $this->blog_post_id
            ]);
            
            $this->ResetVars();
            return session()->flash('success', 'نظر با موفقیت ثبت شد');
        }
        return session()->flash('errors', 'نظر  ثبت نشد');
    }
    
    
    public function show($id){
        $this->ResetVars();
        $this->modelId = $id;
        $this->getModalData();
    }
    public function getModalData(){
        $data = BlogComment::where('id','=',$this->modelId )->with(['blogPost'])->get();
        
        $this->modelId = $data[0]->id;
        $this->comment = $data[0]->comment;
        $this->full_name = $data[0]->full_name;
        $this->email = $data[0]->email;
        $this->phone = $data[0]->phone;
        $this->visiable = $data[0]->visiable;
        $this->blog_post_id = $data[0]->blog_post_id;
        $this->blogPostTitle = $data[0]->blogPost->title;
        
    }
    public function cancel(){
        $this->ResetVars();
    }
    
    public function update()
    {
        $this->validate();
        if ($this->modelId) {
            $data = BlogComment::find($this->modelId);
            $data->update([
                'comment' => strip_tags($this->comment),
                'full_name' => strip_tags($this->full_name),
                'email' => $this->email,
                'phone' => strip_tags($this->phone),
                'visiable' => strip_tags($this->visiable),
                'blog_post_id' => $this->blog_post_id
            ]);
            $this->ResetVars();

            session()->flash('success', 'نظر با موفقیت ویرایش شد');
        }
    }

    public function showDelete($id){
        $this->ResetVars();
        $this->modelId = $id;
        
    }

    public function deleteMessageData(){
        $data = BlogComment::where('id' , $this->modelId)->delete();
        if($data){
            session()->flash('success', 'نظر با موفقیت حذف شد');
        }
    }
    
}
