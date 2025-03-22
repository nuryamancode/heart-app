<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link rel="icon" href="assets/images/favicon/icon.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/media-query.css') }}">
</head>

<body>
    @include('sweetalert::alert')

    <div class="site_content">
        @include('user.components.preloader')

        @include('user.test.components.header')

        @yield('content-test')
    </div>
    <script src="{{ asset('assets/js/jquery-min-3.6.0.js') }}"></script>
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const progress = document.querySelector('.progress');
            const questionNumber = document.querySelector('.question-number');
            const totalQuestions = 10;
            let currentQuestion = 1;

            function updateProgress() {
                const progressWidth = (currentQuestion / totalQuestions) * 100;
                progress.style.width = `${progressWidth}%`;
                questionNumber.textContent = `Question ${currentQuestion} of ${totalQuestions}`;
            }

            document.getElementById('prev-btn').addEventListener('click', () => {
                if (currentQuestion > 1) {
                    currentQuestion--;
                    updateProgress();
                }
            });

            document.getElementById('next-btn').addEventListener('click', () => {
                if (currentQuestion < totalQuestions) {
                    currentQuestion++;
                    updateProgress();
                }
            });

            updateProgress();
        });

        function autoSubmit() {
            document.getElementById('questionForm').submit();
        }
    </script>
</body>

</html>
