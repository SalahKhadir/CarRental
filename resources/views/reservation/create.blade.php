<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental - Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand text-info fw-bold fs-4" href="/">CarRental</a>
            <div class="ms-auto d-flex">
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger ms-2">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Reservation Form -->
    <div class="container py-5">
        <h1 class="text-center fw-bold mb-4">Reserve Vehicle</h1>
        <p class="text-center text-muted mb-5">Select start and end dates to make your reservation.</p>

        <form action="{{ route('reservation.store') }}" method="POST">
            @csrf
            <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">

            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="total_price" class="form-label">Total Price (€)</label>
                <input type="text" name="total_price" id="total_price" class="form-control" value="{{ old('total_price', $totalPrice ?? '') }}" readonly>
            </div>

            <button type="submit" class="btn btn-info w-100">Confirm Reservation</button>
        </form>
    </div>
</body>

</html>