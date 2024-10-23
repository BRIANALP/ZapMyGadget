@props(['name'])

@error($name)
    <p class='text-red-500 font-semibold text-sm'>{{$message}}<p>
@enderror