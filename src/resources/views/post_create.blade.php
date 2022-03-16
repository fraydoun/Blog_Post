@extends('blog::layouts.app')
@section('css')
<link href="{{asset('/vendor/blog/plugins/editors/quill/quill.snow.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
{{-- @livewire('PostCreate') --}}

<div class="col-12">
    <div id="basic" class="col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class=" col-12">
                        <h4>ایجاد  پست</h4>
                    </div>                 
                </div>
            </div>
            <div class="widget-content widget-content-area">
                
                <form action="{{ route('poststore') }}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class=" col-12 mx-auto">
                            
                            <div class="form-group">
                                <label for="blog_categoryInput">دسته بندی</label>
                                <select id="blog_categoryInput"  class="form-control" name="blog_category_id">
                                    <option value="" data-hidden="true">دسته بندی انتخاب کنید</option>
                                    @foreach ($blog_categories as $category)
                                    <option value="{{$category->id}}" {{ $category->id == old('blog_category_id') ? ' selected' : '' }}>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                
                                @error('blog_category_id') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            
                            <div class="form-group">
                                
                                <label>نویسنده </label>
                                <select id="blog_categoryInput"  class="form-control" name="admin_id">
                                    <option value="" data-hidden="true">نویسنده انتخاب کنید</option>
                                    @foreach ($admins as $admin)
                                    <option value="{{ $admin->id }}" {{ $admin->id == old('admin_id') ? ' selected' : '' }}>{{ $admin->name }}</option>
                                    @endforeach
                                </select>
                                
                                @error('admin_id') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="photo">عکس برای پست </label>
                                <input type="file" class="form-control" name="photo" id="photo" value="{{old("photo")}}">
                                @error('photo') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="titleInput">عنوان </label>
                                <input type="text" class="form-control" name="title" id="titleInput" placeholder="عنوان پست را وارد کنید!" value="{{old("title")}}">
                                @error('title') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="tags">برچسب ها  </label>
                                <input type="text" class="form-control" name="tags" id="tags" placeholder="برچسب ها را وارد کنید!" value="{{old("tags")}}">
                                @error('tags') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="tg">متن  کوتاه پست </label>
                                <textarea class="form-control" id="tg"  name="short_content" rows="3" placeholder="توضیحات  کوتاه پست را وارد نمایید...">{{old("short_content")}}</textarea>
                                @error('short_content') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="titleInput">متن کامل پست</label>
                                <div  id="editor-container">  
                                    {!!old("content")!!} 
                                </div>
                                <textarea id="detail" style="display:none" name="content">{{old("content")}}</textarea>
                                
                                @error('content') <span class="text-danger">{{ $message }}</span>@enderror 
                            </div>
                            
                        </div>                                        
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit"  class="btn btn-success">
                            ذخیره 
                        </button>
                        
                    </div>
                </form>
                
            </div>
        </div>
        
    </div>  
    
</div> 

@endsection


@section('script')
<script src="{{asset('/vendor/blog/plugins/editors/quill/quill.js')}}"></script>
<script>
    var quill = new Quill('#editor-container', {
        modules: {
            toolbar: [
            [{ header: [1, 2, 3, 4, 5, 6,  false] }],
            ['bold', 'italic', 'underline','strike'],
            
            ['link'],
            [{ 'script': 'sub'}, { 'script': 'super' }],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            ['clean']
            ]
        },
        placeholder: 'توضیحات  کامل پست را وارد نمایید...',
        theme: 'snow'  // or 'bubble'
    });
    quill.on('text-change', function(delta, oldDelta, source) {
        $('#detail').val(quill.container.firstChild.innerHTML);
    });
    
    
    
</script>
@endsection
