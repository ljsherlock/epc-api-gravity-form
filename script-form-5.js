const API_URL = 'https://dbr.fts.mybluehost.me/api-test.php';

// receive the lmk-key
const searchParams = new URLSearchParams(window.location.search);
const lmkKey = searchParams.get('lmk-key'); //9bdcf905959c0c1cf7a476e8dcc85ba6bc4d150edd2bc0ec566850935e81032f

// call the API to get the data obj
var myHeaders = new Headers();
var epcCertificate;
myHeaders.append("Accept", "application/json");
var requestOptions = {
    method: "GET",
    headers: myHeaders,
    redirect: "follow",
};
fetch(`${API_URL}?lmk-key=${lmkKey}`, requestOptions).then(response => {
    if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
    }
    return response.text();
})
.then(response => {
    console.log(response);

    const data = JSON.parse(response);
    const propertyObj = data.rows[0];

    // console.log('propertyObj', propertyObj);

    // populate address
    document.getElementById("input_5_9_1").value = propertyObj.address1;
    document.getElementById("input_5_9_3").value = propertyObj.posttown;
    document.getElementById("input_5_9_4").value = propertyObj.county;
    document.getElementById("input_5_9_5").value = propertyObj.postcode;

    // populate hidden fields 
    document.getElementById("input_5_13").value = propertyObj['current-energy-rating'];
    document.getElementById("input_5_14").value = propertyObj['local-authority-label'];
    document.getElementById("input_5_15").value = propertyObj['main-fuel'];
    // console.log(JSON.stringify(propertyObj))
    document.getElementById("input_5_31").value = JSON.stringify(propertyObj);
});