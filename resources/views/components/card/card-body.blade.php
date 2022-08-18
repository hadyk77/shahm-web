<div {{$attributes->merge(['class' => 'card-body'])}} id="overlay">
    <div class="row">
        {{$slot}}
    </div>
    <div id="data"></div>
</div>
