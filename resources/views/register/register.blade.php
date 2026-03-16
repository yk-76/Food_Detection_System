<div id="registerSection" class="hidden">
                <h3 class="text-center text-3xl font-extrabold text-orange-400 mb-8!">Join Us</h3>
                <form id="modalRegistrationForm" action="{{ route('register') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="space-y-4!">
                        <input type="text" name="userName" class="w-full p-3 text-orange-600! font-semibold! border-2 border-orange-200 rounded-xl outline-none focus:border-orange-500 transition-colors" placeholder="Username" required/>
                        <input type="email" name="email" class="w-full p-3 text-orange-600! font-semibold! border-2 border-orange-200 rounded-xl outline-none focus:border-orange-500 transition-colors" placeholder="Email Address" required/>
                        <input type="tel" name="phoneNo" class="w-full p-3 text-orange-600! font-semibold! border-2 border-orange-200 rounded-xl outline-none focus:border-orange-500 transition-colors" placeholder="Phone Number" required/>
                        
                        <div>
                            <label class="text-xs font-bold text-orange-400 uppercase tracking-wider ml-1">Birth Date</label>
                            <input type="date" name="dateOfBirth" class="w-full p-3 text-orange-600! font-semibold! border-2 border-orange-200 rounded-xl outline-none focus:border-orange-500 transition-colors" required/>
                        </div>

                        <div class="flex gap-6 px-1">
                            <label class="flex! items-center! cursor-pointer font-medium text-orange-600">
                                <input type="radio" name="gender" value="male" checked class="mr-2! w-4 h-4 text-orange-500 focus:ring-orange-500"> Male
                            </label>
                            <label class="flex! items-center! cursor-pointer font-medium text-orange-600">
                                <input type="radio" name="gender" value="female" class="mr-2! w-4 h-4 text-orange-500 focus:ring-orange-500"> Female
                            </label>
                        </div>

                        <div class="group">
                            <div class="relative flex items-center border-2 border-orange-200 rounded-xl overflow-hidden focus-within:border-orange-500 transition-colors">
                                <span class="px-4 text-orange-400 group-focus-within:text-orange-500"><i class="fa-solid fa-lock"></i></span>
                                
                                <input type="password" name="password" id="registerPassword" 
                                    class="w-full py-3 pr-12 outline-none text-orange-700 bg-transparent" 
                                    placeholder="Password" required/>
                                
                                <button type="button" onclick="togglePassword('registerPassword', 'registerIcon')" 
                                        class="absolute right-0 top-0 h-full px-4 text-orange-400 hover:text-orange-600 focus:outline-none z-10">
                                    <i id="registerIcon" class="fa-solid fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>

                    <label class="flex! items-center! text-xs text-orange-500 cursor-pointer pt-1! pb-1!">
                        <input type="checkbox" id="terms" required class="mr-2! rounded border-orange-300 text-orange-600 focus:ring-orange-500">
                        <span>By registering, I agree to the <a href="#" class="text-orange-700! underline">Terms of Service</a> and Privacy Policy.</span>
                    </label>

                    <button type="submit" class="w-full bg-gradient-to-r from-orange-400/80 via-orange-500/90 to-orange-400/80
 hover:bg-orange-700 text-white font-bold py-4 rounded-xl! transition-all shadow-sm shadow-orange-500/30 active:scale-[0.98]">
                        CREATE ACCOUNT
                    </button>
                </form>

                <p class="text-center mt-4! text-orange-500 text-sm">
                    Already registered? <button class="text-orange-600 font-bold hover:underline" id="showLoginLink">Log in</button>
                </p>
            </div>


            <script>
                function togglePassword(inputId, iconId) {
    const passwordInput = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (passwordInput.type === 'password') {
        // Make password visible, show the "Open Eye"
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        // Hide password, show the "Slashed Eye" (default)
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
}
            </script>