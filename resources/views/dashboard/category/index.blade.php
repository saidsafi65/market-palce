@extends('dashboard.parent')

<!-- ********************************************** -->

@section('css')

@endsection

<!-- ********************************************** -->
 
@section('Direction','Categories')

@section('Main-Titel','Index Page')

<!-- ********************************************** -->

@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Categories Table</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>Title</th>
            <th>Is_Active</th>
            <th>created_at</th>
            <th>updated_Date</th>
            <th>updated_Hour</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ( $categories as $categories )
          <tr>
            <td>{{ $categories->id }}</td>
            <td>{{ $categories->title }}</td>
            @if ($categories->is_active)
            <td><span class="badge badge-success">Active</span></td>
                
            @else
            <td><span class="badge badge-danger">Not Active</span></td>
                
            @endif
            <td>{{ $categories->created_at->format('Y-M-d') }}</td>
            <td>{{ $categories->updated_at->format('Y-M-d') }}</td>
            <td><span class="badge badge-primary">{{ $categories->updated_at->format('H:i A') }}</span></td>
            <td><div class="btn-group">
                <a href="{{ route('category.edit',$categories->id) }}" class="btn btn-info">Edit</a>
                <button type="button" class="btn btn-danger">Delete</button>
              </div></td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    
  </div>
@endsection

<!-- ********************************************** -->

@section('js')

@endsection