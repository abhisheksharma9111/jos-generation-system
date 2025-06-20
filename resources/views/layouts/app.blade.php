<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOS Generation System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <nav class="bg-blue-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">JOS Generation System</h1>
            <ul class="flex space-x-6">
                <li><a href="{{ route('type-of-works.index') }}" class="hover:text-blue-200">Type of Work</a></li>
                <li><a href="{{ route('contractors.index') }}" class="hover:text-blue-200">Contractors</a></li>
                <li><a href="{{ route('conductors.index') }}" class="hover:text-blue-200">Conductors</a></li>
                <li><a href="{{ route('job-orders.index') }}" class="hover:text-blue-200">Job Orders</a></li>
                <li><a href="{{ route('jos.index') }}" class="hover:text-blue-200">JOS</a></li>
            </ul>
        </div>
    </nav>
      @if(session('success'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="fixed bottom-4 right-4 bg-red-500 text-white px-4 py-2 rounded shadow-lg">
            {{ session('error') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <main class="container mx-auto py-6 px-4">
        @yield('content')
    </main>

  

    <script>
        // Auto-hide flash messages after 3 seconds
        setTimeout(() => {
            const messages = document.querySelectorAll('[class*="fixed"]');
            messages.forEach(msg => msg.remove());
        }, 3000);
    </script>
</body>

</html>