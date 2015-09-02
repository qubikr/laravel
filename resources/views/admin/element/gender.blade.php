<div class="checkbox-inline">
  <label>
    <input type="checkbox" name="{{$key}}[]" value="32" {{$value & 32 ? 'checked' : ''}} />
    Мужчины
  </label>
</div>
<div class="checkbox-inline">  
  <label>
    <input type="checkbox" name="{{$key}}[]" value="16" {{$value & 16 ? 'checked' : ''}} />
    Женщины
  </label>
</div>
<br/>
<div class="checkbox-inline">
  <label>
    <input type="checkbox" name="{{$key}}[]" value="8" {{$value & 8 ? 'checked' : ''}} />
    Взрослые
  </label>
</div>
<div class="checkbox-inline">
  <label>
    <input type="checkbox" name="{{$key}}[]" value="4" {{$value & 4 ? 'checked' : ''}} />
    Подростки
  </label>
</div>
<div class="checkbox-inline">
  <label>
    <input type="checkbox" name="{{$key}}[]" value="2" {{$value & 2 ? 'checked' : ''}} />
    Дети
  </label>
</div>
<div class="checkbox-inline">
  <label>
    <input type="checkbox" name="{{$key}}[]" value="1" {{$value & 1 ? 'checked' : ''}} />
    Младенцы до года
  </label>
</div>
<input type="hidden" name="form_multiply_type[]" value="{{$key}}">