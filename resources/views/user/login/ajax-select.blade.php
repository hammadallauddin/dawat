<option value="0" >-Select-</option>
@if(!empty($areas))
    @foreach($areas as $area)
        <option value="{{$area->id}}" >{{ $area->name }}</option>
    @endforeach
@endif