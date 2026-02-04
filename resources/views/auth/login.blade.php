<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIAP APP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-white font-sans flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md p-8">
        <div class="flex flex-col items-center mb-10">
            <div class="w-48 mb-4">
                <svg viewBox="0 0 450 150" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                    <text x="0" y="125" font-family="Arial Black, sans-serif" font-size="140" font-weight="900" fill="#e31e24">SI</text>
                    <g transform="translate(185, 10)">
                        <path d="M10,110 Q40,70 70,110 L70,125 L10,125 Z" fill="#b1b3b6" />
                        <path d="M10,110 Q25,85 40,110 L25,125 L10,125 Z" fill="#008a44" />
                        <path d="M30,95 L50,125 L40,125 L25,105 Z" fill="#f9d949" />
                        <path d="M40,0 A28,28 0 1,0 40,56 L40,75 L40,56 A28,28 0 0,0 40,0" fill="#e31e24" />
                        <circle cx="40" cy="28" r="20" fill="white" />
                        <circle cx="33" cy="24" r="2.5" fill="#e31e24" />
                        <circle cx="47" cy="24" r="2.5" fill="#e31e24" />
                        <path d="M30,34 Q40,45 50,34" fill="none" stroke="#e31e24" stroke-width="3" stroke-linecap="round" />
                    </g>
                    <text x="300" y="125" font-family="Arial Black, sans-serif" font-size="140" font-weight="900" fill="#e31e24">P</text>
                </svg>
            </div>
            <h2 class="text-xl font-bold tracking-widest text-gray-400 uppercase">Sistem Manajemen Personel</h2>
        </div>

        <div class="bg-black border border-gray-800 p-8 rounded-2xl shadow-2xl">
            <h3 class="text-2xl font-bold mb-6 text-center">Masuk ke Akun</h3>
            
            <form action="{{ route('login.process') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Email Address</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" name="email" required
                            value="admin@gmail.com"
                            class="w-full bg-gray-900 border border-gray-800 text-white text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block pl-10 p-3 outline-none transition-all" 
                            placeholder="admin@example.com">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" id="passwordField" name="password" required
                            value="password123"
                            class="w-full bg-gray-900 border border-gray-800 text-white text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block pl-10 pr-10 p-3 outline-none transition-all" 
                            placeholder="••••••••">
                        
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-white transition-colors">
                            <i id="eyeIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                @if($errors->any())
                    <div class="bg-red-900/20 border border-red-900/50 text-red-500 text-sm p-3 rounded-lg flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <button type="submit" 
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg transition-colors shadow-lg shadow-red-900/20">
                    LOGIN
                </button>
            </form>
        </div>

        <p class="text-center text-gray-600 text-xs mt-8">
            &copy; 2026 SIAP APP - All Rights Reserved.
        </p>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('passwordField');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>

</body>
</html>