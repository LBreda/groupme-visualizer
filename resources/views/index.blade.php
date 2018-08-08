<!doctype html>
<html>
<head>
    <title>GroupMe export visualizer</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/node_modules/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flatly.min.css') }}">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12 text-center"><h1>GroupMe export visualizer</h1></div>
        <div class="col-12">
            <form action="{{ route('analyzer.analyze') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row justify-content-center">
                    <div class="col-auto">
                        <label for="file">File:</label>
                        <input class="form-control-file" type="file" name="file" id="file" accept=".zip">
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <div class="col-auto">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Boostrap core JS -->
<script src="{{ asset('assets/js_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>
</html>