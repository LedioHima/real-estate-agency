<div class="card h-100">
    <img src="{{ $image ?? 'https://via.placeholder.com/400x250' }}" class="card-img-top" alt="{{ $title }}">
    <div class="card-body">
        <h5 class="card-title">{{ $title ?? 'Property Title' }}</h5>
        <p class="card-text">{{ $description ?? 'Property details here' }}</p>
    </div>
</div>
