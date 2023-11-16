<div class="md-card">
    <div class="md-card-toolbar">
        <h3 class="md-card-toolbar-heading-text">
            {{$item->title}}
        </h3>
    </div>
    <div class="uk-form-row m-20">
        <label for="title" class="uk-form-label">
            Title
        </label>
        <input class="md-input"
            type="text"
            value="{{$item->title}}"
            id="config[{{$item->id}}]['title']"
            name="config[{{$configuration->id}}][items][title]"/>
    </div>

    <div class="uk-form-row m-20">
        <label for="rightIcon" class="uk-form-label">
            Right Icon
        </label>
        <input class="md-input"
            type="text"
            value="{{$item->rightIcon}}"
            id="config['rightIcon']"
            name="config[{{$configuration->id}}][items][rightIcon]"/>
    </div>

    <div class="uk-form-row m-20">
        <label for="leftIcon" class="uk-form-label">
            LeftIcon
        </label>
        <input class="md-input"
            type="text"
            value="{{$item->leftIcon}}"
            id="config['leftIcon']"
            name="config[{{$configuration->id}}][items][leftIcon]"/>
    </div>

    <div class="uk-form-row m-20">
        <label for="color" class="uk-form-label">
            Color
        </label>
        <input class="md-input"
            type="text"
            value="{{$item->color}}"
            id="color"
            name="config[{{$configuration->id}}][items][color]"/>
    </div>

    <div class="uk-form-row m-20">
        <label for="url" class="uk-form-label">
            Url
        </label>
        <input class="md-input"
            type="text"
            value="{{$item->url}}"
            id="url"
            name="config[{{$configuration->id}}][items][url]"/>
    </div>
</div>