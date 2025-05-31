<svg viewBox="0 0 150 150" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <circle cx="75" cy="75" r="70" fill="#4F46E5"/>
    <text x="75" y="80" font-size="70" text-anchor="middle" fill="#fff" font-family="Arial, sans-serif" dominant-baseline="middle">{{ Auth::user()->name[0] }}</text>
</svg>
