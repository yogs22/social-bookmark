<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Content</title>
</head>
<body>
    <div>
        <div class="text-center">
            <table style="width: 100%">
                <tr>
                    <td colspan="5">
                        <h3><b>Laporan Content</b></h3>
                    </td>
                </tr>
                    <tr>
                        <td colspan="5">
                            @if ($request['start_date'] != null && $request['end_date'] != null)
                                <h5>
                                    <b>
                                        {{ \Carbon\Carbon::parse($request['start_date'])->formatLocalized('%d %b %y') }}
                                        Sampai
                                        {{ \Carbon\Carbon::parse($request['end_date'])->formatLocalized('%d %b %y') }}</b></h5>
                            @else
                                <h5>All Data</h5>
                            @endif
                    </td>
                </tr>
            </table>
        </div>

        <table class="table table-stripped table-bordered" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Tanggal Publish</th>
                    <th>User</th>
                    <th>Original URL</th>
                    <th>Bookmark URL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contents as $content)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $content->title }}</td>
                        <td>{!! $content->published_status !!}</td>
                        <td>{{ $content->published_at_formated }}</td>
                        <td>{{ @$content->user->name }}</td>
                        <td>
                            <a href="{{ $content->content_url }}" class="btn btn-primary" target="_blank" rel="noreferrer">
                                {{ $content->content_url }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ secure_url("/{$content->slug}") }}" class="btn btn-primary" target="_blank" rel="noreferrer">
                                {{ secure_url("/{$content->slug}") }}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
