@extends('layouts.admin')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">الرئيسية </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.main.categories')}}"> المنتجات </a>
                            </li>
                            <li class="breadcrumb-item active"> أضافه منتج جديد
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form"> البيانات الاساسية للمنتج </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.error')

                            <div class="card-content collapse show">
                                <!-- row -->
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                   <form action="{{ route('admin.products.general.information.store') }}" class="samer wizard-circle"
                                        method="POST"
                                        id="wizard"
                                        enctype="multipart/form-data"

                                        >
                                        @csrf
                                            <!-- Step 1 -->
                                            <h6>Step 1</h6>
                                            <fieldset>
                                                <div class="form-body">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> اسم المنتج
                                                                </label>
                                                                <input type="text" id="name" class="form-control"
                                                                    placeholder="  " value="{{old('name')}}"
                                                                    name="name">
                                                                @error("name")
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> اسم بالرابط
                                                                </label>
                                                                <input type="text" id="slug" class="form-control"
                                                                    placeholder="  " value="{{old('slug')}}"
                                                                    name="slug">
                                                                @error("slug")
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> وصف المنتج
                                                                    </label>
                                                                    <textarea class="form-control" for="projectinput1"
                                                                        id="description" name="description" rows="2"
                                                                        cols="100"
                                                                        style="align-content:center; overflow:auto;">
                                                                    {{old('description')}}
                                                                    </textarea>
                                                                    @error("description")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> الوصف المختصر
                                                                    </label>
                                                                    <textarea class="form-control"
                                                                        id="short_description" name="short_description"
                                                                        rows="2" cols="100"
                                                                        style="align-content:center; overflow:auto;">
                                                                    {{old('short_description')}}
                                                                    </textarea>
                                                                    @error("short_description")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group mt-1">
                                                                <div id="list-category">
                                                                    <label for="project">اختر القسم الرئيسي</label>
                                                                    <select name="categories[]" id="category_id"
                                                                        class="form-control " multiple="multiple">
                                                                        <optgroup label="اختر القسم من فضلك">
                                                                            @if ($data['categories'] &&
                                                                            $data['categories']->count()>0)
                                                                            @foreach ($data['categories'] as $category)
                                                                            <option value="{{ $category->id }}">
                                                                                {{ $category->name }}</option>
                                                                            @endforeach
                                                                            @endif
                                                                        </optgroup>
                                                                    </select>

                                                                    @error("parent_id")
                                                                    <span class="text-danger">{{$message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mt-1">
                                                                <div id="list-category">
                                                                    <label for="project">اختر العلامات الدلالية </label>
                                                                    <select name="tags[]" id="tags"
                                                                        class="form-control " multiple="multiple">
                                                                        <optgroup label="اختر العلامات الدلالية ">
                                                                            @if ($data['tags'] &&
                                                                            $data['tags']->count()>0)
                                                                            @foreach ($data['tags'] as $tag)
                                                                            <option value="{{ $tag->id }}">
                                                                                {{ $tag->name }}</option>
                                                                            @endforeach
                                                                            @endif
                                                                        </optgroup>
                                                                    </select>

                                                                    @error("tags")
                                                                    <span class="text-danger">{{$message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4" id="cats_list">
                                                            <div class="form-group mt-1">
                                                                <div id="list-category">
                                                                    <label for="project">اختر الماركة </label>
                                                                    <select name="brand_id" id="brand_id"
                                                                        class="form-control">
                                                                        <optgroup label="اختر الماركة ">
                                                                            @if ($data['brands'] &&
                                                                            $data['brands']->count()>0)
                                                                            @foreach ($data['brands'] as $brand)
                                                                            <option value="{{ $brand->id }}">
                                                                                {{ $brand->name }}</option>
                                                                            @endforeach
                                                                            @endif
                                                                        </optgroup>
                                                                    </select>

                                                                    @error("brand_id")
                                                                    <span class="text-danger">{{$message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group mt-1">
                                                                <input type="checkbox" value="0" name="is_active"
                                                                    id="switcheryColor4" class="switchery"
                                                                    data-color="success" checked />
                                                                <label for="switcheryColor4"
                                                                    class="card-title ml-1">الحالة </label>

                                                                @error("is_active")
                                                                <span class="text-danger">{{$message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                            </fieldset>

                                            <!-- Step 2 -->
                                            <h6>Step 2</h6>
                                            <fieldset>
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> سعر  المنتج
                                                                </label>
                                                                <input type="number" id="price"
                                                                       class="form-control"
                                                                       placeholder="  "
                                                                       value="{{old('price')}}"
                                                                       name="price">
                                                                @error("price")
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> سعر خاص
                                                                </label>
                                                                <input type="number"
                                                                       class="form-control"
                                                                       placeholder="  "
                                                                       value="{{old('special_price')}}"
                                                                       name="special_price">
                                                                @error("special_price")
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <!-- QTY  -->
                                                          <div class="col-md-12">
                                                              <div class="form-group">
                                                                  <label for="projectinput1">نوع السعر
                                                                  </label>
                                                                  <select name="special_price_type" class="custom-select form-control" >
                                                                      <optgroup label=" من فضلك أختر  النوع">
                                                                        <option value="percent">Precent</option>
                                                                        <option value="fixed" selected>Fixed</option>
                                                                      </optgroup>
                                                                  </select>
                                                                  @error('special_price_type')
                                                                  <span class="text-danger"> {{$message}}</span>
                                                                  @enderror
                                                              </div>
                                                      </div>



                                                   </div>




                                                    <div class="row" >
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> تاريخ البداية
                                                                </label>

                                                                <input type="date" id="price"
                                                                       class="form-control"
                                                                       placeholder="  "
                                                                       value="{{old('special_price_start')}}"
                                                                       name="special_price_start">

                                                                @error('special_price_start')
                                                                <span class="text-danger"> {{$message}}</span>
                                                                @enderror
                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> تاريخ البداية
                                                                </label>
                                                                <input type="date" id="price"
                                                                       class="form-control"
                                                                       placeholder="  "
                                                                       value="{{old('special_price_end')}}"
                                                                       name="special_price_end">

                                                                @error('special_price_end')
                                                                <span class="text-danger"> {{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>

                                            </fieldset>

                                            <!-- Step 3 -->
                                            <h6>Step 3</h6>
                                            <fieldset>
                                                <div class="form-body">

                                                    <h4 class="form-section"><i class="ft-home"></i> صور المنتج
                                                    </h4>
                                                    <div class="form-group">
                                                        <div id="dpz-multiple-files" class="dropzone dropzone-area">
                                                            <div class="dz-message">يمكنك رفع اكثر من صوره هنا
                                                            </div>
                                                        </div>
                                                        <br><br>
                                                    </div>
    
    
                                                </div>
                                            </fieldset>

                                            <!-- Step 4 -->
                                            <h6>Step 4</h6>
                                            <fieldset>
                                                <div class="row">
                                                  <div class="col-md-12">
                                                     <div class="form-body">


                                                            <div class="form-group">
                                                                <label for="projectinput1"> كود  المنتج
                                                                </label>
                                                                <input type="text" id="sku"
                                                                       class="form-control"
                                                                       placeholder="  "
                                                                       value="{{old('sku')}}"
                                                                       name="sku">
                                                                @error("sku")
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>





                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <!-- QTY  -->
                                                      <div class="col-md-12">
                                                          <div class="form-group">
                                                              <label for="projectinput1">تتبع المستودع
                                                              </label>
                                                              <select name="manage_stock" class="custom-select form-control" >
                                                                  <optgroup label=" من فضلك أختر  النوع">
                                                                    <option value="1">اتاحة التتبع</option>
                                                                    <option value="0" selected>عدم اتاحه التتبع</option>
                                                                  </optgroup>
                                                              </select>
                                                              @error('manage_stock')
                                                              <span class="text-danger"> {{$message}}</span>
                                                              @enderror
                                                          </div>
                                                  </div>



                                               </div>




                                                        <div class="row">
                                                          <!-- QTY  -->
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">حالة المنتج
                                                                    </label>
                                                                    <select name="in_stock" class="custom-select form-control" >
                                                                        <optgroup label="من فضلك أختر  ">
                                                                            <option value="1">متاح</option>
                                                                            <option value="0">غير متاح </option>
                                                                        </optgroup>
                                                                    </select>
                                                                    @error('in_stock')
                                                                    <span class="text-danger"> {{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>



                                                        </div>






                                            </fieldset>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>

    </div>
</div>
@stop

@section('js')
<script>
  var uploadedDocumentMap = {}
            Dropzone.options.dpzMultipleFiles = {
                paramName: "dzfile", // The name that will be used to transfer the file
                //autoProcessQueue: false,
                maxFilesize: 7, // MB
                clickable: true,
                addRemoveLinks: true,
                acceptedFiles: 'image/*',
                dictFallbackMessage: " المتصفح الخاص بكم لا يدعم خاصيه تعدد الصوره والسحب والافلات ",
                dictInvalidFileType: "لايمكنك رفع هذا النوع من الملفات ",
                dictCancelUpload: "الغاء الرفع ",
                dictCancelUploadConfirmation: " هل انت متاكد من الغاء رفع الملفات ؟ ",
                dictRemoveFile: "حذف الصوره",
                dictMaxFilesExceeded: "لايمكنك رفع عدد اكثر من هضا ",
                headers: {
                    'X-CSRF-TOKEN':
                        "{{ csrf_token() }}"
                }

                ,
                url: "{{ route('admin.products.images.store') }}", // Set the url
                success:
                    function (file, response) {
                        $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
                        uploadedDocumentMap[file.name] = response.name
                    }
                ,
                removedfile: function (file) {
                    file.previewElement.remove()
                    var name = ''
                    if (typeof file.file_name !== 'undefined') {
                        name = file.file_name
                    } else {
                        name = uploadedDocumentMap[file.name]
                    }
                    $('form').find('input[name="document[]"][value="' + name + '"]').remove()
                }
                ,
                // previewsContainer: "#dpz-btn-select-files", // Define the container to display the previews
                init: function () {

                        @if(isset($event) && $event->document)
                    var files =
                    {!! json_encode($event->document) !!}
                        for (var i in files) {
                        var file = files[i]
                        this.options.addedfile.call(this, file)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
                    }
                    @endif
                }
            }



    $('.samer').steps({
        headerTag: "h6",
        bodyTag: "fieldset",
        transitionEffect: "fade",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
        finish: "submit",
        next: "next",
        previous:"previous",
        },
        onFinished: function (event, currentIndex) {
        $('#wizard').submit();
        }
        });
        $("#category_id").select2();
    $("#brand_id").select2();
    $("#tags").select2();
    $("in_stock").select2();
    $("#manageStock").select2();
    $("#special_price_type").select2();
    $('a[href$="next"]').text('التالي');
    $('a[href$="previous"]').text('السابق');

        </script>

<script>






  

</script>

@endsection


