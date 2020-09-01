@extends('dashboard.layout')
@section('content')
    <div style="color: white; margin-top: 20px">
        <div style="padding: 50px">
            <div class="d-flex">
                <div>
                    <img src="{{asset('img/avatar.png')}}" class="top-avatar" style="width: 100px; height: 100px">
                </div>
                <div style="margin-left: 30px; margin-top: 10px">
                    <h4 class="text-white">{{$user->first_name}} {{$user->last_name}}</h4>
                    <h5 class="text-white">Joined on {{$user->created_at}}</h5>
                </div>
            </div>
            <h3 style="margin-top: 30px">Products</h3>
            <div>
                <table class="table table-bordered" style="color: white">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>URL</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $key => $product)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$product->name}}</td>
                            <td><a href="{{$product->url}}" target="_blank" style="color: white!important;">{{$product->url}}</a></td>
                            <td><a class="btn btn-modern" href="{{URL::to('')}}/edit/product/{{$product->id}}">Edit</a></td>
                        </tr>
                     @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function saveProduct() {
            let name = document.getElementById('name').value;
            let description = document.getElementById('description').value;
            let url = document.getElementById('url').value;
            if(name === ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid Name!',
                });
                return;
            }
            if(description === ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid Description!',
                });
                return;
            }
            if (!/(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})/gi.test(url))
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid URL!',
                });
                return;
            }
            $.ajax({
                url: `{{env('APP_URL')}}/products/save`,
                type: 'POST',
                dataType: "JSON",
                data: {name : name,description : description, url: url, "_token": "{{ csrf_token() }}"},
                success: function (result) {
                    if (result.status === true) {
                        window.location.href = `{{env('APP_URL')}}/my-products`
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: result.message,
                        });
                    }
                },
            });
        }
    </script>
@endsection
