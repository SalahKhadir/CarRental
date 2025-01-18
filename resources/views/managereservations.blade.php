<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarRental - Manage Reservations</title>
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

    <section id="reservations">
        <h2 class="h4 fw-bold mb-3">Reservations List</h2>
        <div class="d-flex justify-content-between align-items-center mb-3">
        </div>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th></th>
                    <th>User name</th>
                    <th>Vehicle brand</th>
                    <th>Vehicle name</th>
                    <th>Price/Day</th>
                    <th>Total days</th>
                    <th>Total Price</th>
                    <th>Start date</th>
                    <th>End date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->user->name }}</td>
                    <td>{{ $reservation->vehicle->brand }}</td>
                    <td>{{ $reservation->vehicle->model }}</td>
                    <td>{{ $reservation->vehicle->price_per_day }} €</td>
                    <td>{{ $reservation->start_date->diffInDays($reservation->end_date) }}</td>
                    <td>{{ $reservation->total_price }} €</td>
                    <td>{{ $reservation->start_date->format('Y-m-d') }}</td>
                    <td>{{ $reservation->end_date->format('Y-m-d') }}</td>
                    <td>
                        <form action="{{ route('reservation.update', $reservation->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()">
                                <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="completed" {{ $reservation->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('reservation.destroy', $reservation->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this reservation?')">Delete</button>
                        </form>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center">No reservations found.</td>
                </tr>
                @endforelse
            </tbody>


        </table>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>