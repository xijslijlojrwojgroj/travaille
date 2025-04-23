document.addEventListener('DOMContentLoaded', function() {
    // Expanded destination data (in a real application, this would come from a database)
    const destinations = [
      {
        id: 1,
        name: "Goa",
        image: "images/goa.jpg",
        description: "Beautiful beaches and vibrant nightlife",
        rating: 4.5,
        price_category: "mid",
        price_per_day: 3500,
        region: "west",
        category: "beach",
        slug: "goa"
      },
      {
        id: 2,
        name: "Varanasi",
        image: "images/varanasi.jpg",
        description: "Ancient spiritual city on the banks of the Ganges",
        rating: 4.3,
        price_category: "budget",
        price_per_day: 1800,
        region: "north",
        category: "spiritual",
        slug: "varanasi"
      },
      {
        id: 3,
        name: "Jaipur",
        image: "images/jaipur.jpg",
        description: "The Pink City with majestic palaces and forts",
        rating: 4.6,
        price_category: "mid",
        price_per_day: 2500,
        region: "north",
        category: "heritage",
        slug: "jaipur"
      },
      {
        id: 4,
        name: "Kerala Backwaters",
        image: "images/kerala.jpg",
        description: "Serene waterways and lush greenery",
        rating: 4.8,
        price_category: "luxury",
        price_per_day: 6000,
        region: "south",
        category: "nature",
        slug: "kerala-backwaters"
      },
      {
        id: 5,
        name: "Darjeeling",
        image: "images/darjeeling.jpg",
        description: "Scenic hill station famous for tea plantations",
        rating: 4.2,
        price_category: "mid",
        price_per_day: 2800,
        region: "east",
        category: "mountain",
        slug: "darjeeling"
      },
      {
        id: 6,
        name: "Ranthambore National Park",
        image: "images/ranthambore.jpg",
        description: "Famous tiger reserve and wildlife sanctuary",
        rating: 4.4,
        price_category: "luxury",
        price_per_day: 5500,
        region: "central",
        category: "wildlife",
        slug: "ranthambore"
      },
      {
        id: 7,
        name: "Hampi",
        image: "images/hampi.jpg",
        description: "Ancient ruins and boulder-strewn landscape",
        rating: 4.7,
        price_category: "budget",
        price_per_day: 1500,
        region: "south",
        category: "heritage",
        slug: "hampi"
      },
      {
        id: 8,
        name: "Andaman Islands",
        image: "images/andaman.jpg",
        description: "Pristine beaches and coral reefs",
        rating: 4.9,
        price_category: "luxury",
        price_per_day: 7000,
        region: "east",
        category: "beach",
        slug: "andaman-islands"
      },
      {
        id: 9,
        name: "Ladakh",
        image: "images/ladakh.jpg",
        description: "Breathtaking landscapes and Buddhist monasteries",
        rating: 4.8,
        price_category: "mid",
        price_per_day: 3200,
        region: "north",
        category: "mountain",
        slug: "ladakh"
      },
      {
        id: 10,
        name: "Munnar",
        image: "images/munnar.jpg",
        description: "Lush tea plantations and misty hills",
        rating: 4.6,
        price_category: "budget",
        price_per_day: 1900,
        region: "south",
        category: "mountain",
        slug: "munnar"
      },
      {
        id: 11,
        name: "Udaipur",
        image: "images/udaipur.jpg",
        description: "City of lakes with romantic palaces",
        rating: 4.7,
        price_category: "mid",
        price_per_day: 2900,
        region: "west",
        category: "heritage",
        slug: "udaipur"
      },
      {
        id: 12,
        name: "Rishikesh",
        image: "images/rishikesh.jpg",
        description: "Yoga capital and adventure sports hub",
        rating: 4.5,
        price_category: "budget",
        price_per_day: 1700,
        region: "north",
        category: "spiritual",
        slug: "rishikesh"
      },
      {
        id: 13,
        name: "Agra",
        image: "images/agra.jpg",
        description: "Home of the iconic Taj Mahal",
        rating: 4.4,
        price_category: "budget",
        price_per_day: 1800,
        region: "north",
        category: "heritage",
        slug: "agra"
      },
      {
        id: 14,
        name: "Amritsar",
        image: "images/amritsar.jpg",
        description: "Home to the Golden Temple and Punjabi culture",
        rating: 4.6,
        price_category: "budget",
        price_per_day: 1600,
        region: "north",
        category: "spiritual",
        slug: "amritsar"
      },
      {
        id: 15,
        name: "Ooty",
        image: "images/ooty.jpg",
        description: "Queen of hill stations with pleasant climate",
        rating: 4.3,
        price_category: "budget",
        price_per_day: 1900,
        region: "south",
        category: "mountain",
        slug: "ooty"
      },
      {
        id: 16,
        name: "Jim Corbett National Park",
        image: "images/corbett.jpg",
        description: "Oldest national park in India with diverse wildlife",
        rating: 4.5,
        price_category: "mid",
        price_per_day: 3800,
        region: "north",
        category: "wildlife",
        slug: "jim-corbett"
      },
      {
        id: 17,
        name: "Kovalam",
        image: "images/kovalam.jpg",
        description: "Crescent-shaped beaches and Ayurvedic resorts",
        rating: 4.4,
        price_category: "mid",
        price_per_day: 2700,
        region: "south",
        category: "beach",
        slug: "kovalam"
      },
      {
        id: 18,
        name: "Mysore",
        image: "images/mysore.jpg",
        description: "City of palaces and cultural heritage",
        rating: 4.3,
        price_category: "budget",
        price_per_day: 1700,
        region: "south",
        category: "heritage",
        slug: "mysore"
      }
    ];
  
    // Function to render destination cards with improved handling
    function renderDestinations(destinationsToRender) {
      const grid = document.getElementById('destinations-grid');
      grid.innerHTML = '';
      
      if (destinationsToRender.length === 0) {
        grid.innerHTML = '<div class="no-results">No destinations match your filters. Try adjusting your criteria.</div>';
        return;
      }
      
      destinationsToRender.forEach(destination => {
        const priceClass = destination.price_category === 'budget' ? 'budget' : 
                           destination.price_category === 'mid' ? 'mid-range' : 'luxury';
        
        const priceText = destination.price_category === 'budget' ? 'Budget Friendly' : 
                         destination.price_category === 'mid' ? 'Mid-range' : 'Luxury';
        
        const card = document.createElement('div');
        card.className = 'destination-card';
        card.dataset.id = destination.id;
        
        card.innerHTML = `
          <img src="${destination.image}" alt="${destination.name}" class="card-image">
          <div class="card-content">
            <div class="card-title">${destination.name}</div>
            <p>${destination.description}</p>
            <div class="card-details">
              <div class="card-detail">
                <span class="rating">★</span> ${destination.rating.toFixed(1)}
              </div>
              <div class="card-detail">
                <span class="price-indicator ${priceClass}">${priceText}</span>
                <span> - ₹${destination.price_per_day}/day</span>
              </div>
              <div class="card-category">${capitalizeFirstLetter(destination.category)}</div>
            </div>
          </div>
        `;
        
        card.addEventListener('click', function() {
          window.location.href = `destination-detail.html?id=${destination.slug}`;
        });
        
        grid.appendChild(card);
      });
    }
    
    function capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    }
  
    // Enhanced filter destinations function with better handling
    function filterDestinations() {
      const priceFilter = document.getElementById('price-range').value;
      const ratingFilter = parseFloat(document.getElementById('rating').value);
      const regionFilter = document.getElementById('region').value;
      const categoryFilter = document.getElementById('category').value;
      
      // Start with all destinations
      let filtered = [...destinations];
      
      // Apply price filter if selected
      if (priceFilter !== 'all') {
        filtered = filtered.filter(dest => dest.price_category === priceFilter);
      }
      
      // Apply rating filter if selected
      if (!isNaN(ratingFilter)) {
        filtered = filtered.filter(dest => dest.rating >= ratingFilter);
      }
      
      // Apply region filter if selected
      if (regionFilter !== 'all') {
        filtered = filtered.filter(dest => dest.region === regionFilter);
      }
      
      // Apply category filter if selected
      if (categoryFilter !== 'all') {
        filtered = filtered.filter(dest => dest.category === categoryFilter);
      }
      
      // Show filter results summary
      const resultsCount = filtered.length;
      const summaryElement = document.getElementById('filter-summary');
      if (summaryElement) {
        summaryElement.textContent = `Showing ${resultsCount} destination${resultsCount !== 1 ? 's' : ''}`;
      }
      
      // Render the filtered destinations
      renderDestinations(filtered);
    }
  
    // Function to reset all filters
    function resetFilters() {
      document.getElementById('price-range').value = 'all';
      document.getElementById('rating').value = 'all';
      document.getElementById('region').value = 'all';
      document.getElementById('category').value = 'all';
      
      renderDestinations(destinations);
      
      const summaryElement = document.getElementById('filter-summary');
      if (summaryElement) {
        summaryElement.textContent = `Showing ${destinations.length} destinations`;
      }
    }
  
    // Add event listeners
    document.getElementById('apply-filters').addEventListener('click', filterDestinations);
    
    // Add reset filters button functionality
    const resetButton = document.getElementById('reset-filters');
    if (resetButton) {
      resetButton.addEventListener('click', resetFilters);
    }
    
    // Initial render of all destinations
    renderDestinations(destinations);
    
    // Set initial summary
    const summaryElement = document.getElementById('filter-summary');
    if (summaryElement) {
      summaryElement.textContent = `Showing ${destinations.length} destinations`;
    }
  });