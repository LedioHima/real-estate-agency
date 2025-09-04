@props(['property'])

@php
  // Works with both array (dummy) and model (later)
  $p = is_array($property) ? (object) $property : $property;
@endphp

<div class="card h-100 shadow-sm">
  <img src="{{ $p->image ?? 'https://picsum.photos/seed/'.$p->id.'/800/450' }}" class="card-img-top" alt="{{ $p->title }}">
  <div class="card-body d-flex flex-column">
    <h5 class="card-title">{{ $p->title }}</h5>
    <p class="card-text text-muted mb-2">{{ $p->city ?? 'Tirana' }} • {{ $p->type ?? 'Apartment' }}</p>
    <p class="card-text fw-semibold mb-3">{{ isset($p->price) ? '€'.number_format($p->price) : 'Price on request' }}</p>
    <a href="{{ route('properties.show', $p->id) }}" class="btn btn-primary mt-auto">View details</a>
  </div>
</div>
