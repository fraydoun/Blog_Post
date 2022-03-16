<?php

namespace Fraidoon\Blog\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Fraidoon\Blog\Models\BlogPost;
use Fraidoon\Blog\Models\BlogCategory;

class Post extends Component
{
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
    public $comment_counter;
    public $tags;
    public $blog_category;
    public $adminname;
    public $created_at;
    
    public function ResetVars(){
        $this->search = null;
        $this->modelId = null;
        $this->title = null;        
        $this->short_content = null;  
        $this->content = null;
        $this->oldPhoto =null;
        $this->photo = null;
        $this->view_counter = null;
        $this->comment_counter = null;
        $this->tags = null;
        $this->blog_category = null;
        $this->adminname = null;
        $this->blog_categorie = null;
        $this->admins = null;
        $this->created_at = null;
    }
    
    public function read()
    {  
        return BlogPost::with(['blogCategory','admin'])->latest()->paginate(5);
    }
    
    public function render()
    {
        return view('blog::livewire.post'
        ,[
            'datas' => $this->read()
        ]);
    }
    
    public function show($id)
    {
        $this->ResetVars();
        $this->modelId = $id;
        $this->getModalData();
    }
    public function getModalData()
    {
        $data = BlogPost::where('id','=',$this->modelId )->with(['blogCategory','admin','blogComments'])->get();
        
        $this->modelId = $data[0]->id;
        $this->title = $data[0]->title;
        $this->short_content = $data[0]->short_content;  
        $this->content = $data[0]->content;
        $this->photo = $data[0]->photo;
        $this->view_counter = $data[0]->view_counter;
        $this->comment_counter = $data[0]->blogComments->count();
        $this->tags = $data[0]->tags;
        $this->blog_category = $data[0]->blogCategory->title;
        $this->adminname = $data[0]->admin->name;
        $this->created_at = \Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strtotime($data[0]->created_at));
    }
    public function cancel()
    {
        $this->ResetVars();
    }
    
    
    public function showDelete($id)
    {
        $this->modelId = $id;
    }
    
    public function deleteMessageData()
    {
        $data = BlogPost::where('id' , $this->modelId)->first();

        if(\File::exists(public_path($data->photo)) && $data->photo != ""){
            // dd(public_path($data->photo));
            // dd(public_path().'/'.$data->photo);
            unlink(public_path().'/'.$data->photo);
        }
        
        if($data->delete()){
                session()->flash('success', 'پوست با موفقیت حذف شد');
            }
            
        }
        
        
        
    }
    