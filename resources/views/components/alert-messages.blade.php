@session('success')
    <div class="alert alert-success mb-3 rounded-0">
        {{ session('success') }}
    </div>
@endsession

@session('error')
    <div class="alert alert-danger mb-3 rounded-0">
        {{ session('error') }}
    </div>
@endsession