<div style="height: 700px; text-align: center; margin-top: 9rem">
  <div style="
     padding:
     0
     auto;">
    <img src="https://i.ibb.co/B4558Hh/mail-Landing.png"
         alt="mail-Landing"
         border="0">
    <h1 style="font-weight: 900">
      {{ __('Recover Password') }}
    </h1>
    <p>
      {{ __('click this button to recover a password') }}
    </p>
    <a href="{{ route('password.reset', ['language' => app()->getLocale(), 'token' => $token, 'email' => $email]) }}">
      <button
              style="background-color: #0FBA68; padding: 1rem; color: whitesmoke; font-size: 1.2rem; width: 400px; font-weight: 900;border-radius: 10px">
        {{ __('RECOVER PASSWORD') }}
      </button>
    </a>
  </div>
</div>
