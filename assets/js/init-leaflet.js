const map = L.map('map', {
    center: [-3.994697, 122.515068],
    maxZoom: 19,
    zoom: 15
})

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);