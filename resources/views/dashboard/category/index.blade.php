@extends('dashboard.parent')

<!-- ********************************************** -->

@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/sweetaler/node_modules/@sweetalert2/themes/dark/dark.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection

<!-- ********************************************** -->

@section('Direction', 'Categories')

@section('Main-Titel', 'Index Page')

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
                    @foreach ($categories as $categories)
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
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('category.edit', $categories->id) }}" class="btn btn-info">Edit</a>
                                    <button onclick="con_delete({{ $categories->id }})"
                                        class="btn btn-danger">Delete</button>
                                </div>
                            </td>
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
    <link rel="stylesheet" href="{{ asset('dashboard/sweetaler/node_modules/sweetalert2/dist/sweetalert2.min.js') }}">
    <script>
        function con_delete(categoryId) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'هل أنت متأكد من أنك تريد حذف هذا العنصر؟',
                text: "لن تستطيع العودة بعد الضغط عليه !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'نعم, احذف',
                cancelButtonText: 'لا إلغاء',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // إذا تم التأكيد على الحذف، قم بتوجيه المتصفح إلى الرابط المحدد
                    window.location.href = '/category/destroy/' + categoryId;
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'إلغاء',
                        'لم يتم حذف العنصر :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endsection
