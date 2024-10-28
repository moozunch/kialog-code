@php
  $color = $color ?? '#2E2E2E'; // Default color if $color is not provided
@endphp

<span>
  <svg width="30" height="{{ $height }}" viewBox="0 0 60 53" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M50.432 41.112C52.288 44.184 53.984 46.232 55.52 47.256C57.056 48.28 58.432 48.792 59.648 48.792V51C58.368 51.448 56.832 51.8 55.04 52.056C53.312 52.312 51.616 52.44 49.952 52.44C47.136 52.44 44.768 51.992 42.848 51.096C40.928 50.2 39.296 48.984 37.952 47.448C36.608 45.912 35.328 44.184 34.112 42.264L26.144 29.496C25.44 28.344 24.864 27.64 24.416 27.384C24.032 27.128 23.552 27 22.976 27C22.336 27 21.792 27.256 21.344 27.768C20.96 28.28 20.768 29.112 20.768 30.264L20.864 41.4C20.8 44.536 21.248 46.52 22.208 47.352C23.232 48.184 25.024 48.664 27.584 48.792V51H1.568V48.792C2.976 48.664 4.032 48.184 4.736 47.352C5.504 46.52 5.888 44.536 5.888 41.4V10.2C5.888 7.064 5.44 5.08 4.544 4.248C3.712 3.352 2.24 2.872 0.128 2.808V0.599997H25.088V2.808C23.68 2.872 22.592 3.352 21.824 4.248C21.12 5.08 20.768 7.064 20.768 10.2V23.16H20.96L37.184 10.2C39.424 8.472 40.544 6.968 40.544 5.688C40.544 3.96 38.976 3 35.84 2.808V0.599997H55.232V2.808C53.824 3.128 52.352 3.8 50.816 4.824C49.344 5.784 47.648 7.096 45.728 8.76L37.088 16.152C36.256 16.92 36.256 17.976 37.088 19.32L50.432 41.112Z" fill="{{ $color }}"/>
  </svg>
</span>
