<h3 class="mb-4">Account settings</h3>
<div class="mb-4 row">
  <div class="col-md-4">
    <div class="row">
      <div class="col">
        @component('user-profile.components.account-setting', ['name' => 'Name', 'value' => Auth::user()->name])@endcomponent
        @component('user-profile.components.account-setting', ['name' => 'Password', 'value' => ''])@endcomponent
        @component('user-profile.components.account-setting', ['name' => 'Email', 'value' => Auth::user()->email])@endcomponent
        @component('user-profile.components.account-setting', ['name' => 'Timezone', 'value' => Auth::user()->timezone])@endcomponent
      </div>
    </div>
  </div>
</div>
