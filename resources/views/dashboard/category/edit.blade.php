@extends('dashboard.parent')

<!-- ********************************************** -->

@section('css')

@endsection

<!-- ********************************************** -->

@section('Direction', 'Categories')

@section('Main-Titel', 'Edit Page')

<!-- ********************************************** -->

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Category</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{ URL('/category/update',$category->id) }}">
            @method('PUT')
            @csrf
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <label for="title1">Category Name | Title</label>
                    <input type="text" class="form-control" value="{{ $category->title  }}" id="title" name="title"
                        placeholder="Category Name | Title">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" @if ($category->is_active)
                            @checked(true)
                        @endif id="is_active" name="is_active">
                        <label class="custom-control-label" for="is_active">Activty</label>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

<!-- ********************************************** -->

@section('js')

@endsection
