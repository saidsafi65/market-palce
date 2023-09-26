@extends('dashboard.parent')

<!-- ********************************************** -->

@section('css')
    <script src="{{ asset('dashboard/axios/node_modules/axios/dist/axios.min.js') }}"></script>
    <script src="{{ asset('dashboard/dist/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('dashboard/dist/js/sweetalert2@11.js') }}"></script>
@endsection

<!-- ********************************************** -->

@section('Direction', 'Products')

@section('Main-Titel', 'Edit Page')

<!-- ********************************************** -->

@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Quick Example</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $product->title }}"
                        placeholder="Enter Title">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" rows="3" id="description" name="description" placeholder="Enter ...">{{ $product->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}"
                        placeholder="Enter price">
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity"
                        value="{{ $product->quantity }}" placeholder="Enter quantity">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category_id" name="category_id">
                        @foreach ($category as $category)
                            <option value="{{ $category->id }}" @selected($product->category_id == $category->id)>{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" id="submitButton" name="submitButton" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@endsection

<!-- ********************************************** -->

@section('js')

    <script>
        $(document).ready(function() {
            $("#submitButton").click(function() {
                EditProduct();
            });
        });

        function EditProduct() {
            axios.put(`/product/{{$product->id}}`, {
                    title: document.getElementById('title').value,
                    description: document.getElementById('description').value,
                    price: document.getElementById('price').value,
                    quantity: document.getElementById('quantity').value,
                    category_id: document.getElementById('category_id').value,
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
                        title: 'تمت عملية الحفظ بنجاح \n' + response.data.message
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
                        timer: 1000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: 'فشل في عملية الحفظ\n' + error.response.data.message
                    })
                });
        }
    </script>

@endsection
