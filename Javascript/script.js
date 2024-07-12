// script.js

fetch('/api/hello')
  .then(response => response.json())
  .then(data => {
    console.log(data.message); // Outputs: Hello from serverless function!
  })
  .catch(error => {
    console.error('Error:', error);
  });
