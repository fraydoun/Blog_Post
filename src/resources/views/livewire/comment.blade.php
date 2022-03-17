  
  <div class="col-12">
    <div id="tableCaption" class="col-lg-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            @if (session()->has('success'))
            <div class="alert alert-outline-success mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button><i class="flaticon-cancel-12 close" data-dismiss="alert"></i> <strong>{{session('success')}}</strong>  </div>
            @endif
            
            @if (session()->has('errors'))
            <div class="alert alert-outline-danger mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button><i class="flaticon-cancel-12 close" data-dismiss="alert"></i> <strong>{{session('errors')}}</strong>  </div>
            @endif
            
            <div class="widget-header">
                <div class="row">
                    
                    <div class="col-xl-6 col-md-6 col-sm-12 col-12">
                        <h4> لیست نظرات پست ها  </h4>
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-12 col-12">
                    </div>
                    <div class="col-xl-2 col-md-2 col-sm-12 col-12">
                        <button type="button"  class="btn btn-primary mt-3" data-toggle="modal" data-target=".createModal">+ ایجاد  نظر</button>
                        {{-- wire:click="create()" --}}
                    </div>
                </div>
                
            </div>
            
            <div class="widget-content widget-content-area">
                
                <div class="table-responsive">
                    <table class="table mb-4">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>  پست مربوطه</th>
                                <th>نام و نام خانوادگی</th>
                                <th>نظر</th>
                                <th>شماره موبایل</th>
                                <th> ایمیل آدرس</th>
                                <th>قابل رویت</th>
                                <th> تاریخ ساخت </th>
                                <th  class="text-center" >عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @if ($datas[0] !== null)
                            @foreach ( $datas as $item )
                            <tr>
                                <td class="text-center">{{((($datas->currentPage() -1 )* $datas->perPage()) + $loop->index+1)}}</td>
                                <td>{{ mb_substr($item->blogPost->title, 0,20,'utf-8')}}... </td>
                                <td>{{$item->full_name}} </td>
                                <td>{{ mb_substr($item->comment, 0,20,'utf-8')}}... </td>
                                <td>{{$item->phone}} </td>
                                <td>{{$item->email}} </td>
                                <td>{{ ($item->visiable == true) ? 'بلی' : 'نخیر' }} </td>
                                <td>
                                    {{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strtotime($item->created_at));}}
                                </td>
                                <td>
                                    <button type="button" wire:click="show({{$item->id}})" class="btn btn-outline-primary mb-2" data-toggle="modal" data-target=".showMode"> نمایش</button>
                                    &nbsp;
                                    <button type="button" wire:click="show({{$item->id}})" class="btn btn-outline-success mb-2" data-toggle="modal" data-target=".updateMode"> ویرایش</button>
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
    {{-- showMode --}}
    <div  wire:ignore.self wire:model.defer="showMode" class="modal fade showMode" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-comment" id="exampleModalLabel"> نمایش</h5>
                </div>
                <div class="modal-body">
                    
                    <div class="card component-card_6">
                        <div class="card-body">
                            <p> نظر داده شده به پست:&nbsp;{{$blogPostTitle}}</p>
                            <p class="card-text">نظر: &nbsp;{{$comment}} </p>
                            <div class="user-info">
                                <div class="media-body">
                                    <p class="card-user_occupation"> قابلیت رویت:&nbsp;
                                        {{ ($visiable == true) ? 'بلی' : 'نخیر' }}
                                    </p>
                                    <p>مشخات نظریه دهنده:</p>
                                    <h5 class="card-user_name">{{$full_name}}</h5>
                                    <p class="card-user_occupation">{{$email}}</p>
                                    <p class="card-user_occupation">{{$phone}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>  نادیده گرفتن</button>
                </div>
            </div>
        </div>
    </div>
    {{-- update --}}
    <div  wire:ignore.self wire:model.defer="updateMode" class="modal fade updateMode" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-comment" id="exampleModalLabel">ویرایش نظر</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Input">پست </label>
                        <select id="Input"  class="form-control"  wire:model="blog_post_id">
                            <option value="" data-hidden="true">پست را انتخاب کنید</option>
                            @foreach ($blog_post as $post)
                            <option value="{{$post->id}}" {{ $post->id == old('blog_post_id') ? ' selected' : '' }}>{{ $post->title }}</option>
                            @endforeach
                        </select>
                        
                        @error('blog_post_id') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="input">نام و نام خانوادگی</label>
                        <input type="text" class="form-control" wire:model="full_name" id="input" placeholder="نام و نام خانوادگی را وارد کنید!">
                        @error('full_name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="input">نظریه </label>
                        <textarea class="form-control" id="input"  wire:model="comment" rows="3"placeholder=" نظریه را وارد کنید!"></textarea>
                        
                        @error('comment') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="input">ایمیل آدرس</label>
                        <input type="text"class="form-control" wire:model="email" id="input" placeholder="">
                        @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="input">شماره موبایل</label>
                        <input type="text"class="form-control" wire:model="phone" id="input" placeholder="">
                        @error('phone') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group form-check pl-0">
                        <div class="custom-control custom-checkbox checkbox-info">
                            <input type="checkbox" class="custom-control-input" id="sChkbox" wire:model="visiable">
                            <label class="custom-control-label" for="sChkbox">نظر قابلیت رویت برای همه باشد</label>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="update()" data-dismiss="modal" class="btn btn-primary"> ویرایش</button>
                    
                    <button class="btn" wire:click.prevent="cancel()" data-dismiss="modal"><i class="flaticon-cancel-12"></i> بستن</button>
                </div>
            </div>
        </div>
    </div>
    
    {{-- create --}}
    <div  wire:ignore.self wire:model.defer="createModal" class="modal fade createModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-comment" id="exampleModalLabel">ایجاد  نظر</h5>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                        <label for="Input">پست </label>
                        <select id="Input"  class="form-control"  wire:model="blog_post_id">
                            <option value="" data-hidden="true">پست را انتخاب کنید</option>
                            @foreach ($blog_post as $post)
                            <option value="{{$post->id}}" {{ $post->id == old('blog_post_id') ? ' selected' : '' }}>{{ $post->title }}</option>
                            @endforeach
                        </select>
                        
                        @error('blog_post_id') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="input">نام و نام خانوادگی</label>
                        <input type="text" class="form-control" wire:model="full_name" id="input" placeholder="نام و نام خانوادگی را وارد کنید!">
                        @error('full_name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="input">نظریه </label>
                        <textarea class="form-control" id="input"  wire:model="comment" rows="3"placeholder=" نظریه را وارد کنید!"></textarea>
                        
                        @error('comment') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="input">ایمیل آدرس</label>
                        <input type="text"class="form-control" wire:model="email" id="input" placeholder="">
                        @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="input">شماره موبایل</label>
                        <input type="text"class="form-control" wire:model="phone" id="input" placeholder="">
                        @error('phone') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    
                </div>
                <div class="modal-footer">
                    
                    <button type="button" wire:click.prevent="create()"  data-dismiss="modal" class="btn btn-primary"> ثبت </button>
                    <button class="btn" wire:click.prevent="cancel()" data-dismiss="modal"><i class="flaticon-cancel-12"></i> بستن</button>
                    
                </div>
            </div>
        </div>
    </div>
    
    
    <div  wire:ignore.self wire:model.defer="deleteModal" class="modal fade itemdeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-comment" id="exampleModalLabel"> هشدار</h5>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row gx-2 justify-content-left">
                            <div class="col-md-4 col-xl-auto col-md-auto col-sm-auto">
                                <p>با حذف این نظر دیگر قابلیت برگشت آن  وجود ندارد!</p>
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
    
</div>



