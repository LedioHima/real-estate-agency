<x-layout title="My Properties">
    <h1>My Properties</h1>

    @if($properties->isEmpty())
        <p>You have no properties listed yet.</p>
    @else
        <ul class="list-group">
            @foreach($properties as $property)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $property->title }}</span>
                    <a href="{{ route('properties.edit', $property->slug) }}" class="btn btn-sm btn-primary">Edit</a>
                </li>
            @endforeach
        </ul>
    @endif
</x-layout>
