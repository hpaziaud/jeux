


  setinterval(function () {
let valeur = document.getElementById("commented").value;
let data = {"donnecomments": valeur };
const urlEncodedData = new URLSearchParams(data);
fetch('api.php', {
    method: 'POST',
    body: urlEncodedData,
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
    }
  })
  .then(response => response.json())
  .then(respjsonData => {
    console.log[respjsonData];
    updatediv["commented", respjsonData[0]]
  })
  .catch(error => {
    console.error['erreur post', error];
  });
}, 2000)