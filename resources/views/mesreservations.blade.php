<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarRental - My Reservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand text-info fw-bold fs-4" href="/">CarRental</a>
            <div class="ms-auto">
                <a href="/user" class="btn btn-outline-info me-2">Home</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger ms-2">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Reservations List -->
    <section id="reservations">
        <h2 class="h4 fw-bold mb-3">My Reservations</h2>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="container">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>User name</th>
                            <th>Vehicle brand</th>
                            <th>Vehicle name</th>
                            <th>Price/Day</th>
                            <th>Total days</th>
                            <th>Total Price</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->user->name }}</td>
                            <td>{{ $reservation->vehicle->brand }}</td>
                            <td>{{ $reservation->vehicle->model }}</td>
                            <td>{{ $reservation->vehicle->price_per_day }} €</td>
                            <td>{{ $reservation->start_date->diffInDays($reservation->end_date) }}</td>
                            <td>{{ $reservation->total_price }} €</td>
                            <td>{{ $reservation->start_date->format('Y-m-d') }}</td>
                            <td>{{ $reservation->end_date->format('Y-m-d') }}</td>
                            <td>
                                <!-- Apply color based on status -->
                                @if($reservation->status == 'pending')
                                    <span class="badge bg-warning text-dark">{{ ucfirst($reservation->status) }}</span>
                                @elseif($reservation->status == 'confirmed')
                                    <span class="badge bg-info text-dark">{{ ucfirst($reservation->status) }}</span>
                                @elseif($reservation->status == 'cancelled')
                                    <span class="badge bg-danger text-white">{{ ucfirst($reservation->status) }}</span>
                                @elseif($reservation->status == 'completed')
                                    <span class="badge bg-success text-white">{{ ucfirst($reservation->status) }}</span>
                                @else
                                    <span class="badge bg-secondary text-white">Unknown</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No reservations found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
