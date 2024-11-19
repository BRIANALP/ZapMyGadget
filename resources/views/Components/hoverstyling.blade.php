@php
    $styling="p-4 bg-white/10 rounded-xl border border-transparent hover:border-teal group"
@endphp

<div {{$attributes->merge(["class"=>$styling])}}>
    {{$slot}}
</div>

