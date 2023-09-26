@extends('dashboard.parent')

<!-- ********************************************** -->

@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/sweetaler/node_modules/@sweetalert2/themes/dark/dark.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('dashboard/axios/node_modules/axios/dist/axios.min.js') }}"></script>
    <script src="{{ asset('dashboard/dist/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('dashboard/dist/js/sweetalert2@11.js') }}"></script>
@endsection

<!-- ********************************************** -->

@section('Direction', 'Products')

@section('Main-Titel', 'Index Page')

<!-- ********************************************** -->

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Products Table</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Title</th>
                        <th>description</th>
                        <th>price</th>
                        <th>quantity</th>
                        <th>category_id</th>
                        <th>created_at</th>
                        <th>updated_Date</th>
                        <th>updated_Hour</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Products as $Product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $Product->title }}</td>
                            <td>{{ $Product->description }}</td>
                            <td><span class="badge badge-danger">{{ $Product->price }}</span></td>
                            <td><span class="badge badge-info">{{ $Product->quantity }}</span></td>
                            <td>{{ $Product->category->title }}</td>
                            <td>{{ $Product->created_at->format('Y-M-d') }}</td>
                            <td>{{ $Product->updated_at->format('Y-M-d') }}</td>
                            <td><span class="badge badge-primary">{{ $Product->updated_at->format('H:i A') }}</span></td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('product.edit', $Product->id) }}" class="btn btn-info">Edit</a>
                                    <button onclick="con_delete({{ $Product->id }})"
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
        function con_delete(id) {
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
                    // window.location.href = "/product/" + ProductId;


                    axios.delete('/product/' + id, {

                        })
                        .then(function(response) {
                            console.log(response);
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: 'تمت عملية الحذف بنجاح \n' + response.data.message
                            }).then(function() {
                                window.location.href = '{{ route('product.index') }}';
                            });

                        })
                        .catch(function(error) {
                            console.log(error);
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'error',
                                title: 'فشل في عملية الحذف\n' + error.response.data.message
                            })
                        });

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
