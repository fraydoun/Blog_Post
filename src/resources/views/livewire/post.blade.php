  
  <div class="col-12">
   
    <div id="tableCaption" class="col-lg-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            @if (session()->has('success'))
                <div class="alert alert-outline-success mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button><i class="flaticon-cancel-12 close" data-dismiss="alert"></i> <strong>{{session('success')}}</strong>  </div>
            @endif
            <div class="widget-header">
                <div class="row">

                    <div class="col-xl-6 col-md-6 col-sm-12 col-12">
                        <h4> لیست پست های وبلاک  </h4>
                    </div>  
                    <div class="col-xl-4 col-md-4 col-sm-12 col-12">
                    </div>
                    <div class="col-xl-2 col-md-2 col-sm-12 col-12">
                        <a  class="btn btn-primary mt-3" href="{{route('postCreate')}}">+ ایجاد پست</a>
                    </div>              
                </div>
                
            </div>
            <div class="widget-content widget-content-area">
                
                <div class="table-responsive">
                    <table class="table mb-4">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>دسته بندی</th>
                                <th>عنوان</th>
                                <th>متن کوتاه پست</th>
                                <th>برچسب</th>
                                <th>نویسنده</th>
                                <th>تعداد بازدید</th>
                                
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
                                <td>{{ mb_substr($item->title, 0,20,'utf-8')}}... </td>
                                <td> {{ mb_substr($item->short_content, 0,20,'utf-8') }} ...</td>
                                <td>{{$item->tags}} </td>
                                <td>{{$item->admin->name}} </td>
                                <td>{{$item->view_counter}} </td>
                                
                                <td>
                                    {{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strtotime($item->created_at));}}
                                </td>
                                <td>
                                    <button type="button" wire:click="show({{$item->id}})" class="btn btn-outline-info mb-2" data-toggle="modal" data-target=".itemShowModal"> نمایش</button>
                                    &nbsp;
                                    <a class="btn btn-outline-success mb-2"  href="{{ route('postsedit',$item->id) }}">ویرایش</a>
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
    
    
    
    {{-- update --}}
    <div  wire:ignore.self wire:model.defer="updateMode" class="modal fade itemShowModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> نمایش پست {{$title}}</h5>
                </div>
                <div class="modal-body">
                    {{-- ///////////////////////// --}}
                    
                    <div class="card component-card_9">
                        @if($photo != "")
                        <img src="{{asset($photo)}}" style="width: 50%;"class="card-img-top" alt="widget-card-2">
                        @endif
                        <div class="card-body">
                            <p class="meta-date">
                                دسته:&nbsp;
                                {{$blog_category}}</p>
                            <p class="meta-date">{{$created_at }}</p>
                            <h5 class="card-title">{{$title}}</h5>
                            <p class="card-text">{{$short_content}}</p>
                            <div>
                                {!!$content!!}
                            </div>
                            <div class="meta-info">
                                <div class="meta-user">
                                    <div class="user-name">
                                        نویسنده: &nbsp;
                                        {{$adminname}}
                                    </div>
                                </div>
            
                                <div class="meta-action">
                                    <div class="meta-likes">
                                        تعداد نظرات: &nbsp;
                                        {{$comment_counter}}
                                    </div>
            
                                    <div class="meta-view">
                                        تعداد بازدید: &nbsp;
                                        {{$view_counter}}
                                    </div>
                                </div>
            
                            </div>
            
                        </div>
                    </div>

                    {{-- ///////////////////////////// --}}
                </div>
                <div class="modal-footer">
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
                                <p>با حذف این پست دیگر قابلیت برگشت آن  وجود ندارد!</p>
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



