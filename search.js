// Product data array
const product = [
    { id: 0, image: 'pinatubo.jpg', title: 'MT. PINATUBO', address: 'Zambales, Philippines' },
    { id: 1, image: 'batad.jpg', title: 'BATAD RICE TERRACES', address: 'Banaue, Philippines' },
    { id: 2, image: 'mayon.jpg', title: 'MAYON VOLCANO', address: 'Albay, Philippines' },
    { id: 3, image: 'intramuros.jpg', title: 'FORT SANTIAGO', address: 'Intramuros, Philippines' },
    { id: 4, image: 'rp.jpg', title: 'RIZAL PARK', address: 'Metro Manila, Philippines' },
    { id: 5, image: 'baguio.jpg', title: 'BAGUIO CITY', address: 'Benguet, Philippines' },
    { id: 6, image: 'mop.jpg', title: 'MANILA OCEAN PARK', address: 'Ermita, Philippines' },
    { id: 7, image: 'vgc.jpg', title: 'VENICE GRAND CANAL', address: 'Taguig, Philippines' },
    { id: 8, image: 'taal.jpg', title: 'TAAL VOLCANO', address: 'Batangas, Philippines' },
    { id: 9, image: 'windmill.jpg', title: 'BANGUI WINDMILL', address: 'Ilocos Norte, Philippines' },
    { id: 10, image: 'monte.jpg', title: 'MONTE MARIA', address: 'Batangas City, Philippines' },
    { id: 11, image: 'batanes.jpg', title: 'BATANES', address: 'Batanes, Philippines' }, 
    { id: 12, image: 'pulag.jpg', title: 'MT. PULAG', address: 'Benguet, Philippines' },
    { id: 13, image: 'vigan.jpg', title: 'VIGAN', address: 'Ilocos Sur, Philippines' },
    { id: 14, image: 'falls.jpg', title: 'PAGSANJAN FALLS', address: 'Laguna, Philippines' },
];

// Function to display places
function displayPlaces(items) {
    const container = document.getElementById('placesContainer');
    if (items.length === 0) {
        container.innerHTML = '<p>No matching places found.</p>';
        return;
    }

    container.innerHTML = items.map(item => {
        return `
            <div class="place">
                <div class="img-place">
                    <img src="${item.image}" alt="${item.title}">
                </div>
                <div class="text-place">
                    <div class="title-place">${item.title}</div>
                    <div class="address-place">${item.address}</div>
                </div>
            </div>`;
    }).join('');
}

// Initial display of all places
displayPlaces(product);

// Search functionality
document.getElementById('searchBar').addEventListener('keyup', function (e) {
    const searchValue = e.target.value.toLowerCase();
    const filteredData = product.filter(item => item.title.toLowerCase().includes(searchValue));
    displayPlaces(filteredData); // Display only the filtered places
});
