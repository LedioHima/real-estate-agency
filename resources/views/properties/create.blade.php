<x-layout title="Add Property">
    <h1 class="mb-4">Add New Property</h1>

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        @csrf
        @include('properties.form') {{-- reusable form --}}
        <div class="d-flex justify-content-between mt-3">
            <a href="{{ route('properties.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-success">Add Property</button>
        </div>
    </form>
</x-layout>
