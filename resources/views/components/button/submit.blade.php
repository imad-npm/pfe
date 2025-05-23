@props(['text'=>null])

<x-button.primary >
    {{$text ?? 'Submit'}}
</x-button.primary>