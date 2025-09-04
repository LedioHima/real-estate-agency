<x-layout title="Manage Listings">
    <h2 class="mb-4">Manage Properties</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Price</th>
                <th>Beds</th>
                <th>Baths</th>
                <th>Area</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                $properties = [
                    ['title'=>'Modern Apartment in City Center','price'=>'$250,000','beds'=>2,'baths'=>2,'area'=>1200],
                    ['title'=>'Luxury Villa with Pool','price'=>'$1,200,000','beds'=>5,'baths'=>4,'area'=>5000],
                    ['title'=>'Cozy Suburban House','price'=>'$350,000','beds'=>3,'baths'=>2,'area'=>1800]
                ];
            @endphp

            @foreach($properties as $property)
            <tr>
                <td>{{ $property['title'] }}</td>
                <td>{{ $property['price'] }}</td>
                <td>{{ $property['beds'] }}</td>
                <td>{{ $property['baths'] }}</td>
                <td>{{ $property['area'] }}</td>
                <td>
                    <a href="#" class="btn btn-sm btn-primary">Edit</a>
                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
