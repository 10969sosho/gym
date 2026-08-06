<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - Gym Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .drawer-overlay {
            transition: opacity 0.3s ease-in-out;
        }
        .drawer-panel {
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-gray-800 text-white flex-shrink-0 hidden md:block">
            <div class="p-4 border-b border-gray-700">
                <h1 class="text-xl font-bold"><i class="fas fa-dumbbell mr-2"></i>Gym Admin</h1>
            </div>
            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-tachometer-alt mr-3 w-5"></i> Dashboard
                </a>
                <a href="{{ route('admin.members.index') }}" class="flex items-center px-4 py-2 rounded {{ request()->routeIs('admin.members*') ? 'bg-indigo-600' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-users mr-3 w-5"></i> Members
                </a>
                <a href="{{ route('admin.payments.index') }}" class="flex items-center px-4 py-2 rounded {{ request()->routeIs('admin.payments*') ? 'bg-indigo-600' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-money-bill-wave mr-3 w-5"></i> Payments
                </a>
                <a href="{{ route('admin.notifications.index') }}" class="flex items-center px-4 py-2 rounded {{ request()->routeIs('admin.notifications*') ? 'bg-indigo-600' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-bell mr-3 w-5"></i> Notifications
                </a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col">
            <header class="bg-white shadow-sm border-b">
                <div class="flex items-center justify-between px-6 py-3">
                    <button id="mobileMenuBtn" class="md:hidden text-gray-600">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div class="flex items-center ml-auto">
                        <span class="text-sm text-gray-600 mr-4">{{ auth()->user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    <div id="mobileMenu" class="fixed inset-0 bg-gray-800 bg-opacity-50 z-50 hidden">
        <div class="w-64 bg-gray-800 h-full text-white">
            <div class="p-4 border-b border-gray-700 flex justify-between items-center">
                <h1 class="text-xl font-bold"><i class="fas fa-dumbbell mr-2"></i>Gym Admin</h1>
                <button id="closeMenuBtn" class="text-white"><i class="fas fa-times"></i></button>
            </div>
            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-tachometer-alt mr-3 w-5"></i> Dashboard
                </a>
                <a href="{{ route('admin.members.index') }}" class="flex items-center px-4 py-2 rounded {{ request()->routeIs('admin.members*') ? 'bg-indigo-600' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-users mr-3 w-5"></i> Members
                </a>
                <a href="{{ route('admin.payments.index') }}" class="flex items-center px-4 py-2 rounded {{ request()->routeIs('admin.payments*') ? 'bg-indigo-600' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-money-bill-wave mr-3 w-5"></i> Payments
                </a>
                <a href="{{ route('admin.notifications.index') }}" class="flex items-center px-4 py-2 rounded {{ request()->routeIs('admin.notifications*') ? 'bg-indigo-600' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-bell mr-3 w-5"></i> Notifications
                </a>
            </nav>
        </div>
    </div>

    <script>
        document.getElementById('mobileMenuBtn')?.addEventListener('click', () => {
            document.getElementById('mobileMenu').classList.remove('hidden');
        });
        document.getElementById('closeMenuBtn')?.addEventListener('click', () => {
            document.getElementById('mobileMenu').classList.add('hidden');
        });

        function openDrawer(drawerId) {
            const drawer = document.getElementById(drawerId);
            const overlay = drawer.querySelector('.drawer-overlay');
            const panel = drawer.querySelector('.drawer-panel');
            const form = drawer.querySelector('form');
            const title = drawer.querySelector('.drawer-title');
            
            // Reset form for create mode
            if (form) {
                form.reset();
                // Remove method field if exists (for create mode)
                const methodField = form.querySelector('input[name="_method"]');
                if (methodField) {
                    methodField.remove();
                }
                // Reset action to store route
                form.action = form.dataset.storeAction || form.action;
            }
            // Reset title
            if (title) {
                title.textContent = title.dataset.defaultTitle || title.textContent;
            }
            
            drawer.classList.remove('hidden');
            setTimeout(() => {
                overlay.classList.remove('opacity-0');
                overlay.classList.add('opacity-100');
                panel.classList.remove('translate-x-full');
                panel.classList.add('translate-x-0');
            }, 10);
            
            document.body.style.overflow = 'hidden';
        }

        function closeDrawer(drawerId) {
            const drawer = document.getElementById(drawerId);
            const overlay = drawer.querySelector('.drawer-overlay');
            const panel = drawer.querySelector('.drawer-panel');
            
            overlay.classList.remove('opacity-100');
            overlay.classList.add('opacity-0');
            panel.classList.remove('translate-x-0');
            panel.classList.add('translate-x-full');
            
            setTimeout(() => {
                drawer.classList.add('hidden');
                document.body.style.overflow = '';
            }, 300);
        }

        function openEditDrawer(drawerId, data) {
            const drawer = document.getElementById(drawerId);
            const form = drawer.querySelector('form');
            const title = drawer.querySelector('.drawer-title');
            
            // Update form action
            if (data.id) {
                const actionUrl = form.dataset.editAction.replace(':id', data.id);
                form.action = actionUrl;
                
                // Add or update method field for PUT
                let methodField = form.querySelector('input[name="_method"]');
                if (!methodField) {
                    methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    form.appendChild(methodField);
                }
                methodField.value = 'PUT';
            }
            
            // Populate form fields
            Object.keys(data).forEach(key => {
                if (key === 'id') return;
                const input = form.querySelector(`[name="${key}"]`);
                if (input) {
                    if (input.type === 'file') {
                        // Skip file inputs
                    } else if (input.tagName === 'SELECT') {
                        input.value = data[key];
                    } else {
                        input.value = data[key];
                    }
                }
            });
            
            // Update drawer title
            if (title && data.name) {
                title.textContent = 'Edit: ' + data.name;
            }
            
            openDrawer(drawerId);
        }
    </script>
    @stack('scripts')
</body>
</html>
