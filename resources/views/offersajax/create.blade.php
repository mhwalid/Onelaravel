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


        <form method="POST" id="offerForm" action="" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">photo</label>
            <input type="file" class="form-control" name="photo"  >
              <small id="photo_error" class="form-text text-danger"></small>
            </div>
        <div class="form-group">
          <label for="exampleInputEmail1">  {{__('message.Name fr')}}</label>
          <input type="text" class="form-control" name="name_fr" placeholder="{{__('message.Name')}}">
          <small id="name_fr_error" class="form-text text-danger"></small>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">  {{__('message.Name en')}}</label>
          <input type="text" class="form-control" name="name_en" placeholder="{{__('message.Name')}}">
          <small  id="name_en_error" class="form-text text-danger"></small>
        </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1">{{__('message.PRICE')}}</label>
            <input type="text" class="form-control" name="price" id="exampleInputEmail1" aria-describedby="emailHelp">
            <small  id="price_error" class="form-text text-danger"></small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">{{__('message.CATEGORIE fr')}}</label>
            <input type="text" class="form-control" name="cato_fr" placeholder="{{__('message.CATEGORIE')}}">
            <small  id="cato_fr_error" class="form-text text-danger"></small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">{{__('message.CATEGORIE en')}}</label>
            <input type="text" class="form-control" name="cato_en" placeholder="{{__('message.CATEGORIE')}}">
            <small id="cato_fr_error"  class="form-text text-danger"></small>
        </div>
      
        <button id="save" class="btn btn-primary"> {{__('message.Save')}}</button>
      </form>
      </div>
      </div>
   
</div>
</div>

@endsection

@section('scripts')
    
<script>

        $(document).on('click' ,'#save' , function(e){
            e.preventDefault(); // to ignore all the event befor that
                //if we style have error from the last esay
            $('#photo_error').text('');
            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#price_error').text('');
            $('#details_ar_error').text('');
            $('#details_en_error').text('');

                var formData = new FormData($('#offerForm')[0]); //   var that fo collecting all data 
             $.ajax({
    type: 'POST',
    enctype:'multipart/form-data',
    url: "{{route('ajax.offers.store')}}",
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
        var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
    }
    
 });
 });

</script>
@endsection

    





     