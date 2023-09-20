<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SMS Portal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row p-4 border rounded-3 bg-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Send SMS
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('posts.sendCustomMessage') }}">
                            @csrf
                            <div class="form-group">
                                <label>Select contacts</label>
                                <select name="post[]" multiple class="form-control post">
                                    @foreach ($users as $user)
                                    <option value="{{ $user->phone }}">{{ $user->phone }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <textarea name="body" class="form-control" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.post').select2();
        });
    </script>
</body>
</html>
