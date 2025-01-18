<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarRental - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand text-info fw-bold fs-4" href="/">CarRental</a>
            <div class="d-flex">
                <a href="/managereservations" class="btn btn-outline-info ms-2">Manage Reservations</a>
                <a href="/managecars" class="btn btn-outline-info ms-2">Manage Vehicles</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger ms-2">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="container py-5">
        <h1 class="text-center fw-bold mb-4">Admin Dashboard</h1>

        <!-- Statistics Section -->
        <div class="row text-center">
            <div class="col-md-4">
                <div class="card p-3 shadow-sm">
                    <h4 class="fw-bold">Total Reservations</h4>
                    <p>{{ $totalReservations }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 shadow-sm">
                    <h4 class="fw-bold">Available Cars</h4>
                    <p>{{ $availableCars }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 shadow-sm">
                    <h4 class="fw-bold">Unavailable Cars</h4>
                    <p>{{ $unavailableCars }}</p>
                </div>
            </div>
        </div>

        <!-- Best Customer Section -->
        <div class="row text-center mt-4">
            <div class="col-12">
                <div class="card p-3 shadow-sm">
                    <h4 class="fw-bold">Best Customer</h4>
                    <p>{{ $bestCustomer }}</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
