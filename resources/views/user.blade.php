<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarRental - User Interface</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @if (session('status'))
    <div class="alert alert-{{ session('status_type') == 'success' ? 'success' : 'danger' }} alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand text-info fw-bold fs-4" href="/">CarRental</a>
            <div class="ms-auto d-flex">
                <a href="/mesreservations" class="btn btn-outline-info me-2">My Reservations</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger ms-2">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- User Interface Content -->
    <div class="container py-5">
        <h1 class="text-center fw-bold mb-4">Welcome :</h1>
        <p class="text-center text-muted">Explore available vehicles and make reservations easily.</p>

        <!-- Vehicle Filter Form -->
        <form action="{{ route('user.filter') }}" method="GET" class="mb-5">
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

        <!-- Vehicles Section -->
        <section id="vehicles" class="mb-5">
            <h2 class="h4 fw-bold mb-3">Available Vehicles</h2>
            <div class="row">
                @forelse($vehicles as $vehicle)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $vehicle->brand }} {{ $vehicle->model }}</h5>
                            <p class="card-text mb-1"><strong>Type:</strong> {{ $vehicle->type }}</p>
                            <p class="card-text mb-1"><strong>Capacity:</strong> {{ $vehicle->capacity }}</p>
                            <p class="card-text"><strong>Price/Day:</strong> €{{ $vehicle->price_per_day }}</p>
                            <a href="{{ route('reservation.create', ['vehicle_id' => $vehicle->id]) }}" class="btn btn-primary">Reserve</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">No vehicles found with the specified criteria.</div>
                </div>
                @endforelse
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>