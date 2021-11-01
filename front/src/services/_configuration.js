let configuration = {};


// WARNING change here to bypass backen url
if(document.location.hash.match(/local/)) {
   configuration = {
    backendBaseURI: 'http://localhost/foodtrotter/back/public'
  }
}
else {
  configuration = {
    backendBaseURI: 'http://ec2-54-208-240-29.compute-1.amazonaws.com/projet-food-trotter-back/public'
  }
}

configuration = {
  backendBaseURI: 'http://localhost/foodtrotter/back/public'
}


export default configuration;
