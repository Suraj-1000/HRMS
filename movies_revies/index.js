// Initialize Firebase
const firebaseConfig = {
    // Your Firebase configuration
    apiKey: "YOUR_API_KEY",
    authDomain: "YOUR_AUTH_DOMAIN",
    projectId: "YOUR_PROJECT_ID",
    storageBucket: "YOUR_STORAGE_BUCKET",
    messagingSenderId: "YOUR_MESSAGING_SENDER_ID",
    appId: "YOUR_APP_ID"
  };
  
  firebase.initializeApp(firebaseConfig);
  
  const db = firebase.firestore();
  
  const reviewsContainer = document.getElementById('reviewsContainer');
  const addReviewForm = document.getElementById('addReviewForm');
  
  // Function to fetch reviews from Firestore and display them
  function fetchAndDisplayReviews() {
    db.collection("reviews").orderBy("movieName").get().then((querySnapshot) => {
      reviewsContainer.innerHTML = ''; // Clear previous reviews
      querySnapshot.forEach((doc) => {
        const review = doc.data();
        const reviewElement = document.createElement('div');
        reviewElement.innerHTML = `
          <p><strong>Movie Name:</strong> ${review.movieName}</p>
          <p><strong>Rating:</strong> ${review.rating}</p>
          <p><strong>Director:</strong> ${review.director}</p>
          <p><strong>Release Date:</strong> ${review.releaseDate}</p>
          <button onclick="editReview('${doc.id}')">Edit</button>
          <button onclick="deleteReview('${doc.id}')">Delete</button>
          <hr>
        `;
        reviewsContainer.appendChild(reviewElement);
      });
    });
  }
  
  // Function to add a new review to Firestore
  addReviewForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const movieName = addReviewForm['movieName'].value;
    const rating = parseInt(addReviewForm['rating'].value);
    const director = addReviewForm['director'].value;
    const releaseDate = addReviewForm['releaseDate'].value;
  
    db.collection("reviews").add({
      movieName,
      rating,
      director,
      releaseDate
    })
    .then(() => {
      addReviewForm.reset(); // Clear form fields
      fetchAndDisplayReviews(); // Update reviews list
    })
    .catch((error) => {
      console.error("Error adding document: ", error);
    });
  });
  
  // Function to edit a review
  function editReview(reviewId) {
    const reviewRef = db.collection("reviews").doc(reviewId);
    
    // Retrieve the current review data
    reviewRef.get().then((doc) => {
        if (doc.exists) {
            const review = doc.data();
            const updatedMovieName = prompt("Enter updated movie name:", review.movieName);
            const updatedRating = parseInt(prompt("Enter updated rating (0-5):", review.rating));
            const updatedDirector = prompt("Enter updated director:", review.director);
            const updatedReleaseDate = prompt("Enter updated release date:", review.releaseDate);
            
            // Update the review in Firestore
            return reviewRef.update({
                movieName: updatedMovieName,
                rating: updatedRating,
                director: updatedDirector,
                releaseDate: updatedReleaseDate
            }).then(() => {
                console.log("Review updated successfully!");
                fetchAndDisplayReviews(); // Refresh reviews list
            }).catch((error) => {
                console.error("Error updating review: ", error);
            });
        } else {
            console.log("No such document exists!");
        }
    }).catch((error) => {
        console.error("Error getting document: ", error);
    });
}
  
  // Function to delete a review
  function deleteReview(reviewId) {
    if (confirm("Are you sure you want to delete this review?")) {
      db.collection("reviews").doc(reviewId).delete()
      .then(() => {
          console.log("Review deleted successfully!");
          fetchAndDisplayReviews(); // Refresh reviews list
      })
      .catch((error) => {
          console.error("Error deleting review: ", error);
      });
  }
}
  
  // Initial fetch and display of reviews
  fetchAndDisplayReviews();
  reviewElement.innerHTML = `
    <p><strong>Movie Name:</strong> ${review.movieName}</p>
    <p><strong>Rating:</strong> ${review.rating}</p>
    <p><strong>Director:</strong> ${review.director}</p>
    <p><strong>Release Date:</strong> ${review.releaseDate}</p>
    <button onclick="editReview('${doc.id}')">Edit</button>
    <button onclick="deleteReview('${doc.id}')">Delete</button>
    <hr>
`;