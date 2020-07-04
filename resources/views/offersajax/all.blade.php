@extends('layouts.app')

@section('content')
<div class="alert alert-success" id="success_msg" style="display: none;">
    delete it  successfuly
</div>

<table class="table">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">{{__('message.Name')}}</th>
        <th scope="col">{{__('message.PRICE')}}</th>
        <th scope="col">{{__('message.CATEGORIE')}}</th>
        <th scope="col">{{__('photo')}}</th>
        <th scope="col">{{__('message.operation')}}</th>
    </tr>
    </thead>
    <tbody>
        
    @foreach($offers as $offer)
    <tr class="offersRow{{$offer -> id}}">
        <th scope="row">{{$offer -> id}}</th>
        <td>{{$offer -> name}}</td>
        <td>{{$offer -> price}}</td>
        <td>{{$offer -> cato}}</td>
        <td><img  style="width: 90px; height: 90px;" src="{{asset('images/offers/'.$offer->photo)}}"></td>
    <td><a href="{{url('offers/edit/'.$offer -> id)}}" class="btn btn-primary" > {{__('message.update')}}</a>
    <a href="{{route('offers.delete',$offer -> id)}}" class="btn btn-danger" > {{__('message.delete')}}</a>
    <a href=""  offer_id="{{$offer -> id}}"  class="delete_ajax btn btn-danger" > {{__('message.delete ')}} Ajax</a>
    <a href="{{route('ajax.offers.edit',$offer -> id)}}"    class=" btn btn-danger" > Edite</a></td>
      
    </tr>
@endforeach
    </tbody>

</table>
@endsection

@section('scripts')
<script>

    $(document).on('click' ,'.delete_ajax' , function(e){
        e.preventDefault(); // to ignore all the event befor that
        var offer_id =$(this).attr('offer_id');
           //   var that fo collecting all data 
         $.ajax({
type: 'POST',
url: "{{route('ajax.offers.delete')}}",
data: {
        '_token' :"{{csrf_token()}}",
        'id' :offer_id,
},
success: function (data){
    if(data.status == true){
        $('#success_msg').show();
    }
    $('.offersRow' +data.id).remove();
},
error:  function (reject){
}

});
});

</script>
@endsection