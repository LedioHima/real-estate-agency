<x-layout :title="$property->title">
  <a href="{{ route('home') }}" class="btn btn-link mb-3">&larr; Back to listings</a>

  <div class="row g-4">
    <div class="col-lg-7">
      <img src="{{ $property->image ?? 'https://picsum.photos/seed/'.$property->id.'/1200/600' }}"
           class="img-fluid rounded shadow-sm" alt="{{ $property->title }}">
    </div>
    <div class="col-lg-5">
      <h2 class="fw-bold">{{ $property->title }}</h2>
      <p class="text-muted">{{ $property->city ?? 'Tirana' }} • {{ $property->type ?? 'Apartment' }}</p>
      <p class="fs-4 fw-semibold">{{ isset($property->price) ? '€'.number_format($property->price) : 'Price on request' }}</p>

      <div class="mt-3">
        <h5>Description</h5>
        <p>{{ $property->description ?? 'No description yet.' }}</p>
      </div>
    </div>
  </div>
</x-layout>
