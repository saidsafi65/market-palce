@extends('dashboard.parent')

<!-- ********************************************** -->

@section('css')

@endsection

<!-- ********************************************** -->

@section('Direction', 'Categories')

@section('Main-Titel', 'Creat Page')

<!-- ********************************************** -->

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Category</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Category Name | Title</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Category Name | Title">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="customSwitch3">
                        <label class="custom-control-label" for="customSwitch3">Activty</label>
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
