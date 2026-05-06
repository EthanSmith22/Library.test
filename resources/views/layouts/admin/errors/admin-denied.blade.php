<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Access Denied | LibraryDB</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-light">
<div class="min-vh-100 d-flex align-items-center justify-content-center px-3">
    <div class="card border-0 shadow-sm rounded-4" style="max-width: 520px; width: 100%;">
        <div class="card-body text-center p-5">
            <div class="rounded-circle bg-danger bg-opacity-10 text-danger d-flex align-items-center justify-content-center mx-auto mb-4"
                 style="width: 72px; height: 72px;">
                <span class="fw-bold" style="font-size: 34px;">!</span>
            </div>

            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 mb-3">
                Access Restricted
            </span>

            <h1 class="h3 fw-bold mb-3">Admin Area Only</h1>

            <p class="text-muted mb-4">
                You do not have permission to access the LibraryDB admin panel.
                Please return to the user site or login with an admin account.
            </p>

            <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
                <a href="http://{{ config('app.project_domain') }}" class="btn btn-outline-secondary px-4">
                    Back to User Site
                </a>

                <a href="http://{{ config('app.project_domain') }}/login" class="btn btn-primary px-4">
                    Admin Login
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>