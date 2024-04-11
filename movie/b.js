const form = document.querySelector("form");
form.addEventListener("submit", searchMovies);

fetch(`http://www.omdbapi.com/?apikey=b4cdfba7&t="Avatar"`)
  .then((response) => response.json())
  .then((data) => {
    const database = JSON.stringify(data);
    localStorage.setItem("database", database);

    const resultDiv = document.querySelector("#result");
    resultDiv.innerHTML = `
        <h2>Movie Title: ${data.Title}</h2> 
        <p>Rating: ${data.imdbRating}</p>
        <p>Actors: ${data.Actors}</p>
        <p>Released Date: ${data.Released}</p>
      `;
  })
  .catch((error) => console.error(error));
const database = localStorage.getItem("database");
const data = JSON.parse(database);

// Display data in result div if it exists
if (data) {
  const resultDiv = document.querySelector("#result");
  resultDiv.innerHTML = `
   <h2>Movie Title: ${data.Title}</h2> 
    <p>Rating: ${data.imdbRating}</p>
    <p>Actors: ${data.Actors}</p>
    <p>Released Date: ${data.Released}</p>
  `;
}
function searchMovies(event) {
  event.preventDefault();

  const searchInput = document.querySelector("#search");
  const searchQuery = searchInput.value;
  if (searchQuery == "") {
    alert("Please Enter a movie name");
  } else {
    fetch(`http://www.omdbapi.com/?apikey=b4cdfba7&t=${searchQuery}`)
      .then((response) => response.json())
      .then((data) => {
        const database = JSON.stringify(data);
        localStorage.setItem("searchdata", database);

        const resultDiv = document.querySelector("#result");
        resultDiv.innerHTML = `
        <h2>Movie Title: ${data.Title}</h2> 
        <p>Rating: ${data.imdbRating}</p>
        <p>Actors: ${data.Actors}</p>
        <p>Released Date: ${data.Released}</p>
      `;
      })
      .catch((error) => console.error(error));
    const database = localStorage.getItem("searchdata");
    const data = JSON.parse(database);

    // Display data in result div if it exists
    if (searchQuery == data.Title) {
      const resultDiv = document.querySelector("#result");
      resultDiv.innerHTML = `
   <h2>Movie Title: ${data.Title}</h2> 
    <p>Rating: ${data.imdbRating}</p>
    <p>Actors: ${data.Actors}</p>
    <p>Released Date: ${data.Released}</p>
  `;
    } else if (navigator.onLine) {
      if (data) {
        const resultDiv = document.querySelector("#result");
        resultDiv.innerHTML = `
   <h2>Movie Title: ${data.Title}</h2> 
    <p>Rating: ${data.imdbRating}</p>
    <p>Actors: ${data.Actors}</p>
    <p>Released Date: ${data.Released}</p>
  `;
      }
    } else {
      alert(`No Internet. Please search ${data.Title} movie in offline mode`);
    }
  }
}