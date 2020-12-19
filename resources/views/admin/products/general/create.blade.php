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
                                <li class="breadcrumb-item"><a href="{{route('admin.main.categories')}}"> المنتجات  </a>
                                </li>
                                <li class="breadcrumb-item active">  أضافه منتج جديد
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
                                    <h4 class="card-title" id="basic-layout-form"> البيانات الاساسية  للمنتج  </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
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
                                    <div class="card-body">
                                        <form class="form"
                                              action="{{route('admin.products.general.information.store')}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-body">


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم المنتج
                                                            </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{old('name')}}"
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
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{old('slug')}}"
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
                                                                <textarea   class="form-control" for="projectinput1" id="description" name="description" rows="2" cols="100"style="align-content:center; overflow:auto;">
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
                                                                <textarea   class="form-control" id="short_description" name="short_description" rows="2" cols="100"style="align-content:center; overflow:auto;">
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
                                                    <div  id="list-category">
                                                        <label for="project">اختر القسم الرئيسي</label>
                                                        <select name="categories[]" id="" class="select2 form-control" multiple>
                                                            <optgroup label="اختر القسم من فضلك">
                                                                @if ($data['categories'] && $data['categories']->count()>0)
                                                                    @foreach ($data['categories'] as $category)
                                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                                    <div  id="list-category">
                                                        <label for="project">اختر العلامات الدلالية </label>
                                                        <select name="tags[]" id="" class="select2 form-control" multiple>
                                                            <optgroup label="اختر العلامات الدلالية ">
                                                                @if ($data['tags'] && $data['tags']->count()>0)
                                                                    @foreach ($data['tags'] as $tag)
                                                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
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
                                                <div class="col-md-4">
                                                    <div class="form-group mt-1">
                                                    <div  id="list-category">
                                                        <label for="project">اختر  الماركة </label>
                                                        <select name="brand_id" id="" class="select2 form-control" >
                                                            <optgroup label="اختر الماركة ">
                                                                @if ($data['brands'] && $data['brands']->count()>0)
                                                                    @foreach ($data['brands'] as $brand)
                                                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
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
                                                        <input type="checkbox" value="1"
                                                               name="is_active"
                                                               id="switcheryColor4"
                                                               class="switchery" data-color="success"
                                                               checked />
                                                        <label for="switcheryColor4"
                                                               class="card-title ml-1">الحالة  </label>

                                                        @error("is_active")
                                                        <span class="text-danger">{{$message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> حقظ
                                                </button>
                                            </div>
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
