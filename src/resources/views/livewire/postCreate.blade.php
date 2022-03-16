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
                
                <form wire:submit.prevent="create" method="POST"  enctype="multipart/form-data">
                    <div class="row">
                        <div class=" col-12 mx-auto">
                            @if (session()->has('success'))
                            <div class="alert alert-outline-success mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button><i class="flaticon-cancel-12 close" data-dismiss="alert"></i> <strong>{{session('success')}}</strong>  </div>
                            @endif
                            
                            @if(session()->has('error'))
                            <div class="alert alert-outline-danger mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button><i class="flaticon-cancel-12 close" data-dismiss="alert"></i> <strong>{{session('error')}}</strong>  </div>
                            @endif
                            
                            <form>
                                <div class="form-group">
                                    <div wire:ignore>
                                        <label for="blog_categoryInput">دسته بندی</label>
                                        <select id="blog_categoryInput"  class="form-control" wire:model.lazy="blog_category_id">
                                            <option value="0" data-hidden="true">دسته بندی انتخاب کنید</option>
                                            @foreach ($blog_categories as $category)
                                            <option value="{{$category->id}}">{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('blog_category_id') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                
                                <div class="form-group">
                                    <div wire:ignore>
                                        <label>نویسنده </label>
                                        <select id="blog_categoryInput"  class="form-control" wire:model.lazy="admin_id">
                                            <option value="0" data-hidden="true">نویسنده انتخاب کنید</option>
                                            @foreach ($admins as $admin)
                                            <option value="{{ $admin->id }}" >{{ $admin->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('admin_id') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                @if ($photo)
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="{{ $photo->temporaryUrl() }}" alt="New image Post">
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="photo">عکس برای پست </label>
                                    <input type="file" class="form-control" wire:model.lazy="photo" id="photo" value="{{old('photo')}}">
                                    @error('photo') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="titleInput">عنوان </label>
                                    <input type="text" class="form-control" wire:model.lazy="title" id="titleInput" placeholder="عنوان پست را وارد کنید!"value="{{old('title')}}">
                                    @error('title') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="tags">برچسب ها  </label>
                                    <input type="text" class="form-control" wire:model.lazy="tags" id="tags" placeholder="برچسب را وارد کنید!" value="{{old('tags')}}">
                                    @error('tags') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="tg">متن  کوتاه پست </label>
                                    <textarea class="form-control" id="tg"  wire:model.lazy="short_content" rows="3" value="{{old('short_content')}}"></textarea>
                                    @error('short_content') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="titleInput">متن کامل پست</label>
                                    <div  id="editor-container">   
                                    </div>
                                    <textarea id="detail"  wire:model.lazy="content" value="{{old('content')}}"></textarea>
                                    
                                </div>
                                
                                
                                
                                @error('content') <span class="text-danger">{{ $message }}</span>@enderror 
                                
                                
                            </form>  
                        </div>                                        
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="button" wire:click.prevent="create()" data-dismiss="modal"  class="btn btn-success">
                            ذخیره 
                        </button>
                        
                        
                    </div>
                </form>
                
            </div>
        </div>
        
    </div>  
    @push('scripts')
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
            placeholder: 'توضیحات را وارد نمایید...',
            theme: 'snow'  // or 'bubble'
        });
        quill.on('text-change', function(delta, oldDelta, source) {
            // console.log(quill.container.firstChild.innerHTML)
            $('#detail').val(quill.container.firstChild.innerHTML);
        });
        
        
    </script>
    @endpush
</div>  