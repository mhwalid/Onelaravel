@extends('layouts.app')

@section('content')



<div class="container">
        <div class="alert alert-success" id="success_msg" style="display: none;">
                save done successfuly
        </div>

<div class="flex-center position-ref full-height">
    <div class="content">

        <div class="title m-b-md">
            {{__('message.Add your offer')}}
        </div>

     @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
           {{ Session::get('success') }}
        </div>
       @endif

        <br>


        <form method="POST" id="offerupdate" action="" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">photo</label>
            <input type="file" class="form-control" name="photo"  id="file" >
              @error('photo')
              <small class="form-text text-danger">{{$message}}</small>
              @enderror
            </div>

            <input type="text"  style="display: none;" class="form-control" value="{{$offer ->id}}"  name="offer_id">
        <div class="form-group">
          <label for="exampleInputEmail1">  {{__('message.Name fr')}}</label>
        <input type="text" class="form-control" value="{{$offer ->name_fr}}" name="name_fr" placeholder="{{__('message.Name')}}">
          @error('name_fr')
          <small class="form-text text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">  {{__('message.Name en')}}</label>
          <input type="text" class="form-control" value="{{$offer ->name_en}}" name="name_en" placeholder="{{__('message.Name')}}">
          @error('name_en')
          <small class="form-text text-danger">{{$message}}</small>
          @enderror
        </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1">{{__('message.PRICE')}}</label>
            <input type="text" class="form-control" name="price" value="{{$offer ->price}}" id="exampleInputEmail1" aria-describedby="emailHelp">
            @error('price')
            <small class="form-text text-danger">{{$message}}</small>
            @enderror  
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">{{__('message.CATEGORIE fr')}}</label>
            <input type="text" class="form-control" name="cato_fr" value="{{$offer ->cato_fr}}" placeholder="{{__('message.CATEGORIE')}}">
            @error('cato_fr')
            <small class="form-text text-danger">{{$message}}</small>
            @enderror   
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">{{__('message.CATEGORIE en')}}</label>
            <input type="text" class="form-control" name="cato_en" value="{{$offer ->cato_en}}" placeholder="{{__('message.CATEGORIE')}}">
            @error('cato_en')
            <small class="form-text text-danger">{{$message}}</small>
            @enderror   
        </div>
      
        <button id="update" class="btn btn-primary"> Edit</button>
      </form>
      </div>
      </div>
   
</div>
</div>

@endsection

@section('scripts')
    
<script>

        $(document).on('click' ,'#update' , function(e){
            e.preventDefault(); // to ignore all the event befor that

                var formData = new FormData($('#offerupdate')[0]); //   var that fo collecting all data 
             $.ajax({
    type: 'POST',
    enctype:'multipart/form-data',
    url: "{{route('ajax.offers.update')}}",
    data: formData,
    processData:false,
    contentType:false,
    cache:false,
    success: function (data){
        if(data.status == true){
            $('#success_msg').show();
        }
    },
    error:  function (reject){
    }
    
 });
 });

</script>
@endsection

    





     