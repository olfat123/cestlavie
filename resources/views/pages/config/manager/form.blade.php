@csrf
<input type="hidden" name="config[{{$configuration->id}}][id]" value="{{$configuration->id}}">
<div class="uk-form-row mb-20">
    <label for="config[{{$configuration->id}}][title]" class="uk-form-label">
        Title
    </label>
    <input class="md-input"
        type="text"
        value="{{$configuration->title}}"
        id="config['title']"
        name="config[{{$configuration->id}}][title]"/>
</div>
<div class="uk-form-row mb-20">
    <label for="config['order']" class="uk-form-label">
        Order
    </label>
    <input class="md-input"
        type="text"
        value="{{$configuration->order}}"
        id="config['order']"
        name="config[{{$configuration->id}}][order]"/>
</div>
@foreach ($configuration->items as $item)
    <input type="hidden" name="config[{{$configuration->id}}][items][id]" value="{{$item->id}}">
    @include('pages.config.manager.item')   
@endforeach
<hr style="width: 70%; margin: auto; padding: 20px 0px; margin-top: 30px; border-top: 5px solid #14b2ba;" />