<div class="overflow-auto">
    @foreach ($users as $user)
    <input class="form-check-input" type="radio" id="{{$user->id}}" name="user_id" value="{{$user->id}}"><label class="form-check-label" for="">{{$user->name}}</label>
    <br />
    @endforeach
</div>