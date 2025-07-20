<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf=token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/colors.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tansam-form.css') }}">
    <link rel="icon" href="{{ asset('tansam_logo.png') }}">
    <title>TANSAM CMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="d-flex mt-50 justify-center items-center">
        <div class="col-md-4">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
                    <div class="w-full bg-white rounded-lg shadow border md:mt-0 sm:max-w-md xl:p-0">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <p class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                                Admin Login
                            </p>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">
                                    Email
                                </label>
                                <input placeholder="name@example.com"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5"
                                    id="email" name="email" type="text">
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">
                                    Password
                                </label>
                                <input
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5"
                                    placeholder="••••••••" id="password" name="password" type="password">
                            </div>
                            @if($errors->any())
                                <div class="alert alert-danger">{{ $errors->first() }}</div>
                            @endif
                            <button
                                class="w-full bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center  focus:ring-blue-800 text-white"
                                type="submit">
                                Login
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>