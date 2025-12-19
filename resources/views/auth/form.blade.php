<div class="overflow-auto">
    @foreach ($universidades as $universidad)
    <input class="form-check-input" type="checkbox" id="uni-{{$universidad->id}}" name="universidades[]" value="{{$universidad->id}}">
    <label class="form-check-label" for="uni-{{$universidad->id}}">
        {{$universidad->universidad}} - {{$universidad->campus}}
    </label>
    <br />
    @endforeach
</div>

