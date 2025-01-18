<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarRental - Manage Cars</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand text-info fw-bold fs-4" href="/">CarRental</a>
            <div class="ms-auto">
                <a href="/dashboard" class="btn btn-outline-info me-2">Home</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger ms-2">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="text-center fw-bold mb-4">Manage Cars</h1>

        <!-- Filter Form -->
        <form action="{{ route('managecars.filter') }}" method="GET" class="mb-5">
            <div class="row g-3 align-items-center">
                <div class="col-md-4">
                    <label for="critere" class="form-label fw-bold">Filter By</label>
                    <select name="critere" id="critere" class="form-select">
                        <option value="brand">Brand</option>
                        <option value="model">Model</option>
                        <option value="type">Type</option>
                        <option value="capacity">Capacity</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="value" class="form-label fw-bold">Value</label>
                    <input type="text" name="value" id="value" class="form-control" placeholder="Enter value" required>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-info w-100">Search</button>
                </div>
            </div>
        </form>

        <!-- Vehicle List -->
        <div class="row">
            @forelse($vehicles as $vehicle)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $vehicle->brand }} {{ $vehicle->model }}</h5>
                        <p class="card-text mb-1"><strong>Type:</strong> {{ $vehicle->type }}</p>
                        <p class="card-text mb-1"><strong>Capacity:</strong> {{ $vehicle->capacity }}</p>
                        <p class="card-text"><strong>Price/Day:</strong> €{{ $vehicle->price_per_day }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">No vehicles found with the specified criteria.</div>
            </div>
            @endforelse
        </div>

        <section id="vehicles">
            <h2 class="h4 fw-bold mb-3">Vehicles</h2>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="h5">Vehicle List</h3>
                <a href="{{ route('managecars.create') }}" class="btn btn-info">Add Vehicle</a>
            </div>

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Model</th>
                        <th>Type</th>
                        <th>Price/Day</th>
                        <th>Availability</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vehicles as $vehicle)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $vehicle->brand }} {{ $vehicle->model }}</td>
                        <td>{{ $vehicle->type }}</td>
                        <td>€{{ $vehicle->price_per_day }}</td>
                        <td>{{ $vehicle->availability ? 'Not Available' : 'Available' }}</td>
                        <td>
                            <a href="{{ route('managecars.edit', $vehicle->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('managecars.destroy', $vehicle->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this vehicle?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No vehicles found with the specified criteria.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </section>


        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $vehicles->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>