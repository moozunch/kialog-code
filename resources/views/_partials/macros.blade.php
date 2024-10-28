@php
  $color = $color ?? '#2E2E2E'; // Default color if $color is not provided
@endphp

<span>
  <svg width="30" height="{{ $height }}" viewBox="0 0 55 60" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M19.008 36.536L35.136 17.576H54.096L33.024 39.368L45.024 59.048H26.736L18.288 41.48L15.456 59.048H0.72L9.168 9.848C9.888 5.768 16.176 0.775997 24.624 0.775997L19.008 36.536Z" fill="{{ $color }}"/>
  </svg>
</span>
