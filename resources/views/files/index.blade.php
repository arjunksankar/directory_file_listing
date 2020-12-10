<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="./.favicon.ico">
    <title>Directory Contents</title>
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body data-new-gr-c-s-check-loaded="14.984.0" data-gr-ext-installed="" cz-shortcut-listen="true">
    <div id="container">
        @if($request->slug == 'uploaded')
        <h1>Uploaded Directory Contents</h1>
        @elseif($request->slug == 'deleted')
        <h1>Deleted Directory Contents</h1>
        @else
        <h1>Directory Contents</h1>
        @endif
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#uploadModal">Create New
            file</button>
        <a href="{{route('list_files')}}" class="btn btn-sm btn-light float-right ml-2"> Current Files</a>
        <a href="{{route('list_files',['uploaded'])}}" class="btn btn-sm btn-light float-right ml-2"> All Uploaded
            Files</a>
        <a href="{{route('list_files',['deleted'])}}" class="btn btn-sm btn-light float-right ml-2"> Deleted Files</a>

        <form class="example" action="{{route('list_files')}}">
            <input type="text" placeholder="Search.." name="search">
            <button>Search</button>
        </form>

        <table class="sortable">
            <thead>
                <tr>
                    <th>Filename</th>
                    <th>Date Modified</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
                @if($files->count()>0)
                @foreach($files as $file)

                <tr class="file">
                    <td>{{$file->name}}</td>
                    <td>{{$file->updated_at}}</td>
                    <td><a href="{{route('delete_file',[$file->id])}}">Delete</a></td>

                </tr>
                @endforeach
                @else
                <tr class="file">
                    <td>no data found</td>
                </tr>
                @endif
            </tbody>
            <tfoot></tfoot>
        </table>
        {{ $files->links() }}

        <!-- Modal -->
        <div id="uploadModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">File upload form</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Form -->
                        <form method='post' action='{{route('post_file')}}' enctype="multipart/form-data">
                            @csrf
                            Select file : <input type='file' name='file' id='file' class='form-control'><br>
                            <button>Upload</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block" style="top:90px;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{!! $message !!}</strong>
    </div>
    @endif

    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block" style="top:90px;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{!! $message !!}</strong>
    </div>
    @endif

    @if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block" style="top:90px;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{!! $message !!}</strong>
    </div>
    @endif

    @if ($message = Session::get('info'))
    <div class="alert alert-info alert-block" style="top:90px;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{!! $message !!}</strong>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger" style="top:90px;">
        <button type="button" class="close" data-dismiss="alert">×</button>

        {{ implode('', $errors->all('<div>:message</div>')) }}
    </div>
    @endif

    <script src="/js/app.js"></script>

</body>

</html>
