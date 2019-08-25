<!-- Changing name is disabled for now -->
@if ($name !== 'Name')
<div class="card mb-2 p-3 flex-row justify-content-between align-items-center">
  <div>
    <div class="font-weight-bold">{{ $name }}</div>
    <div>{{ $value }}</div>
  </div>
  <a
    href="#"
    class="nav-link"
    data-toggle="modal"
    data-target="#change{{ $name }}Modal"
  >Edit</a>
</div>
@endif
