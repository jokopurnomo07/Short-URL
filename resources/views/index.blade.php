
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>URL Shortener JDK</title>
        <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/pages/error.css') }}" />
        <link
        rel="shortcut icon"
        href="{{ asset('assets/images/logo/favicon.svg') }}"
        type="image/x-icon"
        />
        <link
        rel="shortcut icon"
        href="{{ asset('assets/images/logo/favicon.png') }}"
        type="image/png"
        />
    </head>

    <body>
        <div id="error">
            <div class="error-page container">
                <div class="col-md-8 col-12 offset-md-2">
                    <div class="text-center">
                        <form action="{{ route('shorten') }}" method="post">
                            @csrf
                            <h3 class="error-title">URL Shortener JDK</h3>
                            <input type="text" class="form-control form-control-xl" name="url" placeholder="Shorten your link">
                            @if(Session::has('message'))
                                @if (session()->get('status') == false)
                                    <div class="alert alert-danger alert-dismissible show fade mt-3">
                                        Masukkan URL yang benar
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                            @endif
                            <button class="btn btn-lg btn-outline-primary mt-3">Shorten</button>
                        </form>

                        @if (Session::has('status'))
                            @if(session()->get('status') == true)
                                <div class="card mt-3">
                                    <div class="card-content">
                                        <div class="card-body d-flex justify-content-between">
                                            <a href="http://127.0.0.1:8000/{{ session()->get('message') }}">http://127.0.0.1:8000/{{ session()->get('message') }}</a>
                                            <button class="btn btn-light-primary float-right" id="copy">Copy</button>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between">
                                        Ingin custom shortlink, brand, and track your link?
                                        <button class="btn btn-light-primary">Login</button>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        function fallbackCopyTextToClipboard(text) {
            try {
                var successful = document.execCommand("copy");
                var msg = successful ? "successful" : "unsuccessful";
            } catch (err) {
                console.error("Fallback: Oops, unable to copy", err);
            }
        }

        function copyTextToClipboard() {
            let text = 'http://127.0.0.1:8000/{{ session()->get('message') }}'
            if (!navigator.clipboard) {
                fallbackCopyTextToClipboard(text);
                return;
            }
            navigator.clipboard.writeText(text).then(
                function() {
                },
                function(err) {
                    console.error("Async: Could not copy text: ", err);
                }
            );
        }

        let copyBtn = document.getElementById('copy')
        let text = document.getElementById('')
        copyBtn.addEventListener("click", function(event) {
            copyTextToClipboard();

            copyBtn.textContent = 'Copied!'
            console.log(copyBtn.value)
        });
    </script>
</html>