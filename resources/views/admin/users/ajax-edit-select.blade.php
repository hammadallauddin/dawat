    <option default value="">-Select-</option>
@foreach($areas as $area)
    <option value="{{$area->id}}">{{$area->name}}</option>
@endforeach