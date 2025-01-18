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

        <!-- Reservations Section -->
        <section id="reservations" class="mb-5">
            <h2 class="h4 fw-bold mb-3">Reservations</h2>
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Car Model</th>
                        <th>Pickup Date</th>
                        <th>Return Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example Row -->
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>Toyota Camry</td>
                        <td>2025-01-20</td>
                        <td>2025-01-27</td>
                        <td>Confirmed</td>
                        <td>
                            <button class="btn btn-sm btn-warning">Edit</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Vehicles Section -->
        <section id="vehicles">
            <h2 class="h4 fw-bold mb-3">Vehicles</h2>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="h5">Vehicle List</h3>
                <button class="btn btn-info">Add Vehicle</button>
            </div>
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Model</th>
                        <th>Type</th>
                        <th>Year</th>
                        <th>Price/Day</th>
                        <th>Availability</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example Row -->
                    <tr>
                        <td>1</td>
                        <td>Ford Explorer</td>
                        <td>SUV</td>
                        <td>2023</td>
                        <td>$50</td>
                        <td>Available</td>
                        <td>
                            <button class="btn btn-sm btn-warning">Edit</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>