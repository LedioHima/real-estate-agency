<x-layout title="Agent Dashboard">
    <h2>Welcome, {{ $user->name }} </h2>

    <h4 class="mt-4">My Properties</h4>
    <form method="GET" action="{{ route('dashboard') }}" class="mb-4 d-flex gap-2">
        <input type="text" 
            name="search" 
            class="form-control" 
            placeholder="Search my properties by title or city..." 
            value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    @if($properties->isEmpty())
        <p>You don’t have any properties listed yet.</p>
    @else
        <div class="row g-4">
            @foreach($properties as $property)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100">
                        @if($property->image)
                            <img src="{{ asset('storage/' . $property->image) }}" 
                                 class="card-img-top" 
                                 style="height:200px; object-fit:cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $property->title }}</h5>
                            <p><strong>City:</strong> {{ $property->city }}</p>
                            <p><strong>Price:</strong> ${{ number_format($property->price, 2) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="mt-4">
                {{ $properties->appends(request()->only('search'))->links() }}
            </div>

        </div>
    @endif
</x-layout>
