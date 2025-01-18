<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Vehicle</title>
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
        <h1 class="text-center fw-bold mb-4">Add New Vehicle</h1>

        <form action="{{ route('managecars.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="form-label fw-bold">Brand</label>
                <input type="text" class="form-control" name="brand" required>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Model</label>
                <input type="text" class="form-control" name="model" required>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Type</label>
                <input type="text" class="form-control" name="type" required>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Capacity</label>
                <input type="number" class="form-control" name="capacity" required>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Price per Day</label>
                <input type="number" class="form-control" name="price_per_day" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-info">Save Vehicle</button>
                <a href="{{ route('managecars') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>