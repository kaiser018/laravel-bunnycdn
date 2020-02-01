<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>{{env('APP_NAME')}}</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">

    </head>
    <body>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h1>File Uploader</h1>

                    @if($url)
                    
                        <div class="form-group">
                            <input type="text" value="{{$url}}" class="form-control" id="url"/>
                        </div>

                        <button class="btn btn-primary copy" data-clipboard-target="#url">Copy to clipboard</button>
                        <a href="{{$url}}" target="_blank" class="btn btn-primary">Open File</a>

                    @else

                        <form action="/upload" method="post" enctype="multipart/form-data" id="upload">
                            @csrf
                            <div class="form-group">
                                <input type="file" name="file" class="form-control"/>
                            </div>
                        </form>

                        <div class="form-group">
                            <button type="submit" form="upload" class="btn btn-primary">Upload</button>
                        </div>

                    @endif

                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
        <script type="text/javascript">
            $(function(){
                
                // var myDropzone = new Dropzone(".dropzone", { url: "/upload"});

                $('.copy').tooltip({
                    trigger: 'click',
                    placement: 'bottom'
                });

                function setTooltip(message) {
                    $('.copy').tooltip('hide')
                    .attr('data-original-title', message)
                    .tooltip('show');
                }

                function hideTooltip() {
                    setTimeout(function() {
                        $('.copy').tooltip('hide');
                    }, 1000);
                }

                let clipboard = new ClipboardJS('.btn');

                clipboard.on('success', function(e) {
                    setTooltip('Copied!');
                    hideTooltip();
                });

                clipboard.on('error', function(e) {
                    setTooltip('Failed!');
                    hideTooltip();
                });
            });

        </script>

    </body>
</html>
