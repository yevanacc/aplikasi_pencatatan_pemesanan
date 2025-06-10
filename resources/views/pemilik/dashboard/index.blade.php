@extends('dashboard')
@section('content')
    <div class="container">

        <div class="row">
            <h1 id="welcome-message"></h1>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var welcomeMessage = document.getElementById('welcome-message');
                    var hour = new Date().getHours();

                    var greeting = '';

                    if (hour >= 5 && hour < 12) {
                        greeting = 'Selamat Pagi';
                    } else if (hour >= 12 && hour < 17) {
                        greeting = 'Selamat Siang';
                    } else if (hour >= 17 && hour < 20) {
                        greeting = 'Selamat Sore';
                    } else {
                        greeting = 'Selamat Malam';
                    }

                    welcomeMessage.textContent = greeting + ', {{ Auth::user()->name }}';
                });
            </script>


        </div>
    </div>
@endsection
