@extends('dashboard.layout')
@section('content')
    <div class="p-5">
        <h4 class="mb-2">Press Kits</h4>
        @if(count($kits) == 0)
            <h5 class="text-muted">No Kits Found!</h5>
        @endif
        <table class="table table-borderless">
            @foreach($kits as $kit)
            <tr>
                <td style="width: 30%">
                    @if(empty($kit->logo))
                        <img src="{{asset('landing-page-styles/images/default-image.svg')}}" style="width: 60px; height: 60px; border-radius: 50%; cursor: pointer" onclick="addLogo({{$kit->id}})">
                    @endif
                    @if(!empty($kit->logo))
                        <img src="{{ URL::to('/public') }}/kits/{{$kit->logo}}" style="width: 60px; height: 60px; border-radius: 50%; cursor: pointer" onclick="addLogo({{$kit->id}})">
                    @endif
                    <input type="file" id="file-{{$kit->id}}" style="display: none" onchange="savelogo({{$kit->id}})">
                </td>
                <td style="width: 40%;">
                       <div style="margin-top: 25px" class="font-weight-bold">
                           {{$kit->name}}
                       </div>
                </td>
                <td>
                    <div style="margin-top: 25px">
                        <a class="btn-global btn-small" href="{{url('/kit/'.$kit->url)}}">Edit</a>
                        <a class="btn-global ml-2 btn-small" onclick="deleteKit({{$kit->id}})">Delete</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
        <div style="border: 1px dotted lightgray; padding: 30px; border-radius: 20px">
            <div class="text-center">
                <button class="btn-global" data-toggle="modal" data-target="#kitsmodal">New Kit</button>
            </div>
        </div>
    </div>
    <div class="modal" id="kitsmodal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Welcome!</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p class="text-muted">
                        Let’s give your press kit a name and URL. Usually, your kit name will be your company’s name.
                    </p>
                    <div>
                        <label>Kit Name</label>
                        <input type="text" onkeyup="setCompanyName()" class="form-control" placeholder="e-g : company name" id="name">
                    </div>
                    <div>
                        <label>Kit URL</label>
                        <input type="text" class="form-control" placeholder="e-g : company url" id="url">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn-global" onclick="createKit()" id="create-kit-btn">Create</button>
                    <button class="btn-global" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <script>
        function setCompanyName() {
           let name = document.getElementById('name').value;
           document.getElementById('url').value = name;
        }

        function createKit() {
            let name = document.getElementById('name').value;
            let url = document.getElementById('url').value;
            if(name === ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid Name!',
                });
                return;
            }
            if(url === ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid Url!',
                });
                return;
            }
            document.getElementById('create-kit-btn').setAttribute('disabled', true);
            $.ajax({
                url: `{{env('APP_URL')}}/kit/create`,
                type: 'POST',
                dataType: "JSON",
                data: {name: name, url: url, "_token": "{{ csrf_token() }}"},
                success: function (result) {
                    document.getElementById('create-kit-btn').setAttribute('disabled', false);
                    if (result.status === true) {
                        window.location.href = `{{env('APP_URL')}}/dashboard`
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: result.message,
                        });
                    }
                },
                error: function(data)
                {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "server Error",
                    });
                }
            });
        }

        function deleteKit(id) {
            if(!confirm('Are you sure to delete the kit?')){
                return;
            }
            $.ajax({
                url: `{{env('APP_URL')}}/kit/delete`,
                type: 'POST',
                dataType: "JSON",
                data: {id: id, "_token": "{{ csrf_token() }}"},
                success: function (result) {
                    if (result.status === true) {
                        window.location.href = `{{env('APP_URL')}}/dashboard`
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: result.message,
                        });
                    }
                },
                error: function(data)
                {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "server Error",
                    });
                }
            });
        }

        function addLogo(id) {
            document.getElementById('file-' + id).click();
        }

        function savelogo(id) {
            let files = document.getElementById('file-' + id).files;
            if(files.length <= 0){
                return
            }
            let formData = new FormData();
            for (let i=0;i<files.length;i++){
                formData.append('files[]', files[i]);
            }
            formData.append("_token", "{{ csrf_token() }}");
            formData.append("id", id);
            console.log(document.getElementById('file-' + id).files);
            $.ajax({
                url: `{{env('APP_URL')}}/kit/logo`,
                type: 'POST',
                dataType: "JSON",
                data: formData,
                contentType: false,
                cache: false,
                processData:false,
                success: function (result) {
                    if (result.status === true) {
                        window.location.href = `{{env('APP_URL')}}/dashboard`
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: result.message,
                        });
                    }
                },
                error: function(data)
                {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "server Error",
                    });
                }
            });
        }
    </script>
@endsection
