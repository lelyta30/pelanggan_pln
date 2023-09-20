<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>Statistik Pelanggan</title>
</head>
<body style="background: lightgray">

<div class="container mt-5"> 
    <div class="row">
        <div class="col-md-10 mx-auto" style="max-width: 1800px;">
            <h3 class="text-center my-4">DETAIL STATISTIK PELANGGAN</h3>
            <hr>
            <div class="card border-0 shadow-sm rounded">
            <div class="text-right">
    <a href="{{ route('posts.create') }}" class="btn btn-md btn-success mb-2">Submit</a>
</div>
                    <div class="d-flex justify-content-end mb-2">
                        <button id="ipButton" class="btn btn-md btn-success ml-2">IP</button>
                        <button id="resetButton" class="btn btn-md btn-success ml-2">RESET</button>
                        <button id="signalButton" class="btn btn-md btn-success ml-2">SIGNAL</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">NAMA</th>
                                    <th scope="col">ALAMAT</th>
                                    <th scope="col">TARIF</th>
                                    <th scope="col">DAYA</th>
                                    <th scope="col">N.MTR</th>
                                    <th scope="col">M.MTR</th>
                                    <th scope="col">T.MTR</th>
                                    <th scope="col">N.CM.DVC</th>
                                    <th scope="col">MRK.CM.DVC</th>
                                    <th scope="col">TP.CM.DVC</th>
                                    <th scope="col">PORT</th>
                                    <th scope="col">PHONE</th>
                                    <th scope="col">PROVIDER</th>
                                    <th scope="col">IP</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $post)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $post->id_pelanggan }}</td>
                                    <td>{{ $post->name }}</td>
                                    <td>{{ $post->address }}</td>
                                    <td>{{ $post->tariff }}</td>
                                    <td>{{ $post->daya }}</td>
                                    <td>{{ $post->no_meter }}</td>
                                    <td>{{ $post->merk_meter }}</td>
                                    <td>{{ $post->type_meter }}</td>
                                    <td>{{ $post->no_comm_device }}</td>
                                    <td>{{ $post->merk_comm_device }}</td>
                                    <td>{{ $post->type_comm_device }}</td>
                                    <td>{{ $post->port }}</td>
                                    <td>{{ $post->phone }}</td>
                                    <td>{{ $post->provider }}</td>
                                    <td>{{ $post->ip_address }}</td>
                                    <td class="text-center">
                                        <input type="checkbox" class="dataTerpilihCheckbox" name="dataTerpilih[]" value="{{ $post->id_pelanggan }}">
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="18" class="text-center">
                                        <div class="alert alert-danger">
                                            Data Pelanggan belum tersedia.
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/twilio@3.69.0/dist/twilio.min.js"></script>
<script>
    $(document).ready (function()) {
        $(".dataTerpilihCheckbox").on("change", function() {
            var phone = $(this).closest("tr").find("td:nth-child(14)").text().trim();
            $("#selectedPhone").val(phone);
        });
    }
</script>
</body>
</html>