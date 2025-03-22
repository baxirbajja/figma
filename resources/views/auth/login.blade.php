<x-guest-layout>
    <main class="frame">
        <div class="overlap-wrapper">
            <div class="overlap">
                <div class="rectangle"></div>
                <div class="group" role="img" aria-label="Logo">
                    <img class="vector" src="{{ asset('images/logo.svg') }}" alt="Logo detail" />
                </div>
                <section class="login-section">
                    @if ($errors->any())
                    <div class="error-message" role="alert">
                        <div class="vector-wrapper">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <p class="error-text">Login ou mot de passe incorrect!</p>
                        <button class="close-button" aria-label="Close error message">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="login-form">
                        @csrf
                        <div class="input-wrapper">
                            <label for="email" class="visually-hidden">Login</label>
                            <input type="email" id="email" name="email" :value="old('email')" required autofocus
                                placeholder="Login" class="text-input" />
                        </div>

                        <div class="input-wrapper">
                            <label for="password" class="visually-hidden">Mot de passe</label>
                            <input type="password" id="password" name="password" required placeholder="Mot de passe"
                                class="text-input" />
                        </div>

                        <div class="options-row">
                            <label class="checkbox-label">
                                <input type="checkbox" name="remember" id="remember_me" class="visually-hidden" />
                                <span class="custom-checkbox"></span>
                                Rester connecté(e)
                            </label>

                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-password">
                                Mot de passe oublié?
                            </a>
                            @endif
                        </div>

                        <button type="submit" class="submit-button">
                            CONNEXION
                        </button>
                    </form>
                </section>
            </div>
        </div>
    </main>

    <style>
        /* Reset and Global Styles */
        * {
            -webkit-font-smoothing: antialiased;
            box-sizing: border-box;
        }

        /* Frame and Layout */
        .frame {
            background-color: #f8f8f8;
            display: flex;
            flex-direction: row;
            justify-content: center;
            width: 100%;
            min-height: 100vh;
        }

        .overlap-wrapper {
            background-color: #f8f8f8;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .overlap {
            position: relative;
            width: 906px;
            padding: 2rem;
        }

        .rectangle {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 71px;
            left: 0;
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: -2.8px -2.8px 8px #ffffffcf,
                5.9px 6.8px 15.5px #becde247,
                inset 3.5px 3.5px 6px #ffffff26;
        }

        /* Logo */
        .group {
            position: relative;
            width: 143px;
            height: 141px;
            margin: 0 auto;
            margin-bottom: 2rem;
            z-index: 1;
        }

        .vector {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* Login Section */
        .login-section {
            position: relative;
            z-index: 1;
            padding: 2rem;
            max-width: 625px;
            margin: 0 auto;
        }

        /* Error Message */
        .error-message {
            display: flex;
            align-items: center;
            background-color: #d11253fc;
            border-radius: 65px;
            padding: 0.75rem 1.5rem;
            margin-bottom: 1.5rem;
            color: white;
        }

        .error-text {
            margin: 0 1rem;
            font-size: 0.875rem;
            flex-grow: 1;
        }

        .close-button {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            padding: 0.25rem;
        }

        /* Form Elements */
        .input-wrapper {
            margin-bottom: 1rem;
        }

        .text-input {
            width: 100%;
            height: 66px;
            background-color: #ffffff;
            border: none;
            border-radius: 63px;
            padding: 0 1.5rem;
            font-size: 0.875rem;
            color: #5e5e5e;
            box-shadow: -2.8px -2.8px 8px #ffffffcf,
                inset 5.9px 0.8px 15.5px #becde247,
                inset 3.5px 3.5px 6px #ffffff26;
        }

        .text-input:focus {
            outline: none;
            box-shadow: 0 0 0 2px #d11253;
        }

        /* Checkbox and Options */
        .options-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1rem 0;
            font-size: 0.875rem;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            color: #113b3a;
            cursor: pointer;
        }

        .visually-hidden {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            border: 0;
        }

        .custom-checkbox {
            width: 16px;
            height: 15px;
            margin-right: 0.5rem;
            background-color: #113b3a0d;
            border-radius: 2px;
            display: inline-block;
            position: relative;
            box-shadow: 0px 0px 4px #f6f6f605,
                inset 3.5px 3.5px 4px #77849d45,
                inset -2.8px -2.8px 3.9px #ffffff94;
        }

        input[type="checkbox"]:checked + .custom-checkbox::after {
            content: '';
            position: absolute;
            left: 5px;
            top: 2px;
            width: 6px;
            height: 9px;
            border: solid #d11253;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .forgot-password {
            color: #d11253;
            text-decoration: none;
        }

        /* Submit Button */
        .submit-button {
            width: 100%;
            height: 66px;
            background-color: #d11253;
            color: white;
            border: none;
            border-radius: 63px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            margin-top: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .submit-button:hover {
            background-color: #b30f47;
        }

        .submit-button:focus {
            outline: none;
            box-shadow: 0 0 0 2px white, 0 0 0 4px #d11253;
        }
    </style>
</x-guest-layout>
