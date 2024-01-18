const API_URL = 'https://www.redrabbitdigital.com/private-api-greenhouse-energy.php';

const btn = document.getElementById("searchPostcode");
const inputElement = document.getElementById("input_3_1");
var select = document.getElementById("input_3_2");
removeOptions(select);
var data;
btn.addEventListener("click", () => {
if (inputElement.value.trim()) {
    document.querySelector("#gform_page_3_2").style.display = "block"
    document.querySelector("#gform_page_3_1").style.display = "none";
    data = fetchAddressFromPostcode(inputElement.value);
    console.log('data', data);
}
});

const goBtn = document.getElementById("selectAddress"); 
goBtn.addEventListener("click", () => {
if (select.value.trim()) {
    document.querySelector("#userAddress").innerHTML = select.value.trim();
    document.getElementById("gform_page_3_2").style.display = "none"
    document.getElementById("gform_page_3_3").style.display = "block";
} 
});

const resetBtn = document.getElementById("restartBTN"); 
resetBtn.addEventListener("click", () => {
if (select.value.trim()) {
    document.getElementById("gform_page_3_1").style.display = "block"
    document.getElementById("gform_page_3_3").style.display = "none";
//   document.querySelector("#address-group").style.display = "none";
} 
removeOptions(document.getElementById('input_3_2'));
});
  
function removeOptions(selectElement) {
    var i, L = selectElement.options.length - 1;
    for(i = L; i >= 0; i--) {
    selectElement.remove(i);
    }
}
  
function fetchAddressFromPostcode(postcode) {
      // Use the actual API endpoint with the postcode directly in the URL
      document.querySelector("#postcodeText").innerHTML = postcode.toUpperCase();
  
      const select = document.getElementById("input_3_2");
      var myHeaders = new Headers();
      myHeaders.append("Accept", "application/json");
      var requestOptions = {
          method: "GET",
          headers: myHeaders,
          redirect: "follow",
      };
  
      // get address from postcode 
      fetch(`${API_URL}?postcode=${postcode.replace(/\s/g, "")}`, requestOptions).then(response => {
          if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
          }
          return response.text();
      })
      .then(response => {
        console.log(JSON.parse(response));
        var data = JSON.parse(response);
  
        var addresses = [];
  
        for (var i=0; i < data.length; i++) {
          console.log(data[i].address)
          var opt = data[i].address;
          addresses[i] = opt;
        }
  
        addresses.sort(function (a, b) {
          var val_a = Number.parseInt(a.replace('Nordmarksvej ', ''));
          var val_b = Number.parseInt(b.replace('Nordmarksvej ', ''));
  
          if (val_a === val_b) {
            return 0;
          }
  
          return val_a > val_b ? 1 : -1
        });
  
  
        console.log('addredsses',addresses);
  
        for (var i=0; i < addresses.length; i++) {
          var opt = addresses[i];
          var el = document.createElement("option");
          el.textContent = opt;
          el.value = opt;
          select.appendChild(el);
        }
  
        // document.querySelector("#address-group").style.display = "flex";
        document.querySelector("#localAuthority").innerHTML = data[0]['constituency-label'];
  
        // needs to be the address selected.
        document.querySelector("#userPostcode").innerHTML = data[0]['postcode'];
        document.querySelector("#userLocalAuthority").innerHTML = data[0]['constituency-label'];
        var lmkKey = data[0]['lmk-key'];

        submitContactBtn.href = submitContactBtn.href + '?lmk-key=' + lmkKey;
        
        return data;    
    });
}