  
  <div class="col-12">
    <div id="tableCaption" class="col-lg-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            @if (session()->has('success'))
            <div class="alert alert-outline-success mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button><i class="flaticon-cancel-12 close" data-dismiss="alert"></i> <strong>{{session('success')}}</strong>  </div>
            @endif
            <div class="widget-header">
                <div class="row">
                    
                    <div class="col-xl-6 col-md-6 col-sm-12 col-12">
                        <h4> لیست پوست های وبلاک  </h4>
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-12 col-12">
                    </div>
                    <div class="col-xl-2 col-md-2 col-sm-12 col-12">
                        <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target=".createModal">+ ایجاد پوست</button>
                    </div>
                </div>
                
            </div>
            <div class="widget-content widget-content-area">
                
                <div class="table-responsive">
                    <table class="table mb-4">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Category</th>
                                <th>عنوان</th>
                                <th>Short content</th>
                                <th>Tags</th>
                                <th>Creator  Fullname</th>
                                <th>view counter</th>
                                <th> تاریخ ساخت </th>
                                <th  class="text-center" >عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($datas[0] !== null)
                            @foreach ( $datas as $item )
                            <tr>
                                <td class="text-center">{{((($datas->currentPage() -1 )* $datas->perPage()) + $loop->index+1)}}</td>
                                <td>{{$item->blogCategory->title}} </td>
                                <td>{{$item->title}} </td>
                                <td> {{ mb_substr($item->short_content, 0,35,'utf-8') }} ...</td>
                                <td>{{$item->tags}} </td>
                                <td>{{$item->admin->name}} </td>
                                <td>{{$item->view_counter}} </td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <button type="button" wire:click="show({{$item->id}})" class="btn btn-outline-primary mb-2" data-toggle="modal" data-target=".itemModal"> ویرایش</button>
                                    &nbsp;
                                    <button type="button" wire:click="showDelete({{$item->id}})" class="btn btn-outline-danger mb-2" data-toggle="modal" data-target=".itemdeleteModal"> حذف</button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="8" class="text-center">
                                    <h2>
                                        هیچ داده ای پیدا نشد
                                    </h2>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                {{ $datas->links('blog::layouts.pagination') }}
                
            </div>
            
            
        </div>
    </div>
    <!-- Create the toolbar container -->
    <div id="toolbar">
        <button class="ql-bold">Bold</button>
        <button class="ql-italic">Italic</button>
      </div>
  
      <!-- Create the editor container -->
      <div id="editor"
        x-data
        wire:ignore
        wire:model.lazy="content"
        @text-change="$dispatch('change', $event.target.value)">
      </div>

    {{-- update --}}
    <div  wire:ignore.self wire:model.defer="updateMode" class="modal fade itemModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ویرایش پوست</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="blog_categoryInput">Category </label>
                            <select id="blog_categoryInput"  class="form-control" wire:model="blog_category">
                                @foreach ($blog_categories as $category)
                                    <option value="{{$category->id}}" {{ $category->id === $blog_category ? ' selected' : '' }}>{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('blog_category') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="blog_categoryInput">Admin </label>
                            <select id="blog_categoryInput"  class="form-control" wire:model="admin_id">
                                @foreach ($admins as $admin)
                                    <option value="{{ $admin->id }}" {{ $admin->id === $admin_id ? ' selected' : '' }}>{{ $admin->name }}</option>
                                @endforeach
                            </select>
                            @error('admin_id') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        @if($oldPhoto)
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{ asset('/storage/app/upload/posts/dollar.png')}}" alt="Old image Post">
                        </div>
                        @endif
                        @if ($photo)
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{ $photo->temporaryUrl() }}" alt="New image Post">
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="photo">Photo </label>
                            <input type="file" class="form-control" wire:model="photo" id="photo">
                            @error('photo') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="titleInput">عنوان </label>
                            <input type="text" class="form-control" wire:model="title" id="titleInput" placeholder="عنوان پوست را وارد کنید!">
                            @error('title') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">short_content </label>
                            <textarea class="form-control" id="exampleFormControlTextarea1"  wire:model="short_content" rows="3"></textarea>
                            @error('short_content') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="titleInput">content</label>
                            <div id="quill-textarea">
                                <h1>the quill editor is here</h1>
                            </div>
                            <textarea style="display: none" id="detail" name="detail"  wire:model="content"></textarea>
                            {{-- <input class="form-control" id="editor-container"  wire:model="content" rows="3">
                            --}}
                            @error('content') <span class="text-danger">{{ $message }}</span>@enderror 
                        </div>

                        <div class="form-group">
                            <label for="tag">Tags </label>
                            <input type="text" class="form-control" wire:model="tags" id="tag" placeholder="عنوان پوست را وارد کنید!">
                            @error('tags') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>


                    </form>        
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="update()" data-dismiss="modal" class="btn btn-primary"> ویرایش</button>
                    
                    <button class="btn" wire:click.prevent="cancel()" data-dismiss="modal"><i class="flaticon-cancel-12"></i> بستن</button>
                </div>
            </div>
        </div>
    </div>
    
    {{-- create --}}
    <div  wire:ignore.self wire:model.defer="updateMode" class="modal fade createModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ایجاد پوست</h5>
                </div>
                <div class="modal-body">
                    <form>
                        {{-- ['blog_category_id','title', 'short_content','content', 'admin_id', 'photo','view_counter','tags']; --}}
                        <div class="form-group">
                            <label for="titleInput">عنوان </label>
                            <input type="title" class="form-control" wire:model="title" id="titleInput" placeholder="عنوان پوست را وارد کنید!">
                            @error('title') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="titleInput">عنوان </label>
                            <input type="title" class="form-control" wire:model="title" id="titleInput" placeholder="عنوان پوست را وارد کنید!">
                            @error('title') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="titleInput">عنوان </label>
                            <input type="title" class="form-control" wire:model="title" id="titleInput" placeholder="عنوان پوست را وارد کنید!">
                            @error('title') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="titleInput">عنوان </label>
                            <input type="title" class="form-control" wire:model="title" id="titleInput" placeholder="عنوان پوست را وارد کنید!">
                            @error('title') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </form>        
                </div>
                <div class="modal-footer">
                    
                    <button type="button" wire:click.prevent="create()" data-dismiss="modal" class="btn btn-primary"> ثبت </button>
                    
                    
                    <button class="btn" wire:click.prevent="cancel()" data-dismiss="modal"><i class="flaticon-cancel-12"></i> بستن</button>
                    
                </div>
            </div>
        </div>
    </div>
    
    
    <div  wire:ignore.self wire:model.defer="deleteModal" class="modal fade itemdeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> هشدار</h5>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row gx-2 justify-content-left">
                            <div class="col-md-4 col-xl-auto col-md-auto col-sm-auto">
                                <p>با حذف این پوست دیگر قابلیت برگشت آن  وجود ندارد!</p>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>  نادیده گرفتن</button>
                    <button type="button" wire:click="deleteMessageData()" class="btn btn-outline-danger mb-2" data-toggle="modal" data-target=".itemdeleteModal"> حذف شود</button>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    @endpush
    @push('scripts')
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        

    <!-- Initialize Quill editor -->
    <script>
      var editor = new Quill('#editor', {
        modules: { toolbar: '#toolbar' },
        theme: 'snow'
      });
    </script>
    @endpush
</div>



