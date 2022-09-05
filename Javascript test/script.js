
// api url
const api_url = "http://search-api.fie.future.net.uk/widget.php?id=review&site=TRD&model_name=iPad_Air";
  
getData(api_url);

// Defining async function
async function getData(url) {
    
    // Storing response
    const response = await fetch(url);
    
    // Storing data in form of JSON
    var data = await response.json();
    console.log(data);
    createTable(data);
}
  

// Function to define innerHTML for HTML table
function createTable(data) {
    let table = 
        `<tr>
          <th>Merchant logo</th>
          <th>Merchant name</th>
          <th>Product name</th>
          <th>Product price</th>
          <th>Product affiliate link</th>
         </tr>`;
    
    // Loop to access all rows 
    console.log(data.widget.data.offers);
    for (let r of data.widget.data.offers) {
    table += 
    `<tr> 
        <td><img src="${r.merchant.logo_url}" alt="${r.merchant.name}"> </td>
        <td>${r.merchant.name}</td>
        <td>${r.model}</td> 
        <td>${r.offer.price} ${r.offer.currency_symbol}</td>
        <td><a href="${r.offer.link}">${r.offer.merchant_link_text}</a></td>             
    </tr>`;
    }
    $("#dataTable").append(table)
}