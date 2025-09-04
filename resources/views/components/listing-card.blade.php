<div class="col">
    <x-card 
        :image="$property['image'] ?? 'https://via.placeholder.com/400x250'" 
        :title="$property['title'] ?? 'Property Title'" 
        :description="$property['description'] ?? 'Price · Beds · Baths · Area'"/>
</div>
